<!-- resources/views/posts/index.blade.php -->

<h1>Articles</h1>

<!-- Search form -->
<form action="{{ route('posts.index') }}" method="GET" style="margin-bottom: 20px;">
    <input
        type="text"
        name="search"
        placeholder="Rechercher un article..."
        value="{{ request('search') }}"
        style="padding: 5px; width: 250px;"
    >
    <button type="submit">Rechercher</button>
</form>

<a href="{{ route('posts.create') }}">Créer un nouvel article</a>

<ul>
@foreach($posts as $post)
    <li style="margin-bottom: 15px;">
        <strong>{{ $post->title }}</strong><br>
        {{ $post->content }}<br>
        <a href="{{ route('posts.edit', $post->id) }}">Modifier</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cet article ?')">Supprimer</button>
        </form>
    </li>
@endforeach
</ul>

<!-- Pagination links -->
{{ $posts->withQueryString()->links() }}
