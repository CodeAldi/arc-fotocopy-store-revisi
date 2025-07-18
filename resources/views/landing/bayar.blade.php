@extends('layouts.landing')
@section('content')
<div class="main-banner" id="top">
    <div class="container">
        <div class="row justify-content-between">
          <div class="card col-8 shadow">
            <div class="card-body">
              <h6 class="card-title">Checkout</h6>
              <p class="card-text">
                <div class="row font-weight-bold">
                  <div class="col">item</div>
                  <div class="col">jumlah</div>
                  <div class="col">harga Satuan</div>
                </div>
              </p>
              <p class="card-text">
                <div class="row">
                  @forelse ($orderDetails as $item)
                  <div class="col">{{ $item->barang->namaBarang }}</div>
                  <div class="col">{{ $item->jumlah }}</div>
                  <div class="col">Rp.{{ $item->barang->hargaBarang }}</div>
                      
                  @empty
                      
                  @endforelse
                </div>
              </p>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <p class="card-text">Total bayar : {{ $order->total_bayar }}</p>
              <button id="pay-button" class="btn btn-success">Bayar</button>
            </div>
          </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
      // SnapToken acquired from previous step
      snap.pay('<?=$order->snap_token?>', {
        // Optional
        onSuccess: function(result){
          /* You may add your own js here, this is just example */ 
          // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          Swal.fire({
          title: 'Success!',
          text: 'Pembayaran berhasil',
          icon: 'success',
          confirmButtonText: 'oke',
          allowOutsideClick: false,
          })
        },
        // Optional
        onPending: function(result){
          /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function(result){
          /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
      });
    };
</script>
@endsection