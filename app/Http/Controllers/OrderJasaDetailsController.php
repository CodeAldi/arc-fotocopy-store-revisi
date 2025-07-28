<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderJasaDetailsController extends Controller
{
    function hitungHarga(Request $request) {
        $temp = $request->file('file')->store('temp');
        $rangkap = $request->rangkap;
        $path = 'C:\laragon\www\arc-fotocopy-store\public'.'/'.$temp;
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
        dd($pagecount);
        
    }
}
