<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Restablecer Contraseña - ModsPlay</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- CSS -->
    @vite(['resources/css/reset-password.css',
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>
<body>
    <!-- Fondo animado -->
    <div class="animated-background">
        <img src="{{ asset('img/fondo.png') }}" alt="Fondo animado">
    </div>

    <div class="wrapper">
        <div class="reset-content-wrapper">
            <!-- LOGO -->
            <div class="logo-container">
                <img src="{{ asset('img/artwork 1.png') }}" alt="Logo ModsPlay" class="logo-image">
            </div>

            <!-- FORMULARIO -->
            <form method="POST" action="{{ route('password.update') }}" class="reset-form">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="welcome-box">
                    <p class="welcome-text">Restablecer Contraseña</p>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nueva Contraseña -->
                <div class="form-group">
                    <label for="password">Nueva Contraseña</label>
                    <input type="password" id="password" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div class="form-group">
                    <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                </div>

                <!-- Botón -->
                <div class="button-container">
                    <button type="submit" class="btn btn-reset">Restablecer Contraseña</button>
                </div>

                <!-- Enlace a login -->
                <div class="form-footer">
                    <a href="{{ route('login') }}" class="login-link">Volver al Inicio de Sesión</a>
                </div>
            </form>  
        </div>
    </div>
</body>
</html>