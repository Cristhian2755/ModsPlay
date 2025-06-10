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
    @vite([
        'resources/css/home.css',
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
                    <a href="{{ route('browse') }}" class="btn btn-primary">Explore Content</a>
                    <a href="{{ route('upload') }}" class="btn btn-secondary">Upload Your Creation</a>
                </div>
            </div>
        </section>

        <!-- Featured Mods -->
        <section class="featured-section">
            <h2 class="section-title">Featured Mods</h2>
            <div class="mods-grid">
                @foreach($featuredMods as $mod)
                <div class="mod-card">
                    <div class="mod-thumbnail">
                        <img src="{{ asset($mod->thumbnail) }}" alt="{{ $mod->title }}">
                        <div class="mod-views"><i class="fas fa-eye"></i> {{ $mod->views }}</div>
                    </div>
                    <div class="mod-info">
                        <h3><a href="{{ route('mods.show', $mod->slug) }}">{{ $mod->title }}</a></h3>
                        <div class="mod-author">by <a href="{{ route('users.show', $mod->author->username) }}">{{ $mod->author->name }}</a></div>
                        <div class="mod-stats">
                            <span><i class="fas fa-download"></i> {{ $mod->downloads }}</span>
                            <span><i class="fas fa-heart"></i> {{ $mod->likes }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Trending Section -->
        <section class="trending-section">
            <h2 class="section-title">🔥 Trending Today</h2>
            <div class="mods-grid">
                @foreach($trending as $mod)
                <div class="mod-card">
                    <div class="mod-thumbnail">
                        <img src="{{ asset($mod->thumbnail) }}" alt="{{ $mod->title }}">
                        <div class="mod-views"><i class="fas fa-eye"></i> {{ $mod->views }}</div>
                    </div>
                    <div class="mod-info">
                        <h3><a href="{{ route('mods.show', $mod->slug) }}">{{ $mod->title }}</a></h3>
                        <div class="mod-author">by <a href="{{ route('users.show', $mod->author->username) }}">{{ $mod->author->name }}</a></div>
                        <div class="mod-stats">
                            <span><i class="fas fa-download"></i> {{ $mod->downloads }}</span>
                            <span><i class="fas fa-heart"></i> {{ $mod->likes }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Recommended Section -->
        <section class="recommended-section">
            <h2 class="section-title">🌟 Community Picks</h2>
            <div class="mods-grid">
                @foreach($recommended as $mod)
                <div class="mod-card">
                    <div class="mod-thumbnail">
                        <img src="{{ asset($mod->thumbnail) }}" alt="{{ $mod->title }}">
                    </div>
                    <div class="mod-info">
                        <h3><a href="{{ route('mods.show', $mod->slug) }}">{{ $mod->title }}</a></h3>
                        <div class="mod-author">by <a href="{{ route('users.show', $mod->author->username) }}">{{ $mod->author->name }}</a></div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Popular Categories -->
        <section class="categories-section">
            <h2 class="section-title">Popular Categories</h2>
            <div class="categories-grid">
                @foreach($categories as $category)
                <a href="{{ route('browse.category', $category->slug) }}" class="category-card">
                    <div class="category-icon"><i class="fas fa-tag"></i></div>
                    <h3>{{ $category->name }}</h3>
                </a>
                @endforeach
            </div>
        </section>

        <!-- Community Activity -->
        <section class="activity-section">
            <div class="activity-container">
                <div class="recent-activity">
                    <h2 class="section-title">🧑‍🤝‍🧑 Community Activity</h2>
                    <div class="activity-feed">
                        @foreach($recentComments as $comment)
                        <div class="activity-item">
                            <img src="{{ asset($comment->user->avatar) }}" alt="{{ $comment->user->name }}" class="activity-avatar">
                            <div class="activity-content">
                                <p>
                                    <a href="{{ route('users.show', $comment->user->username) }}">{{ $comment->user->name }}</a>
                                    commented on
                                    <a href="{{ route('mods.show', $comment->mod->slug) }}">{{ $comment->mod->title }}</a>
                                </p>
                                <small class="activity-time">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="top-mods">
                    <h2 class="section-title">🏆 Top Mods This Week</h2>
                    <div class="top-mods-list">
                        @foreach($topMods as $index => $mod)
                        <div class="top-mod-item">
                            <span class="mod-rank">{{ $index + 1 }}</span>
                            <div class="mod-details">
                                <h3><a href="{{ route('mods.show', $mod->slug) }}">{{ $mod->title }}</a></h3>
                                <div class="mod-author">by <a href="{{ route('users.show', $mod->author->username) }}">{{ $mod->author->name }}</a></div>
                                <div class="mod-stats"><i class="fas fa-download"></i> {{ $mod->downloads }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- News / Blog -->
        <section class="news-section">
            <h2 class="section-title">📰 Latest News</h2>
            <div class="mods-grid">
                @foreach($news as $article)
                <div class="mod-card">
                    <div class="mod-info">
                        <h3><a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a></h3>
                        <div class="mod-author">by {{ $article->author->name }}</div>
                        <p>{{ Str::limit($article->content, 100) }}</p>
                    </div>
                </div>
                @endforeach
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
                        <a href="#"><i class="fab fa-discord"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
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
