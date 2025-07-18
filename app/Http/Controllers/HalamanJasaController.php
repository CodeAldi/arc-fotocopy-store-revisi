<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HalamanJasaController extends Controller
{
    function index() {
        if (Auth::check()) {
            $keranjang = Keranjang::where('user_id', Auth()->user()->id)->get();
        }
        else{
            $keranjang = 0;    
        }
        $jasa = Jasa::paginate(3);
        return view('landing.jasa',[
            'jasa' => $jasa,
            'keranjang' => $keranjang,

        ]);
    }
    function renderPesanJasa($id)
    {
        $keranjang = Keranjang::where('user_id', Auth()->user()->id)->get();
        $jasa = Jasa::find($id);
        return view('landing.pesanJasa', [
            'jasa' => $jasa,
            'keranjang' => $keranjang,
        ]);
    }
}
