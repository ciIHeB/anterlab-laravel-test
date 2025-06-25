<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tâches de {{ $user->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title mb-4">Tâches de {{ $user->name }}</h2>

            @if ($user->tasks->isEmpty())
                <p class="text-muted">Aucune tâche assignée à cet utilisateur.</p>
            @else
                <ul class="list-group">
                    @foreach($user->tasks as $task)
                        <li class="list-group-item">
                            <h5 class="mb-1">{{ $task->title }}</h5>
                            <p class="mb-0 text-muted">{{ $task->description }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

</body>
</html>
