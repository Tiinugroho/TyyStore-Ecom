<?php

namespace App\Models;

use App\Models\User;
use App\Models\tbstok;
use App\Models\tbpesanandetail;
use App\Models\tbcheckoutdetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tbpesanan extends Model
{
    use HasFactory;

    protected $table = 'tbpesanans';
    protected $fillable = [
        'id_user',
        'id_barang',
        'jumlah_pesan',
        'tanggal',
        'jumlah_harga',
        'status',
        'kode',
    ];
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function tbstok(): BelongsTo
    {
        return $this->belongsTo(tbstok::class, 'id_barang');
    }
    public function pesanandetails()
    {
        return $this->hasMany(tbpesanandetail::class, 'id_user', 'id_user');
    }
    public function checkoutdetails()
    {
        return $this->hasMany(tbcheckoutdetail::class, 'id_user', 'id_user');
    }
    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();

        foreach ($this->pesanandetails as $pesanandetail) {
            $pesanandetail->updateStatus($status);
        }
    }
}
