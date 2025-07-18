<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    function index() {
        $keranjang = Keranjang::where('user_id', Auth()->user()->id)->get();
        $totalbayar = 0;
        foreach ($keranjang as $key => $value) {
            $totalbayar = $totalbayar + ($value->barang->hargaBarang * $value->jumlah);
        }
        return view('landing.keranjang',[
            'keranjang'=> $keranjang,
            'totalbayar' => $totalbayar,
        ]);
    }
    function store(Request $request) {
        $keranjang = new Keranjang();
        $keranjang->user_id = Auth()->user()->id;
        $keranjang->barang_id = $request->barang_id;
        $keranjang->jumlah = $request->quantity;
        $keranjang->catatan = $request->catatan;
        $keranjang->save();
        return back()->with('barangSuccess','success');
    }
}
