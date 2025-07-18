@extends('layouts.landing')
@section('content')

<section class="section mt-5" id="products">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Our Latest Products</h2>
                    <span>Check out all of our products.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @forelse ($barang as $item)
            <div class="col-lg-4">
                <div class="item">
                    <div class="thumb">
                        <div class="hover-content">
                            <ul>
                                {{-- <li><a href="{{ route('halaman.barang.pesan',['id'=>$item->id]) }}"><i class="fa fa-eye"></i></a></li> --}}
                                <li><a href="{{ route('halaman.barang.pesan',['id'=>$item->id]) }}" class="bg-success text-white"><i class="fa fa-shopping-cart"></i></a>
                            </ul>
                        </div>
                        <img src="{{ asset($item->gambar) }}" alt="">
                    </div>
                    <div class="down-content">
                        <h5>{{ $item->namaBarang }}</h5>
                        <span>Rp.{{ $item->hargaBarang }},- (stock : {{ $item->jumlah }})</span>
                        <span>{{ $item->deskripsi }}</span>
                        <ul class="stars">
                            <li>
                                <span class="badge badge-pill bg-info text-white">{{ $item->kategori->namaKategori }}</span>
                                {{-- <span class="badge">{{ $item->kategori->namaKategori }}</span> --}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
                
            @empty
                
            @endforelse
        </div>
        <div class="row">
            <div class="mx-auto">
                {{ $barang->links() }}
            
            </div>
        </div>
    </div>
</section>
@endsection