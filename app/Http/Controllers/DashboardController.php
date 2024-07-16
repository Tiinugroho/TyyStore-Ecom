<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbstok;
use App\Models\tbpesanan;
use App\Models\tbkategori;
use Illuminate\Http\Request;
use App\Models\tbcheckoutdetail;
use App\Models\tbcheckoutreturn;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $jumlah_pesanan_sukses = tbcheckoutdetail::where('status', 'completed')->count();
        $jumlahPenjualan = tbcheckoutdetail::where('status', 'completed')->sum('price');
        $jumlahPenjualanReturn = tbcheckoutreturn::count();
        $jumlah_produk = tbstok::count();
        $jumlah_pesanan = tbpesanan::count();
        $jumlahAnggota = User::where('role_id', 2)->count();
        $result = DB::table('tbstok')
            ->leftjoin('tbsatuan', 'tbsatuan.id', '=', 'tbstok.id_satuan')
            ->leftjoin('tbkategori', 'tbkategori.id', '=', 'tbstok.id_kategori')
            ->select('tbstok.*', 'tbsatuan.nama as namasatuan', 'tbkategori.nama as namakategori')
            ->orderBy('tbstok.id', 'DESC')
            ->get();
        
        return view('admin/dashboard', compact('jumlah_pesanan_sukses','jumlah_produk'
        ,'jumlah_pesanan','jumlahAnggota'
        ,'jumlahPenjualan','jumlahPenjualanReturn'))
            ->with('result', $result);
    }
    
}
