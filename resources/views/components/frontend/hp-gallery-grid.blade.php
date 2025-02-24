@php
    use Illuminate\Support\Str;

    $text = 'This is a sample text for slug generation!';
    $slug = Str::slug($pages->slug); // Converts the text into a slug
@endphp
<div class="home about col-md-8 center mx-auto p-3" style="border: .8px #7b6f1f solid;">
    <!-- Image Container -->
    @if($images->isNotEmpty())
        <!-- First Image (Always Full Width) -->
        <div class="position-relative o-hidden mb-4 animate-box" data-animate-effect="fadeInUp">
            <img src="{{ asset('storage/' . $images[0]->path) }}" alt="" class="w-100 hover-img first-image">
            <div class="overlay">
                <a href="/nos-cuisines">
                    <p class="image-text text-white animated" data-animate-effect="fadeInUp">{{ $titles[0] ?? 'Nos Cuisines' }}</p>
                </a>
            </div>
        </div>

        <!-- Second & Third Images -->
        <div class="row g-3">
            <!-- Second Image -->
            <div class="col-lg-7 col-md-12">
                <div class="position-relative about-img d-flex position-relative fade-in animate-box" data-animate-effect="fadeInUp">
                    <img src="{{ asset('storage/' . $images[1]->path) }}" alt="ccs_logo" class="img-fluid w-100 hover-img second-image" style="object-fit: cover;">
                    <div class="overlay">
                    <a href="/nos-cuisines">
                        <p class="image-text text-white animated" data-animate-effect="fadeInUp">{{ $titles[0] ?? 'Nos Cuisines' }}</p>
                    </a>
                    </div>
                </div>
            </div>

            <!-- Third Image -->
            <div class="col-lg-5 col-md-12">
                <div class="position-relative about-img d-flex position-relative fade-in animate-box h-100" data-animate-effect="fadeInUp">
                    <img src="{{ asset('storage/' . $images[2]->path) }}" alt="ccs_logo"
                        class="img-fluid w-100 h-100 hover-img third-image"
                        style="object-fit: cover; min-height: 100%;">  <!-- Ensure full height -->
                    <div class="overlay">
                    <a href="/nos-dressings">
                        <p class="image-text text-white animated" data-animate-effect="fadeInUp">{{ $titles[0] ?? 'Nos Dressings' }}</p>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>Aucune Image à afficher</p>
    @endif
</div>

<style>
    /* Full width image on desktop */
    .first-image {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    /* Make second and third images fill equal height */
    .second-image, .third-image {
        object-fit: cover;
        width: 100%;
    }

    /* On mobile, first image should cover its container (responsive height) */
    @media (max-width: 768px) {
        .first-image {
            width: 100%;
            height: 300px; /* You can adjust this to control the height */
            object-fit: cover;
        }

        /* Ensure second image adjusts to the same height as the first image */
        .second-image, .third-image {
            height: 300px; /* Same height as the first image */
        }
    }

    /* For larger screens (desktop), keep normal behavior */
    @media (min-width: 769px) {
        .first-image {
            width: 100%;
            height: auto;
        }
    }
</style>
