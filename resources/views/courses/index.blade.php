@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des cours</h1>

        <!-- Message de succès -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulaire de recherche -->
        <form method="GET" action="{{ route('courses.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher un cours" value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Nom du cours</th>
                    <th>Catégorie</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>
                        @if ($course->category)
                            {{ $course->category->name }}
                        @else
                            Catégorie non définie
                        @endif
                    </td>
                    <td>{{ $course->type }}</td>
                    <td>
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary">Éditer</a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <!-- Bouton pour créer un nouveau cours -->
        <a href="{{ route('courses.create') }}" class="btn btn-success">Créer un nouveau cours</a>

        <!-- Pagination avec recherche -->
        {{ $courses->appends(['search' => $search])->links() }}
    </div>
@endsection
