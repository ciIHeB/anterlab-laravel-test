<h1>Tasks for {{ $user->name }}</h1>

<ul>
    @foreach($user->tasks as $task)
        <li>
            <strong>{{ $task->title }}</strong><br>
            {{ $task->description }}
        </li>
    @endforeach
</ul>
