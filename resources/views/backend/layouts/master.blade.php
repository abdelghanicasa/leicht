<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('backend/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('backend/assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
    <!-- Editors -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
    <!-- css custom -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['backend/assets/css/admin.css']) <!-- Load CSS -->
</head>
<body class="g-sidenav-show  bg-gray-100">

    @include('backend.layouts.header')   <!-- Header -->
    

    <main>
    @include('backend.layouts.sidebar') <!-- Sidebar -->
        @include('backend.layouts.navbar') <!-- Sidebar -->
        @yield('content') <!-- This is where child views will insert content -->
        <!-- @include('backend.layouts.footer')   Header -->
    </main>

  <footer>
    <!-- Here you yield the JS scripts -->
  @stack('scripts')
    
  </footer>
    @include('backend.layouts.scripts') 
</body>
</html>
