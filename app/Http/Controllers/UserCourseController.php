<?php

namespace App\Http\Controllers;
use App\Models\UserCourse;
use Illuminate\Http\Request;
class UserCourseController extends Controller
{
    public function completeCourse($courseId)
    {
        // Récupérez l'utilisateur connecté
        $user = auth()->user();

        // Créez une instance de UserCourse pour enregistrer la progression
        $userCourse = new UserCourse();
        $userCourse->user_id = $user->id;
        $userCourse->course_id = $courseId;
        $userCourse->is_completed = true;
        $userCourse->save();

        // Redirigez l'utilisateur ou effectuez une autre action en conséquence
        return redirect()->back()->with('success', 'Cours marqué comme terminé !');
    }
}
