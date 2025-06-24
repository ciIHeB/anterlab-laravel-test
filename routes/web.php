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
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('posts', PostController::class);
Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/form', [FormController::class, 'submitForm'])->name('form.submit');
Route::get('/user/{id}/tasks', [UserTaskController::class, 'showTasks']);

Route::post('/ajax-post', [PostController::class, 'ajaxStore'])->name('ajax.post');

Route::get('/posts/restore/{id}', function ($id) {
    $post = Post::withTrashed()->findOrFail($id); // Find the post even if soft deleted
    $post->restore(); // Restore the post (remove deleted_at timestamp)

    return redirect()->back()->with('status', 'Post restored successfully!');
})->name('posts.restore');
Route::post('/ajax-post', [PostController::class, 'ajaxStore'])->name('ajax.post');

Route::view('/ajax-form', 'posts.ajax-form');
