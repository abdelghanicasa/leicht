<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="/" target="_blank">
        <img style="height:80px" src="{{ asset('frontend/assets/img/leicht-logo-black.png') }}" class="navbar-brand-img" alt="main_logo">
        <!-- <span class="ms-1 text-sm text-dark">Leicht</span> -->
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="../pages/dashboard.html">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Navigation</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Gestion des Pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('admin.pages.index') }}">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Listes des page</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('admin.pages.create') }}">
            <i class="material-symbols-rounded opacity-5">tv_signin</i>
            <span class="nav-link-text ms-1">Créer une page</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Gestion des Sliders</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('sliders.create') }}">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Créer des sliders</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('sliders.index') }}">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Listes des sliders</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Gestion des Bloc</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('blocs.index') }}">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Listes des Blocs</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Paramétres</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('admin.settings') }}">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Information Société</span>
          </a>
        </li>
      
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-dark w-100" href="#" type="button">Déconnexion</a>
      </div>
    </div>
  </aside>