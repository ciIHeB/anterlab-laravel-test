<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // List posts, with optional search filter



    public function ajaxStore(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    Post::create($validated);

    return response()->json(['message' => 'Post created successfully!']);
}
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

        // You can paginate if needed, or use get() for all results
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

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
