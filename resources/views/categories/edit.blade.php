@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la Catégorie</h2>

    <!-- Afficher les erreurs de validation ici si nécessaire -->

    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
        </div>
        <div class="mb-3">
            <label for="visibility" class="form-label">Visibilité</label>
            <select class="form-select" id="visibility" name="visibility">
                <option value="public" {{ $category->visibility === 'public' ? 'selected' : '' }}>Public</option>
                <option value="private" {{ $category->visibility === 'private' ? 'selected' : '' }}>Privé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer les Modifications</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
    
</div>
@endsection
