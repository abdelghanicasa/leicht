@extends('frontend.layouts.app')

@php
    $categories = App\Models\Category::with('images')->get();
@endphp

@section('content')

    <!-- Content Block -->
    <x-frontend.content-block 
        :title="$page->title" 
        :content="$page->content" 
    />

    <!-- formulaire -->
    <div class="d-flex justify-content-around align-items-center vh-80 contactForm mb-4">
        <div class="col-lg-6">
            <div id="success-message" id="envoye">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                        <h2>
                            Confirmation de Réception !
                             {{ $message }}
                        </h2>
                    </div>
                @endif                
            </div> <!-- Success message container -->

            <form id="contact-form" class="row g-3" method="POST" action="{{ route('page.send') }}">
                @csrf
                <div class="col-md-6">
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom*" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom*" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Téléphone*" required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Adresse Email*" required>
                </div>
                <div class="col-12">
                    <textarea class="form-control" id="message" rows="5" name="message" placeholder="Message*" required></textarea>
                </div>
                <p class="formText">{{ $page->text_block_content }}</p>
                <div class="col-lg-5">
                    <input name="submit" type="submit" value="Envoyer!">
                </div>
            </form>
        </div>
    </div>

    <!-- <div class="container-fluid p-0">

            <div id="map">
                @if($page->images->isNotEmpty())
                    <img src="{{ asset('storage/' . $page->images->first()->path) }}" 
                         alt="{{ $page->images->first()->title }}" 
                         class="img-fluid" style="object-fit: cover; height: 100%; width: 100%;">
                @endif

    </div>
</div> -->


<div class="row">
    <div class="col-md-12 mb-0 animate-box fadeInUp animated" data-animate-effect="fadeInUp">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2885.599148785766!2d9.437942894574158!3d42.63510914199283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDIuNjM1MTA5MTQxOTkyODMsIDkuNDM3OTQyODk0NTc0MTU4!5e0!3m2!1sen!2sus!4v1707900000000" 
            width="100%" 
            height="500" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            class="map">
        </iframe>
    </div>
</div>

@endsection

@push('scripts')
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
$(document).ready(function () {
    $('#contact-form').on('submit', function (e) {
        e.preventDefault(); // Prevent page reload

        $.ajax({
            url: "{{ route('page.send') }}",  // This must match your POST route
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                $('#success-message').html(
                    '<div class="alert alert-success">' + response.success + '</div>'
                );
                $('#contact-form')[0].reset(); // Reset form after success

                        // Scroll smoothly to the confirmation section
            $('html, body').animate({
                scrollTop: $("#envoye").offset().top
            }, 800);

            },
            error: function (xhr) {
                alert("Une erreur s\'est produite. Veuillez réessayer.");
            }
        });
    });
});
</script>
@endpush
