<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    function index() {
        $stokKosong = Barang::where('jumlah',0)->get();
        $menungguCetak = Order::has('orderJasaDetails')->where('status_order','being prepared')->get();
        $menungguDiambil = Order::where('status_order','waiting to be picked up')->get();
        $data = DB::table('order_details')
            ->join('barang', 'order_details.barang_id', '=', 'barang.id')
            ->join('kategori_barang', 'barang.kategori_barang_id', '=', 'kategori_barang.id')
            ->select('kategori_barang.namaKategori', DB::raw('COUNT(order_details.id) as total_terjual'))
            ->groupBy('kategori_barang.namaKategori')
            ->orderByDesc('total_terjual')
            ->limit(4)
            ->get();
        // total semua order
        $totalOrders = DB::table('order_details')->count();

        $year = now()->year; // tahun berjalan

        $dataSales = DB::table('order')
            ->select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(id) as total_penjualan')
            )
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Buat array bulan dari 1-12, kalau tidak ada penjualan, isi 0
        $months = collect(range(1, 12))->map(function ($m) {
            return date('F', mktime(0, 0, 0, $m, 1)); // Nama bulan
        });

        $sales = collect(range(1, 12))->map(function ($m) use ($dataSales) {
            return (int) optional($dataSales->firstWhere('bulan', $m))->total_penjualan ?? 0;
        });
        return view('beranda', [
            'title' => 'Beranda',
            'stockKosong'=> $stokKosong,
            'menungguCetak'=>count($menungguCetak),
            'menungguDiambil'=>count($menungguDiambil),
            'labels' => $data->pluck('namaKategori'),
            'series' => $data->pluck('total_terjual'),
            'dataKategori' => $data,
            'totalOrders' => $totalOrders,
            'months' => $months,
            'sales' => $sales
        ]);
    }
}
