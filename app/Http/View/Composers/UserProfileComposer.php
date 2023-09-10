<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Level;

class UserProfileComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();
        if ($user && $user->is_gamified) {
            $currentLevel = $user->level;
            $currentExperience = $user->current_experience;

            $nextLevel = Level::where('level', '>', $currentLevel)
                              ->orderBy('required_experience', 'asc')
                              ->first();

            $previousLevel = Level::where('level', '<', $currentLevel)
                                   ->orderBy('required_experience', 'desc')
                                   ->first();

            $view->with(compact('user', 'currentLevel', 'currentExperience', 'nextLevel', 'previousLevel'));
        }
    }
}
