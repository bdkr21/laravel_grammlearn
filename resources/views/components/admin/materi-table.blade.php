<div id="materi-table">
    <div class="mt-6">
        <table class="min-w-full bg-gray-100">
            <thead>
                <tr>
                    <th class="w-1/3 px-4 py-2 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="w-1/3 px-4 py-2 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Description</th>
                    <th class="w-1/3 px-4 py-2 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($materis as $materi)
                <tr>
                    <td class="px-4 py-2">{{ $materi->title }}</td>
                    <td class="px-4 py-2">{{ $materi->description }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('materi.edit', $materi->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('materi.destroy', $materi->id) }}" method="POST" class="inline">
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
</div>
<div class="pagination">
    {{ $materis->links() }}
</div>
<br>
<a href="{{ route('materi.create') }}" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah</a>
