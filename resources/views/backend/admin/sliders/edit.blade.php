@extends('backend.layouts.master')

@section('content')
    <div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Modifier Slider</h6>
                    </div>
                </div>
                <div class="card-body col-10 px-0 pb-2 mx-4">    
                    <form action="{{ route('sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                            @if($slider->image)
                                <img src="{{ asset('storage/' . $slider->image) }}" width="150" alt="Slider Image">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ $slider->title }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control">{{ $slider->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="url" name="url" value="{{ $slider->url }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="page_id">Page</label>
                            <select name="page_id" class="form-control" required>
                                @foreach($pages as $page)
                                    <option value="{{ $page->id }}" {{ $slider->page_id == $page->id ? 'selected' : '' }}>{{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Slider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
