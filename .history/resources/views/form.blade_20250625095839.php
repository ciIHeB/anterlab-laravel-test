<!DOCTYPE html>
<html>
<head>
    <title>Formulaire</title>
</head>
<body>
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="/submit" method="POST">
        @csrf
        <label>Nom:</label>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
