<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AttachmentController extends Controller
{

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // Max file size of 10MB (adjust as needed)
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads', 'public');

        $attachment = new Attachment();
        $attachment->project_id = $project->id;
        $attachment->file_path = '/storage/' . $path;
        $attachment->user_id = auth()->id();
        $attachment->save();

        return redirect()->route('projects.index', $project)->with('success', 'Attachment uploaded successfully.');
    }

    public function destroy(Attachment $attachment)
    {
        // Delete the attachment file from storage
        Storage::disk('public')->delete('public_html' . $attachment->file_path);

        // Delete the attachment record from the database
        $attachment->delete();

        // Redirect or perform any additional actions
        return redirect()->back()->with('success', 'Attachment deleted successfully.');
    }
}
