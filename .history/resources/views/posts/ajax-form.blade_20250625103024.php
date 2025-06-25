<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AJAX Post Submission</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<h1>Create Post (AJAX)</h1>

<form id="ajaxPostForm">
    <label>Title:</label><br>
    <input type="text" name="title" id="title"><br><br>

    <label>Content:</label><br>
    <textarea name="content" id="content" rows="5"></textarea><br><br>

    <button type="submit">Submit</button>
</form>

<p id="message" style="color: green;"></p>

<script>
document.getElementById('ajaxPostForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const title = document.getElementById('title').value;
    const content = document.getElementById('content').value;
    const message = document.getElementById('message');

    // Clear message
    message.textContent = '';

    // CSRF token from meta tag
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    axios.post('{{ route('ajax.post') }}', { title, content }, {
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        }
    })
    .then(function (response) {
        message.textContent = response.data.message;
        // Optionally clear form
        document.getElementById('ajaxPostForm').reset();
    })
    .catch(function (error) {
        if (error.response && error.response.data.errors) {
            // Show validation errors
            let errors = error.response.data.errors;
            message.style.color = 'red';
            message.textContent = Object.values(errors).flat().join(' ');
        } else {
            message.style.color = 'red';
            message.textContent = 'An error occurred.';
        }
    });
});
</script>

</body>
</html>
