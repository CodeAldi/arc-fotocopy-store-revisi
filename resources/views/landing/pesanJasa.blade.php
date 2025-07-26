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
                    <img src="{{ asset($jasa->gambar) }}" alt="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="right-content">
                    <form action="{{ route('keranjang.masukan') }}" method="post">
                        @csrf
                        <h4>{{ $jasa->namaJasa }}</h4>
                        <span class="price" id="hargaSatuan">Rp.{{ $jasa->harga }},- /lembar</span>
                        <span>{{ $jasa->deskripsi }}</span>
                        <div class="quantity-content">
                            <div class="left-content">
                                <h6>Jumlah / Rangkap</h6>
                            </div>
                            <div class="right-content">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="" id="jumlahBeli">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>
                        </div>
                        <div class="upload-file">
                            <h4 class="mb-1 text-secondary">Pilih file yang akan dicetak</h4>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                    
                                </div>
                              </div>
                        </div>
                        <div class="total">
                            <input type="text" hidden readonly value="{{ $jasa->id }}" name="barang_id">
                            <h4 class="mb-1">catatan untuk toko :</h4>
                            <input type="text" name="catatan" placeholder="catatan untuk pihak toko"
                                class="form-control mb-2">
                            </div>
                            <div class="main-border-button">
                            </div>
                            <div class="tombol">
                                <button class="btn btn-success mt-2">Upload dan lihat total bayar</button>
                            <button class="btn btn-danger mt-2">Batal dan Kembali !</button>
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
        text: 'Jasa berhasil dipesan, silahkan cek berkala diriwayat pesanan ;)',
        icon: 'success',
        confirmButtonText: 'oke'
        })
</script>
@endif

@endsection