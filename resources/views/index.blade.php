<!-- resources/views/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basics test</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <style>
        /* Custom navbar styles */
        .navbar {
            background-color: #343a40; /* Dark background color */
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .nav-link {
            color: #fff !important;
            padding: 0.5rem 1rem;
        }
        .dropdown-menu {
            background-color: #343a40;
        }
        .dropdown-item {
            color: #fff !important;
        }
        .dropdown-item:hover {
            background-color: #495057;
        }
        .dropdown-divider {
            border-color: #495057;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Grammlearn</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @if (Route::has('login'))
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/materi') }}">materi</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                        <!-- Bootstrap Dropdown for User Settings -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item disabled" href="#">Points: {{ Auth::user()->points }}</a>
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
            <h1>Quiz</h1>
        </div>
        <div class="card-container">
            @foreach ($categories as $category)
                @php
                    $pointsRequired = $category->required_points;
                @endphp

                @if (Auth::check() && Auth::user()->unlockedCategories->contains($category->id))
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->title }}</h5>
                            <p class="card-text">{{ $category->description }}</p>
                            <a href="{{ route('grammar.quiz.showQuestion', ['category' => $category->slug, 'questionIndex' => 1]) }}" class="btn btn-primary" aria-label="Learn">Learn</a>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->title }}</h5>
                            <p class="card-text">{{ $category->description }}</p>
                            @if (Auth::check())
                                @if (Auth::user()->points >= $pointsRequired)
                                    <form id="unlockCategoryForm" action="{{ route('unlock.category') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="category" value="{{ $category->slug }}">
                                        <button type="button" class="btn btn-warning unlock-category-btn" data-category="{{ $category->slug }}" data-points-required="{{ $pointsRequired }}" aria-label="Unlock">Unlock ({{ $pointsRequired }} points)</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary" disabled aria-label="Locked">Locked (Requires {{ $pointsRequired }} points)</button>
                                @endif
                            @else
                                <button class="btn btn-secondary" disabled aria-label="Locked">Locked (Requires {{ $pointsRequired }} points - Please log in)</button>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <!-- Modal for Confirmation -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Unlock Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to unlock this category? This will cost <span id="pointsRequired"></span> points.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmUnlockBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <form id="unlockCategoryForm" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle click on unlock button
            $('.unlock-category-btn').click(function() {
                var categorySlug = $(this).data('category');
                var pointsRequired = $(this).data('points-required');

                // Display the required points in the modal
                $('#pointsRequired').text(pointsRequired);

                // Store the category slug in the modal for use when confirming
                $('#confirmationModal').data('category', categorySlug).modal('show');
            });

            // Handle click on confirm button in modal
            $('#confirmUnlockBtn').click(function() {
                var categorySlug = $('#confirmationModal').data('category');

                // Set the action of the form and submit it
                var $form = $('#unlockCategoryForm');
                $form.attr('action', '/unlock-category').append('<input type="hidden" name="category" value="' + categorySlug + '">');
                $form.submit();
            });
        });
    </script>

</body>
</html>
