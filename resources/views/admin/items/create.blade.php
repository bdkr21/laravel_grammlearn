<!-- resources/views/items/create.blade.php -->

<x-app-layout>
    <br>
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-md space-y-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('Create New Item') }}</h1>
        <form action="{{ route('items.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Enter item name" required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                <textarea name="description" id="description"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    rows="4" placeholder="Enter item description" required></textarea>
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">{{ __('Quantity') }}</label>
                <input type="number" name="quantity" id="quantity"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Enter quantity" required>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">{{ __('Price') }}</label>
                <input type="number" name="price" id="price"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Enter price" required>
            </div>

            {{-- <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">{{ __('Image') }}</label>
                <input type="file" name="image" id="image" class="mt-1 p-2 w-full border rounded" accept="image/*" required>
            </div> --}}

            <div class="flex justify-end space-x-2">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-5 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    {{ __('Back') }}
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

