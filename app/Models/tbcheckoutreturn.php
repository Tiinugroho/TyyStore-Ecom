<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbcheckoutreturn extends Model
{
    use HasFactory;

    protected $table = 'tbcheckoutreturn';

    protected $fillable = [
        'id_checkout'
    ];

    public function checkoutreturn()
    {
        return $this->belongsTo(tbcheckoutdetail::class, 'id_checkout');
    }
}
