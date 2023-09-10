@extends('layouts.app')

@section('content')
    <div class="container">
    <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
        <h1>Détails du cours : {{ $course->name }}</h1>

        <ul>
            <li><strong>Nom du cours :</strong> {{ $course->name }}</li>
            <li><strong>Catégorie :</strong> {{ $course->category->name }}</li>
            <li><strong>Type :</strong> {{ $course->type }}</li>
            <li><strong>Visibilité :</strong> {{ $course->visibility }}</li>
        </ul>

        <h2>Contenu du cours :</h2>
        <p>{{ $course->content }}</p>
        @if (Auth::user()->is_gamified)   
        @if (!$course->isCompleted())
        <form method="POST" action="{{ route('complete-course', ['courseId' => $course->id]) }}">
            @csrf
            <button type="submit" class="btn btn-primary mt-4">Marquer comme terminé</button>
        </form>
        @else
            <p>Cours terminé</p>
        @endif      
    
        @endif
        <form action="{{ route('courses.destroy', $course->id) }}" method="POST"   >
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mt-4" type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">Supprimer</button>
        </form>
        
    </div>
@endsection


