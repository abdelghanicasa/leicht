<!-- Preloader -->
@php
use Illuminate\Support\Str;
@endphp
<div class="preloader-bg"></div>
<div id="preloader">
    <div id="preloader-status">
        <div class="preloader-position loader"><span></span></div>
    </div>
</div>

<!-- Progress scroll totop -->
<div class="progress-wrap cursor-pointer">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo -->
        <div class="logo-wrapper">
            <a class="logo" href="{{ url('/') }}">
                <img src="{{ asset('storage/' . $settings->logo) }}" class="logo-img" alt="">
            </a>
            <p class="smalltxt">{{ $settings->slogan }}</p>
        </div>

        <!-- Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="ti-menu" style="font-size: 30px;"></i>  <!-- Increase icon size --></i>
                <span style="font-size: 9px;">MENU</span>
            </span>
        </button>

        <!-- Menu -->
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                @foreach($pages as $index => $page)
                    <li class="nav-item {{ (Request::is('/') && $index == 0) || Request::is(Str::slug($page->slug)) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url(Str::slug($page->slug)) }}">{{ $page->slug }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</nav>

<!-- Stacked Div (Hidden on Mobile) -->
<div class="stacked-div d-none d-lg-block">
    <div class="stacked-div-content">
        <a href="tel:{{ $settings->phone }}">{{ $settings->phone }}</a>
    </div>
    <span class="badge">
        <span style="position: absolute; top: 27%; right: 24%;">
            <svg fill="none" height="24" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.05 5A5 5 0 0119 8.95M15.05 1A9 9 0 0123 8.94m-1 7.98v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"></path>
            </svg>
        </span>
    </span>
</div>
<style>
    /* Increase the size of the hamburger icon */
    .navbar-toggler-icon {
        font-size: 30px; /* Adjust this value to make it larger */
    }

    .navbar-toggler {
        padding: 10px 15px; /* Optional: Adjust padding to make the button larger */
    }

</style>
