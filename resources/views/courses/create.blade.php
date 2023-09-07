@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer un nouveau cours</h1>

        <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Nom du cours :</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="category">Catégorie :</label>
                <select name="category_id" id="category" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type">Type de cours :</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="Théorie">Théorie</option>
                    <option value="Exercice">Exercice</option>
                </select>
            </div>

            <div class="form-group">
                <label for="visibility">Visibilité :</label>
                <select name="visibility" id="visibility" class="form-control" required>
                    <option value="public">Public</option>
                    <option value="privé">Privé</option>
                </select>
            </div>

            <div class="form-group">
                <label for="content">Contenu du cours :</label>
                <textarea name="content" id="content" class="form-control" rows="10" required></textarea>
            </div>

            <div class="form-group">
                <label for="image">Image :</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Créer le cours</button>
        </form>
    </div>
@endsection
