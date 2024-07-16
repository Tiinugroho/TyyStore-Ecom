<?php

namespace App\Http\Controllers;

use App\Models\tbstok;
use App\Models\tbpesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(){
        $product = tbstok::all();
        $id_user = Auth::id();
        $products = tbpesanan::where('id_user', $id_user)
        ->where('status', 'pending')
            ->with('tbstok')
            ->get();
        $jumlah_pesanan = $products->count();
        return view ('blog',compact('product','jumlah_pesanan','products'));
    }
}
