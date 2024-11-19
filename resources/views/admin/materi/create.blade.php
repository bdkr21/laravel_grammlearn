<!-- resources/views/admin/materi/create.blade.php -->

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <form method="POST" action="{{ route('materi.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
                    <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded" required>
                </div>

                <input type="hidden" name="slug" id="slug">

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                    <textarea name="description" id="description" class="mt-1 p-2 w-full border rounded" required></textarea>
                </div>

                <div class="flex items-center justify-end">
                    <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded mr-2">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
