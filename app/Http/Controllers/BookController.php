<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->paginate(10);
        return view('books.index', compact('books'));
    }

    // Afficher le formulaire de création d'un nouveau livre
    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    // Enregistrer un nouveau livre
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'published_year' => 'required|integer',
        ]);

        $isbn = $this->generateIsbn();

        Book::create([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'isbn' => $isbn,
            'published_year' => $request->published_year,
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    // Afficher les détails d'un livre spécifique
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Afficher le formulaire d'édition d'un livre existant
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    // Mettre à jour un livre existant
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'published_year' => 'required|integer',
        ]);

        $isbn = $this->generateIsbn();

        $book->update([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'isbn' => $isbn,
            'published_year' => $request->published_year,
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Supprimer un livre
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    // Méthode pour générer un ISBN aléatoire
    private function generateIsbn()
    {
        $prefix = '978'; // Préfixe standard pour ISBN-13
        $registration_group = '0'; // Groupe d'enregistrement, par exemple, 0 pour l'anglais
        $registrant = str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Numéro de l'éditeur
        $publication = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT); // Numéro de publication

        // Générer la partie sans le chiffre de contrôle
        $isbn_without_check_digit = $prefix . $registration_group . $registrant . $publication;

        // Calculer le chiffre de contrôle
        $check_digit = $this->calculateIsbnCheckDigit($isbn_without_check_digit);

        // Retourner l'ISBN complet
        return $isbn_without_check_digit . $check_digit;
    }

    // Méthode pour calculer le chiffre de contrôle de l'ISBN-13
    private function calculateIsbnCheckDigit($isbn_without_check_digit)
    {
        $sum = 0;

        for ($i = 0; $i < 12; $i++) {
            $digit = (int) $isbn_without_check_digit[$i];
            $sum += $i % 2 === 0 ? $digit : $digit * 3;
        }

        $remainder = $sum % 10;
        $check_digit = $remainder === 0 ? 0 : 10 - $remainder;

        return $check_digit;
    }
}
