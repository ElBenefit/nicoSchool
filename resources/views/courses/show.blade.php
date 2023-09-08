@extends('layouts.app')

@section('content')
    <div class="container">
    <a href="{{ route('courses.index') }}" class="btn btn-primary">Retour</a>
        <h1>Détails du cours : {{ $course->name }}</h1>

        <ul>
            <li><strong>Nom du cours :</strong> {{ $course->name }}</li>
            <li><strong>Catégorie :</strong> {{ $course->category->name }}</li>
            <li><strong>Type :</strong> {{ $course->type }}</li>
            <li><strong>Visibilité :</strong> {{ $course->visibility }}</li>
        </ul>

        <h2>Contenu du cours :</h2>
        <p>{{ $course->content }}</p>
        @if (!$course->isCompleted())
    <form method="POST" action="{{ route('complete-course', ['courseId' => $course->id]) }}">
        @csrf
        <button type="submit" class="btn btn-primary mt-4">Marquer comme terminé</button>
    </form>
@else
    <p>Cours terminé</p>
@endif      
        
    </div>
@endsection


