<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderJasaDetails;
use Illuminate\Http\Request;

class OrderJasaController extends Controller
{
    function hitungHarga($filePath)
    {
        
        $path = 'C:\laragon\www\arc-fotocopy-store\public' . '/' . $filePath;
        // mulai mengihitung jumlah halaman
        $cmd = "C:\Users\arc-laptop\Downloads\xpdf-tools\bin64\pdfinfo.exe";  // Windows

        // Parse entire output
        // Surround with double quotes if file name has spaces
        exec("$cmd \"$path\"", $output, $hasilExec);

        // Iterate through lines
        $pagecount = 0;
        foreach ($output as $op) {
            // Extract the number
            if (preg_match("/Pages:\s*(\d+)/i", $op, $matches) === 1) {
                $pagecount = intval($matches[1]);
                break;
            }
        }
        // akhir menghitung jumlah halaman
        return $pagecount;
    }

    function orderJasaStore(Request $request) {
        $order = new Order();
        $orderJasaDetails = new OrderJasaDetails();
        $user_id = Auth()->user()->id;
        $jasa_id = $request->jasa_id;
        $harga = $request->harga;
        $filePath = $request->file('file')->store('order_jasa/print');
        $jumlahHalaman = $this->hitungHarga($filePath);
        $jumlahRangkap = $request->jumlah_rangkap;
        $catatan = $request->catatan;
        $totalBayar = ($jumlahHalaman * $harga) * $jumlahRangkap;
        switch ($request->jenisFinishing) {
            case 'hekter':
                $orderJasaDetails->hekter = 1;
                $totalBayar += 0;
                break;
            
            case 'jepit_besi':
                $orderJasaDetails->jepit_besi = 1;
                $totalBayar += 2500;
                break;
            
            case 'jilid':
                $orderJasaDetails->jilid_plastik = 1;
                $totalBayar += 3000;
                break;
            
            default:
                $orderJasaDetails->tidak_ada = 1;
                $totalBayar += 0;
                break;
        }
        $order->user_id = $user_id;
        $order->total_bayar = $totalBayar;
        $order->snap_token = '';
        $order->save();
        $orderJasaDetails->order_id = $order->id;
        $orderJasaDetails->jasa_id = $jasa_id;
        $orderJasaDetails->file = $filePath;
        if (isset($request->catatan)) {
            $orderJasaDetails->catatan = $request->catatan;
        }
        $orderJasaDetails->jumlah_halaman = $jumlahHalaman;
        $orderJasaDetails->jumlah_rangkap = $jumlahRangkap;
        $orderJasaDetails->save();
        dd($request->jenisFinishing, $orderJasaDetails);

        return redirect()->route('landing.home');

    }
}
