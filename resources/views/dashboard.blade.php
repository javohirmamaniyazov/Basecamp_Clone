<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mt-3">
                        Projects
                        <a style="margin-left:80%" href="{{ url('/projects/create') }}">
                            <button type="button" class="btn ml-5 text-white shadow">
                                📂 Add Project
                            </button>
                        </a>
                    </h2>
                    
                    <hr class="my-4 border-gray-300 dark:border-gray-700" />

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($projects as $project)
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 shadow block transition-colors">
                                <h3 class="text-lg ml-3 font-semibold text-gray-900 dark:text-white">
                                    {{ $project->name }}
                                </h3>
                                <p class="text-gray-600 ml-3 dark:text-gray-400">
                                    {{ $project->description }}
                                </p>
                                <a href="{{ url('projects/' . $project->id . '/edit') }}" class="btn btn-warning m-1" style="color: orange;">
                                    EDIT
                                </a>
                                <form action="{{ url('projects/' . $project->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this project?')" class="btn btn-danger m-1" style="color: red;">
                                        DELETE
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>