<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Group;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gamifier',
        'group_id',        
        'currencies',
        "experiences",
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_courses')
            ->withPivot('is_completed')
            ->withTimestamps();
    }
   
   
    public function completedCourses()
    {
        return $this->hasMany(UserCourse::class)->where('is_completed', true);;
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_users');
    }
  
    public function canViewCategory(Category $category)
{
    // Implémentez votre logique d'autorisation ici.
    // Par exemple, vérifiez si l'utilisateur a accès à la catégorie.
    return true; // Exemple simple, autorise toujours l'utilisateur à voir la catégorie.
}

}
