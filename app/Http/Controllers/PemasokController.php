<?php

namespace App\Http\Controllers;

use App\Models\tbpemasok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PemasokController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');

        // Query untuk mengambil data dari tabel tbstok, tbkategori, dan tbsatuan
        $result = DB::table('tbpemasok')
            ->orderBy($sort, $direction)
            ->paginate(10); // Menggunakan paginate untuk membatasi jumlah data per halaman

        return view('admin.pemasok.list', compact('result'));
    }

    public function create()
    {
        return view("admin.pemasok.tambah");
    }
    public function show($id)
    {
        return view('admin.pemasok.edit')->with('id', $id);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $kodevendor = $this->generateKodeVendor();

        tbpemasok::create([
            'kode' => $kodevendor,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'top' => $request->top,
        ]);

        Session::flash('success', 'Produk berhasil ditambahkan!');
        return redirect()->route('pemasok.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        // Mencari data pemasok berdasarkan ID
        $pemasok = tbpemasok::findOrFail($id);

        // Mengupdate data pemasok
        $pemasok->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'top' => $request->top,
        ]);

        // Menyimpan pesan sukses ke dalam session
        Session::flash('success', 'Data pemasok berhasil diperbarui!');

        // Mengarahkan kembali ke halaman daftar pemasok
        return redirect()->route('pemasok.index');
    }

    public function destroy($id)
    {
        $barang = tbpemasok::findOrFail($id);
        $barang->delete();

        Session::flash('success', 'Produk berhasil dihapus!');
        return redirect()->back();
    }
    private function generateKodeVendor()
    {
        $date = date('YmdHis');
        $randomNumber = mt_rand(100, 999); // Menghasilkan angka acak 3 digit
        return 'VNDTS' . $date . $randomNumber;
    }
}
