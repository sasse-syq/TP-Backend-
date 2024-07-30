<?php

namespace App\Http\Controllers;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::paginate(10);
        return view('authors.index', compact('authors'));
    }

    // Afficher le formulaire pour créer un nouvel auteur
    public function create()
    {
        return view('authors.create');
    }

    // Enregistrer un nouvel auteur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
        ]);

        $author = new Author;
        $author->name = $request->name;
        $author->biography = $request->biography;
        $author->save();

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    // Afficher les détails d'un auteur spécifique
    public function show($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.show', compact('author'));
    }

    // Afficher le formulaire pour éditer un auteur
    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author'));
    }

    // Mettre à jour les informations d'un auteur
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
        ]);

        $author = Author::findOrFail($id);
        $author->name = $request->name;
        $author->biography = $request->biography;
        $author->save();

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    // Supprimer un auteur
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
