<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;

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
        $name = $request->name;
        $description = $request->description;
        $project = new Project;
        $project->name=$name;
        $project->description=$description;
        $project->user_id = auth()->user()->id;
        $project->save();
        
        // Project::create($request->only(['name', 'description']));

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }
    
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $project->update($request->only(['name', 'description']));

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }
    
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $comments = Comment::where('project_id', $id)->get();
        $attachments = Attachment::where('project_id', $id)->get(); // Retrieve attachments for the project
        
        return view('projects.index', compact('project', 'comments', 'attachments'));
    }
    
    
    public function destroy(Project $project)
    {
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