<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        h1 {
            text-align: center;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        <h1>Edit Book</h1>
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ $book->title }}" required>
        
        <label for="author_id">Author:</label>
        <select name="author_id" required>
            @foreach($authors as $author)
                <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>{{ $author->name }}</option>
            @endforeach
        </select>
        
        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" value="{{ $book->isbn }}" required>
        
        <label for="published_year">Published Year:</label>
        <input type="number" name="published_year" value="{{ $book->published_year }}" required>
        
        <button type="submit">Update Book</button>
    </form>
</body>
</html>

