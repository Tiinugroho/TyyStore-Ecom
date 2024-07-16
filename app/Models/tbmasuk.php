<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbmasuk extends Model
{
    use HasFactory;

    protected $table = 'tbmasuk';

    protected $fillable = [
        'kode',
        'quantity',
        'desc',
        'price',
        'saldo_sebelum',
        'saldo_setelah',
        'tanggal',
        'status',
        'id_user',
        'id_barang',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function barang()
    {
        return $this->belongsTo(tbstok::class, 'id_barang');
    }
}
