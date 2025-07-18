<nav class="main-nav">
    <!-- ***** Logo Start ***** -->
    <a href="{{ route('landing.home') }}" class="logo">
        {{-- <img src="landing-assets/images/logo.png"> --}}
        <h1 class="text-success mt-3 p-2">ARC FOTOCOPY</h1>
    </a>
    <!-- ***** Logo End ***** -->
    <!-- ***** Menu Start ***** -->
    <ul class="nav">
        <li class="scroll-to-section"><a href="{{ route('landing.home') }}" class="{{ (Request::RouteIs('landing.home')) ? 'active' : '' }}">Home</a></li>
        <li class="scroll-to-section"><a href="{{ route('halaman.barang') }}" class="{{ (Request::RouteIs('halaman.barang')) ? 'active' : '' }}">ATK dan lain lain</a></li>
        <li class="scroll-to-section"><a href={{ route('halaman.jasa') }} class="{{ (Request::RouteIs('halaman.jasa')) ? 'active' : '' }}">Jasa</a></li>
        {{-- <li class="scroll-to-section"><a href="#about">tentang kami</a></li> --}}
        @if (auth()->check())
        <li class="scroll-to-section"><a href="{{ route('keranjang.lihat') }}"><i class="fa fa-shopping-cart"></i>
            <span class="badge badge-pill badge-danger">{{ count($keranjang) }}</span>
        </a></li>
        <li class="submenu border rounded-pill border-success"><a href="javascript:;"><i class="fa fa-user"></i>Saya</a>
            <ul>
                {{-- <li><a href="#">pengaturan akun</a></li> --}}
                <li><a href="{{ route('pesanan.cek') }}">cek pesanan</a></li>
            </ul>
        </li>
        <li class="scroll-to-section border rounded-pill border-secondary ml-2">
            <form action="{{ route('logout.aksi') }}" method="post">
                @csrf
                <button class="btn" type="submit">Logout</button>
            </form>
        </li>
        <li class=""><a href="#"></a></li>
            
        @else
        <li class="scroll-to-section rounded-pill bg-success"><a href="{{ route('login') }}">Login</a></li>
        <li class=""><a href="#"></a></li>
            
        @endif
    </ul>
    <a class='menu-trigger'>
        <span>Menu</span>
    </a>
    <!-- ***** Menu End ***** -->
</nav>