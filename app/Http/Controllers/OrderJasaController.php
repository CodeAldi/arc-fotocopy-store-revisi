<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderJasaDetails;
use Illuminate\Support\Facades\Storage;

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
            
            case 'jilid_plastik':
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
        if (isset($catatan)) {
            $orderJasaDetails->catatan = $catatan;
        }
        $orderJasaDetails->jumlah_halaman = $jumlahHalaman;
        $orderJasaDetails->jumlah_rangkap = $jumlahRangkap;
        $orderJasaDetails->save();

        return back()->with('pesanJasaSuccess','success');

    }
    function destroyOrderJasa($id){
        $order = Order::find($id);
        Storage::delete($order->orderJasaDetails[0]->file);
        $order->delete();
        return back()->with('message','delete');
        
    }
    function checkoutJasa(Request $request) {
        $order = Order::find($request->id);

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->total_bayar,
            ),
            'customer_details' => array(
                'first_name' => Auth()->user()->name,
                'last_name' => '',
                'email' => Auth()->user()->email,
                'phone' => '08111222333',
            ),
        );
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $snapToken = Snap::getSnapToken($params);
        $order->snap_token = $snapToken;
        $order->save();

        $orderJasaDetails = $order->orderJasaDetails[0];
        // dd($order);
        return view('landing.bayarJasa', [
            'order' => $order,
            'orderDetails' => $orderJasaDetails,
        ]);
    }
}
