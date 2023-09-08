<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriesUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Obtenez l'ID de la catégorie "Histoire"
          $categoryId = DB::table('categories')->where('name', 'Histoire')->value('id');

          // Obtenez l'ID de l'utilisateur administrateur (ID 1)
          $adminUserId = 1;
  
       
          // Associez l'administrateur aux cours de la catégorie "Histoire"
          
              DB::table('categories_users')->insert([
                  'user_id' => $adminUserId,
                  'category_id' => $categoryId,
              ]);
         
    }
}
