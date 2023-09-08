<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
{
    $categories = Category::all();  // Récupère toutes les catégories de la base de données
    return view('categories.index', compact('categories'));
}

public function show($id)
{
    // Récupérez la catégorie spécifique par son ID
    $category = Category::findOrFail($id);
    
    $user = auth()->user(); // Utilisateur connecté

    // Vérifiez si l'utilisateur a accès à cette catégorie via la table categories_users
    $access = $user->categories->contains($category);

    if ($access) {
        // Récupérez les cours de la catégorie si l'utilisateur a accès
        $courses = $category->courses;
    } else {
        // Redirigez l'utilisateur vers une page d'erreur ou effectuez une autre action en fonction de votre logique.
        return redirect()->route('courses.index')->with('error', 'Vous n\'avez pas accès à cette catégorie.');
    }

    return view('categories.show', compact('category', 'courses'));
}

public function create()
{
    return view('categories.create');
}

public function store(Request $request)
{
    // Validez les données du formulaire ici si nécessaire

    $category = new Category();
    $category->name = $request->input('name');
    $category->visibility = $request->input('visibility');
    $category->save();

    return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès.');
}

public function edit($id)
{
    $category = Category::find($id);

    if (!$category) {
        return redirect()->route('categories.index')->with('error', 'Catégorie non trouvée.');
    }

    return view('categories.edit', compact('category'));
}

public function update(Request $request, $id)
{
    // Validez les données du formulaire ici si nécessaire

    $category = Category::find($id);

    if (!$category) {
        return redirect()->route('categories.index')->with('error', 'Catégorie non trouvée.');
    }

    $category->name = $request->input('name');
    $category->visibility = $request->input('visibility');
    $category->save();

    return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
}

public function destroy($id)
{
    $category = Category::find($id);

    if (!$category) {
        return redirect()->route('categories.index')->with('error', 'Catégorie non trouvée.');
    }

    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
}
}
