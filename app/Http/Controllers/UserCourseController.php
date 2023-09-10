<?php

namespace App\Http\Controllers;
use App\Models\UserCourse;
use App\Models\Course;
use App\Models\Level;
use Illuminate\Http\Request;
class UserCourseController extends Controller
{
    public function completeCourse($courseId)
    {
        // Récupérez l'utilisateur connecté
        $user = auth()->user();
        $categoryId = Course::find($courseId)->category_id;
        $course = Course::find($courseId);
        // Créez une instance de UserCourse pour enregistrer la progression
        $userCourse = new UserCourse();
        $userCourse->user_id = $user->id;
        $userCourse->course_id = $courseId;
        $userCourse->category_id = $categoryId;
        $userCourse->is_completed = true;
        $userCourse->save();
        $user->experiences += $course->experiences_gived;
        $user->currencies += $course->currencies_gived;
        $user->save();

         // Vérifier si l'utilisateur doit monter de niveau
        $this->checkLevelUp($user);
        // Redirigez l'utilisateur ou effectuez une autre action en conséquence
        return redirect()->back()->with('success', 'Cours marqué comme terminé !');
    }

    public function checkLevelUp($user)
{
    $nextLevel = Level::where('level', '>', $user->level)
                      ->orderBy('required_experience', 'asc')
                      ->first();

    if ($nextLevel && $user->experiences >= $nextLevel->required_experience) {
        $user->level = $nextLevel->level;
        $user->save();
    }
}

}
