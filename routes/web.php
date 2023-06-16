<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
<<<<<<< HEAD
use App\Http\Controllers\ThreadController;
=======
use App\Http\Controllers\AttachmentController;
>>>>>>> c766dae1abeaa52b54701cdc953f137cc50bca09
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Add Admin to Project
    Route::post('projects/{project}/addAdmin', [ProjectController::class, 'addAdmin'])->name('projects.addAdmin');
});

Route::post('projects/{project}/comments', [ProjectController::class, 'storeComment'])->name('projects.storeComment');

// Thread routes
Route::get('/projects/{projectId}/threads', [ThreadController::class, 'index'])->name('threads.index');
Route::get('/projects/{projectId}/threads/create', [ThreadController::class, 'create'])->name('threads.create');
Route::post('/projects/{projectId}/threads', [ThreadController::class, 'store'])->name('threads.store');
Route::get('/projects/{projectId}/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');
Route::get('/projects/{projectId}/threads/{thread}/edit', [ThreadController::class, 'edit'])->name('threads.edit');
Route::put('/projects/{projectId}/threads/{thread}', [ThreadController::class, 'update'])->name('threads.update');
Route::delete('/projects/{projectId}/threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');

Route::delete('/comments/{comment}', [ProjectController::class, 'deleteComment'])->name('comments.destroy');
Route::put('/comments/{comment}', [ProjectController::class, 'updateComment'])->name('comments.update');

<<<<<<< HEAD
Route::resource('projects', ProjectController::class)->except(['create', 'store']);
=======
Route::post('/projects/{project}/attachments', [AttachmentController::class, 'store'])->name('attachments.store');
Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy'])->name('attachments.destroy');

>>>>>>> c766dae1abeaa52b54701cdc953f137cc50bca09

require __DIR__.'/auth.php';
