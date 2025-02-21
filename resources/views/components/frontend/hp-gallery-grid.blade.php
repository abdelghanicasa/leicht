<div class="home about col-md-8 center mx-auto p-3" style="border: .8px #7b6f1f solid;">
    <!-- Image Container -->
    @if($images->isNotEmpty())
        <!-- First Image (Always Full Width) -->
        <div class="position-re o-hidden mb-4 animate-box" data-animate-effect="fadeInUp">
            <img src="{{ asset('storage/' . $images[0]->path) }}" alt="" class="w-100 hover-img">
            <div class="overlay">
                <p class="image-text text-white animated" data-animate-effect="fadeInUp">{{ $titles[0] ?? 'Nos Cuisines' }}</p>
            </div>
        </div>

        <!-- Second & Third Images -->
        <div class="row g-3">
            <!-- Second Image -->
            <div class="col-lg-7 col-md-12">
                <div class="position-re about-img d-flex position-relative fade-in animate-box" data-animate-effect="fadeInUp">
                    <img src="{{ asset('storage/' . $images[1]->path) }}" alt="ccs_logo" class="img-fluid w-100 h-100 hover-img" style="object-fit: cover;">
                    <div class="overlay">
                        <p class="image-text text-white animated" data-animate-effect="fadeInUp">{{ $titles[1] ?? 'Nos Dressings' }}</p>
                    </div>
                </div>
            </div>

            <!-- Third Image -->
            <div class="col-lg-5 col-md-12">
                <div class="position-re about-img d-flex position-relative fade-in animate-box h-100" data-animate-effect="fadeInUp">
                    <img src="{{ asset('storage/' . $images[2]->path) }}" alt="ccs_logo"
                        class="img-fluid w-100 h-100 hover-img"
                        style="object-fit: cover; min-height: 100%;">  <!-- Ensure full height -->
                    <div class="overlay">
                        <p class="image-text text-white animated" data-animate-effect="fadeInUp">{{ $titles[2] ?? 'Nos Réalisations' }}</p>
                    </div>
                </div>
            </div>

        </div>
    @else
        <p>Aucune Image à afficher</p>
    @endif
</div>
