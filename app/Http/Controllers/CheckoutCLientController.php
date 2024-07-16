<?php

namespace App\Http\Controllers;

use App\Models\tbstok;
use App\Models\tbpesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutCLientController extends Controller
{
    public function index(Request $request)
    {
        $product = tbstok::all();
        $id_user = Auth::id();
        $products = tbpesanan::where('id_user', $id_user)
        ->where('status', 'pending')
            ->with('tbstok')
            ->get();
        $jumlah_pesanan = $products->count();
        return view('checkout', compact('product', 'products', 'jumlah_pesanan'));
    }

    public function show($id)
    {
        $product = tbstok::all();
        $id_user = Auth::id();
        $products = tbpesanan::where('id_user', $id_user)
        ->where('status', 'pending')
            ->with('tbstok')
            ->get();
        $jumlah_pesanan = $products->count();
        return view('checkout', compact('product', 'products', 'jumlah_pesanan', 'id'));
    }
}
