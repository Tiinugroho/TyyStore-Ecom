<?php

namespace App\Models;

use App\Models\User;
use App\Models\tbstok;
use App\Models\tbpesanan;
use App\Models\tbpesanandetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tbcheckoutdetail extends Model
{
    use HasFactory;

    protected $table = 'tbcheckoutdetail';

    protected $fillable = [
        'kode', 'status', 'id_user', 'bukti_transaksi', 'quantity', 'price','kode_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function pesanan()
    {
        return $this->belongsTo(tbpesanan::class, 'id_user');
    }
    public function pesanandetail()
    {
        return $this->belongsTo(tbpesanandetail::class, 'id_user');
    }
    public function checkoutreturns()
    {
        return $this->hasMany(tbcheckoutreturn::class, 'id_checkout');
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