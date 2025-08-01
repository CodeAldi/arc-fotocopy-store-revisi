<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    function index() {
        $user_id = Auth()->user()->id;
        $keranjang = Keranjang::where('user_id', $user_id)->get();
        $totalbayar = 0;
        $totalbayarJasa = 0;
        $keranjangJasa = Order::where('user_id', $user_id)->where('snap_token','')->has('orderJasaDetails')->get();
        // dd($keranjangJasa);
        foreach ($keranjang as $key => $value) {
            $totalbayar = $totalbayar + ($value->barang->hargaBarang * $value->jumlah);
        }
        foreach ($keranjangJasa as $key => $value) {
            $totalbayarJasa = $totalbayarJasa + (($value->orderJasaDetails[0]->jasa->harga * $value->orderJasaDetails[0]->jumlah_halaman) * $value->orderJasaDetails[0]->jumlah_rangkap);
            
            // dd($totalbayarJasa);
            if ($value->orderJasaDetails[0]->jilid_plastik == 1) {
                $totalbayarJasa = $totalbayarJasa + 3000;
            } else if ($value->orderJasaDetails[0]->jepit_besi == 1) {
                $totalbayarJasa = $totalbayarJasa + 2500;
            } else {
                $totalbayarJasa += 0;
            }
        }

        return view('landing.keranjang',[
            'keranjang'=> $keranjang,
            'keranjangJasa' => $keranjangJasa,
            'totalbayar' => $totalbayar,
            'totalbayarJasa' => $totalbayarJasa,
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
    function destroy(Keranjang $keranjang) {
        $keranjang->delete();
        return back()->with('message','delete');
    }
}
