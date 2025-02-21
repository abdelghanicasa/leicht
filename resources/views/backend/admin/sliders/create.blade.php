@extends('backend.layouts.master')

@section('content')
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Créer un Slider</h6>
                    </div>
                </div>
                <div class="card-body col-10 px-0 pb-2 mx-4">
                    <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label" for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label" for="url">URL</label>
                            <input type="text" name="url" class="form-control">
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label" for="page_id">Page</label>
                            <select name="page_id" class="form-control" required>
                                @foreach($pages as $page)
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistré</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection