@extends('layouts.dashboard')
@section('content')
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">Welcome back</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card bg-primary text-white">
                <div class="card-body"> stok barang yang kosong : -</div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-warning text-white">
                <div class="card-body"> pesanan menunggu dicetak : -</div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-success text-white">
                <div class="card-body"> pesanan menunggu diambil : -</div>
            </div>
        </div>
    </div>
@endsection