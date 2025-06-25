<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserTaskController;
use App\Models\Post;

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

// Soft Delete Restore Route
Route::get('/posts/restore/{id}', function ($id) {
    $post = Post::withTrashed()->findOrFail($id);
    $post->restore();
    return redirect()->back()->with('status', 'Post restored successfully!');
})->name('posts.restore');

// View Deleted Posts Page
Route::get('/posts/deleted', function () {
    $deletedPosts = Post::onlyTrashed()->get();
    return view('posts.deleted', compact('deletedPosts'));
})->name('posts.deleted');

Route::delete('/posts/{id}', [PostController::class, 
