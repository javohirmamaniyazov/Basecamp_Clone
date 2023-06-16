<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-title">
            <a class="basecamp_title" href="/dashboard"> <img class="basecamp-logo"
                    src="https://assets.stickpng.com/thumbs/62c6f1487a58a4aa1fb770a7.png" width="35px"
                    height="35px" />
                <h4>BASECAMP</h4>
            </a>
        </div>
        @if (auth()->check())
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="nav-username">{{ auth()->user()->name }}</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        @endif
    </nav>
    <div class="container">
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
                                    <a href="{{ url('projects/' . $project->id . '/edit') }}" class="edit-btn">Edit</a>
                                    <form action="{{ url('projects/' . $project->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this project?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">Delete</button>
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
</body>

</html>
