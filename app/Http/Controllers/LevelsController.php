<?php

namespace App\Http\Controllers;

use App\Models\m;
use Illuminate\Http\Request;

class LevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(m $m)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(m $m)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, m $m)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(m $m)
    {
        //
    }

    public function showDashboard()
{
    $user = Auth::user();
    $currentLevel = $user->level;
    $currentExperience = $user->current_experience;

    $nextLevel = Level::where('level', '>', $currentLevel)
                      ->orderBy('required_experience', 'asc')
                      ->first();

    $previousLevel = Level::where('level', '<', $currentLevel)
                           ->orderBy('required_experience', 'desc')
                           ->first();

    return view('dashboard', compact('user', 'currentLevel', 'currentExperience', 'nextLevel', 'previousLevel'));
}
}
