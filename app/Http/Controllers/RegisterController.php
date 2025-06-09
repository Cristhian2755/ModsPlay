<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // asegúrate de tener la vista auth/register.blade.php
    }

    public function register(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Crear el usuario
        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Loguear al usuario
        auth()->login($user);

        // Redirigir
        return redirect()->route('home'); // o a donde quieras redirigir después del registro
    }
}
