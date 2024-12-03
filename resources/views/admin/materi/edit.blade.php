<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">{{ __('Edit Materi') }}</h2>
                <form method="POST" action="{{ route('materi.update', $materi->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label for="title" class="block text-lg font-medium text-gray-700">{{ __('Title') }}</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $materi->title) }}" class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label for="content" class="block text-lg font-medium text-gray-700">{{ __('Content') }}</label>
                        <textarea name="content" id="ckeditor" class="ckeditor mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('content', $materi->content) }}</textarea>
                    </div>

                    <div class="flex justify-end mt-8">
                        <a href="{{ route('dashboard') }}" class="flex items-center bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg mr-4">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="flex items-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
