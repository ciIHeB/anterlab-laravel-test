<!-- resources/views/posts/index.blade.php -->

<h1>Articles</h1>

<a href="{{ route('posts.create') }}">Créer un nouvel article</a>

<ul>
@foreach($posts as $post)
    <li>
        <strong>{{ $post->title }}</strong><br>
        {{ $post->content }}<br>
        <a href="{{ route('posts.edit', $post->id) }}">Modifier</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Supprimer</button>
        </form>
    </li>
@endforeach
</ul>
