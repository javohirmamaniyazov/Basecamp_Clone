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
                    <a style="margin-left: 80%" href="{{ url('/projects/create') }}">
                        <button type="button" class="btn ml-5 text-white shadow">
                            📂 Add Project
                        </button>
                    </a>
                </h2>
                <hr class="my-4 border-gray-300 dark:border-gray-700" />

                <div class="lg:grid-cols-2 gap-5">
                    @if ($projects)
                        @foreach ($projects as $project)
                        <a href="{{ url('projects/' . $project->id) }}">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg m-3  p-4 shadow block  transition-colors" style="height: 125px">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $project->name }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ $project->description }}
                                </p>
                                <div class="flex justify-end mt-4">
                                    @if ($project->user_id === auth()->user()->id)
                                        <a href="{{ url('projects/' . $project->id . '/edit') }}" class="btn btn-warning m-1" style="color: orange">
                                            EDIT
                                        </a>
                                        <form action="{{ url('projects/' . $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger m-1" style="color: red">
                                                DELETE
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                                </a>        
                            @endforeach
                    @else
                        <p>No projects found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
