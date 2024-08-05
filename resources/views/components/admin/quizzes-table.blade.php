<div id="quizzes-table">
    <div class="mt-6">
        <table class="min-w-full bg-gray-100">
            <thead>
                <tr>
                    <th class="w-1/3 px-4 py-2 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Title</th>
                    <th class="w-1/3 px-4 py-2 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Description</th>
                    <th class="w-1/3 px-4 py-2 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($quizzes as $quiz)
                <tr>
                    <td class="px-4 py-2">{{ $quiz->title }}</td>
                    <td class="px-4 py-2">{{ $quiz->description }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('quizzes.edit', $quiz->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" class="inline">
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
