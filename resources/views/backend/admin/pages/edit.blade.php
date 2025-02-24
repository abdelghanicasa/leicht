@extends('backend.layouts.master')

@section('content')

<div class="container-fluid py-2">
    <div class="ms-3">
        <h3 class="mb-0 h4 font-weight-bolder">Modifier la page</h3>
        <p class="mb-4">Modification : {{ $page->title }}</p>
    </div>
    <div class="row">
        <div class="col-12 px-2">
            <div class="card my-4 px-3">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 d-flex justify-content-between">
                    <div style="margin-right: 10px;" class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center w-100">
                        <!-- Title on the left -->
                        <h6 class="text-white text-capitalize ps-3 mb-0">Liste des pages</h6>

                        <!-- Button on the right -->
                        <a class="btn bg-gradient-dark px-3 mb-0" style="margin-right: 10px;" href="{{ route('admin.pages.create') }}">
                            <i class="material-symbols-rounded text-sm">add</i>&nbsp;&nbsp;Créer une page
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-check form-switch my-3">
                            <input class="form-check-input" type="checkbox" id="isHome" name="is_home" value="1" {{ $page->is_home ? 'checked' : '' }}>
                            <label class="form-check-label" for="isHome">Définir comme page d'accueil</label>
                        </div>

                        <div class="input-group input-group-outline my-3">
                            <!-- <label class="form-label">Nom menu navigation</label> -->
                            <input type="text" name="name" class="form-control" value="{{ old('name', $page->name ?? '') }}" placeholder="Entrez le nom de la page">

                        </div>

                        <div class="input-group input-group-outline my-3">
                            <!-- <label class="form-label">Titre de l'article</label> -->
                            <input type="text" name="title" class="form-control" value="{{ $page->title }}" placeholder="" required>
                        </div>

                        <div class="input-group input-group-outline my-3">
                            <!-- <label class="form-label">Url de la page</label> -->
                            <input type="text" name="slug" class="form-control" value="{{ $page->slug }}" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Contenu</label>
                            <textarea name="content" id="editor" class="form-control" rows="5">{{ $page->content }}</textarea>
                        </div>

                        <div class="">
                            <div class="input-group input-group-outline my-3">
                                <!-- <label class="form-label">Titre Bloc </label> -->
                                <input type="text" name="text_block_title" class="form-control" value="{{ $page->text_block_title }}">
                            </div>

                            <div class="w-100 input-group input-group-outline my-3" style="min-height: 350px; ">
                                <textarea name="text_block_content" id="blockContentEditor" class="form-control">{{ $page->text_block_content }}</textarea>
                            </div>
                        </div>

                        <!-- Existing Images Section -->
                        <div class="form-group">
                            <label>Images Existantes</label>
                            <div class="row" id="existingImages">
                                @foreach($page->images as $index => $image)
                                    <div class="col-md-2 mb-3 image-item" data-index="{{ $index }}">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="Image" class="card-img-top img-fluid" 
                                            style="min-height: 211px !important">
                                            <div class="card-body">
                                                <div class="input-group input-group-outline my-3">
                                                    <input type="number" name="image_orders[{{ $index }}]" class="form-control" value="{{ $image->order }}" placeholder="Ordre">
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <input type="text" name="image_titles[{{ $index }}]" class="form-control" value="{{ $image->title }}" placeholder="Titre de l'image">
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <select name="image_categories[{{ $index }}]" class="form-control">
                                                        <option value="">Sélectionnez une catégorie</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $image->category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- Add a Delete Button -->
                                                <button type="button" class="btn btn-danger btn-sm delete-image" data-image-id="{{ $image->id }}">Supprimer</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Upload New Images Section -->
                        <div class="form-group">
                            <label>Télécharger de nouvelles images</label>
                            <input type="file" name="new_images[]" multiple class="form-control" id="newImagesInput">
                        </div>

                        <!-- Fields for New Images -->
                        <div id="newImagesFields" class="form-group">
                            <div class="row">
                                <!-- Dynamically added fields will go here -->
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier la Page</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Initialize CKEditor -->
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    // Handle dynamic removal of existing images
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-image')) {
            const imageItem = event.target.closest('.image-item');
            if (imageItem) {
                imageItem.remove();
            }
        }
    });

    // Dynamically add fields for new images when files are selected
    document.getElementById('newImagesInput').addEventListener('change', function(event) {
        const newImagesFields = document.getElementById('newImagesFields');
        const row = newImagesFields.querySelector('.row');

        // Clear existing fields for new images
        row.innerHTML = '';

        // Generate fields for each selected file and show image preview
        Array.from(event.target.files).forEach((file, index) => {
            const reader = new FileReader();
            
            // Create a div to hold the new image field
            const col = document.createElement('div');
            col.className = 'col-md-4 mb-3';
            
            // Set up the FileReader to load image preview
            reader.onload = function(e) {
                col.innerHTML = `
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <img src="${e.target.result}" alt="Image Preview" class="img-fluid" style="max-height: 150px;">
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <input type="number" name="new_image_orders[${index}]" class="form-control" placeholder="Ordre">
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <input type="text" name="new_image_titles[${index}]" class="form-control" placeholder="Titre de l'image">
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <select name="new_image_categories[${index}]" class="form-control">
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remove-new-image">Supprimer</button>
                        </div>
                    </div>
                `;
                row.appendChild(col);
            };

            // Read the file as a data URL for preview
            reader.readAsDataURL(file);
        });
    });

    document.addEventListener('click', function (event) {
    if (event.target.classList.contains('delete-image')) {
        const imageId = event.target.dataset.imageId;
        const confirmDelete = confirm('Êtes-vous sûr de vouloir supprimer cette image ?');

        if (confirmDelete) {
            fetch(`/admin/pages/images/${imageId}`, {
                method: 'POST',  // Laravel does not accept DELETE without _method
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ _method: 'DELETE' }) // Fake DELETE request
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const imageItem = event.target.closest('.image-item');
                    if (imageItem) {
                        imageItem.remove();
                    }
                    alert('Image supprimée avec succès!');
                } else {
                    alert('Erreur: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue lors de la suppression de l\'image.');
            });
        }
    }
});

</script>
@endsection