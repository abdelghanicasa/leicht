@php
    $bloc = App\Models\Bloc::where('bloc_type', 'video')->first();
@endphp

@if($bloc)
<section class="about section-padding" style="background-color: #1F1C1D ;">
    <div class="col-md-9 center mx-auto white">
        <div class="row align-items-center">
            
            <!-- Image on the Left -->
            <div class="col-md-6 animate-box fadeInUp animated" data-animate-effect="fadeInUp">
                <div class="about-img position-relative">
                    @if($bloc->images)
                        @php $images = json_decode($bloc->images, true); @endphp
                        @if(!empty($images))
                            <div class="img">
                                <img src="{{ asset('storage/' . $images[0]) }}" class="img-fluid" alt="">
                            </div>
                        @endif
                    @endif

                    <!-- Video Button (positioned on the image) -->
                    <div class="vid-area position-absolute top-50 start-50 translate-middle" style="z-index: 999;">
                        <div class="vid-icon">
                            <a class="play-button vid" href="javascript:void(0);" onclick="openVideoPopup()">
                                <svg class="circle-fill">
                                    <circle cx="43" cy="43" r="39" stroke="#fff" stroke-width=".5"></circle>
                                </svg>
                                <svg class="circle-track">
                                    <circle cx="43" cy="43" r="39" stroke="none" stroke-width="1" fill="none"></circle>
                                </svg> 
                                <span class="polygon">
                                    <i class="ti-control-play"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Text on the Right -->
            <div class="col-md-6 mb-30 animate-box fadeInUp animated" data-animate-effect="fadeInUp">
                <h2 class="text-center mt-5 mb-5 white fade-in animate-box fadeInUp animated" data-animate-effect="fadeInUp">
                    {{ $bloc->title }}
                </h2>
                <div class="text-align-center">
                    {!! str_replace('<p>', '<p class="text-center">', $bloc->text) !!}
                </div>

                <!-- Video Popup Modal -->
                <div id="videoPopup" class="video-popup">
                    <div class="video-popup-content">
                        <span class="close-button" onclick="closeVideoPopup()">×</span>
                        <video id="popupVideo" controls width="100%">
                        <source src="{{ asset('frontend/assets/img/leicht.mp4') }}" type="video/webm">
                        <source src="{{ asset('frontend/assets/img/leicht.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif

@push('scripts')
<script>
    function openVideoPopup() {
        document.getElementById("videoPopup").style.display = "block";
    }

    function closeVideoPopup() {
        document.getElementById("videoPopup").style.display = "none";
    }
</script>
@endpush
