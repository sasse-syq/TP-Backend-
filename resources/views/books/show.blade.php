
<!DOCTYPE html>
<html>
<head>
    <title>Book Details</title>
</head>
<body>
    <h1>Book Details</h1>
    <p><strong>Title:</strong> {{ $book->title }}</p>
    <p><strong>Author:</strong> {{ $book->author->name }}</p>
    <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
    <p><strong>Published Year:</strong> {{ $book->published_year }}</p>
    <a href="{{ route('books.index') }}">Back to List</a>
</body>
</html>
