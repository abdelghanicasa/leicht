@extends('frontend.layouts.app')

@php
    $categories = App\Models\Category::with('images')->get();
@endphp

@section('content')

    <x-frontend.content-block 
        :title="$page->text_block_title" 
        :content="$page->text_block_content" 
    />

    <!-- frealisations -->
    <!-- <div class="col-md-11 center mx-auto white fadeInUp animated" data-animate-effect="fadeInUp">
        <h2 class="text-center mt-5 bold underline fade-in animate-box" data-animate-effect="fadeInUp">Vos projets en images</h2>
        <div class="text-center fade-in animate-box mb-5" data-animate-effect="fadeInUp">
            <p>Explorez les cuisines et dressings réalisés pour nos clients.  <br>
                Des créations sur mesure qui reflètent vos besoins et votre style. <br>
            </p>
        </div>
    </div> -->

    <section class="projects2 section-padding2">
        <div class="container">
            <!-- <div class="row">
                <div class="col-md-12 animate-box" data-animate-effect="fadeInUp">
                    <h2 class="section-title">Our <span>Projects</span></h2>
                </div>
            </div> -->
            <div class="row mt-4">
                @foreach($page->images->chunk(ceil($page->images->count() / 2)) as $imageChunk)
                    <div class="col-12 col-md-6 project-masonry-wrapper-padding">
                        @foreach($imageChunk as $image)
                            <div class="portfolio-item-wrapp">
                                <div class="portfolio-item">
                                    <div class="project-masonry-wrapper">
                                        <a href="{{ $image->url ?? '#' }}" class="project-masonry-item-img-link"> 
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}" />
                                            <div class="project-masonry-item-img"></div>
                                            <div class="project-masonry-item-content">
                                                <h6 class="project-masonry-item-title">{{ $image->title ?? 'Realisation leicht' }}</h6>
                                                <!-- <div class="project-masonry-item-category">{{ $image->category->name ?? 'BASTIA' }}</div> -->
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Call to Action Section -->
    <x-frontend.blocdevis/>
        
@endsection