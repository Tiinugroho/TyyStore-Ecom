<?php

namespace App\Http\Controllers;

use App\Models\tbpesanan;
use Illuminate\Http\Request;
use App\Models\tbpesanandetail;
use App\Models\tbcheckoutdetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $id_user = Auth::id();
        $products = tbpesanan::where('id_user', $id_user)
            ->where('status', 'pending')
            ->with('tbstok')
            ->get();
        $jumlah_pesanan = $products->count();
        $saldo_awal = $products->first() ? $products->first()->tbstok->saldoawal : 0;

        return view('cart', compact('products', 'jumlah_pesanan', 'saldo_awal'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'tbpesanan.*.id' => 'required|integer|exists:tbpesanans,id',
            'tbpesanan.*.jumlah_pesan' => 'required|integer|min:1',
        ]);

        DB::beginTransaction(); // Mulai transaksi

        try {
            foreach ($request->tbpesanan as $item) {
                $order = tbpesanan::findOrFail($item['id']);
                $order->jumlah_pesan = $item['jumlah_pesan'];
                $order->jumlah_harga = $item['jumlah_pesan'] * $order->tbstok->hargajual;
                $order->save();
            }

            // Update detail pesanan setelah semua pesanan diperbarui
            $id_user = Auth::id();
            $this->storeOrderDetails($id_user);

            DB::commit(); // Commit transaksi

            Session::flash('success', 'Pesanan Berhasil Diupdate!');
            return redirect('cart');
        } catch (\Exception $e) {
            DB::rollback(); // Rollback transaksi jika terjadi kesalahan
            Session::flash('error', 'Terjadi kesalahan saat mengupdate pesanan: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function storeOrderDetails($id_user)
    {
        // Hitung total quantity dan total price dari semua pesanan pengguna ini
        $totalQuantity = tbpesanan::where('id_user', $id_user)->where('status', 'pending')->sum('jumlah_pesan');
        $totalPrice = tbpesanan::where('id_user', $id_user)->where('status', 'pending')->sum('jumlah_harga');

        // Perbarui atau buat detail pesanan berdasarkan id_user
        $pesananDetail = tbpesanandetail::where('id_user', $id_user)->first();

        if ($pesananDetail) {
            // Update existing order detail
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

    public function createOrderDetail($id_user)
    {
        // Panggil fungsi untuk membuat pesanan detail
        $this->storeOrderDetails($id_user);

        // Redirect kembali ke halaman cart atau halaman lain yang sesuai
        return redirect('cart')->with('success', 'Pesanan Detail Berhasil Dibuat!');
    }

    public function checkout(Request $request)
    {
        DB::beginTransaction();

        try {
            $id_user = Auth::id();
            $kode_pesanan = $this->generateKodePesanan();

            // Validasi bukti transaksi
            $request->validate([
                'bukti_transaksi' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);

            // Simpan bukti transaksi
            $imageName = $request->file('bukti_transaksi')->getClientOriginalName();
            $request->file('bukti_transaksi')->move(public_path('bukti_transaksi'), $imageName);

            // Ambil semua pesanan pending untuk pengguna ini
            $products = tbpesanan::where('id_user', $id_user)
                ->where('status', 'pending')
                ->with('tbstok')
                ->get();

            if ($products->isEmpty()) {
                throw new \Exception('Tidak ada pesanan yang dapat di-checkout.');
            }

            // Cek apakah sudah ada entri tbcheckoutdetail untuk id_user dan kode_pesanan
            $existingCheckoutDetail = tbcheckoutdetail::where('id_user', $id_user)
                ->where('kode', $kode_pesanan)
                ->first();

            if ($existingCheckoutDetail) {
                // Update detail checkout yang sudah ada
                $existingCheckoutDetail->quantity += $products->sum('jumlah_pesan');
                $existingCheckoutDetail->price += $products->sum(function ($product) {
                    return $product->jumlah_pesan * $product->tbstok->hargajual;
                });
                $existingCheckoutDetail->bukti_transaksi = $imageName;
                $existingCheckoutDetail->save();
            } else {
                // Buat detail checkout baru
                $pesananDetail = tbpesanandetail::where('id_user', $id_user)
                    ->where('status', 'pending')
                    ->first();

                if (!$pesananDetail) {
                    throw new \Exception('Tidak ada pesanan detail yang sesuai untuk checkout.');
                }

                $checkoutDetail = new tbcheckoutdetail([
                    'kode' => $kode_pesanan,
                    'status' => 'pending',
                    'kode_status' => 'p',
                    'id_user' => $id_user,
                    'quantity' => $products->sum('jumlah_pesan'),
                    'price' => $products->sum(function ($product) {
                        return $product->jumlah_pesan * $product->tbstok->hargajual;
                    }),
                    'bukti_transaksi' => $imageName,
                ]);
                $checkoutDetail->save();

                // Update kode pesanan di tbpesanan
                $pesanans = tbpesanan::where('id_user', $checkoutDetail->id_user)
                    ->where('status', 'pending')
                    ->get();

                foreach ($pesanans as $pesanan) {
                    $pesanan->kode = $kode_pesanan;
                    $pesanan->save();
                }

                // Update kode pesanan di tbpesanandetail
                $pesanandetails = tbpesanandetail::where('id_user', $checkoutDetail->id_user)
                    ->where('status', 'pending')
                    ->get();

                foreach ($pesanandetails as $pesanandetail) {
                    $pesanandetail->kode = $kode_pesanan;
                    $pesanandetail->save();

                    Log::info('Pesanandetail status updated', ['pesanandetail' => $pesanandetail]);
                }
            }

            // Kurangi stok di tbstok berdasarkan jumlah_pesan
            foreach ($products as $product) {
                $stock = $product->tbstok;
                if ($stock->saldoakhir < $product->jumlah_pesan) {
                    throw new \Exception('Stok tidak mencukupi untuk barang: ' . $stock->nama_barang);
                }
                $stock->saldoakhir -= $product->jumlah_pesan;
                $stock->save();
            }

            // Tandai pesanan sebagai complete
            // tbpesanan::where('id_user', $id_user)
            //     ->where('status', 'pending');

            DB::commit();
            Session::flash('success', 'Pesanan Berhasil Dicheckout!');
            return redirect('/');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $order = tbpesanan::findOrFail($id);
            $order->delete();

            // Perbarui atau hapus entri terkait di tbpesanandetail
            $id_user = Auth::id();
            tbpesanandetail::where('id_user', $id_user)->update([
                'quantity' => 0,
                'price' => 0,
            ]);

            Session::flash('success', 'Pesanan Berhasil Dihapus!');
            return redirect('cart');
        } catch (\Exception $e) {
            Session::flash('error', 'Terjadi kesalahan saat menghapus pesanan: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    private function generateKodePesanan()
    {
        $userId = Auth::id();
        $dateTime = now()->format('YmdHis'); // Format tanggal yang lebih aman
        $uniqueNumber = strtoupper(substr(uniqid(), -4)); // Dapatkan 4 karakter unik dari uniqid()

        return 'TYSX' . $dateTime . '_' . $userId . $uniqueNumber;
    }

    
}
