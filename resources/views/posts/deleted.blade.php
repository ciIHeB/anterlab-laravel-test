<h2>Deleted Posts</h2>

@foreach ($deletedPosts as $post)
    <div>
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->content }}</p>
        <a href="{{ route('posts.restore', $post->id) }}">Restore</a>
        <a href="{{ route('posts.ajaxForm') }}">Back to AJAX Form</a>

    </div>
@endforeach
