<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iniciar Sesión - ModsPlay</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- CSS -->
    @vite(['resources/css/login.css',
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
        <div class="login-content-wrapper">
            <!-- LOGO -->
            <div class="logo-container">
                <img src="{{ asset('img/artwork 1.png') }}" alt="Logo" class="logo-image">
            </div>

            <!-- FORMULARIO -->
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <div class="welcome-box">
                    <p class="welcome-text">Iniciar Sesión</p>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="remember"> Recuérdame
                    </label>
                </div>

                <div class="buttons-container">
                    <button type="submit" class="btn btn-login">Entrar</button>
                    <a href="{{ route('register') }}" class="btn btn-signin">Regístrate</a>
                </div>

                <div class="form-group" style="margin-top: 1.5rem; text-align: center;">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="color: #99ccff;">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>
            </form>  
        </div>
    </div>
</body>
</html>