<div class="w-64 bg-gray-800 text-white h-screen flex flex-col">
    <div class="p-4 border-b border-gray-700">
        <h2 class="text-xl font-bold text-gray-300">{{ __('Dashboard Menu') }}</h2>
    </div>
    <ul class="space-y-2 flex-1 overflow-y-auto">
        <li>
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                    <span class="text-sm font-medium">{{ __('Admin Dashboard') }}</span>
                </a>
            @else
                <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                    <span class="text-sm font-medium">{{ __('User Dashboard') }}</span>
                </a>
            @endif
        </li>
        <li>
            <a href="#" data-url="{{ route('profile.edit') }}" class="menu-item flex items-center px-4 py-2 hover:bg-gray-700">
                {{ __('Profil') }}
            </a>
        </li>
        <li>
            <a href="#" data-url="{{ route('history.redeem') }}" class="menu-item flex items-center px-4 py-2 hover:bg-gray-700">
                {{ __('Riwayat Transaksi') }}
            </a>
        </li>
        @if(Auth::user()->role === 'admin')
            <li x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center uppercase px-4 py-2 text-gray-500 hover:bg-gray-700 rounded transition">
                    <span class="text-sm font-medium">{{ __('Menu Admin') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-auto" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 011.414 0L10 11.586l3.293-3.879a1 1 0 011.414 1.415l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <ul x-show="open" x-cloak class="mt-2 space-y-2 pl-6">
                    <li>
                        <a href="#" data-url="{{ route('items.getItems') }}" class="menu-item flex items-center px-4 py-2 hover:bg-gray-700">
                            {{ __('Managemen Barang') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" data-url="{{ route('materi.getCourses') }}" class="menu-item flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                            {{ __('Managemen Materi') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="showModal('quizzes')" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded transition">
                            <span class="text-sm font-medium">{{ __('Manage Quizzes') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <li>
            <form method="POST" action="{{ route('logout') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                @csrf
                <button type="submit" class="w-full text-left flex items-center hover:bg-gray-700 rounded transition">
                    <span class="text-sm font-medium">{{ __('Keluar') }}</span>
                </button>
            </form>
        </li>
    </ul>
</div>
