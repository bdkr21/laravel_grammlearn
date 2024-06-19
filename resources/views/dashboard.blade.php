<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-12 w-12 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <div class="text-lg font-medium text-gray-900">
                                {{ __('Your Points') }}
                            </div>
                            <div class="text-2xl font-semibold text-gray-900">
                                {{ $points }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div x-data="{ showCategories: false }" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center cursor-pointer" @click="showCategories = !showCategories">
                        <div class="flex-shrink-0">
                            <svg class="h-12 w-12 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <div class="text-lg font-medium text-gray-900">
                                {{ __('Unlocked Categories') }}
                            </div>
                            <div class="text-2xl font-semibold text-gray-900">
                                {{ $unlockedCategories->count() }}
                            </div>
                        </div>
                    </div>
                    <div x-show="showCategories" class="mt-6">
                        <div class="text-lg font-medium text-gray-900">
                            {{ __('Unlocked Categories List') }}
                        </div>
                        <ul class="list-disc list-inside">
                            @foreach($unlockedCategories as $category)
                                <li>{{ $category->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
