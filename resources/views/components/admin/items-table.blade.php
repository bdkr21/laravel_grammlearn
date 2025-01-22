<x-app-layout>
    <div class="flex flex-col lg:flex-row gap-6 bg-gray-50 min-h-screen">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Content -->
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Daftar Barang</h1>
                <a href="{{ route('items.create') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-md focus:ring-4 focus:ring-green-300">
                    + Tambah Barang
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table id="items-table" class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <!-- Table Header -->
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                Nama
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                Banyak Barang
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody class="divide-y divide-gray-200">
                        @foreach($items as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->description }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <!-- Edit Button -->
                                <a href="{{ route('items.edit', $item->id) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-2 px-4 rounded transition">
                                    Edit
                                </a>
                                <!-- Delete Button -->
                                <button onclick="openDeleteModal(event, '{{ $item->id }}')" class="inline-block bg-red-500 hover:bg-red-600 text-white text-xs font-medium py-2 px-4 rounded transition">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $items->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Konfirmasi Penghapusan</h2>
            <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin menghapus item ini?</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">
                    Batal
                </button>
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function openDeleteModal(event, id) {
        event.preventDefault();
        const modal = document.getElementById('delete-modal');
        modal.classList.remove('hidden');
        const deleteForm = document.getElementById('delete-form');
        deleteForm.action = `/items/${id}`;
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
    }
</script>
