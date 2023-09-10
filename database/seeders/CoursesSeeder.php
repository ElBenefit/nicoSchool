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

        $categoryId = DB::table('categories')->where('name', 'Histoire')->value('id');

        // Insérez 15 cours associés à la catégorie "Histoire"
        for ($i = 1; $i <= 21; $i++) {
            DB::table('courses')->insert([
                'name' => "Cours $i",
                'type' => 'Théorie',
                'category_id' => 1,
                'content' => "Contenu du cours $i ici",
                'experiences_gived' => rand(50, 200),  // Points d'expérience aléatoires pour cet exemple
                'order' => $i,
            ]);
        }
             // Insérez 15 cours associés à la catégorie "Histoire"
             for ($i = 1; $i <= 14; $i++) {
                DB::table('courses')->insert([
                    'name' => "Cours $i",
                    'type' => 'Théorie',
                    'category_id' => 2,
                    'content' => "Contenu du cours $i ici",
                    'experiences_gived' => rand(50, 200),  // Points d'expérience aléatoires pour cet exemple
                    'order' => $i,
                ]);
            }
                 // Insérez 15 cours associés à la catégorie "Histoire"
        for ($i = 1; $i <= 17; $i++) {
            DB::table('courses')->insert([
                'name' => "Cours $i",
                'type' => 'Théorie',
                'category_id' => 3,
                'content' => "Contenu du cours $i ici",
                'experiences_gived' => rand(50, 200),  // Points d'expérience aléatoires pour cet exemple
                'order' => $i,
            ]);
        }
   
    }
}
