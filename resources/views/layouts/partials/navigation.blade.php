<header class="header-section">
  <div class="top-header py-2">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-auto">
          <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logoNoBg.png') }}" alt="Locco Florist Logo" class="logo-img">
          </a>
        </div>
        <div class="col-auto">
          <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-whatsapp text-white rounded-pill px-4 d-none d-md-inline-flex align-items-center">
            <i class="bi bi-whatsapp me-2"></i>
            <span class="fw-semibold">Hubungi Kami</span>
          </a>
          <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-whatsapp-mobile rounded-circle d-md-none d-inline-flex align-items-center justify-content-center">
            <i class="bi bi-whatsapp"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="main-header py-1 d-none d-lg-block">
    <div class="container">
      <nav class="desktop-menu">
        <ul class="nav justify-content-center gap-5">
          <li class="nav-item">
            <a class="nav-link px-3 py-2 rounded-pill {{ request()->routeIs('home') ? 'active' : '' }}" 
               href="{{ route('home') }}">
              Beranda
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-3 py-2 rounded-pill {{ request()->routeIs('product.catalog*') ? 'active' : '' }}" 
               href="{{ route('product.catalog') }}">
              Katalog
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-3 py-2 rounded-pill {{ request()->routeIs('ongkos.kirim') ? 'active' : '' }}" 
               href="{{ route('ongkos.kirim') }}">
              Ongkos Kirim
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-3 py-2 rounded-pill {{ request()->routeIs('about.us') ? 'active' : '' }}" 
               href="{{ route('about.us') }}">
              Tentang Kami
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</header>
