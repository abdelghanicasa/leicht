@extends('frontend.layouts.app')

@section('content')

    <!-- Content Block -->
    <x-frontend.content-block 
        :title="$page->title" 
        :content="$page->content" 
    />


    <!-- Title bloc -->
     <x-frontend.page-title 
     :title="$page->text_block_title" 
     />

     <!-- Cuisines en images -->
    <div class="about col-md-8 center mx-auto p-3">
        <section class="section-padding2">
            <div class="container">            
                <div class="row">
                    <div class="col-md-12 text-center">
                        <!-- Filter Buttons -->
                        <ul class="bauen-gallery-filter">
                            <li class="active" data-filter="*">Tous</li>
                            @foreach($categories as $category)
                                <li data-filter=".{{ Str::slug($category->name) }}">{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Gallery Items -->
                <div class="row bauen-gallery-items">
                    @foreach($categories as $category)
                        @foreach($category->images as $image)
                            <div class="col-12 col-sm-6 col-md-4 gallery-masonry-wrapper single-item {{ Str::slug($category->name) }}">
                                <a href="{{ asset('storage/' . $image->path) }}" title="{{ $image->title }}" class="gallery-masonry-item-img-link img-zoom">
                                    <div class="gallery-box">
                                        <div class="gallery-img">
                                            <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid mx-auto d-block" alt="{{ $image->title }}"> 
                                        </div>
                                        <div class="gallery-masonry-item-content">
                                            <div class="gallery-masonry-item-category">{{ $image->title }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>

            </div>
        </section>
    </div>

    <!-- Call to Action Section -->
     <x-frontend.blocdevis/>


    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var grid = document.getElementById('gallery-grid');
            var msnry = new Masonry(grid, {
                itemSelector: '.gallery-masonry-wrapper',
                columnWidth: '.col-md-4',
                gutter: 20, // Adjust spacing between items
            });
        });
    </script>
    @endpush
@endsection

