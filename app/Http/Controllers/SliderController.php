<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.slider.list');
    }

    public function create()
    {
        return view("admin.slider.tambah");
    }

    public function store(Request $r)
    {
        $r->validate([
            'foto' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);

        $foto = $r->file('foto');
        $namaFile = $foto->getClientOriginalName();
        $foto->move(public_path('slider'), $namaFile);

        DB::table('tbsliders')->insert([
            'foto' => $namaFile,
            'pajang' => $r->pajang,
            'tglmasuk' => $r->tglmasuk,
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider berhasil ditambahkan.');
    }
    public function show($id)
    {
        return view('admin.slider.edit')
            ->with('id', $id);
    }

    public function update(Request $request, $id)
    {
        $stok = DB::table('tbsliders')->where('id', $id)->first();
    
        if (!$stok) {
            return redirect()->route('slider.index')->with('error', 'Data tidak ditemukan.');
        }
    
        $foto = $request->file('foto');
        $namaFile = $stok->foto;
    
        if ($foto) {

            if (file_exists(public_path('slider/' . $namaFile))) {
                unlink(public_path('slider/' . $namaFile));
            }
            
            $namaFile = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('slider'), $namaFile);
        }
    
        DB::table('tbsliders')
            ->where('id', $id)
            ->update([
                'foto' => $namaFile,
                'pajang' => $request->pajang,
                'tglmasuk' => $request->tglmasuk,
            ]);
    
            return redirect()->route('slider.index')->with('success', 'Slider berhasil diperbarui.');
    }
    
    public function destroy(Request $r)
    {
        DB::table('tbsliders')
            ->where('id', $r->id)
            ->delete();

            return redirect()->route('slider.index')->with('success', 'Slider berhasil dihapus.');
    }
}
