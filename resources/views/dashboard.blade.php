<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    @php
    $inventories = $inventories ?? collect(); // Tambahkan fallback di sini
    @endphp
    <div class="flex">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Content -->
        <div id="dynamic-content" class="flex-1 max-h-screen py-4 px-4 bg-gray-100 overflow-auto">

            <div id="createModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div id="modalContent"></div>
                    </div>
                </div>
            </div>
            <!-- Content dari Dashboard -->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <div class="text-lg font-medium text-gray-900">
                                    @if(Auth::user()->role === 'admin')
                                        <p>Selamat datang, Admin!</p>
                                    @else
                                        <p>Selamat datang, {{ Auth::user()->name }}!</p>
                                    @endif
                                </div>
                                <div class="text-2xl font-semibold text-gray-700">
                                    {{ __('MY POINTS') }}: <span class="ml-2">{{ $points }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian Inventory di Dashboard -->
                        <div class="bg-white shadow rounded-lg p-4 mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Daftar Item Pengguna') }}</h3>

                            <!-- Search Bar -->
                            <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                                <div class="flex items-center">
                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Cari item..."
                                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                    <button
                                        type="submit"
                                        class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                                        Cari
                                    </button>
                                </div>
                            </form>
                            <!-- Toaster Notification -->
                            @if(session('success'))
                                <div id="toast-success" class="fixed top-0 right-0 mt-4 mr-4 bg-green-500 text-white p-4 rounded shadow-lg">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if($inventories->isNotEmpty() && $inventories->contains(fn($inventory) => !$inventory->redeemed))
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($inventories->where('redeemed', false) as $inventory)
                                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                            <h4 class="text-xl font-semibold">{{ $inventory->item->name }}</h4>
                                            <p class="text-gray-700 mb-4">Kirim ke: {{ $inventory->phone_number }}</p>
                                            <p class="text-gray-500">{{ __('Dibeli pada: ') . $inventory->created_at->format('d M Y') }}</p>
                                            <p class="text-gray-500">{{ __('Pemilik: ') . $inventory->user->name }}</p>
                                            <p class="text-gray-500">
                                                {{ __('Status: ') }}
                                                <span class="text-yellow-500">
                                                    {{ 'Pending' }}
                                                </span>
                                            </p>
                                            @if(auth()->user()->role === 'admin')
                                            <form action="{{ route('inventory.redeemItem', $inventory->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded mt-4">
                                                    {{ __('Redeem') }}
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            {{ $inventories->appends(['search' => request('search')])->links() }} <!-- Include search query in pagination -->
                        @else
                            <p class="text-gray-500 mt-4">{{ __('Tidak ada item yang harus di-redeem.') }}</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toast = document.getElementById('toast-success');
        if (toast) {
            setTimeout(() => {
                toast.remove();
            }, 3000); // Menghilangkan toaster setelah 3 detik
        }
    });
    </script>
</x-app-layout>
