<?php

namespace App\Models;

use App\Models\tbsatuan;
use App\Models\tbpemasok;
use App\Models\tbpesanan;
use App\Models\tbkategori;
use App\Models\tbStokRekap;
use App\Models\tbpesanandetail;
use App\Models\tbcheckoutdetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tbstok extends Model
{
    use HasFactory;
    protected $table = 'tbstok';
    protected $fillable = ['id','kode','nama_barang','saldoawal','hargabeliakhir','hargajual','tglmasuk','hargamodal','cover','foto','desc','pajang','saldoakhir','id_satuan','id_kategori'];
    public function tbsatuan(): BelongsTo
    {
        return $this->belongsTo(tbsatuan::class, 'id_satuan');
    }
    public function tbkategori(): BelongsTo
    {
        return $this->belongsTo(tbkategori::class, 'id_kategori');
    }
    public function pesanan()
    {
        return $this->hasMany(tbpesanan::class, 'id_barang', 'id');
    }

    // Method untuk menghitung jumlah pesanan
    public function jumlah_pesanan()
    {
        return $this->pesanan()->sum('jumlah_pesan');
    }
    public function tbcheckoutdetails()
    {
        return $this->hasMany(tbcheckoutdetail::class, 'id_user');
    }
    public function stokRekap()
    {
        return $this->hasMany(tbStokRekap::class, 'id_barang');
    }
    // public function pemasok()
    // {
    //     return $this->belongsTo(tbpemasok::class, 'id_vendor');
    // }
    public function getBarangByVendor($id_vendor) {
        $barang = tbstok::where('id_vendor', $id_vendor)->get();
        return response()->json($barang);
    }
}
