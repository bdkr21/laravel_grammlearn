<nav class="bg-white p-4">
    <div class="container mx-auto flex items-center justify-between">
        <div class="flex items-center">
            <a class="text-black text-xl" href="{{ url('/') }}">Grammlearn</a>
            <button class="text-black focus:outline-none md:hidden ml-4" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" @click="isOpen = !isOpen">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <div class="hidden md:flex md:items-center md:space-x-8 ml-6" :class="{ 'block': isOpen, 'hidden': !isOpen }" id="navbarNav">
                @if (Route::has('login'))
                    <ul class="flex space-x-8 ml-auto">
                        <li class="nav-item">
                            <a class="text-black hover:bg-gray-200 hover:rounded-lg transition duration-300 px-3 py-2" href="{{ url('/shop') }}">Toko</a>
                        </li>
                        <li class="nav-item">
                            <a class="text-black hover:bg-gray-200 hover:rounded-lg transition duration-300 px-3 py-2" href="{{ url('/quiz') }}">Kuis</a>
                        </li>
                        <li class="nav-item">
                            <a class="text-black hover:bg-gray-200 hover:rounded-lg transition duration-300 px-3 py-2" href="{{ url('/courses') }}">Materi</a>
                        </li>
                        <li class="nav-item">
                            <a class="text-black hover:bg-gray-200 hover:rounded-lg transition duration-300 px-3 py-2" href="{{ url('/about') }}">Tentang Kami</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="text-black hover:bg-gray-200 hover:rounded-lg transition duration-300 px-3 py-2" href="{{ url('/daily-mission') }}">Daily Mission</a>
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
                        <button @click="open = !open" class="text-black hover:bg-gray-200 hover:rounded-lg transition duration-300 px-3 py-2" id="navbarDropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <div x-show="open" @click="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->role === 'admin')
                                <a class="block px-4 py-2 text-black-200 hover:bg-gray-200 hover:rounded-lg transition duration-300" href="{{ route('dashboard') }}">
                                    Admin Dashboard
                                </a>
                            @else
                                <a class="block px-4 py-2 text-black-200 hover:bg-gray-200 hover:rounded-lg transition duration-300" href="{{ route('user.dashboard') }}">
                                    Dashboard
                                </a>
                            @endif
                            <div class="border-t border-gray-200"></div>
                            <button class="block w-full text-left px-4 py-2 text-black-200 hover:bg-gray-200 hover:rounded-lg transition duration-300" onclick="logoutAndClearStorage()">
                                Log Out
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <a class="text-black hover:bg-gray-700 hover:rounded-lg transition duration-300 px-3 py-2" href="{{ url('/login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a class="bg-blue-500 text-black px-4 py-2 rounded shadow hover:bg-blue-600 active:translate-y-1 transition duration-300" href="{{ url('/register') }}">Sign up</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>

<script src="//unpkg.com/alpinejs" defer></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    // Menampilkan alert jika ada session alertMessage
    @if (session('alertMessage'))
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: '{{ session('alertMessage') }}',
            showConfirmButton: false,
            timer: 2500,
            width: '300px',   // Ukuran lebar alert
            padding: '10px',  // Jarak di dalam alert
            fontSize: '14px', // Ukuran font
            customClass: {
                popup: 'small-alert' // Kelas kustom untuk styling
            }
        });
    @endif
</script>
