<!-- resources/views/items/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea name="description" id="description" class="mt-1 p-2 w-full border rounded" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">{{ __('Price') }}</label>
                        <input type="number" name="price" id="price" class="mt-1 p-2 w-full border rounded" required>
                    </div>

                    {{-- <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">{{ __('Image') }}</label>
                        <input type="file" name="image" id="image" class="mt-1 p-2 w-full border rounded" accept="image/*" required>
                    </div> --}}

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
</x-app-layout>
