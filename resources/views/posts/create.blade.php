<!-- resources/views/posts/create.blade.php -->

<h1>Créer un article</h1>

<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <label>Titre :</label>
    <input type="text" name="title"><br>
    <label>Contenu :</label>
    <textarea name="content"></textarea><br>
    <button type="submit">Enregistrer</button>
</form>
