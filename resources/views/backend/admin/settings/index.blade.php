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
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Informations site web</h6>
              </div>
            </div>
            <div class="card-body col-10 px-0 pb-2 mx-4">
              
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="input-group input-group-outline my-3">
                        @if($settings && $settings->logo)
                            <div style="padding:5px; background-color: black;"><img src="{{ asset('storage/' . $settings->logo) }}" width="150" alt="Logo actuel"></div>
                        @endif
                    </div>
                    
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Logo</label>
                        <input type="file" id="logo" name="logo" class="form-control d-none">
                        <label for="logo" class="btn btn-secondary">Sélectionner un fichier</label>
                        <!-- <span id="file-name" class="ms-2">Aucun fichier sélectionné</span> -->
                    </div>

                    <div class="input-group input-group-outline my-3">
                    @if($settings && $settings->logoblack)
                        <div style="background-color: white;">
                            <img src="{{ asset('storage/' . $settings->logoblack) }}" width="150" alt="Logo Noir">
                        </div>
                        @endif
                    </div>                    
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Logo Noir</label>
                        <input type="file" id="logoblack" name="logoblack" class="form-control d-none">
                        <label for="logoblack" class="btn btn-secondary">Sélectionner Logo Version Noir</label>
                        <!-- <span id="file-name" class="ms-2">Aucun fichier sélectionné</span> -->

                    </div>


                    <div class="input-group input-group-outline my-3">
                        <!-- <label class="form-label">Addresse</label> -->
                        <!-- <input type="text" name="address" class="form-control" value="{{ $settings->address ?? '' }}"> -->
                        <textarea name="address" rows="5" id="address" class="form-control">{{ $settings->address ?? '' }}</textarea>
                    </div>

                    <div class="input-group input-group-outline my-3">
                        <!-- <label class="form-label">Téléphone</label> -->
                        <input type="text" name="slogan" class="form-control" value="{{ $settings->slogan ?? '' }}">
                    </div>

                    <div class="input-group input-group-outline my-3">
                        <!-- <label class="form-label">Téléphone</label> -->
                        <input type="text" name="phone" class="form-control" value="{{ $settings->phone ?? '' }}">
                    </div>

                    <div class="input-group input-group-outline my-3">
                        <!-- <label class="form-label">Email</label> -->
                        <input type="text" name="email" class="form-control" value="{{ $settings->email ?? '' }}">
                    </div>

                    <div class="input-group input-group-outline my-3">
                        <!-- <label class="form-label">Site web</label><br> -->
                        <input type="text" name="website" class="form-control" value="{{ $settings->website ?? '' }}">
                    </div>

                    <div class="input-group input-group-outline my-3">
                        <!-- <label class="form-label">Horaires</label> -->
                        <textarea name="opening_hours" class="form-control" id="opening_hours" rows="10">{{ $settings->opening_hours ?? '' }}</textarea>
                    </div>
                    <p style="color: orange;" class="form-label">Instagram Access Token</p>
                    <div class="input-group input-group-outline my-3">
                        
                        <textarea name="instagram_token" class="form-control" >{{ $settings->access_token ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
              
            </div>
          </div>
        </div>
      </div>

    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                ClassicEditor
                    .create(document.querySelector('#address'))
                    .catch(error => {
                        console.error(error);
                    });

                ClassicEditor
                    .create(document.querySelector('#opening_hours'))
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>
    @endpush

@endsection
