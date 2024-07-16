<?php

namespace App\Http\Controllers;

use App\Models\tbstok;
use App\Models\tbpesanan;
use App\Models\tbkategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductListController extends Controller
{
    public function index(Request $request)
    {
        // Dapatkan kategori dari request
        $selectedCategory = $request->query('category');

        // Filter produk berdasarkan kategori jika ada
        $query = tbstok::leftjoin('tbsatuan', 'tbsatuan.id', '=', 'tbstok.id_satuan')
            ->leftjoin('tbkategori', 'tbkategori.id', '=', 'tbstok.id_kategori')
            ->select('tbstok.*', 'tbsatuan.nama as namasatuan', 'tbkategori.nama as namakategori')
            ->orderby('tbstok.id', 'DESC');

        if ($selectedCategory) {
            $query->where('tbkategori.nama', $selectedCategory);
        }

        $id_user = Auth::id();
        $products = tbpesanan::where('id_user', $id_user)
            ->where('status', 'pending')
            ->with('tbstok')
            ->get();

        $product = $query->get();

        // Hanya hitung jumlah pesanan untuk pengguna yang sedang login
        // $jumlah_pesanan = tbpesanan::where('id_user', $id_user)->count();
        $jumlah_pesanan = $products->count(); // Menghitung jumlah pesanan hanya untuk pengguna yang sedang login
        
        $jumlah_produk = tbstok::count();

        // Hitung jumlah produk per kategori
        $categories = tbkategori::leftJoin('tbstok', 'tbkategori.id', '=', 'tbstok.id_kategori')
            ->select('tbkategori.nama', DB::raw('COUNT(tbstok.id) as jumlah'))
            ->groupBy('tbkategori.nama')
            ->get()
            ->pluck('jumlah', 'nama')
            ->toArray();

        return view('product', compact('products', 'product', 'jumlah_produk', 'jumlah_pesanan', 'selectedCategory', 'categories'));
    }
}
