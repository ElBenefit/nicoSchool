@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer un nouveau cours</h1>

        <form method="POST" action="{{ route('courses.store') }}" >
            @csrf

            <div class="form-group mb-2">
                <label for="name">Nom du cours :</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
                      

            <div class="form-group mb-2">
                <label for="type">Type de cours :</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="Théorie">Théorie</option>
                    <option value="Exercice">Exercice</option>
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="visibility">Visibilité :</label>
                <select name="visibility" id="visibility" class="form-control" required>
                    <option value="public">Public</option>
                    <option value="privé">Privé</option>
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="content">Contenu du cours :</label>
                <textarea name="content" id="summernote" ></textarea>
            </div>

            <div class="form-group mb-2">
                <label for="category_id">Catégorie :</label>
                <select class="form-control" id="category_id" name="category_id" onchange="updateOrderOptions()">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" data-courses="{{ $category->courses->pluck('name')->toJson() }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="order">Selectionnez la position du cours :</label>
                <select class="form-control" id="order" name="order">
                    <!-- Les options seront ajoutées dynamiquement par JavaScript -->
                </select>
            </div>
    

            <button type="submit" class="btn btn-primary">Créer le cours</button>
        </form>
    </div>
    <script> 
        document.addEventListener("DOMContentLoaded", function() {
            updateOrderOptions();
            document.getElementById('category_id').addEventListener('change', updateOrderOptions);
        });

        function updateOrderOptions() {
            const categorySelect = document.getElementById('category_id');
            const orderSelect = document.getElementById('order');
            const selectedCategory = categorySelect.options[categorySelect.selectedIndex];
            const courses = JSON.parse(selectedCategory.getAttribute('data-courses'));

            while (orderSelect.firstChild) {
                orderSelect.removeChild(orderSelect.firstChild);
            }

            courses.forEach((courseName, index) => {
                const option = document.createElement('option');
                option.value = index + 1;
                option.text = 'Avant : '+ courseName;
                orderSelect.appendChild(option);
            });

            // Ajouter une option pour la position "après le dernier cours"
            const lastOption = document.createElement('option');
            lastOption.value = courses.length + 1;
            lastOption.text = "Après le dernier cours (" + courses[courses.length-1] + ")";
            lastOption.selected = true; 
            orderSelect.appendChild(lastOption);
        }
    </script>
@endsection
