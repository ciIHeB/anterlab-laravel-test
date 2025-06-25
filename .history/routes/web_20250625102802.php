<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserTaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Posts CRUD except 'show' (optional, if you don't want 'show' route)
Route::resource('posts', PostController::class)->except(['show']);

// If you need the 'show' route, add it explicitly (optional)
// Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Soft Delete routes (overrides destroy)
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
Route::patch('/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');

// Form Validation Task
Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/form', [FormController::class, 'submitForm'])->name('form.submit');

// User Tasks Relationship
Route::get('/user/{id}/tasks', [UserTaskController::class, 'showTasks'])->name('user.tasks');

// AJAX Form Submission for posts
Route::post('/ajax-post', [PostController::class, 'ajaxStore'])->name('ajax.post');
Route::view('/ajax-form', 'posts.ajax-form')->name('posts.ajaxForm');
