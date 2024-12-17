
<div class="overflow-x-auto">
    <table id="items-table" class="min-w-full bg-gray-100">
        <thead>
            <tr>
                <th class="w-1/3 px-4 py-2 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Nama</th>
                <th class="w-1/3 px-4 py-2 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Deskripsi</th>
                <th class="w-1/3 px-4 py-2 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Banyak Barang</th>
                <th class="w-1/3 px-4 py-2 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($quizs as $quiz)
            <tr>
                <td class="px-4 py-2">{{ $quiz->title }}</td>
                <td class="px-4 py-2">{{ $quiz->description }}</td>
                <td class="px-4 py-2">{{ $quiz->topic }}</td>
                <td class="px-4 py-2 flex space-x-2">
                    <a href="{{ route('kuiss.edit', $quiz->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                        {{ __('Edit') }}
                    </a>
                    <form action="{{ route('kuiss.destroy', $quiz->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pagination">
    {{ $quizs->links() }}
</div>
<br>
<a href="{{ route('kuiss.create') }}" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah</a>
