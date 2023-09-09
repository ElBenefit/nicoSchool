@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Cours</h1>
    @if ($categories->isEmpty())
    <div class="alert alert-warning">
        Vous n'avez aucune catégorie de cours.
    </div>
    @else
    <div class="row">
        @foreach ($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card">
                <h5 class="card-header">{{ $category->name }}</h5>
                <div class="card-body">
                    
                <ul class="list-unstyled">
                    @php
                    $courses = $category->courses->take(6);    
                    @endphp
                    @foreach ($courses as $course)
                        <li class="mb-2">
                            @if (($course->order === 1) || $course->isCompleted())
                                <a href="{{ route('courses.show', $course->id) }}">{{ $course->name }}</a>
                                @else
                                @if (!empty($userCoursesCompleted->first()) && !is_null($course))
                                @php
                                $lastCompletedCourse = $userCoursesCompleted->where('category_id', '=', $course->category_id)->last();
                                @endphp
                                    @if ($lastCompletedCourse && $lastCompletedCourse->course->order + 1 == $course->order)
                                    <a href="{{ route('courses.show', $course->id) }}">{{ $course->name }}</a>
                                @else
                                
                                    {{ $course->name }}
                                @endif
                                @else
                                    {{ $course->name }}
                                @endif
                            @endif
                        </li>
                    @endforeach
                </ul>
                    @if ($category->courses->count() > 6)
                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary">Voir Tout</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
