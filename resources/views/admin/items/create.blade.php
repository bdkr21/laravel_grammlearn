<!-- resources/views/items/create.blade.php -->

        <div class="mt-3 text-center">
            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Add New Item') }}</h3>
            <form action="{{ route('items.store') }}" method="POST">
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
                    <label for="quantity" class="block text-sm font-medium text-gray-700">{{ __('Quantity') }}</label>
                    <input type="number" name="quantity" id="quantity" class="mt-1 p-2 w-full border rounded" required></input>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">{{ __('Price') }}</label>
                    <input type="number" name="price" id="price" class="mt-1 p-2 w-full border rounded" required>
                </div>

                {{-- <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">{{ __('Image') }}</label>
                    <input type="file" name="image" id="image" class="mt-1 p-2 w-full border rounded" accept="image/*" required>
                </div> --}}

                <div class="mb-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>


    {{-- <div class="py-12">
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
                        <label for="quantity" class="block text-sm font-medium text-gray-700">{{ __('Quantity') }}</label>
                        <input type="number" name="quantity" id="quantity" class="mt-1 p-2 w-full border rounded" required></input>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">{{ __('Price') }}</label>
                        <input type="number" name="price" id="price" class="mt-1 p-2 w-full border rounded" required>
                    </div>

                    {{-- <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">{{ __('Image') }}</label>
                        <input type="file" name="image" id="image" class="mt-1 p-2 w-full border rounded" accept="image/*" required>
                    </div> --}}

                    {{-- <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
