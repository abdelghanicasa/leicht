@extends('backend.layouts.master')  <!-- Adjust with your layout name -->

@section('content')
    @if(session('success'))
        <div class="col-md-2" style="margin-left:20px">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
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
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Titre</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Slug</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Etat</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Créer</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $page)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <!--  -->
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $page->title }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $page->slug }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $page->slug }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <!-- You can modify the status based on conditions -->
                                            <span class="badge badge-sm bg-gradient-success">Published</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $page->created_at->format('d/m/Y') }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn bg-gradient-dark mb-0 text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit page">
                                                Modifier
                                            </a>
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

