<?php

namespace App\Http\Controllers;

use App\Models\KategoriJasa;
use Illuminate\Http\Request;

class KategoriJasaController extends Controller
{
    function store(Request $request) {
        $kategoriJasa = new KategoriJasa();
        $kategoriJasa->namaKategori = $request->nama;
        $kategoriJasa->save();
        return back();
    }
    function update(Request $request) {
        $kategoriJasa = KategoriJasa::find($request->id);
        $kategoriJasa->namaKategori = $request->nama;
        $kategoriJasa->save();
        return back();
    }
    function destroy(Request $request) {
        $kategoriJasa = KategoriJasa::find($request->id);
        $kategoriJasa->delete();
        return back();
    }
}
