<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function index($projectId)
    {
        $threads = Thread::where('project_id', $projectId)->get();
        return view('projects.index', compact('threads'));
    }

    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);
        return view('threads.create', compact('project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $thread = new Thread();
        $thread->title = $request->input('title');
        $thread->content = $request->input('content');
        $thread->project_id = $request->input('project_id'); // Ensure you have a 'project_id' field in your form
        $thread->user_id = Auth::id();
        $thread->save();

        return redirect()->route('threads.index', $thread->project_id)->with('success', 'Thread created successfully.');
    }

    public function edit(Thread $thread)
    {
        if ($thread->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to edit this thread.');
        }

        return view('threads.edit', compact('thread'));
    }

    public function update(Request $request, Thread $thread)
    {
        if ($thread->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this thread.');
        }

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $thread->title = $request->input('title');
        $thread->content = $request->input('content');
        $thread->save();

        return redirect()->route('threads.index', $thread->project_id)->with('success', 'Thread updated successfully.');
    }

    public function destroy(Thread $thread)
    {
        if ($thread->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this thread.');
        }

        $thread->delete();

        return redirect()->route('threads.index', $thread->project_id)->with('success', 'Thread deleted successfully.');
    }
}
