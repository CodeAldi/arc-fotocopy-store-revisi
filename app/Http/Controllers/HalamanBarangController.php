<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HalamanBarangController extends Controller
{
    function index() {
        if (Auth::check()) {
            $keranjang = Keranjang::where('user_id', Auth()->user()->id)->get();
        } else {
            $keranjang = 0;
        }
        $barang = Barang::paginate(3);
        return view('landing.barang',[
            'barang'=> $barang,
            'keranjang' => $keranjang,
        ]);
    }
    function renderPesanBarang($id) {
        $keranjang = Keranjang::where('user_id', Auth()->user()->id)->get();
        $barang = Barang::find($id);
        return view('landing.pesanBarang',[
            'barang'=>$barang,
            'keranjang' => $keranjang,
        ]);
    }
}
