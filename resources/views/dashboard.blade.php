<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 text-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-lg font-medium">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="text-2xl font-semibold">
                            {{ __('MY POINT') }} <span class="ml-2">{{ $points }}</span>
                        </div>
                    </div>
                    <div>
                        <button class="bg-gray-700 text-white px-4 py-2 rounded ml-2">
                            <a href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </a>
                        </button>
                        {{-- <a href="{{ route('points.history') }}" class="bg-gray-700 text-white px-4 py-2 rounded">
                            {{ __('View points history') }}
                        </a> --}}
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded ml-2">
                                {{ __('log out') }}
                            </button>
                        </form>
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
