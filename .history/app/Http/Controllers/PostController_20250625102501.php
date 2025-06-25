<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // List posts (not trashed)
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // Soft delete
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post soft deleted.');
    }

    // List trashed posts
    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();
        return view('posts.trashed', compact('posts'));
    }

    // Restore post
    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('posts.trashed')->with('success', 'Post restored.');
    }
}
