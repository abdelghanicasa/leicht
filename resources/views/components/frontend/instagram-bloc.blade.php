<section class="projects mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- section-title -->
                <h2 class="text-center mt-5 mb-4 bold white mb-4">Nos Réalisations</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(-1140px, 0px, 0px); transition: all; width: 3420px;">
                            @foreach($items as $item)
                                <div class="owl-item" style="width: 255px; margin-right: 30px;">
                                    <div class="item">
                                        <div class="position-re o-hidden">
                                            <img src="{{ $item['media_url'] }}" alt="{{ $item['caption'] }}">
                                        </div>
                                        <div class="con">
                                            <h6><a href="#">{{ $item['caption'] }}</a></h6>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</section>
