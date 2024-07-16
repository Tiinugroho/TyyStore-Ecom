<?php

namespace App\Models;

use App\Models\User;
use App\Models\tbstok;
use App\Models\tbpesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tbreturnjual extends Model
{
    use HasFactory;

    protected $table = 'tbreturnjual';

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
        'id_pesanan',
        'id_barang',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pesanan()
    {
        return $this->belongsTo(tbpesanan::class, 'id_pesanan');
    }

    public function barang()
    {
        return $this->belongsTo(tbstok::class, 'id_barang');
    }
}
