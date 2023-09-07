<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Category;

class CourseController extends Controller
{

    public function __construct()
    {
    $this->middleware(function ($request, $next) {
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Accès non autorisé');
        }
        return $next($request);
    })->except(['index', 'show']);
    }
    public function index(Request $request)
{
    $search = $request->input('search');
    if ($search) {
        $courses = Course::where('name', 'LIKE', "%{$search}%")->paginate(10);
    } else {
        $courses = Course::paginate(10);
    }
    return view('courses.index', compact('courses', 'search'));
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'type' => 'required',
        'image' => 'nullable|image|max:2048',
    ]);

    $course = new Course($request->all());

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('course_images', 'public');
        $course->image_path = $path;
    }

    $course->save();

    session()->flash('success', 'Cours créé avec succès.');
    return redirect()->route('courses.index');
}
public function create()
{
    // Récupérer toutes les catégories depuis la base de données
    $categories = Category::all();

    // Afficher la vue de création de cours en passant les catégories
    return view('courses.create', compact('categories'));
}
public function edit($id)
{
    $course = Course::findOrFail($id);
    // Vous pouvez également charger les catégories ici si nécessaire
    $categories = Category::all();
    
    return view('courses.edit', compact('course', 'categories'));
}
public function update(Request $request, $id)
{
    // Validez les données du formulaire
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|integer',
        'type' => 'required|string|max:255',
        'content' => 'required|string',
        'visibility' => 'required|string|in:public,private', // Ajoutez cette règle de validation
    ]);

    // Obtenez le cours à mettre à jour
    $course = Course::findOrFail($id);

    // Mettez à jour les données du cours, y compris la visibilité
    $course->update([
        'name' => $validatedData['name'],
        'category_id' => $validatedData['category_id'],
        'type' => $validatedData['type'],
        'content' => $validatedData['content'],
        'visibility' => $validatedData['visibility'], // Mettez à jour la visibilité
    ]);

    // Redirigez l'utilisateur vers la page du cours mis à jour
    return redirect()->route('courses.show', $course->id)->with('success', 'Cours mis à jour avec succès.');
}

public function show($id)
{
    // Récupérez le cours avec l'ID spécifié depuis la base de données
    $course = Course::findOrFail($id);

    // Affichez la vue des détails du cours en passant le cours récupéré
    return view('courses.show', compact('course'));
}

}
