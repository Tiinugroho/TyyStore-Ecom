<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbcheckoutdetail;
use App\Http\Controllers\Controller;

class RJController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');

        // Query untuk mengambil data dari tabel tbcheckoutdetail dengan join ke users, tbpesanandetail, tbpesanan, dan tbstok
        $returnjual = tbcheckoutdetail::join('users', 'users.id', '=', 'tbcheckoutdetail.id_user')
            ->join('tbpesanandetail', 'tbpesanandetail.id_user', '=', 'tbcheckoutdetail.id_user')
            ->join('tbpesanans', 'tbpesanans.id_user', '=', 'tbpesanandetail.id_user')
            ->join('tbstok', 'tbstok.id', '=', 'tbpesanans.id_barang')
            ->select('tbcheckoutdetail.*', 'users.username as username', 'tbstok.nama_barang as nama_barang', 'tbstok.cover')
            ->orderBy($sort, $direction)
            ->where('tbcheckoutdetail.status', 'returned')
            ->where('tbcheckoutdetail.kode_status', 'rj')
            ->distinct() // Menggunakan distinct untuk menghindari duplikasi
            ->paginate(10); // Menggunakan paginate untuk membatasi jumlah data per halaman

        return view('admin.ReturnJual', compact('returnjual'));
    }
}
