<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RBController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');

        // Query untuk mengambil data dari tabel tbmutasi dengan join ke users dan tbstok
        $returnbeli = DB::table('tbstokrekap')
            ->leftJoin('users', 'users.id', '=', 'tbstokrekap.id_user')
            ->leftJoin('tbstok', 'tbstok.id', '=', 'tbstokrekap.id_barang')
            ->select('tbstokrekap.*', 'users.username as username', 'tbstok.nama_barang as nama_barang', 'tbstok.cover as cover','tbstok.hargabeliakhir as price')
            ->orderBy($sort, $direction)
            ->where('status','return beli')
            ->where('kode_status','rb')
            ->paginate(10); // Menggunakan paginate untuk membatasi jumlah data per halaman;

        return view('admin.ReturnBeli', compact('returnbeli'));
    }
}
