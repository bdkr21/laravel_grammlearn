<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="flex">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Content -->
        <div id="dynamic-content" class="flex-1 py-12 px-6 bg-gray-100">

            <div id="createModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div id="modalContent"></div>
                    </div>
                </div>
            </div>

            <div class="flex-1 py-12 px-6 bg-gray-100">
                <div class="max-w-7xl mx-auto">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                        <!-- Content dari Dashboard -->
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                                    <div class="flex justify-between items-center mb-6">
                                        <div>
                                            <div class="text-lg font-medium text-gray-900">
                                                {{ Auth::user()->name }}
                                            </div>
                                            <div class="text-2xl font-semibold text-gray-700">
                                                {{ __('MY POINTS') }}: <span class="ml-2">{{ $points }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bagian Inventory di Dashboard -->
                                    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 mt-6">
                                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Daftar Item Pengguna') }}</h3>

                                        <!-- Toaster Notification -->
                                        @if(session('success'))
                                            <div id="toast-success" class="fixed top-0 right-0 mt-4 mr-4 bg-green-500 text-white p-4 rounded shadow-lg">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if(Auth::user()->role === 'admin')
                                            @if($inventories->isEmpty() || !$inventories->contains(fn($inventory) => !$inventory->redeemed))
                                                <p class="text-gray-500 mt-4">{{ __('Tidak ada item yang harus di-redeem.') }}</p>
                                            @else
                                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                                    @foreach($inventories as $inventory)
                                                        @if(!$inventory->redeemed)
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
                                                                <form action="{{ route('inventory.redeemItem', $inventory->id) }}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded mt-4">
                                                                        {{ __('Redeem') }}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                {{ $inventories->links() }} <!-- Tampilkan pagination -->
                                            @endif
                                        @else
                                            <p class="text-gray-500 mt-4">{{ __('You do not have permission to view all inventories.') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
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
