<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Articles</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Créer un nouvel article</a>
    </div>

    <!-- Search form -->
    <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher un article..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Rechercher</button>
        </div>
    </form>

    @foreach($posts as $post)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->content }}</p>
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet article ?')">Supprimer</button>
                </form>
            </div>
        </
