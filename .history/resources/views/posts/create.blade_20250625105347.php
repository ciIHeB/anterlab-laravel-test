<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4">Créer un Article</h2>

            <form method="POST" action="{{ route('posts.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Titre de l'article">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Contenu</label>
                    <textarea id="content" name="content" rows="5" class="form-control" placeholder="Contenu de l'article"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
