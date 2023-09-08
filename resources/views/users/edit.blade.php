@extends('layouts.app')

@section('content')
    <div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

        <h1>Éditer l'Utilisateur</h1>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
            </div>

            <div class="mb-3">
                <label for="group" class="form-label">Groupe</label>
                <select class="form-select" id="group" name="group_id">
                    <option value="">Aucun groupe</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" {{ $user->group_id == $group->id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <h3>Catégories auxquelles vous avez accès :</h3>
            @foreach ($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" @if ($user->categories->contains($category)) checked @endif>
                    <label class="form-check-label" for="categories">{{ $category->name }}</label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
@endsection
