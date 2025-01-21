<div class="overflow-x-auto shadow-md rounded-lg">
    <table id="materi-table" class="min-w-full bg-white border border-gray-200">
        <!-- Table Header -->
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <!-- Table Body -->
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($materis as $materi)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">{{ $materi->title }}</td>
                <td class="px-6 py-4 flex items-center space-x-2">
                    <!-- Edit Button -->
                    <a href="{{ route('users.edit', $materi->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-2 px-4 rounded">
                        {{ __('Edit') }}
                    </a>
                    <!-- Delete Form -->
                    <form action="{{ route('users.destroy', $materi->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-medium py-2 px-4 rounded" onclick="confirmDelete(event)">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $materis->links('pagination::tailwind') }}
</div>

<!-- Add Button -->
<a href="{{ route('items.create') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow focus:ring-4 focus:ring-green-300">
    {{ __('Tambah') }}
</a>
