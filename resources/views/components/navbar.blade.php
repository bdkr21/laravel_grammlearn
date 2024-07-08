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
                        <a class="text-white hover:text-gray-400" href="{{ url('/courses') }}">materi</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="text-white hover:text-gray-400" href="{{ url('/daily-mission/quiz') }}">Daily Mission</a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white hover:text-gray-400" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                        <!-- Tailwind Dropdown for User Settings -->
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
</script>
