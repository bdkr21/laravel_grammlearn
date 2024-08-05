<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            {{ __('Profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                                {{ __('Log out') }}
                            </button>
                        </form>
                    </div>
                </div>

                @if(Auth::user()->role === 'admin')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('CRUD Items') }}</h3>
                        <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded block text-center mb-2" onclick="showModal('items')">
                            {{ __('Manage Items') }}
                        </a>
                        <a href="#" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded block text-center" onclick="showAddItemModal()">
                            {{ __('Add New Item') }}
                        </a>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('CRUD Materi') }}</h3>
                        <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded block text-center mb-2" onclick="showModal('materi')">
                            {{ __('Manage Materi') }}
                        </a>
                        <a href="{{ route('materi.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded block text-center">
                            {{ __('Add New Materi') }}
                        </a>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('CRUD Quizzes') }}</h3>
                        <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded block text-center mb-2" onclick="showModal('quizzes')">
                            {{ __('Manage Quizzes') }}
                        </a>
                        <a href="{{ route('quizzes.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded block text-center">
                            {{ __('Add New Quiz') }}
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Lihat Items') }}</h3>
                        <a href="{{ route('items.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded block text-center mb-2">
                            {{ __('View Items') }}
                        </a>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Lihat Materi') }}</h3>
                        <a href="{{ route('materi.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded block text-center mb-2">
                            {{ __('View Materi') }}
                        </a>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Lihat Kuis') }}</h3>
                        <a href="{{ route('quizzes.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded block text-center mb-2">
                            {{ __('View Quizzes') }}
                        </a>
                    </div>
                </div>
                @endif

                @if(Auth::user()->role === 'admin')
                <div id="items-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden modal">
                    <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white modal-content">
                        <div class="mt-3 text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Manage Items') }}</h3>
                            <div id="items-content">
                                <!-- The content for managing items will be loaded here -->
                            </div>
                            <button type="button" class="mt-2 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded w-full" onclick="hideModal('items')">
                                {{ __('Close') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div id="materi-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden modal">
                    <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white modal-content">
                        <div class="mt-3 text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Manage Materi') }}</h3>
                            <div id="materi-content">
                                <!-- The content for managing materi will be loaded here -->
                            </div>
                            <button type="button" class="mt-2 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded w-full" onclick="hideModal('materi')">
                                {{ __('Close') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div id="quizzes-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden modal">
                    <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white modal-content">
                        <div class="mt-3 text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Manage Quizzes') }}</h3>
                            <div id="quizzes-content">
                                <!-- The content for managing quizzes will be loaded here -->
                            </div>
                            <button type="button" class="mt-2 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded w-full" onclick="hideModal('quizzes')">
                                {{ __('Close') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div id="add-item-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden modal">
                    <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white modal-content">
                        <div class="mt-3 text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Add New Item') }}</h3>
                            <div id="add-item-modal-content">
                                <!-- The content for adding a new item will be loaded here -->
                            </div>
                            <button type="button" class="mt-2 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded w-full" onclick="hideAddItemModal()">
                                {{ __('Close') }}
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function showModal(type) {
            document.getElementById(`${type}-modal`).classList.remove('hidden');
            loadTable(type); // Load table content when the modal is opened
        }

        function hideModal(type) {
            document.getElementById(`${type}-modal`).classList.add('hidden');
        }

        function showAddItemModal() {
            fetch('/items/create-form', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('add-item-modal-content').innerHTML = html;
                document.getElementById('add-item-modal').classList.remove('hidden');
            })
            .catch(error => console.error('Error:', error));
        }

        function hideAddItemModal() {
            document.getElementById('add-item-modal').classList.add('hidden');
        }

        function filterTable() {
            const input = document.getElementById('search');
            const filter = input.value.toLowerCase();
            const table = document.querySelector('#items-table table tbody');
            const rows = table.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let match = false;
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
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
    </script>
</x-app-layout>
