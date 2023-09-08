<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'categories_users');
    }
    public function coursesVisibleToUser($user)
    {
        return $this->courses()->whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }
    
}
