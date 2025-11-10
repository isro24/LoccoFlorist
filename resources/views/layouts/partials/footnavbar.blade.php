<nav class="footnavbar d-lg-none">
    <ul class="nav w-100">
        <li class="nav-item flex-fill">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                <i class="bi bi-house-door"></i>
                <span>Beranda</span>
            </a>
        </li>
        <li class="nav-item flex-fill">
            <a class="nav-link {{ request()->routeIs('product.catalog') ? 'active' : '' }}" href="{{ route('product.catalog') }}">
                <i class="bi bi-view-list"></i>
                <span>Katalog</span>
            </a>
        </li>
        <li class="nav-item flex-fill">
            <a class="nav-link {{ request()->routeIs('ongkos.kirim') ? 'active' : '' }}" href="{{ route('ongkos.kirim') }}">
                <i class="bi bi-truck"></i>
                <span>Cek Ongkir</span>
            </a>
        </li>
        <li class="nav-item flex-fill">
            <a class="nav-link {{ request()->routeIs('about.us') ? 'active' : '' }}" href="{{ route('about.us') }}">
                <i class="bi bi-info-circle"></i>
                <span>Tentang</span>
            </a>
        </li>
    </ul>
</nav>
