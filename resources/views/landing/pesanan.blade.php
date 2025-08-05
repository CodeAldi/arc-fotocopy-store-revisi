@extends('layouts.landing')
@section('content')
<div class="main-banner" id="top">
    <div class="container">
        <h1>cek pesanan</h1>
        <div class="card shadow mt-2 mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">no</div>
                    <div class="col">tanggal</div>
                    <div class="col">total bayar</div>
                    <div class="col">status pembayaran</div>
                    <div class="col">status pesanan</div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @forelse ($order as $item)
                <div class="row mb-3">
                    <div class="col-2">{{ $loop->iteration }}</div>
                    <div class="col">{{ date_format($item->updated_at,"d/m/Y") }}</div>
                    <div class="col">Rp.{{ $item->total_bayar }}</div>
                    <div class="col">{{ $item->status_pembayaran }}</div>
                    <div class="col">
                        @if ($item->status_order == 'done')
                        <span class="badge badge-primary">Pesanan selesai</span>
                        @elseif ($item->status_order == 'waiting for payment')
                        <span class="badge badge-dark">Menunggu pembayaran</span>
                        @elseif ($item->status_order == 'being prepared')
                        <span class="badge badge-info">Sedang dipersiapkan toko</span>
                        @elseif ($item->status_order == 'waiting to be picked up')
                        <span class="badge badge-success">Pesanan dapat diambil</span>
                        @endif
                    </div>
                </div>
                    @empty
                        
                    @endforelse
                </div>
        </div>
    </div>
</div>
@endsection