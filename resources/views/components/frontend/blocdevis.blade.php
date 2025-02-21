
@php
    $bloc = App\Models\Bloc::where('bloc_type', 'devis')->first();
@endphp

@if($bloc)
    <section class="py-5 mt-5 text-center bgColorGrey80">
        <div class="container">
            <h2 class="mb-4 col-md-7 mx-auto bold white fade-in animate-box" data-animate-effect="fadeInUp">
                {!! $bloc->title !!}
            </h2>
            <p class="mb-4 fade-in animate-box" data-animate-effect="fadeInBottom">
                {!! $bloc->text !!}
            </p>

            @if($bloc->url)
            <div class="d-grid gap-2 col-lg-4 col-md-6 col-10 mx-auto">
                <button onclick="window.location.href='{{ $bloc->url }}'"
                    class="fade-in animate-box fadeInUp animated btnDevis" 
                    data-animate-effect="fadeInUp" 
                    type="button" 
                    style="height: 70px; border-radius: 10px;">
                        <span style="font-weight: bolder;" class="me-2 buttonProject">
                            {{ $bloc->url_text ?? 'Prendre Rendez-Vous' }}
                        </span> 
                    <i class="ti-arrow-right"></i>
                </button>
            </div>

            @endif
        </div>
    </section>
@endif
