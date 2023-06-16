<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('dashboard', compact('projects'));
    }
    
    public function create()
    {
        return view('projects.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);


        $project = new Project;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->user_id = auth()->user()->id;
        $project->save();
        
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        // Fetch all users to populate the dropdown
        $users = User::all();

        return view('projects.edit', compact('project', 'users'));
    }

    // public function update(Request $request, Project $project)
    // {
    //     $this->authorize('update', $project);

    //     $request->validate([
    //         'name' => 'required',
    //         'description' => 'required',
    //         'admin_user_id' => 'nullable|exists:users,id', // Validate the selected user
    //     ]);

    //     $project->update($request->only(['name', 'description']));

    //     // Assign the selected user as admin if provided
    //     if ($request->has('admin_user_id')) {
    //         $adminUser = User::findOrFail($request->admin_user_id);
    //         $project->admin()->associate($adminUser);
    //         $project->save();
    //     }

    //     return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    // }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);
    
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'admin_user_id' => 'nullable|exists:users,id', // Validate the selected user
        ]);
    
        $project->update($request->only(['name', 'description']));
    
        // Assign the selected user as admin if provided
        if ($request->has('admin_user_id')) {
            $adminUser = User::findOrFail($request->admin_user_id);
    
            // Check if the authenticated user is the admin or owner of the project
            if (auth()->user()->id === $project->user_id) {
                $project->admin_user_id = $adminUser->id;
                $project->save();
            }
        }
    
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }
    
    
    
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $comments = Comment::where('project_id', $id)->get();
        $attachments = Attachment::where('project_id', $id)->get(); // Retrieve attachments for the project
        $users = User::all();
        
        return view('projects.index', compact('project', 'comments', 'attachments', 'users'));
    }
    
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();
    
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function editComment(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function updateComment(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    public function storeComment(Request $request, Project $project)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->project_id = $project->id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
