<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AttachmentController extends Controller
{

    public function store(Request $request, Project $project)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|max:10240', // Max file size of 10MB (adjust as needed)
        ]);

        // Store the uploaded file
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $filename = Str::random(40) . '.' . $extension;
        $path = $file->storeAs('uploads', $filename, 'public');

        // Create a new attachment record in the database
        $attachment = new Attachment();
        $attachment->project_id = $project->id;
        $attachment->file_path = '/uploads/' . $filename;
        $attachment->user_id = auth()->id(); // Set the user_id to the authenticated user's ID
        $attachment->save();

        // Move the uploaded file to the public/uploads directory
        $file->move(public_path('uploads'), $filename);

        // Redirect or perform any additional actions
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
