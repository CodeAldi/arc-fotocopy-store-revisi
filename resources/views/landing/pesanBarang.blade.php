@extends('layouts.landing')
@section('content')
<!-- ***** Main Banner Area Start ***** -->
<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Halaman Detail Produk</h2>
                    <span>detail produk dan pesanan</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->
    <!-- ***** Product Area Starts ***** -->
    <section class="section" id="product">
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-images">
                        <img src="{{ asset($barang->gambar) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                    <form action="{{ route('keranjang.masukan') }}" method="post">
                    @csrf
                        <h4>{{ $barang->namaBarang }}</h4>
                        <span class="price" id="hargaSatuan">Rp.{{ $barang->hargaBarang }},-</span>
                        <span>{{ $barang->deskripsi }}</span>
                        <div class="quantity-content">
                            <div class="left-content">
                                <h6>Jumlah</h6>
                            </div>
                            <div class="right-content">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" step="1" min="1"
                                        max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4"
                                        pattern="" inputmode="" id="jumlahBeli" onchange="hitungHarga({{ $barang }})">
                                        <input type="button" value="+" class="plus">
                                </div>
                            </div>
                        </div>
                        <div class="total">    
                                <input type="text" hidden readonly value="{{ $barang->id }}" name="barang_id">
                                <h4 class="mb-1">catatan untuk toko :</h4>
                                <input type="text" name="catatan" placeholder="contoh : request warna spesifik" class="form-control mb-2">
                                <h4 id="hargaTotal">total bayar : Rp. {{ $barang->hargaBarang }}</h4>
                                <button class="btn btn-success mt-2">tambah ke keranjang</button>
                                <div class="main-border-button">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Product Area Ends ***** -->
    @if (session('barangSuccess'))
    <script>
        Swal.fire({
        title: 'Success!',
        text: 'Barang berhasil ditambahkan ke keranjang',
        icon: 'success',
        confirmButtonText: 'oke'
        })
    </script>
    @endif
    <script>
        function hitungHarga(item) {
            const myjson = item;
            let hargasatuannya = myjson.hargaBarang;
            let jumlahBeli = document.getElementById("jumlahBeli").value;
            let total = parseInt(jumlahBeli) * hargasatuannya;
            document.getElementById("hargaTotal").textContent = "total bayar : Rp. " + total;
            // console.log(hargasatuannya,jumlahBeli,);
            
        }
    </script>
@endsection