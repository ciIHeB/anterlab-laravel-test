<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // List posts, with optional search filter
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('search') && !empty($request->search)) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        $posts = $query->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($request->all());
        return redirect()->route('posts.index');
    }

    public function ajaxStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($validated);

        return response()->json(['message' => 'Post created successfully!']);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($request->all());
        return redirect()->route('posts.index');
    }

    // Soft delete a post
    public function destroy(Post $post)
    {
        $post->delete();  // This performs soft delete because Post uses SoftDeletes trait
        return redirect()->route('posts.index')->with('success', 'Post soft deleted.');
    }

    // Show soft deleted posts
    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate(10);
        return view('posts.trashed', compact('posts'));
    }

    // Restore a soft deleted post
    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('posts.trashed')->with('success', 'Post restored successfully.');
    }
}
