<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verificar Email - ModsPlay</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- CSS -->
    @vite(['resources/css/verify-email.css',
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>
<body>
    <!-- Fondo animado -->
    <div class="animated-background">
        <img src="{{ asset('img/fondo.png') }}" alt="Fondo animado">
    </div>

    <div class="verify-email-container">
        <div class="verify-email-card">
            <!-- Logo -->
            <div class="logo-container">
                <img src="{{ asset('img/artwork 1.png') }}" alt="Logo ModsPlay" class="logo-image">
            </div>

            <!-- Título -->
            <div class="verify-email-header">
                <h1>Verifica tu dirección de email</h1>
            </div>

            <!-- Mensaje -->
            <div class="verify-email-message">
                @if (session('status') == 'verification-link-sent')
                    <div class="alert-success">
                        Se ha enviado un nuevo enlace de verificación a tu dirección de email.
                    </div>
                @endif

                <p>Antes de continuar, por favor verifica tu email con el enlace que te hemos enviado.</p>
                <p>Si no recibiste el email, haz clic en el botón para solicitar uno nuevo.</p>
            </div>

            <!-- Formulario -->
            <div class="verify-email-form">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-resend">Reenviar Email de Verificación</button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>