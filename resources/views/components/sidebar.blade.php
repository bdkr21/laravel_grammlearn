<div x-data="{ openSidebar: true, adminOpen: {{ request()->routeIs('items.getItems', 'materi.getCourses', 'kuis.getKuis', 'users.getUsers') ? 'true' : 'false' }} }" class="flex h-screen">
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
            <!-- Dashboard -->
            <li>
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded transition {{ request()->routeIs('dashboard') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-folder text-gray-300 mr-3 pl-2"></i>
                @else
                <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-2 rounded transition {{ request()->routeIs('dashboard') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-folder text-gray-300 mr-3 pl-2"></i>
                @endif
                    <span x-show="openSidebar" class="text-sm font-medium pl-2">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <!-- Profil -->
            <li>
                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 rounded transition {{ request()->routeIs('profile.edit') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-user text-gray-300 mr-3 pl-2"></i>
                    <span x-show="openSidebar" class="text-sm font-medium pl-2">{{ __('Profil') }}</span>
                </a>
            </li>
            <!-- History -->
            <li>
                <a href="{{ route('history.redeem') }}" class="flex items-center px-4 py-2 rounded transition {{ request()->routeIs('history.redeem') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-history text-gray-300 mr-3 pl-2"></i>
                    <span x-show="openSidebar" class="text-sm font-medium pl-2">{{ __('History') }}</span>
                </a>
            </li>
            <!-- Menu Admin -->
            @if(Auth::user()->role === 'admin')
                <li>
                    <button @click="adminOpen = !adminOpen" class="w-full flex items-center uppercase px-4 py-2 text-gray-500 hover:bg-gray-700 rounded transition">
                        <i class="fa-regular fa-folder-open text-gray-300 mr-3 pl-2"></i>
                        <span x-show="openSidebar" class="text-sm font-medium pl-2">{{ __('Menu Admin') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 011.414 0L10 11.586l3.293-3.879a1 1 0 011.414 1.415l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul x-show="adminOpen" x-cloak class="mt-2 space-y-2 pl-6">
                        <li>
                            <a href="{{ route('items.getItems') }}" class="flex items-center px-4 py-2 rounded transition {{ request()->routeIs('items.getItems') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                                <i class="fas fa-box text-gray-300 mr-3 pl-2"></i>
                                <span x-show="openSidebar" class="text-sm font-medium pl-2">{{ __('Managemen Barang') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('materi.getCourses') }}" class="flex items-center px-4 py-2 rounded transition {{ request()->routeIs('materi.getCourses') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                                <i class="fas fa-book text-gray-300 mr-3 pl-2"></i>
                                <span x-show="openSidebar" class="text-sm font-medium pl-2">{{ __('Managemen Materi') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kuis.getKuis') }}" class="flex items-center px-4 py-2 rounded transition {{ request()->routeIs('kuis.getKuis') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                                <i class="fas fa-question-circle text-gray-300 mr-3 pl-2"></i>
                                <span x-show="openSidebar" class="text-sm font-medium pl-2">{{ __('Managemen Kuis') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.getUsers') }}" class="flex items-center px-4 py-2 rounded transition {{ request()->routeIs('users.getUsers') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                                <i class="fas fa-user text-gray-300 mr-3 pl-2"></i>
                                <span x-show="openSidebar" class="text-sm font-medium pl-2">{{ __('Managemen User') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- Home -->
            <li>
                <a href="{{ route('home') }}" class="flex items-center px-4 py-2 rounded transition {{ request()->routeIs('home') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-home text-gray-300 mr-3 pl-2"></i>
                    <span x-show="openSidebar" class="text-sm font-medium pl-2">{{ __('Home') }}</span>
                </a>
            </li>
            <!-- Logout -->
            <li>
                <form method="POST" action="{{ route('logout') }}" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center">
                        <i class="fas fa-sign-out-alt text-gray-300 mr-3 pl-2"></i>
                        <span x-show="openSidebar" class="text-sm font-medium pl-2">{{ __('Keluar') }}</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
