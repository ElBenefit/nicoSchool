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
                            $courses = $category->courses;
                        @endphp
                        @foreach ($courses as $course)
                    
                        <li class="mb-2">
                            @if (($course->order === 1) ||  $course->isCompleted() || ($course->order == $userCoursesCompleted->last()->course->order+1) )
                            <a href="{{ route('courses.show', $course->id) }}">{{ $course->name }}</a>
                            @else
                            {{ $course->name }}
                            @endif                           
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary">Retour à la liste des catégories</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
