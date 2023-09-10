<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\UserCourse;
use App\Models\Category;
use DOMDocument;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
            // Récupérer l'utilisateur connecté
        $user = Auth::user();
        $courses = Course::all(); 
        $userCoursesCompleted = UserCourse::all(); 
        // Récupérer les catégories auxquelles l'utilisateur a accès
        $categories = $user->categories;

        return view('courses.index', compact('categories','user','userCoursesCompleted'));
        }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $description = $request->content;
    
        $dom = new DOMDocument();
        $dom->loadHTML($description,9);

        $images = $dom->getElementsByTagName('img');
    
        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
            $image_name = "/upload/" . time(). $key.'.png';
            file_put_contents(public_path().$image_name,$data);

            $img->removeAttribute('src');
            $img->setAttribute('src',$image_name);
        }
        $description = $dom->saveHTML();

        $data = $request->all();
        $new_order = $data['order'] ;
        $category_id = $data['category_id'];
        // Décaler les numéros d'ordre des cours suivants
        Course::where('category_id', $category_id)
              ->where('order', '>=', $new_order)
              ->increment('order');    
     
        Course::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'visibility' => $request->visibility,
            'content' => $description,
            'order' => $new_order,
        ]);

        session()->flash('success', 'Cours créé avec succès.');
        return redirect()->route('courses.index');
    }


public function create()
{
    // Récupérer toutes les catégories depuis la base de données
    $categories = Category::with(['courses' => function($query) {
        $query->orderBy('order', 'asc');
    }])->get();

    $courses = Course::orderBy('order', 'asc')->get();
    // Afficher la vue de création de cours en passant les catégories
    return view('courses.create', compact('categories','courses'));
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
public function destroy($id)
{
    $course = Course::find($id);
    $category_id = $course->category_id;
    $course->delete();

    // Réorganiser les valeurs de la colonne 'order'
    $remainingCourses = Course::where('category_id', $category_id)
                               ->orderBy('order')
                               ->get();

    $order = 1;
    foreach ($remainingCourses as $remainingCourse) {
        $remainingCourse->order = $order++;
        $remainingCourse->save();
    }

    return redirect()->route('courses.index');
}
}
