
@extends('backend.layouts.master')

@section('content')
<!-- <div class="container">
    <h2 class="mb-4">Ajouter un Bloc</h2> -->
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between w-100">
                            <h6 class="text-white text-capitalize ps-3 mb-0">Créer une Nouveau Bloc</h6>
                            <a href="{{ route('admin.pages.index') }}" class="btn bg-gradient-secondary px-3 mb-0" style="margin-right: 10px;">
                                <i class="material-symbols-rounded text-sm">list</i>&nbsp;&nbsp;Listes des pages
                            </a>
                        </div>
                    </div>
                    <div class="card-body col-10 px-0 pb-2 mx-4">
                        <form action="{{ route('blocs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="input-group input-group-outline my-3">
                                <!-- <label for="title" class="form-label">Titre du Bloc</label> -->
                                <textarea name="title" id="title" class="form-control" required></textarea>
                            </div>

                            <div class="input-group input-group-outline my-3">
                                <label for="text" class="form-label">Texte</label>
                                <textarea name="text" id="text" class="form-control"></textarea>
                            </div>

                            <div class="input-group input-group-outline my-3">
                                <label for="images" class="form-label">Images</label>
                                <input type="file" name="images[]" id="images" class="form-control" multiple>
                            </div>

                            <div class="input-group input-group-outline my-3">
                                <label for="url" class="form-label">Lien (URL)</label>
                                <input type="text" name="url" id="url" class="form-control">
                            </div>

                            <div class="input-group input-group-outline my-3">
                                <label for="bloc_type" class="form-label">Type Bloc (ex : devis, bloc)</label>
                                <input type="text" name="bloc_type" id="bloc_type" class="form-control">
                            </div>

                            <div class="input-group input-group-outline my-3">
                                <label for="url_text" class="form-label">Text (URL)</label>
                                <input type="text" name="url_text" id="url_text" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    ClassicEditor.create(document.querySelector('#text')).catch(error => console.error(error));
</script>
@endpush
