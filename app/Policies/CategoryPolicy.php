<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function view(User $user, Category $category)
{
    // Mettez en place votre logique d'autorisation ici.
    // Par exemple, vérifiez si l'utilisateur a accès à la catégorie.
    return $user->canViewCategory($category);
}
}
