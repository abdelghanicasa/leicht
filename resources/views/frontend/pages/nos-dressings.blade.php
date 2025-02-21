@extends('frontend.layouts.app')

@section('content')
    <!-- Content Block -->
    <x-frontend.content-block 
        :title="$page->title" 
        :content="$page->content" 
    />

    <!-- Gallery Section -->
    <x-frontend.page-title 
     :title="$page->text_block_title" 
     />
     
     <div class="about col-md-8 center mx-auto p-3">
        <section class="section-padding2">
            <div class="container">            

                <!-- Gallery Items -->
                <div class="row bauen-gallery-items" id="gallery-grid">
                    @foreach($page->images as $image)
                        <div class="col-md-4 gallery-masonry-wrapper single-item">
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

