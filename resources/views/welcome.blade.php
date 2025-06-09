<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ModsPlay</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- CSS -->
    @vite(['resources/css/welcome.css',
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>
<body>
    <!-- Fondo animado -->
    <div class="animated-background">
        <img src="{{ asset('img/Loop Wave GIF by Matthew Butler.gif') }}" alt="Animated Background" class="background-gif">
    </div>

    <div class="wrapper">
        <main class="login-main-content">
            <div class="login-content-wrapper">
                <img src="{{ asset('img/artwork 1.png') }}" alt="Logo" class="logo-image"><br>

                <div class="welcome-box">
                    <h1 class="welcome-text">WELCOME</h1>
                </div>


                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="email">Nombre de Usuario</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="buttons-container">
                        <button type="submit" class="btn btn-login">Login</button>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-signin">Sign In</a>
                        @endif
                    </div>
                </form>

        </main>

        <footer class="site-footer">
            <div class="footer-columns">
                <div class="footer-column">
                    <h4>Quiénes somos</h4>
                    <ul>
                        <li><a href="#">Nuestras librerías</a></li>
                        <li><a href="#">Contáctanos</a></li>
                        <li><a href="#">Misión</a></li>
                        <li><a href="#">Visión</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Ayuda</h4>
                    <ul>
                        <li><a href="#">Devoluciones</a></li>
                        <li><a href="#">Pedidos</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Información legal</h4>
                    <ul>
                        <li><a href="#">Política de privacidad</a></li>
                        <li><a href="#">Condiciones de uso</a></li>
                    </ul>
                </div>
                <div class="footer-column social-media-column">
                    <div class="social-icons-container">
                        <a href="#" aria-label="Instagram"><img src="{{ asset('img/InstagramLogo.png') }}" alt="Instagram"></a>
                        <a href="#" aria-label="Twitter"><img src="{{ asset('img/TwitterLogo.png') }}" alt="Twitter"></a>
                        <a href="#" aria-label="Facebook"><img src="{{ asset('img/FacebookLogo.png') }}" alt="Facebook"></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
</body>
</html>