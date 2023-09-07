<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
{
    $categories = Category::all();  // Récupère toutes les catégories de la base de données
    return view('categories.index', compact('categories'));
}
}
