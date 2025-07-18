<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ManajemenPesananController extends Controller
{
    function renderManajemenBarang() {
        $order = Order::latest()->get();
        // dd($order[0]->orderDetails[0]->barang);
        return view('manajemenPesananBarang',[
            'title'=>'Manajemen Pesanan',
            'order' => $order,
        ]);
    }
    function renderManajemenJasa() {
        return view('manajemenPesananJasa', [
            'title' => 'Manajemen Pesanan',
        ]);
    }
    function selesikanOrderBarang($id) {
        $order = Order::find($id);
        $order->status_order = 'done';
        $order->save();
        return back();
    }
}
