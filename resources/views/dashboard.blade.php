<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        html {
            background-color: #E1E1E1;
        }
    </style>
</head>

<body>
    <x-app-layout>
        <div class="containerr">
            <div class="main-content">
                <h2 class="page-title">Projects</h2>
                <a href="{{ url('/projects/create') }}" class="add-project-link">
                    <button type="button" class="btn">📂 Add Project</button>
                </a>
            </div>
            <hr class="divider">
            <div class="projects">
                @if ($projects)
                    @foreach ($projects as $project)
                        <a href="{{ url('projects/' . $project->id) }}" class="project-link">
                            <div class="project">
                                <h3>{{ $project->name }}</h3>
                                <p>{{ $project->description }}</p>
                                <div class="project-actions">
                                    @if ($project->user_id === auth()->user()->id)
                                        <a href="{{ url('projects/' . $project->id . '/edit') }}"
                                            class="edit-btn">Edit</a>
                                        <form action="{{ url('projects/' . $project->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this project?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete" >Delete</button>
                                        </form>
                                    @endif
                                </div>
                                <h4 class="project-author">Created by: {{ $project->user->name }}</h4>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p>No projects found.</p>
                @endif
            </div>
        </div>
    </x-app-layout>
</body>

</html>
