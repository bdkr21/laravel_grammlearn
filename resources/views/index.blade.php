<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basics test</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Grammlearn</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @if (Route::has('login'))
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                        <!-- Bootstrap Dropdown for User Settings -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">Log in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/register') }}">Sign up</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            @endif
        </div>
    </nav>

    <div class="container">
        <div class="text-center my-4">
            <h1>Basics</h1>
        </div>
        <div class="card-container">
            @php
                $categories = [
                    ['title' => 'Animals', 'description' => 'Learn: dog, cat, bear, lion,...', 'image' => 'url_to_image1', 'slug' => 'animals', 'pointsRequired' => 0],
                    ['title' => 'Food', 'description' => 'Learn: bread, milk, pasta,...', 'image' => 'url_to_image2', 'slug' => 'food', 'pointsRequired' => 150],
                    ['title' => 'Clothes', 'description' => 'Learn: dress, shirt, hat,...', 'image' => 'url_to_image3', 'slug' => 'clothes', 'pointsRequired' => 200],
                    // Tambahkan kategori lain di sini
                ];
            @endphp

            @foreach ($categories as $category)
                @if (Auth::check() && Auth::user()->points >= $category['pointsRequired'])
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category['title'] }}</h5>
                            <p class="card-text">{{ $category['description'] }}</p>
                            <a href="{{ route('grammar.quiz', ['category' => strtolower($category['slug'])]) }}" class="btn btn-primary" aria-label="Learn">Learn</a>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category['title'] }}</h5>
                            <p class="card-text">{{ $category['description'] }}</p>
                            @if (Auth::check())
                                <button class="btn btn-secondary" disabled aria-label="Locked">Locked (Requires {{ $category['pointsRequired'] }} points)</button>
                            @else
                                <button class="btn btn-secondary" disabled aria-label="Locked">Locked (Requires {{ $category['pointsRequired'] }} points - Please log in)</button>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
