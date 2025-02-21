@php
    $settings = \App\Models\Setting::first();
@endphp

<!-- Footer -->
<footer class="main-footer dark mt-5">
    <div class="container-fluid bgColor">
        <div class="row">
            <!-- Logo Section -->
            <div class="footerM col-md-2 d-flex justify-content-center align-items-center primary-bg py-4">
                <div class="text-center">
                    <a class="logo" href="#">
                        @if($settings && $settings->logo)
                            <img src="{{ asset('storage/' . $settings->logoblack) }}" class="logo-img mb-2" alt="Logo">
                        @else
                            <img src="{{ asset('img/leicht-logo-black.png') }}" class="logo-img mb-2" alt="Default Logo">
                        @endif
                    </a>
                    <p class="small-text " style="color: #000;">{{ $settings->slogan }}</p>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="col-md-3 text-center py-4">
                <h5 class="text-uppercase fw-bold">Coordonnées</h5>
                <!-- <p class="mb-0">{!! $settings->address !!}</p> -->
                {!! str_replace('<p>', '<p class="mb-0">', $settings->address) !!}
                <p class="mb-0"><a href="mailto:{{ $settings->email ?? 'contact@leichtbastia.fr' }}">{{ $settings->email ?? 'contact@leichtbastia.fr' }}</a></p>
                <p class="mb-0"><a href="{{ $settings->website ?? 'www.leichtbastia.fr' }}" target="_blank">{{ $settings->website ?? 'www.leichtbastia.fr' }}</a></p>
                <p class="mb-0">{{ $settings->phone ?? '04 95 32 12 12' }}</p>
            </div>

            <!-- Visit Section -->
            <div class="col-md-3 text-center py-4">
                <h5 class="text-uppercase fw-bold">Nous rendre visite</h5>
                @if($settings && $settings->opening_hours)
                {!! str_replace('<p>', '<p class="mb-0">', $settings->opening_hours) !!}
                @else
                    <p class="mb-0">Du lundi au vendredi</p>
                    <p class="mb-0">de 10h à 12h et de 14h à 19h.</p>
                    <p class="mb-0">Le samedi</p>
                    <p class="mb-0">de 10h à 19h.</p>
                @endif
            </div>

            <!-- Links Section -->
            <div class="col-md-4 text-center py-4">
                <h5 class="text-uppercase fw-bold">Liens utiles</h5>
                <p class="mb-0"><a href="#">Informations complémentaires</a></p>
                <p class="mb-0"><a href="#">Mentions légales</a></p>
                <p class="mb-0"><a href="#">Politique de confidentialité</a></p>
                <p class="mb-0">
                    <a href="https://www.instagram.com/leicht" target="_blank">
                        <i class="ti-instagram" style="font-size: 24px;"></i>
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- CopyRight Part -->
    <!-- <div class="sub-footer mb-4 mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-left">
                    <p>© {2025} LEICHT BY RD Concept.</p>
                </div>
            </div>
        </div>
    </div> -->
</footer>
