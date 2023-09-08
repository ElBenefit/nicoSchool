@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Créer une Catégorie</h2>

    <!-- Afficher les erreurs de validation ici si nécessaire -->

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="visibility" class="form-label">Visibilité</label>
            <select class="form-select" id="visibility" name="visibility">
                <option value="public">Public</option>
                <option value="private">Privé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer la Catégorie</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
