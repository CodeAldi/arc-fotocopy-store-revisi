<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{
    function index() {
        if (Auth::check()) {
            $keranjang = Keranjang::where('user_id', Auth()->user()->id)->get();
            
        }
        else {
            $keranjang = 0;
        }
        $barang = Barang::all();
        $jasa = Jasa::all();
        return view('landing.home',[
            'jasa'=>$jasa,
            'barang'=>$barang,
            'keranjang' => $keranjang,
        ]);
    }
}
