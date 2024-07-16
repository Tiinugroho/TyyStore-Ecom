<?php

namespace App\Models;

use App\Models\User;
use App\Models\tbstok;
use App\Models\tbmasuk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tbreturnbeli extends Model
{
    use HasFactory;

    protected $table = 'tbreturnbeli';

    protected $fillable = [
        'kode',
        'desc',
        'quantity',
        'price',
        'saldo_sebelum',
        'saldo_setelah',
        'tanggal',
        'status',
        'id_user',
        'id_barang',
        'id_stok_rekap',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function barang()
    {
        return $this->belongsTo(tbstok::class, 'id_barang');
    }
    public function barangmasuk()
    {
        return $this->belongsTo(tbmasuk::class, 'id_masuk');
    }
}
