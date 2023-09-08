@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <h5 class="card-header">{{ $category->name }}</h5>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @php
                            $courses = $category->courses->take(6); // Prendre les 6 derniers cours
                        @endphp
                        @foreach ($courses as $course)
                        <li class="mb-2"><a href="{{ route('courses.show', $course->id) }}">{{ $course->name }}</a></li>
                        @endforeach
                    </ul>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary">Retour à la liste des catégories</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
