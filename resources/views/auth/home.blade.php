<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ModsPlay - Home</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />

    <!-- CSS -->
    @vite(['resources/css/home.css',
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="main-nav">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/artwork 1.png') }}" alt="ModsPlay Logo">
                </a>
            </div>
            
            <div class="nav-search">
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="q" placeholder="Search mods, games, users..." class="search-input">
                    <button type="submit" class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            
            <div class="nav-links">
                <a href="{{ route('browse') }}" class="nav-link">Browse</a>
                <a href="{{ route('upload') }}" class="nav-link">Upload</a>
                <a href="{{ route('community') }}" class="nav-link">Community</a>
                <div class="user-dropdown">
                    <button class="user-button">
                        <img src="{{ Auth::user()->avatar ?? asset('img/default-avatar.png') }}" alt="User Avatar" class="user-avatar">
                        <span>{{ Auth::user()->name ?? 'Guest' }}</span>
                    </button>
                    <div class="dropdown-content">
                        @auth
                            <a href="{{ route('profile') }}">Profile</a>
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                            <a href="{{ route('logout') }}">Logout</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-wrapper">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <h1>Discover and Share Game Mods</h1>
                <p>Join our community of modders and gamers to enhance your gaming experience</p>
                <div class="hero-buttons">
                    <a href="{{ route('browse') }}" class="btn btn-primary">Browse Mods</a>
                    <a href="{{ route('upload') }}" class="btn btn-secondary">Upload Your Mod</a>
                </div>
            </div>
        </section>

        <!-- Featured Mods Section -->
        <section class="featured-section">
            <h2 class="section-title">Featured Mods</h2>
            <div class="mods-grid">
                @foreach($featuredMods as $mod)
                <div class="mod-card">
                    <div class="mod-thumbnail">
                        <img src="{{ asset($mod->thumbnail) }}" alt="{{ $mod->title }}">
                        <div class="mod-views">
                            <i class="fas fa-eye"></i> {{ $mod->views }}
                        </div>
                    </div>
                    <div class="mod-info">
                        <h3><a href="{{ route('mods.show', $mod->slug) }}">{{ $mod->title }}</a></h3>
                        <div class="mod-author">
                            by <a href="{{ route('users.show', $mod->author->username) }}">{{ $mod->author->name }}</a>
                        </div>
                        <div class="mod-stats">
                            <span class="mod-downloads"><i class="fas fa-download"></i> {{ $mod->downloads }}</span>
                            <span class="mod-likes"><i class="fas fa-heart"></i> {{ $mod->likes }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Categories Section -->
        <section class="categories-section">
            <h2 class="section-title">Popular Categories</h2>
            <div class="categories-grid">
                <a href="{{ route('browse.category', 'games') }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <h3>Games</h3>
                </a>
                <a href="{{ route('browse.category', 'characters') }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-user-astronaut"></i>
                    </div>
                    <h3>Characters</h3>
                </a>
                <a href="{{ route('browse.category', 'skins') }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h3>Skins</h3>
                </a>
                <a href="{{ route('browse.category', 'maps') }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-map"></i>
                    </div>
                    <h3>Maps</h3>
                </a>
                <a href="{{ route('browse.category', 'tools') }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>Tools</h3>
                </a>
                <a href="{{ route('browse.category', 'audio') }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-music"></i>
                    </div>
                    <h3>Audio</h3>
                </a>
            </div>
        </section>

        <!-- Recent Activity Section -->
        <section class="activity-section">
            <div class="activity-container">
                <div class="recent-activity">
                    <h2 class="section-title">Recent Activity</h2>
                    <div class="activity-feed">
                        @foreach($recentActivity as $activity)
                        <div class="activity-item">
                            <img src="{{ asset($activity->user->avatar) }}" alt="{{ $activity->user->name }}" class="activity-avatar">
                            <div class="activity-content">
                                <p>
                                    <a href="{{ route('users.show', $activity->user->username) }}">{{ $activity->user->name }}</a>
                                    {{ $activity->description }}
                                    @if($activity->mod)
                                        <a href="{{ route('mods.show', $activity->mod->slug) }}">{{ $activity->mod->title }}</a>
                                    @endif
                                </p>
                                <small class="activity-time">{{ $activity->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="top-mods">
                    <h2 class="section-title">Top Mods This Week</h2>
                    <div class="top-mods-list">
                        @foreach($topMods as $index => $mod)
                        <div class="top-mod-item">
                            <span class="mod-rank">{{ $index + 1 }}</span>
                            <div class="mod-details">
                                <h3><a href="{{ route('mods.show', $mod->slug) }}">{{ $mod->title }}</a></h3>
                                <div class="mod-author">
                                    by <a href="{{ route('users.show', $mod->author->username) }}">{{ $mod->author->name }}</a>
                                </div>
                                <div class="mod-stats">
                                    <span class="mod-downloads"><i class="fas fa-download"></i> {{ $mod->downloads }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-columns">
                <div class="footer-column">
                    <h4>About ModsPlay</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Community Guidelines</a></li>
                        <li><a href="#">Modding Tutorials</a></li>
                        <li><a href="#">Safety</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                        <li><a href="#">DMCA</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Connect</h4>
                    <div class="social-icons">
                        <a href="#" aria-label="Discord"><i class="fab fa-discord"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="newsletter">
                        <h5>Subscribe to our newsletter</h5>
                        <form class="newsletter-form">
                            <input type="email" placeholder="Your email">
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} ModsPlay. All rights reserved.</p>
                <div class="footer-links">
                    <a href="#">Terms</a>
                    <a href="#">Privacy</a>
                    <a href="#">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
    @vite('resources/js/app.js')
</body>
</html>