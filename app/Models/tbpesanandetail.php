<?php

namespace App\Models;

use App\Models\User;
use App\Models\tbstok;
use App\Models\tbpesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tbpesanandetail extends Model
{
    protected $table = 'tbpesanandetail';

    protected $fillable = [
        'id_user',
        'quantity',
        'price',
        'status',
        'kode',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function pesanan()
    {
        return $this->belongsTo(tbpesanan::class, 'id_user');
    }
    public function tbstok(): BelongsTo
    {
        return $this->belongsTo(tbstok::class, 'id_barang');
    }
    public function checkoutdetails()
    {
        return $this->hasMany(tbcheckoutdetail::class, 'id_user', 'id_user');
    }

    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }
}
