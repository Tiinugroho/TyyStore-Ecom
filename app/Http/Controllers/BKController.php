<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbcheckoutdetail;
use App\Http\Controllers\Controller;

class BKController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');

        // Query untuk mengambil data dari tabel tbcheckoutdetail dengan join ke users, tbpesanandetail, tbpesanan, dan tbstok
        $barangkeluar = tbcheckoutdetail::leftjoin('users', 'users.id', '=', 'tbcheckoutdetail.id_user')
            ->leftjoin('tbpesanandetail', 'tbpesanandetail.id_user', '=', 'tbcheckoutdetail.id_user')
            ->leftjoin('tbpesanans', 'tbpesanans.id_user', '=', 'tbpesanandetail.id_user')
            ->leftjoin('tbstok', 'tbstok.id', '=', 'tbpesanans.id_barang')
            ->select('tbcheckoutdetail.*', 'users.username as username', 'tbstok.nama_barang', 'tbstok.cover')
            ->orderBy($sort, $direction)
            ->where('tbcheckoutdetail.status', 'completed')
            ->where('tbcheckoutdetail.kode_status', 'k')
            ->distinct() // Menggunakan distinct untuk menghindari duplikasi
            ->paginate(10); // Menggunakan paginate untuk membatasi jumlah data per halaman

        return view('admin.BarangKeluar', compact('barangkeluar'));
    }
}
