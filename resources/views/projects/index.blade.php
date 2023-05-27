<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
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

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">Comments</h2>
                    <hr class="my-4 border-gray-300 dark:border-gray-700" />

                    <div class="mt-4">
                        <form action="{{ url('projects', $project->id) }}/comments" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="content" class="block text-gray-700 dark:text-gray-400 font-bold mb-2">Comment:</label>
                                <textarea name="content" id="content" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:text-gray-300"></textarea>
                            </div>
                            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Submit</button>
                        </form>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold">Existing Comments:</h3>
                        <ul class="mt-4">
                            @foreach ($project->comments as $comment)
                                <li class="mb-4">
                                    <div class="flex items-center">
                                        <span class="ml-2 font-semibold">{{ $comment->user->name }}</span>
                                    </div>
                                    <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $comment->content }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
