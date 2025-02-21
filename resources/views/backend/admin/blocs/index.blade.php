@extends('backend.layouts.master')

@section('content')
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between w-100">
                            <h6 class="text-white text-capitalize ps-3 mb-0">Listes des blocs</h6>
                            <a href="{{ route('blocs.create') }}" class="btn btn-primary" style="margin-right: 10px;">Ajouter un Bloc</a>
                            
                        </div>
                    </div>
                    <div class="card-body col-10 px-0 pb-2 mx-4"></div>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Text</th>
                                <th>Images</th>
                                <th>URL</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blocs as $bloc)
                            <tr>
                                <td>{{ $bloc->title }}</td>
                                <td>{{ Str::limit($bloc->text, 50) }}</td>
                                <td>
                                    @if($bloc->images)
                                    @php
                                    $images = is_string($bloc->images) ? json_decode($bloc->images, true) : [];
                                    @endphp

                                    @foreach($images as $image)
                                    <img src="{{ asset('storage/' . $image) }}" width="50" height="50">
                                    @endforeach
                                    @endif
                                </td>
                                <td><a href="{{ $bloc->url }}" target="_blank">{{ $bloc->url }}</a></td>
                                <td>
                                    <a href="{{ route('blocs.edit', $bloc->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('blocs.destroy', $bloc->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this bloc?')">Supprimer</button>
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
@endsection