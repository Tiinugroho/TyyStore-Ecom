<?php

namespace App\Http\Controllers;

use App\Models\tbstok;
use App\Models\tbmutasi;
use App\Models\tbStokRekap;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RestockController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');

        // $barangs = DB::table('tbstok')
        //     ->leftJoin('tbpemasok', 'tbpemasok.id', '=', 'tbstok.id_vendor')
        //     ->select('tbstok.*', 'tbpemasok.nama as namavendor')
        //     ->orderBy($sort, $direction)
        //     ->paginate(10); // Menggunakan paginate untuk membatasi jumlah data per halaman;

        // $stok = DB::table('tbstokrekap')
        //     ->leftJoin('tbstok', 'tbstok.id', '=', 'tbstokrekap.id_barang')
        //     ->leftJoin('tbpemasok', 'tbpemasok.id', '=', 'tbstok.id_vendor')
        //     ->select('tbstokrekap.*', 'tbstok.nama_barang as namabarang', 'tbpemasok.nama as namavendor')
        //     ->orderBy($sort, $direction)
        //     ->where('kode_status', 'm')
        //     ->paginate(10);

        // $mutasi = DB::table('tbmutasi')
        //     ->leftJoin('tbstok', 'tbstok.id', '=', 'tbmutasi.id_barang')
        //     ->select('tbmutasi.*', 'tbstok.nama_barang as namabarang')
        //     ->orderBy($sort, $direction)
        //     ->paginate(10);

        // Generate kode here
        // $kode = $this->generateKodeRekap();

        return view('admin.restock.list');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang.*' => 'required|integer|exists:tbstok,id',
            'quantity.*' => 'required|integer|min:1',
            'harga.*' => 'required|numeric|min:0',
            'subtotal.*' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'id_vendor' => 'required|exists:tbpemasok,id',
            'kode' => 'required|string',
            'tanggal' => 'required|date',
            'desc' => 'nullable|string',
        ]);

        // Iterate through each product and update their stock and create entries in tbStokRekap and tbmutasi
        foreach ($request->id_barang as $index => $id_barang) {
            $quantity = $request->quantity[$index];
            $harga = $request->harga[$index];
            $subtotal = $request->subtotal[$index];

            // Mendapatkan barang berdasarkan id_barang
            $barang = tbstok::findOrFail($id_barang);

            $saldo_sebelum = $barang->saldoawal;

            // Update saldo awal dan saldo akhir
            $barang->saldoawal += $quantity;
            $barang->saldoakhir += $quantity;
            // Update harga beli terakhir
            $barang->hargabeliakhir = $harga;

            // Simpan perubahan saldo dan harga
            $barang->save();

            // Membuat rekap baru
            tbStokRekap::create([
                'kode' => $request->kode,
                'kode_status' => 'm',
                'status' => 'masuk',
                'id_barang' => $id_barang,
                'id_vendor' => $request->id_vendor,
                'jumlah' => $quantity,
                'harga' => $harga * $quantity,
                'desc' => $request->desc,
                'saldo_sebelum' => $saldo_sebelum,
                'saldo_setelah' => $barang->saldoawal,
                'tanggal' => $request->tanggal,
                'id_user' => auth()->id(),
            ]);

            $barang = DB::table('tbstok')->where('id',$id_barang)->value('nama_barang');
            // dd($barang);
            tbmutasi::create([
                'no_bukti' => $request->kode,
                'barang' => $barang,
                'mk' => 'm',
                'qty' => $quantity,
                'harga' => $harga * $quantity,
                'tanggal' => $request->tanggal,
                'status' => 'masuk',
                'bukti_pembayaran' => 'Null',
                'user_id' => auth()->id(),
                'ket' => 'Barang Masuk'
            ]);

            // Update saldo akhir dan harga modal di tbstok
            $this->updateSaldoAkhirHargaModal($id_barang);
        }

        Session::flash('success', 'Stok berhasil ditambahkan!');
        return redirect()->route('admin.restock.index'); // Redirect ke halaman list setelah berhasil tambah stok
    }


    private function updateSaldoAkhirHargaModal($id)
    {
        $barang = tbstok::findOrFail($id);

        // Hitung saldo akhir
        $barang->saldoakhir = $barang->saldoawal - $barang->jumlah_pesanan();

        // Hitung harga modal
        $barang->hargamodal = $barang->saldoawal * $barang->hargabeliakhir;

        // Simpan perubahan saldo akhir dan harga modal
        $barang->save();
    }

    public function show($id)
    {
        $barang = tbstok::with('pemasok')->findOrFail($id);
        return view('admin.BarangMasuk', compact('barang'));
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Temukan entri restock berdasarkan ID
            $rekap = tbstokrekap::findOrFail($id);

            // Temukan barang yang direstock
            $barang = tbstok::findOrFail($rekap->id_barang);

            // Simpan saldo sebelumnya untuk keperluan audit atau catatan
            $saldo_sebelum = $barang->saldoawal;

            // Hitung jumlah yang ingin direturn
            $jumlah_return = $rekap->jumlah; // Sesuaikan dengan kolom yang benar

            // Kurangi jumlah stok dari saldo awal dan saldo akhir
            $barang->saldoawal -= $jumlah_return;
            $barang->saldoakhir -= $jumlah_return;

            // Simpan perubahan saldo awal dan saldo akhir
            $barang->save();

            // Update status dan kode_status di tbstokrekap
            $rekap->status = 'return beli';
            $rekap->kode_status = 'rb';
            $rekap->save();

            // Buat entri mutasi dengan detail yang sesuai
            tbmutasi::create([
                'desc' => 'No Bukti: ' . $rekap->kode,
                'quantity' => -$jumlah_return, // Jumlah return dari restock
                'price' => $barang->hargabeliakhir,
                'saldo_sebelum' => $saldo_sebelum,
                'saldo_setelah' => $barang->saldoawal,
                'tanggal' => Carbon::now(),
                'status' => 'return beli', // Status return
                'id_user' => auth()->id(),
                'id_barang' => $barang->id
            ]);

            // Update saldo akhir dan harga modal barang
            $this->updateSaldoAkhirHargaModal($barang->id);

            // Commit transaksi database
            DB::commit();

            // Redirect kembali dengan pesan sukses
            Session::flash('success', 'Stok berhasil direturn!');
            return redirect()->back();
        } catch (\Exception $e) {
            // Rollback transaksi database jika terjadi kesalahan
            DB::rollback();

            // Redirect kembali dengan pesan error
            Session::flash('error', 'Terjadi kesalahan saat menghapus restock: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function getHarga($id)
    {
        $barang = tbstok::findOrFail($id);
        return response()->json(['harga' => $barang->hargabeliakhir]);
    }

    public function getBarangByVendor($id_vendor)
    {
        $barang = tbstok::where('id_vendor', $id_vendor)->get();
        return response()->json($barang);
    }
}
