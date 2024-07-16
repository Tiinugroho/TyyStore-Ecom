<?php

namespace App\Http\Controllers;

use App\Models\tbstok;
use App\Models\tbmasuk;
use App\Models\tbmutasi;
use App\Models\tbStokRekap;
use App\Models\tbreturnbeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BMController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');

        // Query untuk mengambil data dari tabel tbmutasi dengan join ke users dan tbstok
        $barangmasuk = DB::table('tbstokrekap')
            ->leftJoin('users', 'users.id', '=', 'tbstokrekap.id_user')
            ->leftJoin('tbstok', 'tbstok.id', '=', 'tbstokrekap.id_barang')
            ->leftJoin('tbpemasok', 'tbpemasok.id', '=', 'tbstokrekap.id_vendor')
            ->select('tbstokrekap.*', 'users.username as username', 'tbstok.nama_barang as nama_barang', 'tbstok.cover as cover','tbstok.hargabeliakhir as price', 'tbpemasok.nama as namavendor')
            ->orderBy($sort, $direction)
            ->where('status','masuk')
            ->where('kode_status','m')
            ->paginate(10); // Menggunakan paginate untuk membatasi jumlah data per halaman;

        return view('admin.BarangMasuk', compact('barangmasuk'));
    }

    
}
