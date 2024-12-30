<div x-data="{ openSidebar: true }" class="flex h-screen">
    <!-- Sidebar -->
    <div :class="openSidebar ? 'w-64' : 'w-16'" class="bg-gray-800 text-white h-screen flex flex-col transition-all duration-300">
        <!-- Header -->
        <div class="p-4 border-b border-gray-700">
            <button @click="openSidebar = !openSidebar" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" :class="openSidebar ? 'h-6 w-6' : 'h-8 w-8'" class="transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
        <!-- Menu Items -->
        <ul class="space-y-2 flex-1 overflow-y-auto">
            <li>
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                        <i class="fas fa-folder text-gray-300 mr-3"></i>
                        <span x-show="openSidebar" class="text-sm font-medium">{{ __('Dashboard') }}</span>
                    </a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                        <i class="fas fa-home text-gray-300 mr-3"></i>
                        <span x-show="openSidebar" class="text-sm font-medium">{{ __('Dashboard') }}</span>
                    </a>
                @endif
            </li>
            <li>
                <a href="#" data-url="{{ route('profile.edit') }}" class="menu-item flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                    <i class="fas fa-user text-gray-300 mr-3"></i>
                    <span x-show="openSidebar" class="text-sm font-medium">{{ __('Profil') }}</span>
                </a>
            </li>
            <li>
                <a href="#" data-url="{{ route('history.redeem') }}" class="menu-item flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                    <i class="fas fa-history text-gray-300 mr-3"></i>
                    <span x-show="openSidebar" class="text-sm font-medium">{{ __('Riwayat Transaksi') }}</span>
                </a>
            </li>
            @if(Auth::user()->role === 'admin')
                <li x-data="{ adminOpen: false }">
                    <button @click="adminOpen = !adminOpen" class="w-full flex items-center uppercase px-4 py-2 text-gray-500 hover:bg-gray-700 rounded transition">
                        <i class="fa-regular fa-folder-open text-gray-300 mr-3"></i>
                        <span x-show="openSidebar" class="text-sm font-medium">{{ __('Menu Admin') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 011.414 0L10 11.586l3.293-3.879a1 1 0 011.414 1.415l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul x-show="adminOpen" x-cloak class="mt-2 space-y-2 pl-6">
                        <li>
                            <a href="#" data-url="{{ route('items.getItems') }}" class="menu-item flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                                <i class="fas fa-box text-gray-300 mr-3"></i>
                                <span x-show="openSidebar">{{ __('Managemen Barang') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-url="{{ route('materi.getCourses') }}" class="menu-item flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                                <i class="fas fa-book text-gray-300 mr-3"></i>
                                <span x-show="openSidebar">{{ __('Managemen Materi') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-url="{{ route('akuganteng') }}" class="menu-item flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                                <i class="fas fa-question-circle text-gray-300 mr-3"></i>
                                <span x-show="openSidebar">{{ __('Managemen Kuis') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="{{ route('home') }}" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                    <i class="fas fa-home text-gray-300 mr-3"></i>
                    <span x-show="openSidebar" class="text-sm font-medium">{{ __('Home') }}</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center">
                        <i class="fas fa-sign-out-alt text-gray-300 mr-3"></i>
                        <span x-show="openSidebar" class="text-sm font-medium">{{ __('Keluar') }}</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
