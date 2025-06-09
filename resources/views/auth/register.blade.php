<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    @vite(['resources/css/register.css',
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>
<body>

    <!-- Fondo animado -->
    <div class="animated-background">
        <img src="{{ asset('img/fondo.png') }}" alt="Fondo animado">
    </div>

    <div class="background"></div>

        <div class="container">
            <div class="form-box">
                <form method="POST" action="{{ route('register') }}">
                @csrf
                <h2>Registro</h2>

                <!-- Nombre -->
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Correo -->
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirmar contraseña -->
                <div class="form-group">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>

                <!-- Enlace y botón -->
                <div class="form-footer btn-group">
                    <a class="login-link" href="{{ route('login') }}">¿Ya estás registrado?</a>
                    <button type="submit">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
