<?php

namespace App\Http\Controllers;

use App\Models\tbstok;
use App\Models\tbkeluar;
use App\Models\tbmutasi;
use App\Models\tbpesanan;
use App\Models\tbreturnjual;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\tbpesanandetail;
use App\Models\tbcheckoutdetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\tbcheckoutreturn; // Model untuk tbcheckoutreturn

class CheckoutController extends Controller
{
    public function index()
    {
        $orders = tbcheckoutdetail::leftJoin('users', 'users.id', '=', 'tbcheckoutdetail.id_user')
            ->select('tbcheckoutdetail.*', 'users.username as username')
            ->orderBy('tbcheckoutdetail.id', 'DESC')
            ->get();

        return view('admin.checkout.list', compact('orders'));
    }

    public function show($id)
    {
        $order = tbcheckoutdetail::leftJoin('users', 'users.id', '=', 'tbcheckoutdetail.id_user')
            ->select('tbcheckoutdetail.*', 'users.username as username')
            ->where('tbcheckoutdetail.id', $id)
            ->first();

        return view('admin.checkout.list', ['orders' => collect([$order])]);
    }

    public function approve(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $checkoutDetail = tbcheckoutdetail::findOrFail($id);

            if ($checkoutDetail->status !== 'pending') {
                throw new \Exception('Status pesanan tidak valid untuk diapprove.');
            }

            $checkoutDetail->status = 'completed';
            $checkoutDetail->kode_status = 'k';
            $checkoutDetail->save();

            $pesanans = tbpesanan::where('id_user', $checkoutDetail->id_user)
                ->where('status', 'pending')
                ->get();

            foreach ($pesanans as $pesanan) {
                $pesanan->status = 'completed';
                $pesanan->save();

                $stok = tbstok::findOrFail($pesanan->id_barang);
                // $saldo_sebelum = $stok->saldoakhir;
                // $stok->saldoakhir -= $pesanan->jumlah_pesan;

                // Pastikan stok tidak negatif
                if ($stok->saldoakhir < 0) {
                    throw new \Exception('Stok tidak mencukupi untuk pesanan.');
                }

                $stok->save();

                // Selalu buat entri baru di tbmutasi
                tbmutasi::create([
                    'no_bukti' => $checkoutDetail->kode,
                    'barang' => $stok->nama_barang,
                    'mk' => 'k',
                    'qty' => $pesanan->jumlah_pesan,
                    'harga' => $stok->hargajual * $pesanan->jumlah_pesan,
                    'tanggal' => now(),
                    'status' => 'keluar',
                    'bukti_pembayaran' => 'Null',
                    'user_id' => auth()->id(),
                    'ket' => 'Barang Keluar'
                ]);
            }

            $pesanandetails = tbpesanandetail::where('id_user', $checkoutDetail->id_user)
                ->where('status', 'pending')
                ->get();

            foreach ($pesanandetails as $pesanandetail) {
                $pesanandetail->status = 'completed';
                $pesanandetail->save();
            }

            DB::commit();

            Session::flash('success', 'Pesanan berhasil diapprove!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Terjadi kesalahan saat mengapprove pesanan: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function returnOrder($id)
    {
        DB::beginTransaction();

        try {
            $checkoutDetail = tbcheckoutdetail::findOrFail($id);

            if ($checkoutDetail->status !== 'completed') {
                return redirect()->back();
            }

            $checkoutReturn = new tbcheckoutreturn([
                'id_checkout' => $checkoutDetail->id,
                'status' => 'returned'
            ]);
            $checkoutReturn->save();

            $checkoutDetail->status = 'returned';
            $checkoutDetail->kode_status = 'rj';
            $checkoutDetail->save();

            // Proses return pesanan
            $pesanans = tbpesanan::where('id_user', $checkoutDetail->id_user)
                ->where('status', 'completed')
                ->get();

            foreach ($pesanans as $pesanan) {
                // Kembalikan stok barang ke tbstok
                $stok = tbstok::findOrFail($pesanan->id_barang);
                $stok->saldoakhir += $pesanan->jumlah_pesan;
                $stok->save();

                // Selalu buat entri baru di tbmutasi
                tbmutasi::create([
                    'no_bukti' => $checkoutDetail->kode,
                    'barang' => $stok->nama_barang,
                    'mk' => 'rj',
                    'qty' => $pesanan->jumlah_pesan,
                    'harga' => $stok->hargajual * $pesanan->jumlah_pesan,
                    'tanggal' => now(),
                    'status' => 'return jual',
                    'bukti_pembayaran' => 'Null',
                    'user_id' => auth()->id(),
                    'ket' => 'Barang Masuk (Return)'
                ]);

                // Ubah status pesanan menjadi 'returned'
                $pesanan->status = 'returned';
                $pesanan->save();

                // Ubah status pesanan detail terkait menjadi 'returned'
                $pesanandetails = tbpesanandetail::where('id_user', $checkoutDetail->id_user)
                    ->where('status', 'completed')
                    ->get();

                foreach ($pesanandetails as $pesanandetail) {
                    $pesanandetail->status = 'returned';
                    $pesanandetail->save();
                }
            }

            DB::commit();
            Session::flash('success', 'Pesanan berhasil di-return!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Terjadi kesalahan saat me-return pesanan: ' . $e->getMessage());
            return redirect()->back();
        }
    }



    public function cancelOrder($id)
    {
        DB::beginTransaction();

        try {
            $checkoutDetail = tbcheckoutdetail::findOrFail($id);

            if ($checkoutDetail->status !== 'pending') {
                throw new \Exception('Status pesanan tidak valid untuk dibatalkan.');
            }

            // Ubah status checkout detail menjadi 'canceled'
            $checkoutDetail->status = 'canceled';
            $checkoutDetail->kode_status = 'c';
            $checkoutDetail->save();

            // Ubah status pesanan menjadi 'canceled'
            $pesanans = tbpesanan::where('id_user', $checkoutDetail->id_user)
                ->where('status', 'pending')
                ->get();

            foreach ($pesanans as $pesanan) {
                $pesanan->status = 'canceled';
                $pesanan->save();

                // Kembalikan stok barang ke tbstok
                $stok = tbstok::findOrFail($pesanan->id_barang);
                $stok->saldoakhir += $pesanan->jumlah_pesan;
                $stok->save();

                // Catat mutasi pembatalan pesanan
                tbmutasi::create([
                    'no_bukti' => $checkoutDetail->kode,
                    'barang' => $stok->nama_barang,
                    'mk' => 'c',
                    'qty' => $pesanan->jumlah_pesan,
                    'harga' => $stok->hargajual * $pesanan->jumlah_pesan,
                    'tanggal' => now(),
                    'status' => 'cancel',
                    'bukti_pembayaran' => 'Null',
                    'user_id' => auth()->id(),
                    'ket' => 'Pesanan Dibatalkan'
                ]);
            }

            // Ubah status pesanan detail menjadi 'canceled'
            $pesanandetails = tbpesanandetail::where('id_user', $checkoutDetail->id_user)
                ->where('status', 'pending')
                ->get();

            foreach ($pesanandetails as $pesanandetail) {
                $pesanandetail->status = 'canceled';
                $pesanandetail->save();
            }

            DB::commit();
            Session::flash('success', 'Pesanan berhasil dibatalkan!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Terjadi kesalahan saat membatalkan pesanan: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function detailBarang($id)
    {
        $orders = tbcheckoutdetail::leftJoin('users', 'users.id', '=', 'tbcheckoutdetail.id_user')
            ->select('tbcheckoutdetail.*', 'users.username as username')
            ->orderBy('tbcheckoutdetail.id', 'DESC')
            ->get();

        $detail = tbpesanan::leftJoin('users', 'users.id', '=', 'tbpesanans.id_user')
            ->select('tbpesanans.*', 'users.username as username')
            ->where('tbpesanans.kode', $id) // memastikan kolom kode ada di tabel tbpesanans
            ->orderBy('tbpesanans.id', 'DESC')
            ->get();

        return view('admin.checkout.list', compact('orders', 'detail', 'id'));
    }
}
