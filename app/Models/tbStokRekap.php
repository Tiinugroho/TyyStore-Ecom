<?php

namespace App\Models;


use App\Models\User;
use App\Models\tbstok;
use App\Models\tbpemasok;
use App\Models\tbreturnbeli;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tbStokRekap extends Model
{
    use HasFactory;

    protected $table = 'tbStokRekap';

    protected $fillable = [
        'id',
        'kode',
        'kode_status',
        'status',
        'id_barang',
        'id_vendor',
        'jumlah',
        'harga',
        'saldo_sebelum',
        'saldo_setelah',
        'tanggal',
        'desc',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function barang()
    {
        return $this->belongsTo(tbstok::class, 'id_barang');
    }
    public function returnbeli()
    {
        return $this->belongsTo(tbreturnbeli::class, 'id_stok_rekap','id');
    }
    public function vendor()
{
    return $this->belongsTo(tbpemasok::class, 'id_vendor');
}

}
