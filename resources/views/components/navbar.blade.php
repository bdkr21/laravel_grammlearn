<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex items-center justify-between">
        <div class="flex items-center">
            <a class="text-white font-bold text-xl" href="{{ url('/') }}">Grammlearn</a>
            <button class="text-white focus:outline-none md:hidden ml-4" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" @click="isOpen = !isOpen">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <div class="hidden md:flex md:items-center md:space-x-6 ml-6" :class="{ 'block': isOpen, 'hidden': !isOpen }" id="navbarNav">
                @if (Route::has('login'))
                    <ul class="flex space-x-4 ml-auto">
                        <li class="nav-item">
                            <a class="text-white hover:bg-gray-700 hover:rounded-lg transition duration-300 px-3 py-2" href="{{ url('/shop') }}">Toko</a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white hover:bg-gray-700 hover:rounded-lg transition duration-300 px-3 py-2" href="{{ url('/quiz') }}">Kuis</a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white hover:bg-gray-700 hover:rounded-lg transition duration-300 px-3 py-2" href="{{ url('/courses') }}">Materi</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="text-white hover:bg-gray-700 hover:rounded-lg transition duration-300 px-3 py-2" href="{{ url('/daily-mission/quiz') }}">Daily Mission</a>
                            </li>
                        @endauth
                    </ul>
                @endif
            </div>
        </div>
        <div class="hidden md:flex md:items-center">
            @if (Route::has('login'))
                @auth
                    <li class="relative" @click.away="open = false" @close.stop="open = false" x-data="{ open: false }">
                        <button @click="open = !open" class="text-white hover:bg-gray-700 hover:rounded-lg transition duration-300 px-3 py-2 focus:outline-none" id="navbarDropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <div x-show="open" @click="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->role === 'admin')
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:rounded-lg transition duration-300" href="{{ route('dashboard') }}">
                                    Admin Dashboard
                                </a>
                            @else
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:rounded-lg transition duration-300" href="{{ route('user.dashboard') }}">
                                    Dashboard
                                </a>
                            @endif
                            <div class="border-t border-gray-200"></div>
                            <button class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 hover:rounded-lg transition duration-300" onclick="logoutAndClearStorage()">
                                Log Out
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <a class="text-white hover:bg-gray-700 hover:rounded-lg transition duration-300 px-3 py-2" href="{{ url('/login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a class="text-white hover:bg-gray-700 hover:rounded-lg transition duration-300 px-3 py-2" href="{{ url('/register') }}">Sign up</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>

<script src="//unpkg.com/alpinejs" defer></script>

<script>
    // Fungsi logout dan hapus localStorage
    function logoutAndClearStorage() {
        // Hapus item dari localStorage
        localStorage.removeItem('quizAnswers');

        // Submit formulir logout
        document.getElementById('logout-form').submit();
    }

    // Alpine.js untuk toggle dropdown
    document.addEventListener('alpine:init', () => {
        Alpine.data('navbarDropdown', () => ({
            open: false,
            toggle() {
                this.open = !this.open;
            },
        }))
    })
</script>
