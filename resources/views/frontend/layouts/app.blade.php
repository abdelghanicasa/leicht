<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('frontend.partials.head')
    <!-- @vite(['frontend/assets/app.js'])  -->
                         

</head>
<body>
    @include('frontend.partials.navbar')
    @include('frontend.partials.header')

    <div class="content-wrapper">
        <!-- content -->
        @yield('content')
        
        <!-- footer -->
        @include('frontend.partials.footer')

    </div>
    

    <!-- Scripts -->
    <script src="{{ asset('frontend/assets/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-migrate-3.0.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/modernizr-2.6.2.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.isotope.v3.0.2.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scrollIt.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/YouTubePopUp.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/before-after.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vegas.slider.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <!-- @vite(['resources/frontend/assets/js/app.js'])  -->
                         
</body>
</html>