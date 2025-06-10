<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Mail\TwoFactorCodeMail;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesa el intento de login
     */
    public function login(Request $request)
    {
        // Validación de campos
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Intento de autenticación
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            $this->generateAndSendTwoFactorCode($user);

            return redirect()->route('2fa.challenge');
        }

        // Si falla la autenticación
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Genera y envía el código 2FA
     */
    protected function generateAndSendTwoFactorCode($user)
    {
        $code = rand(100000, 999999);
        
        $user->update([
            'two_factor_code' => $code,
            'two_factor_expires_at' => Carbon::now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new TwoFactorCodeMail($code));
    }

    /**
     * Muestra el formulario 2FA
     */
    public function showTwoFactorForm()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        if (!$user->two_factor_code) {
            return redirect()->route('home');
        }

        return view('auth.twofactor');
    }

    /**
     * Verifica el código 2FA
     */
    public function verifyTwoFactor(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required|numeric|digits:6',
        ]);

        $user = $request->user();

        // Verifica si existe código
        if (!$user->two_factor_code) {
            return redirect()->route('login')->withErrors([
                'email' => 'Por favor inicia sesión nuevamente.'
            ]);
        }

        // Verifica expiración
        if (Carbon::parse($user->two_factor_expires_at)->lt(now())) {
            $this->generateAndSendTwoFactorCode($user);
            return back()->withErrors([
                'two_factor_code' => 'El código ha expirado. Se ha enviado uno nuevo.'
            ])->withInput();
        }

        // Verifica coincidencia
        if ($request->two_factor_code != $user->two_factor_code) {
            return back()->withErrors([
                'two_factor_code' => 'El código que ingresaste es incorrecto.'
            ])->withInput();
        }

        // Autenticación exitosa
        $user->update([
            'two_factor_code' => null,
            'two_factor_expires_at' => null,
            'two_factor_verified_at' => now(),
        ]);

        return redirect()->intended(route('home'));
    }

    /**
     * Reenvía el código 2FA
     */
    public function resendTwoFactorCode(Request $request)
    {
        $user = $request->user();
        
        if ($user->two_factor_code && Carbon::parse($user->two_factor_expires_at)->gt(now())) {
            return back()->withErrors([
                'two_factor_code' => 'Debes esperar a que el código actual expire.'
            ]);
        }

        $this->generateAndSendTwoFactorCode($user);

        return back()->with('resent', true);
    }

    /**
     * Cierra la sesión
     */
    public function logout(Request $request)
    {
        // Limpia los códigos 2FA
        if (Auth::check()) {
            Auth::user()->update([
                'two_factor_code' => null,
                'two_factor_expires_at' => null,
            ]);
        }

        // Cierra sesión
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}