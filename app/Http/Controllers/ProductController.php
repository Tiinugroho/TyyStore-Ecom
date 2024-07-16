<?php

namespace App\Http\Controllers;

use App\Models\tbstok;
use App\Models\tbpesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\tbpesanandetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
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
        return view('product-detail', compact('product', 'products', 'jumlah_pesanan'))->with($request);
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
        return view('product-detail', compact('product', 'products', 'jumlah_pesanan', 'id'));
    }

    public function store(Request $request)
    {
        $tanggal = Carbon::now();
        $id_barang = $request->input('id_barang');
        $barang = tbstok::find($id_barang);
        $jumlah_pesan = $request->input('jumlah_pesan');
        $jumlah_harga = $jumlah_pesan * $barang->hargajual;
        $id_user = Auth::id();

        // Cari pesanan yang masih pending untuk user yang sama dan barang yang sama
        $pesanan = tbpesanan::where('id_user', $id_user)
            ->where('id_barang', $id_barang)
            ->where('status', 'pending')
            ->first();

        if ($pesanan) {
            // Update pesanan yang sudah ada
            $pesanan->jumlah_pesan += $jumlah_pesan;
            $pesanan->jumlah_harga += $jumlah_harga;
            $pesanan->save();
        } else {
            // Buat pesanan baru
            $pesanan = tbpesanan::create([
                'id_user' => $id_user,
                'id_barang' => $id_barang,
                'jumlah_pesan' => $jumlah_pesan,
                'tanggal' => $tanggal,
                'jumlah_harga' => $jumlah_harga,
                'status' => 'pending',
            ]);
        }

        // Tambah atau update detail pesanan
        $this->storeOrderDetails($id_user);

        // Redirect langsung ke halaman cart dengan pesan success
        Session::flash('success', 'Pesanan berhasil ditambahkan!');
        return redirect('cart');
    }

    public function storeOrderDetails($id_user)
    {
        // Ambil semua pesanan yang berstatus 'pending' untuk pengguna ini
        $pendingOrders = tbpesanan::where('id_user', $id_user)
            ->where('status', 'pending')
            ->get();

        // Hitung total quantity dan total price dari semua pesanan 'pending' pengguna ini
        $totalQuantity = $pendingOrders->sum('jumlah_pesan');
        $totalPrice = $pendingOrders->sum('jumlah_harga');

        // Ambil atau buat detail pesanan berdasarkan id_user
        $pesananDetail = tbpesanandetail::where('id_user', $id_user)
            ->where('status', 'pending')
            ->first();

        if ($pesananDetail) {
            // Update detail pesanan yang ada
            $pesananDetail->quantity = $totalQuantity;
            $pesananDetail->price = $totalPrice;
            $pesananDetail->save();
        } else {
            // Buat detail pesanan baru
            tbpesanandetail::create([
                'id_user' => $id_user,
                'quantity' => $totalQuantity,
                'price' => $totalPrice,
                'status' => 'pending',
            ]);
        }
    }

    private function calculateOverallStatus($orders)
    {
        $hasCompleted = false; // Flag untuk menandai apakah ada pesanan yang selesai

        // Iterasi pesanan untuk memeriksa status masing-masing
        foreach ($orders as $order) {
            if ($order->status === 'completed') {
                $hasCompleted = true;
                break; // Keluar dari loop jika ditemukan pesanan yang selesai
            }
        }

        // Jika ada pesanan yang selesai, kembalikan 'completed'
        // Jika tidak ada yang selesai, kembalikan status terakhir yang ditemukan
        return $hasCompleted ? 'completed' : $orders->last()->status;
    }

    public function createOrderDetail($id_user)
    {
        // Panggil fungsi untuk membuat pesanan detail
        $this->storeOrderDetails($id_user);

        // Redirect kembali ke halaman cart atau halaman lain yang sesuai
        return redirect('cart')->with('success', 'Pesanan Detail Berhasil Dibuat!');
    }
}
