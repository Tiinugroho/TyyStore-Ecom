<?php

namespace App\Http\Controllers;

use App\Models\tbmutasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MutasiController extends Controller
{
    public function index($no_bukti = null)
    {
        $barang = DB::table('tbmutasi')
            ->leftJoin('users', 'users.id', '=', 'tbmutasi.user_id')
            ->select(
                DB::raw('SUM(tbmutasi.qty) as total_qty'),
                DB::raw('SUM(tbmutasi.harga) as total_harga'),
                'users.username as namauser',
                'tbmutasi.no_bukti as no_bukti',
                DB::raw('MIN(tbmutasi.id) as id'),
                DB::raw('MAX(tbmutasi.barang) as namabarang'),
                DB::raw('MAX(tbmutasi.tanggal) as tanggal'),
                'tbmutasi.mk as mk',
                'tbmutasi.status as status',
                DB::raw('MAX(tbmutasi.bukti_pembayaran) as bukti_pembayaran')
            )
            ->groupBy(
                'users.username',
                'tbmutasi.no_bukti',
                'tbmutasi.mk',
                'tbmutasi.status'
            )
            ->orderby('id', 'desc')
            ->paginate(10); // Menggunakan paginate dengan batasan 10 data per halaman

        return view('admin.mutasi.list')
            ->with('barang', $barang)
            ->with('no_bukti', '')
            ->with('items', '');
    }

    public function show($no_bukti)
    {
        $barang = DB::table('tbmutasi')
            ->leftJoin('users', 'users.id', '=', 'tbmutasi.user_id')
            ->select(
                DB::raw('SUM(tbmutasi.qty) as total_qty'),
                DB::raw('SUM(tbmutasi.harga) as total_harga'),
                'users.username as namauser',
                'tbmutasi.no_bukti as no_bukti',
                DB::raw('MIN(tbmutasi.id) as id'),
                DB::raw('MAX(tbmutasi.barang) as namabarang'),
                DB::raw('MAX(tbmutasi.tanggal) as tanggal'),
                'tbmutasi.mk as mk',
                'tbmutasi.status as status',
                DB::raw('MAX(tbmutasi.bukti_pembayaran) as bukti_pembayaran')
            )
            ->groupBy(
                'users.username',
                'tbmutasi.no_bukti',
                'tbmutasi.mk',
                'tbmutasi.status'
            )
            ->orderby('id', 'desc')
            ->paginate(10); // Menggunakan paginate dengan batasan 10 data per halaman

        $items = tbmutasi::where('no_bukti', $no_bukti)->get();

        return view('admin.mutasi.list')
            ->with('barang', $barang)
            ->with('no_bukti', $no_bukti)
            ->with('items', $items);
    }

    public function getBarangByNoBukti($no_bukti)
    {
        $items = tbmutasi::where('no_bukti', $no_bukti)->get();
        return response()->json(['items' => $items]);
    }
}
