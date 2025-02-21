<!-- Slider -->
<header class="header slider-fade">
    <div class="owl-carousel owl-theme">
    @foreach($sliders as $slider)
            <div class="text-start item bg-img" data-overlay-dark="3" data-background="{{ asset('storage/' . $slider->image) }}">
                <div class="v-middle caption mt-30">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <!-- <h1>{{ $slider->title }}</h1> -->
                                <!-- <p>{{ $slider->description }}</p> -->
                                <!-- <div class="butn-light mt-30 mb-30">
                                    <a href="{{ $slider->url }}" target="_blank"><span>Visit</span></a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Mouse Scroll Animation -->
    <div class="mouse_scroll">
        <div class="mouse">
            <div class="wheel"></div>
        </div>
        <div>
            <span class="m_scroll_arrows unu"></span>
            <span class="m_scroll_arrows doi"></span>
            <span class="m_scroll_arrows trei"></span>
        </div>
    </div>
</header>
