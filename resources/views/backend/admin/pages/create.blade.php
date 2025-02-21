@extends('backend.layouts.master')

@section('content')
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between w-100">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Créer une nouvelle page</h6>
                        <a href="{{ route('admin.pages.index') }}" class="btn bg-gradient-secondary px-3 mb-0" style="margin-right: 10px;">
                            <i class="material-symbols-rounded text-sm">list</i>&nbsp;&nbsp;Listes des pages
                        </a>
                    </div>
                </div>
                <div class="card-body col-10 px-0 pb-2 mx-4">
                    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data" id="createPageForm">
                        @csrf
                                                
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Titre de l'article</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Slug (URL)</label>
                            <input type="text" name="slug" class="form-control" required>
                        </div>
                        <div class="w-100" style="min-height: 350px;">
                            <textarea name="content" id="contentEditor" class="form-control"></textarea>
                        </div>
                       
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Images</label>
                            <input type="file" name="images[]" id="imageUpload" multiple class="form-control d-none" accept="image/*">
                            <label for="imageUpload" class="btn bg-gradient-dark px-3 mb-0">
                                <i class="material-symbols-rounded text-sm">image</i>&nbsp;&nbsp;Choisir des images
                            </label>
                        </div>

                        <div id="blockTitleContentFields" class="d-none">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Titre Bloc </label>
                                <input type="text" name="text_block_title" class="form-control">
                            </div>

                            <div class="w-100" style="min-height: 350px;">
                                <textarea name="text_block_content" id="blockContentEditor" class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Checkbox to activate the text block -->
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="activeBlock" name="active_block">
                            <label class="form-check-label" for="activeBlock">Active Bloc titre / content</label>
                        </div>

                        <!-- Preview Container -->
                        <div id="imagePreview" class="d-flex flex-wrap mt-3"></div>
                        <div id="categories-data" style="display: none;">
                            @foreach($categories as $category)
                                <div data-id="{{ $category->id }}" data-name="{{ $category->name }}"></div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn bg-gradient-dark px-3 mb-0" form="createPageForm">
                            <i class="material-symbols-rounded text-sm">save</i>&nbsp;&nbsp;Sauvegarder
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#contentEditor'))
        .catch(error => {
            console.error(error);
        });

    // Initialize CKEditor for block content when checkbox is checked
    document.getElementById('activeBlock').addEventListener('change', function() {
        const blockTitleContentFields = document.getElementById('blockTitleContentFields');
        const blockContentEditor = document.querySelector('#blockContentEditor');

        // If checkbox is checked, show title and content inputs and initialize CKEditor for block content
        if (this.checked) {
            blockTitleContentFields.classList.remove('d-none');
            if (!blockContentEditor.classList.contains('ck-editor__editable')) {
                ClassicEditor
                    .create(blockContentEditor)
                    .catch(error => {
                        console.error(error);
                    });
            }
        } else {
            blockTitleContentFields.classList.add('d-none');
        }
    });

    document.getElementById('imageUpload').addEventListener('change', function(event) {
    let previewContainer = document.getElementById('imagePreview');
    let files = Array.from(event.target.files);

    // Get categories from the hidden HTML element
    let categoriesData = document.getElementById('categories-data').children;
    let categories = [];
    for (let category of categoriesData) {
        categories.push({
            id: category.getAttribute('data-id'),
            name: category.getAttribute('data-name')
        });
    }

    files.forEach((file, index) => {
        if (file.type.startsWith('image/')) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let imageWrapper = document.createElement('div');
                imageWrapper.classList.add('image-wrapper');

                let img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('preview-img');

                // Create a div for each input with the specified class
                let orderInputGroup = createInputDiv('number', 'image_orders[]', index + 1, 'Ordre de l\'image');
                let titleInputGroup = createInputDiv('text', 'image_titles[]', '', 'Titre de l\'image');
                let categoryInputGroup = createCategoryDiv(categories);

                // Append all input groups to the inputContainer
                let inputContainer = document.createElement('div');
                inputContainer.classList.add('d-flex', 'flex-column', 'align-items-start', 'w-100');
                inputContainer.appendChild(orderInputGroup);
                inputContainer.appendChild(titleInputGroup);
                inputContainer.appendChild(categoryInputGroup);

                // Create close button
                let closeBtn = document.createElement('button');
                closeBtn.innerHTML = '&times;';
                closeBtn.classList.add('close-btn');
                closeBtn.onclick = function() {
                    imageWrapper.remove();
                };

                // Append elements to imageWrapper
                imageWrapper.appendChild(img);
                imageWrapper.appendChild(inputContainer);
                imageWrapper.appendChild(closeBtn);

                // Append imageWrapper to previewContainer
                previewContainer.appendChild(imageWrapper);
            };
            reader.readAsDataURL(file);
        }
    });
});

// Helper function to create an input group
function createInputDiv(type, name, value, placeholder) {
    let inputGroup = document.createElement('div');
    inputGroup.classList.add('input-group', 'input-group-outline', 'my-1');

    let input = document.createElement('input');
    input.type = type;
    input.name = name;
    input.value = value || '';
    input.classList.add('form-control');
    input.placeholder = placeholder;

    inputGroup.appendChild(input);
    return inputGroup;
}

// Helper function to create a category select group
function createCategoryDiv(categories) {
    let inputGroup = document.createElement('div');
    inputGroup.classList.add('input-group', 'input-group-outline', 'my-1');

    let categorySelect = document.createElement('select');
    categorySelect.name = "image_categories[]";
    categorySelect.classList.add('form-control');

    // Populate the category dropdown
    let defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.text = 'Sélectionnez une catégorie';
    categorySelect.appendChild(defaultOption);

    categories.forEach(category => {
        let option = document.createElement('option');
        option.value = category.id;
        option.text = category.name;
        categorySelect.appendChild(option);
    });

    inputGroup.appendChild(categorySelect);
    return inputGroup;
}
</script>
@endpush

<!-- Add CSS for the image preview -->
<style>
    .ck-editor__editable {
        min-height: 300px !important;
    }

    .image-wrapper {
        position: relative;
        display: inline-block;
        margin: 5px;
        text-align: center;
        width: 120px;
    }

    .preview-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #ddd;
        padding: 3px;
    }

    .image-title {
        width: 100px;
        margin-top: 5px;
        font-size: 12px;
        padding: 3px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .close-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        cursor: pointer;
        font-size: 14px;
        line-height: 18px;
        text-align: center;
    }

    .close-btn:hover {
        background: red;
    }
</style>
@endsection