@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Catégories</h2>

    <!-- Afficher le message de succès ici si nécessaire -->

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Visibilité</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if ($category->visibility)
                            {{ $category->visibility }}
                        @else
                            Catégorie non définie
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Éditer</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container">
    <!-- ... Votre code existant ... -->

    <a href="{{ route('categories.create') }}" class="btn btn-success">Créer une Catégorie</a>
</div>

</div>
@endsection
