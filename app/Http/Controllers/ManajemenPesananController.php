<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManajemenPesananController extends Controller
{
    function renderManajemenBarang() {
        $order = Order::where('snap_token', 'NOT LIKE', '')->has('orderDetails')->get();
        // dd($order[0]->orderDetails[0]->barang);
        return view('manajemenPesananBarang',[
            'title'=>'Manajemen Pesanan',
            'order' => $order,
        ]);
    }
    function renderManajemenJasa() {
        $user_id = Auth()->user()->id;
        $orderJasa = Order::where('snap_token','NOT LIKE', '')->has('orderJasaDetails')->get();
        // dd($orderJasa);
        return view('manajemenPesananJasa', [
            'title' => 'Manajemen Pesanan',
            'orderJasa'=>$orderJasa,
        ]);
    }
    function pesananDapatDiambil($id) {
        $order = Order::find($id);
        $order->status_order = 'waiting to be picked up';
        $order->save();
        return back();
    }
    function selesikanOrderBarang($id) {
        $order = Order::find($id);
        $order->status_order = 'done';
        $order->save();
        return back();
    }
    function DownloadDokumen($path) {
        return Storage::download($path);
    }
}
