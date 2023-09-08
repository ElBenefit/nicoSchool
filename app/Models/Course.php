<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'type',
        'content',
        'visibility', // Ajoutez cette ligne
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses')
            ->withPivot('is_completed')
            ->withTimestamps();
    }
    public function userCourses()
    {
        return $this->belongsToMany(Course::class, 'user_courses')            
            ->withTimestamps(); // Si vous avez des colonnes de timestamps (created_at, updated_at)
    }
public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

public function isCompleted()
{
    // Vérifiez si l'utilisateur connecté a marqué ce cours comme terminé
    $user = Auth::user();

    if ($user) {
        return $this->users()
            ->where('users.id', $user->id)
            ->wherePivot('is_completed', true)
            ->exists();
    }
    return false;
}

public function nextCourse()
{
    $user = Auth::user();
    $latestCompletedCourse = $user->completedCourses()->orderBy('created_at', 'desc')->first();

    if ($latestCompletedCourse) {
        return Course::where('order', $latestCompletedCourse->course->order + 1)->first();
    }
    
    return null; // Retourne null si aucun cours n'a été complété
}

public function previousCourse()
{
    // Recherchez le cours précédent ayant un ordre inférieur au cours actuel.
    return Course::where('order', '<', $this->order)->orderBy('order', 'desc')->first();
}


}
