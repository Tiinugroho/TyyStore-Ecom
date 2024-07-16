<?php

namespace App\Models;

use App\Models\tbstok;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tbpemasok extends Model
{
    use HasFactory;

    protected $table = 'tbpemasok';

    protected $fillable = [
        'id','nama','kode','nohp','alamat','top'
    ];

    public function stok()
    {
        return $this->hasMany(tbstok::class, 'id_vendor');
    }
}
