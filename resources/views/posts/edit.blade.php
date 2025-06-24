<!-- resources/views/posts/edit.blade.php -->

<h1>Modifier l'article</h1>

<form method="POST" action="{{ route('posts.update', $post->id) }}">
    @csrf
    @method('PUT')
    <label>Titre :</label>
    <input type="text" name="title" value="{{ $post->title }}"><br>
    <label>Contenu :</label>
    <textarea name="content">{{ $post->content }}</textarea><br>
    <button type="submit">Mettre à jour</button>
</form>
