<h1>Trashed Posts</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<ul>
    @foreach($posts as $post)
        <li>
            <strong>{{ $post->title }}</strong>
            <form action="{{ route('posts.restore', $post->id) }}" method="POST" style="display:inline">
                @csrf
                @method('PATCH')
                <button type="submit">Restore</button>
            </form>
        </li>
    @endforeach
</ul>
