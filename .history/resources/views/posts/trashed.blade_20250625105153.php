<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trashed Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-body">
            <h2 class="card-title mb-4">Articles Supprimés (Soft Deleted)</h2>

            {{-- Success message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($posts->isEmpty())
                <p class="text-muted">Aucun article supprimé pour le moment.</p>
            @else
                <ul class="list-group">
                    @foreach($posts as $post)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $post->title }}</strong>
                                <small class="text-muted d-block">Supprimé le {{ $post->deleted_at->format('d/m/Y à H:i') }}</small>
                            </div>
                            <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">Restaurer</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

</body>
</html>
