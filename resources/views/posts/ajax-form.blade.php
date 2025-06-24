<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AJAX Post Form</title>
</head>
<body>
    <h2>Create Post (AJAX)</h2>

    <form id="postForm">
        @csrf
        <input type="text" name="title" placeholder="Title" required><br><br>
        <textarea name="content" placeholder="Content" required></textarea><br><br>
        <button type="submit">Submit</button>
    </form>

    <div id="responseMessage" style="color: green; margin-top: 10px;"></div>

    <script>
        document.getElementById('postForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const data = new FormData(form);

            fetch("{{ route('ajax.post') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: data
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('responseMessage').textContent = data.message;
                form.reset();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
