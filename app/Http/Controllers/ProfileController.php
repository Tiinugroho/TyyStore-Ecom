<?php

namespace App\Http\Controllers;

use App\Models\tbstok;
use App\Models\tbpesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\tbcheckoutdetail;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {

        $produks = tbstok::leftjoin('tbsatuan', 'tbsatuan.id', '=', 'tbstok.id_satuan')
            ->leftjoin('tbkategori', 'tbkategori.id', '=', 'tbstok.id_kategori')
            ->select(
                'tbstok.*', 'tbsatuan.nama as namasatuan', 'tbkategori.nama as namakategori'
                )
            ->orderby('tbstok.id', 'DESC')
            ->get();

        $id_user = Auth::id();

        $completedOrders = tbcheckoutdetail::leftJoin('users', 'users.id', '=', 'tbcheckoutdetail.id_user')
            ->select('tbcheckoutdetail.*', 'users.username as username')
            ->orderBy('tbcheckoutdetail.id', 'DESC')
            ->get();

        $products = tbpesanan::where('id_user', $id_user)
            ->where('status', 'pending')
            ->with('tbstok')
            ->get();

        $jumlah_pesanan = $products->count(); // Menghitung jumlah pesanan hanya untuk pengguna yang sedang login

        return view('profile', compact('produks', 'products', 'jumlah_pesanan', 'completedOrders'));
    }
}
