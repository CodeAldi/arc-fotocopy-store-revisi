<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function index() {
        if (Auth::check()) {
            $keranjang = Keranjang::where('user_id', Auth()->user()->id)->get();
        } else {
            $keranjang = 0;
        }
        return view('landing.profile', [
            'keranjang' => $keranjang,
        ]);
    }
}
