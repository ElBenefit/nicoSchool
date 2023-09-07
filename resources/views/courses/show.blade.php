@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails du cours : {{ $course->name }}</h1>

        <ul>
            <li><strong>Nom du cours :</strong> {{ $course->name }}</li>
            <li><strong>Catégorie :</strong> {{ $course->category->name }}</li>
            <li><strong>Type :</strong> {{ $course->type }}</li>
            <li><strong>Visibilité :</strong> {{ $course->visibility }}</li>
        </ul>

        <h2>Contenu du cours :</h2>
        <p>{{ $course->content }}</p>

        <a href="{{ route('courses.index') }}" class="btn btn-primary">Retour à la liste des cours</a>
    </div>
@endsection
