<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validación mejorada
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u', // Solo letras y espacios
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', // Al menos 1 mayúscula, 1 minúscula y 1 número
        ], [
            'password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula y un número.'
        ]);

        // Creación del usuario con Hash
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Autenticación
        Auth::login($user);

        // Redirección con mensaje flash
        return redirect()->route('home')->with('success', '¡Registro exitoso! Bienvenido a ModsPlay');
    }
}