<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación en dos pasos</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/login.css', 'resources/css/app.css'])
</head>
<body>
    <div class="animated-background">
        <img src="{{ asset('img/fondo.png') }}" alt="Fondo animado">
    </div>

    <div class="wrapper">
        <div class="login-content-wrapper">
            <!-- LOGO -->
            <div class="logo-container">
                <img src="{{ asset('img/artwork 1.png') }}" alt="Logo" class="logo-image">
            </div>

            <!-- Mensajes -->
            @if(session('resent'))
                <div class="alert alert-success">
                    Se ha enviado un nuevo código de verificación
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- FORMULARIO -->
            <form method="POST" action="{{ route('2fa.verify') }}">
                @csrf

                <div class="welcome-box">
                    <p class="welcome-text">Verificación en dos pasos</p>
                </div>

                <div class="form-group">
                    <label for="two_factor_code">Código de verificación</label>
                    <input type="text" id="two_factor_code" name="two_factor_code" maxlength="6" required autofocus>
                </div>

                <div class="buttons-container">
                    <button type="submit" class="btn btn-login">Verificar</button>
                </div>

                <div class="form-footer">
                    <p>¿No recibiste el código? <a href="{{ route('2fa.resend') }}">Reenviar código</a></p>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-link">Cancelar y salir</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</body>
</html>