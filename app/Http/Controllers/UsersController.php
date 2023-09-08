<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Category; //
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // Récupérez tous les utilisateurs depuis la base de données

        return view('users.index', compact('users')); // Retournez la vue avec la liste des utilisateurs
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Group::all(); // Récupérez tous les groupes depuis la base de données
        $categories = Category::all();
        return view('users.create', compact('groups','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validez les données du formulaire, par exemple, les champs 'name', 'email' et 'password'.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $selectedCategories = $request->input('categories', []);

        // Attachez les catégories sélectionnées à l'utilisateur
        
        // Créez un nouvel utilisateur avec les données validées.
        $user = User::create($validatedData);
        $user->categories()->attach($selectedCategories);
    
        // Vous pouvez également attribuer un rôle ou d'autres informations à l'utilisateur ici si nécessaire.
    
        // Redirigez l'utilisateur vers la page appropriée après la création.
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $groups = Group::all(); // Récupérer la liste des groupes
        $categories = Category::all();
        return view('users.edit', compact('user', 'groups','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
            // Validez les données entrées par l'utilisateur ici

        // Validez les données entrées par l'utilisateur ici
 // Récupérez les catégories sélectionnées dans le formulaire
        $selectedCategories = $request->input('categories', []);

        // Mettez à jour les relations entre l'utilisateur et les catégories
        $user->categories()->sync($selectedCategories);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->group_id = $request->input('group_id');
        $user->save();

        return redirect()->route('users.edit', $user->id)->with('success', 'Utilisateur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
