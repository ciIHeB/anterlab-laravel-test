<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Affiche la liste des posts non supprimés
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // Supprime un post (soft delete)
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post soft deleted.');
    }

    // Affiche la liste des posts supprimés (soft deleted)
    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();
        return view('posts.trashed', compact('posts'));
    }

    // Restaure un post supprimé
    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('posts.trashed')->with('success', 'Post restored.');
    }
}
