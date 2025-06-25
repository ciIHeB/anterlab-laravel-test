<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un Article (AJAX)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title mb-4">Créer un article (AJAX)</h2>

            <!-- Success or error message -->
            <div id="message" class="mb-3"></div>

            <!-- AJAX Form -->
            <form id="ajaxPostForm">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Titre de l'article">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Contenu</label>
                    <textarea name="content" id="content" rows="5" class="form-control" placeholder="Contenu de l'article"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Soumettre</button>
            </form>
        </div>
    </div>
</div>

<!-- AJAX Script -->
<script>
document.getElementById('ajaxPostForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const title = document.getElementById('title').value;
    const content = document.getElementById('content').value;
    const message = document.getElementById('message');
    message.innerHTML = '';
    message.className = '';

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    axios.post('{{ route('ajax.post') }}', { title, content }, {
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        }
    })
    .then(function (response) {
        message.className = 'alert alert-success';
        message.textContent = response.data.message;
        document.getElementById('ajaxPostForm').reset();
    })
    .catch(function (error) {
        if (error.response && error.response.data.errors) {
            const errors = Object.values(error.response.data.errors).flat().join(' ');
            message.className = 'alert alert-danger';
            message.textContent = errors;
        } else {
            message.className = 'alert alert-danger';
            message.textContent = 'Une erreur est survenue.';
        }
    });
});
</script>

</body>
</html>
