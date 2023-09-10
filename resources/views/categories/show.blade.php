@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <h5 class="card-header">{{ $category->name }}</h5>
                <div class="card-body">
                    <ul class="list-unstyled">
                    
                        @foreach ($courses as $course)
                    
                        <li class="mb-2">
                        @if (Auth::user()->is_gamified)
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
                         @else
                         <a href="{{ route('courses.show', $course->id) }}">{{ $course->name }}</a>
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
