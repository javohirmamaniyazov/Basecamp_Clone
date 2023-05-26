<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">
                        Project Index - {{ $project->name }}
                    </h2>
                    <hr class="my-4 border-gray-300 dark:border-gray-700" />

                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">Name: {{ $project->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">Description: {{ $project->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
