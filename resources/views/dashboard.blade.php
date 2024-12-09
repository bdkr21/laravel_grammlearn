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
                                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('My Inventory') }}</h3>

                                        <!-- Toaster Notification -->
                                        @if(session('success'))
                                            <div id="toast-success" class="fixed top-0 right-0 mt-4 mr-4 bg-green-500 text-white p-4 rounded shadow-lg">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                            @foreach(Auth::user()->inventories as $inventory)
                                                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                                    <h4 class="text-xl font-semibold">{{ $inventory->item->name }}</h4>
                                                    <p class="text-gray-700 mb-4">{{ $inventory->item->description }}</p>
                                                    <p class="text-gray-500">{{ __('Purchased on: ') . $inventory->created_at->format('d M Y') }}</p>
                                                    @if (!$inventory->redeemed)
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
                                        @if(Auth::user()->inventories->isEmpty())
                                            <p class="text-gray-500 mt-4">{{ __('You do not have any items in your inventory.') }}</p>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const menuItems = document.querySelectorAll('.menu-item');
        const contentArea = document.getElementById('dynamic-content');

        menuItems.forEach(item => {
            item.addEventListener('click', function (event) {
                event.preventDefault(); // Mencegah reload halaman
                const url = this.getAttribute('data-url'); // Ambil URL dari data attribute

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html', // Pastikan menerima HTML
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error(`Error ${response.status}: ${response.statusText}`);
                    return response.text();
                })
                .then(html => {
                    contentArea.innerHTML = html; // Perbarui konten dengan HTML
                })
                .catch(error => {
                    console.error('Error:', error);
                    contentArea.innerHTML = '<p class="text-red-500">Failed to load content. Please try again later.</p>';
                });
            });
        });
    });


        function showAddItemModal() {
            document.getElementById('add-item-modal').classList.remove('hidden');
        }

        function showAddCourseModal() {
            document.getElementById('add-materi-modal').classList.remove('hidden');
        }

        function showAddQuizModal() {
            document.getElementById('add-quiz-modal').classList.remove('hidden');
        }
        function hideAddModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');

                // Cari form di dalam modal dan reset isinya
                const form = modal.querySelector('form');
                if (form) {
                    form.reset();
                }

                if (modalId === 'items') {
                    document.getElementById('search').value = '';
                    const rows = document.querySelectorAll('#items-table table tbody tr');
                    rows.forEach(row => row.style.display = '');
                }
            }
        }
        function showModal(type) {
            document.getElementById(`${type}-modal`).classList.remove('hidden');
            loadTable(type); // Load table content when the modal is opened
        }
        function hideModal(type) {
            document.getElementById(`${type}-modal`).classList.add('hidden');
        }
        function filterTable() {
            const input = document.getElementById('search');
            const filter = input.value.toLowerCase();
            const table = document.querySelector('#items-table tbody');
            if (!table) {
                console.error('Table or tbody not found');
                return;
            }
            const rows = table.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let match = false;
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                rows[i].style.display = match ? '' : 'none';
            }
        }


        function confirmDelete(event) {
            if (!confirm('Are you sure you want to delete this item?')) {
                event.preventDefault();
            }
        }

        document.addEventListener('click', function (e) {
            if (e.target.matches('.pagination a')) {
                e.preventDefault();
                const url = new URL(e.target.href);
                const page = url.searchParams.get('page');
                const modalType = e.target.closest('.modal').id.replace('-modal', '');
                loadTable(modalType, page);
            }
        });

        function loadTable(type, page = 1) {
            fetch(`/${type}/get-items?page=${page}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(html => {
                document.getElementById(`${type}-content`).innerHTML = html;
                history.pushState(null, '', `/${type}/get-items?page=${page}`);
            })
            .catch(error => console.error('Error:', error));
        }

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
