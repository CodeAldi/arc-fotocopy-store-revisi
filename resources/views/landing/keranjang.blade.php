@extends('layouts.landing')
@section('content')
<div class="main-banner" id="top">
    <div class="container">
        <div class="col-12">
            <h2>Keranjang Barang</h2>
            <div class="card my-2 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">no</div>
                        <div class="col">nama barang</div>
                        <div class="col">jumlah</div>
                        <div class="col">total</div>
                        <div class="col">aksi</div>
                    </div>
                </div>
            </div>
        </div>
        @forelse ($keranjang as $item)
        <div class="col-12">
            <div class="card my-2 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">{{ $loop->iteration }}</div>
                        <div class="col">{{ $item->barang->namaBarang }}</div>
                        <div class="col">{{ $item->jumlah }}</div>
                        <div class="col">Rp.{{ $item->barang->hargaBarang * $item->jumlah }}</div>
                        <div class="col">
                            <form action="{{ route('keranjang.hapus.item',['keranjang'=>$item]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            
        @endforelse
        <div class="col-12">
            <div class="card my-2 ">
                <div class="card-body">
                    <div class="row">
                        <div class="col">Total Bayar:</div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col">Rp.{{ $totalbayar }},-</div>
                        <div class="col">
                            <form action="{{ route('checkout.store') }}" method="post">
                                @csrf
                                <button class="btn btn-success">Bayar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container mt-2">
        <div class="col-12">
            <h2>Keranjang Jasa Print & Cetak Photo</h2>
            <div class="card my-2 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">no</div>
                        <div class="col">nama Jasa</div>
                        <div class="col">Harga</div>
                        <div class="col">jumlah Halaman</div>
                        <div class="col">jumlah Rangkap</div>
                        <div class="col">finishing</div>
                        <div class="col">total</div>
                        <div class="col">aksi</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- list order jasa --}}
        @forelse ($keranjangJasa as $item)
            <div class="col-12">
                <div class="card my-2 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">{{ $loop->iteration }}</div>
                            <div class="col">{{ $item->orderJasaDetails[0]->jasa->namaJasa }}</div>
                            <div class="col">Rp{{ $item->orderJasaDetails[0]->jasa->harga }}</div>
                            <div class="col">{{ $item->orderJasaDetails[0]->jumlah_halaman }}</div>
                            <div class="col">{{ $item->orderJasaDetails[0]->jumlah_rangkap }}</div>
                            <div class="col">
                                @if ($item->orderJasaDetails[0]->jilid_plastik == 1)
                                    Jilid Plastik
                                @elseif ($item->orderJasaDetails[0]->jepit_besi == 1)
                                    Jepit Besi
                                @elseif ($item->orderJasaDetails[0]->hekter == 1)
                                    Hekter
                                @elseif ($item->orderJasaDetails[0]->tidak_ada == 1)
                                    Tidak Ada
                                @endif

                            </div>
                            <div class="col">Rp.{{ ($item->orderJasaDetails[0]->jasa->harga * $item->orderJasaDetails[0]->jumlah_halaman) *
                            $item->orderJasaDetails[0]->jumlah_rangkap }}</div>
                            <div class="col">
                                <form action="{{ route('keranjang.hapus.item',['keranjang'=>$item]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            
        @endforelse
        {{-- total bayar untuk order jasa --}}
        <div class="col-12">
            <div class="card my-2 ">
                <div class="card-body">
                    <div class="row">
                        <div class="col">Total Bayar:</div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col">Rp.{{ $totalbayarJasa }},-</div>
                        <div class="col">
                            <form action="{{ route('checkout.store') }}" method="post">
                                @csrf
                                <button class="btn btn-success">Bayar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (session('message'))
    @push('script')
        <script>
            Swal.fire({
            title: 'Success!',
            text: 'Item keranjang berhasil dihapus',
            icon: 'success',
            confirmButtonText: 'oke',
            allowOutsideClick: false,
            })
        </script>
    @endpush
@endif
@endsection