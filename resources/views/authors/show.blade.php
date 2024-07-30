
<!DOCTYPE html>
<html>
<head>
    <title>Author Details</title>
</head>
<body>
    <h1>Author Details</h1>
    <p><strong>Name:</strong> {{ $author->name }}</p>
    <p><strong>Biography:</strong> {{ $author->biography }}</p>
    <a href="{{ route('authors.index') }}">Back to List</a>
</body>
</html>
