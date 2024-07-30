<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');

// Route to display the form to create a new author
Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');

// Route to store a new author in the database
Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');

// Route to display details of a specific author
Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');

// Route to display the form to edit an existing author
Route::get('/authors/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');

// Route to update an author in the database
Route::put('/authors/{author}', [AuthorController::class, 'update'])->name('authors.update');

// Route to delete an author from the database
Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');


Route::get('/books', [BookController::class, 'index'])->name('books.index');

// Route to display the form to create a new book
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');

// Route to store a new book in the database
Route::post('/books', [BookController::class, 'store'])->name('books.store');

// Route to display details of a specific book
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Route to display the form to edit an existing book
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');

// Route to update a book in the database
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');

// Route to delete a book from the database
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');



