@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Éditer un cours</h1>
        <form action="{{ route('courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom du cours</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $course->name }}">
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Catégorie</label>
                <select class="form-select" id="category" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id === $course->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type">
                    <option value="Théorie" {{ $course->type === 'Théorie' ? 'selected' : '' }}>Théorie</option>
                    <option value="Exercice" {{ $course->type === 'Exercice' ? 'selected' : '' }}>Exercice</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="visibility" class="form-label">Visibilité</label>
                <select class="form-select" id="visibility" name="visibility">
                    <option value="public" {{ $course->visibility === 'public' ? 'selected' : '' }}>Public</option>
                    <option value="private" {{ $course->visibility === 'private' ? 'selected' : '' }}>Privé</option>
                </select>
            </div>

            <div class="form-group">
                <label for="content">Contenu du cours :</label>
                <textarea name="content" id="summernote" >{{ $course->content }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>
@endsection
