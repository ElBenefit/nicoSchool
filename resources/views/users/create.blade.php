@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create User</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="group_id" class="form-label">Group</label>
            <select class="form-select" id="group_id" name="group_id">
                <option value="">Aucun groupe</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>
            <h3>Catégories auxquelles l'utilisateur aura accès :</h3>
        @foreach ($categories as $category)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}">
                <label class="form-check-label" for="categories">{{ $category->name }}</label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
