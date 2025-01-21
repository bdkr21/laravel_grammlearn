<!-- resources/views/users/edit.blade.php -->
<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">{{ __('Edit User') }}</h2>
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="name" class="block text-lg font-medium text-gray-700">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div class="mb-6">
                        <label for="username" class="block text-lg font-medium text-gray-700">{{ __('username') }}</label>
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-lg font-medium text-gray-700">{{ __('email') }}</label>
                        <input type="text" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label for="points" class="block text-lg font-medium text-gray-700">{{ __('points') }}</label>
                        <input type="number" name="points" id="points" value="{{ old('points', $user->points) }}" class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="flex justify-end mt-8">
                        <a href="{{ route('dashboard') }}" class="flex items-center bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg mr-4">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11H9v4h2V7zm0 6H9v2h2v-2z" clip-rule="evenodd"></path></svg>
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="flex items-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11H9v4h2V7zm0 6H9v2h2v-2z" clip-rule="evenodd"></path></svg>
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
