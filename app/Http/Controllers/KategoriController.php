<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        
        $result = DB::table('tbkategori')
            ->orderBy('tbkategori.id', 'DESC')
            ->get();
        
            return view ('admin.kategori.list')
            ->with('isi','admin.kategori.tabelbarang')
            ->with('result',$result);
        }
}
