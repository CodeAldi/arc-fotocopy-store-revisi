<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class RiwayatPesananController extends Controller
{
    function index(){
        $keranjang = Keranjang::where('user_id', Auth()->user()->id)->get();
        $order = Order::where('user_id', Auth()->user()->id)->get();
        return view('landing.pesanan',[
            'keranjang'=>$keranjang,
            'order' => $order,
        ]);
    }
}
