<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko - Redeem Points</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex items-center justify-between">
        <a class="text-white font-bold text-xl" href="{{ url('/') }}">Grammlearn</a>
        <button class="text-white focus:outline-none md:hidden" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <div class="hidden md:flex md:items-center md:space-x-6" id="navbarNav">
            @if (Route::has('login'))
                <ul class="flex space-x-4 ml-auto">
                    <li class="nav-item">
                        <a class="text-white hover:text-gray-400" href="{{ url('/shop') }}">Toko</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-white hover:text-gray-400" href="{{ url('/courses') }}">Materi</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="text-white hover:text-gray-400" href="{{ url('/daily-mission/quiz') }}">Daily Mission</a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white hover:text-gray-400" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="relative">
                            <button class="text-white hover:text-gray-400 focus:outline-none" id="navbarDropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20 hidden" aria-labelledby="navbarDropdown">
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-default" href="#">Points: {{ Auth::user()->points }}</a>
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('profile.edit') }}">Profile</a>
                                <div class="border-t border-gray-200"></div>
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="text-white hover:text-gray-400" href="{{ url('/login') }}">Log in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="text-white hover:text-gray-400" href="{{ url('/register') }}">Sign up</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            @endif
        </div>
    </div>
</nav>

<!-- Konten Toko -->
<div class="container mx-auto p-5">
    <h1 class="text-2xl font-bold mb-5">Toko</h1>
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-5">
            {{ session('error') }}
        </div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($items as $item)
        <div class="bg-white shadow-md rounded-lg p-4 relative">
            <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-full h-48 object-cover mb-4 rounded">
            <h2 class="text-xl font-bold">{{ $item->name }}</h2>
            <p class="text-gray-600">{{ $item->description }}</p>
            <div class="mt-4 flex items-center justify-between">
                <span class="text-lg font-bold">{{ $item->price }} Points</span>
                <form action="{{ route('shop.buy', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="buy-button bg-blue-500 text-white px-4 py-2 rounded">Beli</button>
                </form>
            </div>
            <span class="absolute top-0 right-0 m-2 bg-yellow-400 text-black px-2 py-1 rounded">New</span> <!-- Label New -->
        </div>
        @endforeach
    </div>
</div>

<!-- SweetAlert JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    // Toggle dropdown
    document.getElementById('navbarDropdown').addEventListener('click', function () {
        var dropdown = this.nextElementSibling;
        dropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    window.addEventListener('click', function (e) {
        if (!e.target.matches('#navbarDropdown')) {
            var dropdowns = document.getElementsByClassName('dropdown-menu');
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('hidden')) {
                    openDropdown.classList.add('hidden');
                }
            }
        }
    });

    // Konfirmasi pembelian menggunakan SweetAlert
    document.querySelectorAll('.buy-button').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            var form = this.closest('form');
            swal({
                title: "Are you sure?",
                text: "Do you want to redeem this item with your points?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willBuy) => {
                if (willBuy) {
                    form.submit();
                }
            });
        });
    });

    // Toastr notification for session messages
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>

</body>
</html>
