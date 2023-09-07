<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 
     // Créer quelques cours et associer à des catégories
     $course1_id = DB::table('courses')->insertGetId([
        'name' => 'Algèbre avancée',
        'type' => 'Théorie',
        'category_id' => 1, // Catégorie Math
        'content' => 'Contenu de votre cours ici',
    ]);

    $course2_id = DB::table('courses')->insertGetId([
        'name' => 'Grammaire française',
        'type' => 'Théorie',
        'category_id' => 2, // Catégorie Français
        'content' => 'Contenu de votre cours ici',
    ]);

    $course3_id = DB::table('courses')->insertGetId([
        'name' => 'Exercices de calcul',
        'type' => 'Exercice',
        'category_id' => 1, // Catégorie Math
        'content' => 'Contenu de votre cours ici',
    ]);

    // Associer l'utilisateur administrateur à ces cours
    $adminUser = \App\Models\User::where('email', 'admin@example.com')->first();
    $adminUser->courses()->attach([$course1_id, $course2_id, $course3_id]);
    
    }
}
