<?php

namespace App\Http\Controllers;

use App\Models\tbstok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');

        // Query untuk mengambil data dari tabel tbstok, tbkategori, dan tbsatuan
        $result = DB::table('tbstok')
            ->leftJoin('tbsatuan', 'tbsatuan.id', '=', 'tbstok.id_satuan')
            ->leftJoin('tbkategori', 'tbkategori.id', '=', 'tbstok.id_kategori')
            ->select('tbstok.*', 'tbsatuan.nama as namasatuan', 'tbkategori.nama as namakategori')
            ->orderBy($sort, $direction)
            ->paginate(10); // Menggunakan paginate untuk membatasi jumlah data per halaman

        return view('admin.barang.list', compact('result'));
    }

    public function create()
    {
        return view("admin.barang.tambah");
    }
    public function show($id)
    {
        return view('admin.barang.edit')->with('id', $id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'cover' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

        // Upload cover
        $cover = $request->file('cover');
        $covernamaFile = $cover->getClientOriginalName();
        $cover->move(public_path('image'), $covernamaFile);

        // Upload foto
        $fotoNames = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                if ($foto->isValid()) {
                    $namaFile = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . $foto->getClientOriginalExtension();
                    $foto->move(public_path('image'), $namaFile);
                    $fotoNames[] = $namaFile;
                } else {
                    return redirect()->back()->withErrors(['error' => 'File foto tidak valid.']);
                }
            }
        }

        // Hitung harga modal otomatis
        $saldoawal = $request->saldoawal;
        $hargabeliakhir = $request->hargabeliakhir;
        $hargamodal = $saldoawal * $hargabeliakhir;

        // Simpan data barang
        $kodeProduk = $this->generateKodeProduk();
        tbstok::create([
            'kode' => $kodeProduk,
            'nama_barang' => $request->nama_barang,
            'saldoawal' => $saldoawal,
            'hargabeliakhir' => $hargabeliakhir,
            'hargajual' => $request->hargajual,
            'tglmasuk' => $request->tglmasuk,
            'hargamodal' => $hargamodal,
            'cover' => $covernamaFile,
            'foto' => json_encode($fotoNames),
            'desc' => $request->desc,
            'pajang' => $request->pajang,
            'saldoakhir' => $saldoawal, // Jangan lupa untuk menyesuaikan saldoakhir
            'id_satuan' => $request->id_satuan,
            'id_kategori' => $request->id_kategori,
        ]);

        Session::flash('success', 'Produk berhasil ditambahkan!');
        return redirect()->route('barang.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'nama_barang' => 'required',
            // 'cover' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

        $barang = tbstok::findOrFail($id);

        // Upload cover jika ada
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $covernamaFile = $cover->getClientOriginalName();
            $cover->move(public_path('image'), $covernamaFile);
            $barang->cover = $covernamaFile;
        }

        // Upload foto jika ada
        $fotoNames = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                if ($foto->isValid()) {
                    $namaFile = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . $foto->getClientOriginalExtension();
                    $foto->move(public_path('image'), $namaFile);
                    $fotoNames[] = $namaFile;
                } else {
                    return redirect()->back()->withErrors(['error' => 'File foto tidak valid.']);
                }
            }
            $barang->foto = json_encode($fotoNames);
        }

        // Hitung harga modal otomatis
        $saldoawal = $request->saldoawal;
        $hargabeliakhir = $request->hargabeliakhir;
        $hargamodal = $saldoawal * $hargabeliakhir;

        // Simpan perubahan data barang
        $barang->nama_barang = $request->nama_barang;
        $barang->saldoawal = $saldoawal;
        $barang->hargabeliakhir = $hargabeliakhir;
        $barang->hargajual = $request->hargajual;
        $barang->tglmasuk = $request->tglmasuk;
        $barang->hargamodal = $hargamodal;
        $barang->desc = $request->desc;
        $barang->pajang = $request->pajang;
        $barang->saldoakhir = $saldoawal; // Jangan lupa untuk menyesuaikan saldoakhir
        $barang->id_satuan = $request->id_satuan;
        $barang->id_kategori = $request->id_kategori;
        $barang->save();

        Session::flash('success', 'Produk berhasil diperbarui!');
        return redirect()->route('barang.index');
    }

    public function destroy($id)
    {
        $barang = tbstok::findOrFail($id);
        $barang->delete();

        Session::flash('success', 'Produk berhasil dihapus!');
        return redirect()->back();
    }

    private function generateKodeProduk()
    {
        $date = date('YmdHis');
        $randomNumber = mt_rand(100, 999); // Menghasilkan angka acak 3 digit
        return 'TYP' . $date . $randomNumber;
    }
}
