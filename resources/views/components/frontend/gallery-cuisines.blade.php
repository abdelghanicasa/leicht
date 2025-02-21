<div class="about col-md-8 center mx-auto p-3">
    <section class="section-padding2">
        <div class="container">            
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="bauen-gallery-filter">
                        <li class="active" data-filter="*">Tous</li>
                        @foreach($categories as $category)
                            <li data-filter=".{{ $category->slug }}">{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row bauen-gallery-items">
                @foreach($categories as $category)
                    @foreach($category->images as $image)
                        <div class="col-md-4 gallery-masonry-wrapper single-item {{ $category->slug }}">
                            <a href="{{ asset('storage/' . $image->path) }}" title="{{ $image->title }}" class="gallery-masonry-item-img-link img-zoom">
                                <div class="gallery-box">
                                    <div class="gallery-img"> 
                                        <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid mx-auto d-block" alt="{{ $image->title }}"> 
                                    </div>
                                    <div class="gallery-masonry-item-img"></div>
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
