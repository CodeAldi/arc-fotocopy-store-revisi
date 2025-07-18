<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Keranjang;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index() {
        $keranjang = Keranjang::where('user_id', Auth()->user()->id)->latest()->get();
        $order = Order::where('user_id', Auth()->user()->id)->latest()->first();
        $orderDetail = OrderDetails::where('order_id',$order->id)->get();
        return view('landing.bayar',[
            'keranjang'=>$keranjang,
            'order'=>$order,
            'orderDetails'=>$orderDetail,
        ]);
    }
    function store() {
        $keranjang = Keranjang::where('user_id', Auth()->user()->id)->get();
        $totalbayar = 0;
        foreach ($keranjang as $key => $value) {
            $totalbayar = $totalbayar + ($value->barang->hargaBarang * $value->jumlah);
        }
        $order = new Order();
        $order->user_id = Auth()->user()->id;
        $order->total_bayar = $totalbayar;
        $order->snap_token = '';
        $order->save();
        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $totalbayar,
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
        foreach ($keranjang as $key => $value) {
            $orderDetail = new OrderDetails();
            $orderDetail->order_id = $order->id;
            $orderDetail->barang_id = $value->barang_id;
            $orderDetail->catatan = $value->catatan;
            $orderDetail->jumlah = $value->jumlah;
            $orderDetail->save();
            $value->delete();
        }
        return redirect()->route('checkout.bayar');
    }
    function berhasil(Request $request) {
        dd('berhasil');
    }
    function callback(Request $request) {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash('sha512',$request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if ($hashed == $request->signature_key) {
            $order = Order::find($request->order_id);
            $order->status_pembayaran = 'paid';
            $order->save();
        }
    }
}
