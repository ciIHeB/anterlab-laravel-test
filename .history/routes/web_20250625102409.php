<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserTaskController;
use App\Models\Post;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// CRUD: Resource controller for Posts
Route::resource('posts', PostController::class);

// Form Validation Task
Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/form', [FormController::class, 'submitForm'])->name('form.submit');

// Model Relationships: User has many Tasks
Route::get('/user/{id}/tasks', [UserTaskController::class, 'showTasks'])->name('user.tasks');

// AJAX Form Submission
Route::post('/ajax-post', [PostController::class, 'ajaxStore'])->name('ajax.post');
Route::view('/ajax-form', 'posts.ajax-form')->name('posts.ajaxForm');

// Soft Deletes (Task 7)

// Soft delete a post (override resource destroy route or add explicit route)
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

// View all soft deleted posts
Route::get('/posts/deleted', function () {
    $deletedPosts = Post::onlyTrashed()->get();
    return view('posts.deleted', ['deletedPosts' => $deletedPosts]);
})->name('posts.deleted');

// Restore a soft deleted post
Route::patch('/posts/restore/{id}', function ($id) {
    $post = Post::withTrashed()->findOrFail($id);
    $post->restore();
    return redirect()->route('posts.deleted')->with('status', 'Post restored successfully!');
})->name('posts.restore');
Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');





Route::resource('posts', PostController::class)->except(['show']); // CRUD except show

// Soft Delete routes
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
Route::patch('/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
