@extends('layouts.landing')
@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                                <h4>Jasa print & cetak foto</h4>
                                <span>print dan cetak foto mudah, kapan saja, dimana pun anda berada tanpa harus datang
                                    ke toko terlebih dahulu</span>
                                <div class="main-border-button">
                                    <a href="#">Purchase Now!</a>
                                </div>
                            </div>
                            <img src="landing-assets/images/left-banner-image.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            {{-- Atk --}}
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Pena, pensil, dan ATK lain nya</h4>
                                            <span>Beragam ATK sesuai kebutuhan anda</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Pena</h4>
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.
                                                </p>
                                                <div class="main-border-button">
                                                    <a href="#">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="landing-assets/images/baner-right-image-01.jpg">
                                    </div>
                                </div>
                            </div>
                            {{-- atk end --}}
                            {{-- buku --}}
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Buku Tulis</h4>
                                            <span>Berbagai buku tulis sesuai kebutuhan</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Buku Tulis</h4>
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.
                                                </p>
                                                <div class="main-border-button">
                                                    <a href="#">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="landing-assets/images/baner-right-image-02.jpg">
                                    </div>
                                </div>
                            </div>
                            {{-- buku end --}}
                            {{-- map --}}
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Map</h4>
                                            <span>Map berkualitas dan harga yang bersahabat</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Map</h4>
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.
                                                </p>
                                                <div class="main-border-button">
                                                    <a href="#">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="landing-assets/images/baner-right-image-03.jpg">
                                    </div>
                                </div>
                            </div>
                            {{-- map end --}}
                            {{-- materai --}}
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Materai</h4>
                                            <span>sedia materai untuk kebutuhan tanda tangan anda</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Materai</h4>
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.
                                                </p>
                                                <div class="main-border-button">
                                                    <a href="#">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="landing-assets/images/baner-right-image-04.jpg">
                                    </div>
                                </div>
                            </div>
                            {{-- materai --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
    
    {{--!! <!-- ***** section barang Starts ***** --> --}}
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>ATK, buku, kertas dan lain lain</h2>
                        <span>pena, pensila, buku tulis, dan lain lain.</span>
                    </div>
                </div>
                <div class="col-lg-6 d-flex">
                    <form action="{{ route('halaman.barang') }}" method="get">

                        <button class="btn rounded rounded-pill btn-success ml-auto mr-5 ml-5 mb-5"><i class="fa fa-arrow-right" aria-hidden="true"></i>Lihat semua</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                            @if (count($barang)>0)
                            @foreach ($barang as $item)
                            {{-- item start --}}
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            {{-- <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li> --}}
                                            <li><a href="{{ route('halaman.barang.pesan',['id'=>$item->id]) }}" class="bg-success text-white"><i class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset($item->gambar) }}" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>{{ $item->namaBarang }}</h4>
                                    <span>Rp.{{ $item->hargaBarang }}</span>
                                    {{-- <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul> --}}
                                </div>
                            </div>
                            {{-- item end --}}
    
                            @endforeach
    
                            @else
    
                            {{-- <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <img src="landing-assets/images/men-02.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>Air Force 1 X</h4>
                                    <span>$90.00</span>
                                    <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <img src="landing-assets/images/men-03.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>Love Nana ‘20</h4>
                                    <span>$150.00</span>
                                    <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <img src="landing-assets/images/men-01.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>Classic Spring</h4>
                                    <span>$120.00</span>
                                    <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div> --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--!! <!-- ***** section barang Ends ***** --> --}}
    
    {{--!! <!-- ***** section jasa Starts ***** --> --}}
    <section class="section" id="women">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Jasa print, skripsi, cetak foto, dan lain lain</h2>
                        <span>print, cetak foto, dan lain lain</span>
                    </div>
                </div>
                <div class="col-lg-6 d-flex">
                    <form action="{{ route('halaman.jasa') }}" method="get">
                
                        <button class="btn rounded rounded-pill btn-success ml-auto mr-5 ml-5 mb-5"><i class="fa fa-arrow-right"
                                aria-hidden="true"></i>Lihat semua</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="women-item-carousel">
                        <div class="owl-women-item owl-carousel">
                            @if (count($jasa)>0)
                            @forelse ($jasa as $item)
    
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            {{-- <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li> --}}
                                            {{-- <li><a href="single-product.html"><i class="fa fa-star"></i></a></li> --}}
                                            <li><a href="{{ route('halaman.jasa.pesan',['id'=>$item->id]) }}" class="bg-success text-white"><i class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset($item->gambar) }}" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>{{ $item->namaJasa }}</h4>
                                    <span>Rp.{{ $item->harga }}</span>
                                    {{-- <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul> --}}
                                </div>
                            </div>
                            @empty
    
                            @endforelse
                            @else
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <img src="landing-assets/images/women-02.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>Classic Dress</h4>
                                    <span>$45.00</span>
                                    <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <img src="landing-assets/images/women-03.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>Spring Collection</h4>
                                    <span>$130.00</span>
                                    <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <img src="landing-assets/images/women-01.jpg" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>Classic Spring</h4>
                                    <span>$120.00</span>
                                    <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
    
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--!! <!-- ***** section jasa Ends ***** --> --}}
    
    
    
@endsection