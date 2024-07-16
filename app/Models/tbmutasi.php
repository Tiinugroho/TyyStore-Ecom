<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbmutasi extends Model
{
    use HasFactory;

    protected $table = 'tbmutasi';

    protected $fillable = [
        'no_bukti',
        'barang',
        'mk',
        'qty',
        'harga',
        'tanggal',
        'status',
        'bukti_pembayaran',
        'user_id',
        'ket'
    ];
}
