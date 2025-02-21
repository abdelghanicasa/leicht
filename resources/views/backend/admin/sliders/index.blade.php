@extends('backend.layouts.master')

@section('content')

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between w-100">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Gestion des sliders</h6>
                        <a href="{{ route('sliders.create') }}" class="btn bg-gradient-dark px-3 mb-0" style="margin-right: 10px;">
                            <i class="material-symbols-rounded text-sm">add</i>&nbsp;&nbsp;Créer un slider
                        </a>
                    </div>
                </div>

                <div class="card-body px-4 pb-2">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Titre</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">URL</th>
                                    <th class="text-center">Page Associée</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                <tr class="text-center align-middle">
                                    <td>
                                        <img src="{{ asset('storage/' . $slider->image) }}" width="100" alt="Slider Image" class="img-fluid">
                                    </td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ Str::limit($slider->description, 50) }}</td>
                                    <td>
                                        <a href="{{ $slider->url }}" target="_blank" class="text-primary">Visiter le lien</a>
                                    </td>
                                    <td>
                                        <!-- Display the associated page title -->
                                        {{ $slider->page->title ?? 'N/A' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('sliders.edit', $slider) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('sliders.destroy', $slider) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
