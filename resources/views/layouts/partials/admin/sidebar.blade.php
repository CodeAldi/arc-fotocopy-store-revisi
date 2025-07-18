<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">ARC Fotocopy</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ (Request::RouteIs('beranda')) ? 'active' : '' }}">
            <a href="{{ route('beranda') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Beranda</div>
            </a>
        </li>
        <li class="menu-item {{ (Request::RouteIs('barang.*')) ? 'active' : '' }}">
            <a href="{{ route('barang.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-archive"></i>
                <div>Manajemen Barang</div>
            </a>
        </li>
        <li class="menu-item {{ (Request::RouteIs('jasa.*')) ? 'active' : '' }}">
            <a href="{{ route('jasa.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-printer"></i>
                <div>Manajemen Jasa</div>
            </a>
        </li>
        <li class="menu-item {{ (Request::RouteIs('manajemenPesanan.*')) ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div >Manajemen Pesanan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (Request::RouteIs('manajemenPesanan.barang.*')) ? 'active' : '' }}">
                    <a href="{{ route('manajemenPesanan.barang.index') }}" class="menu-link">
                        <div>Barang</div>
                    </a>
                </li>
                <li class="menu-item {{ (Request::RouteIs('manajemenPesanan.jasa.*')) ? 'active' : '' }}">
                    <a href="{{ route('manajemenPesanan.jasa.index') }}" class="menu-link">
                        <div>Jasa</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>