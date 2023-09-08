<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Group;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',  // Assurez-vous que votre table users a une colonne 'role',
        ]);

        $groups = Group::all();

    User::factory(10)->create()->each(function ($user) use ($groups) {
        $user->group()->associate($groups->random());
        $user->save();
    });
    }
}
