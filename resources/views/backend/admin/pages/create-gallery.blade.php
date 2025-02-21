@extends('backend.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h5>Créer la galerie pour {{ $page->title }}</h5>
                </div>
                <div class="card-body">
                <form action="{{ route('admin.pages.storeGallery', $page->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group input-group-outline my-3">
                        <label for="category">Séléctionner une Categorie (Facultatif)</label>
                        <select name="category_id" id="category" class="input-group input-group-outline my-3">
                            <option value="">Aucune</option> <!-- Option for no category -->
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group input-group-outline my-3">
                        <label for="page_type">Page Type</label>
                        <select name="page_type" id="page_type" class="input-group input-group-outline my-3">
                            <option value="project">Project</option>
                            <option value="cuisines">Cuisines</option>
                            <option value="dressings">Dressings</option>
                        </select>
                    </div>

                    <div class="input-group input-group-outline my-3">
                        <label for="images">Upload Images</label>
                        <input type="file" name="images[]" id="images" class="input-group input-group-outline my-3" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Gallery</button>
                </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
.input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
    border: 1px solid #dddddd;
    border-radius: 5px;
    padding: 10px;
}    

</style>