<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbsatuan extends Model
{
    use HasFactory;

    protected $table = 'tbsatuan';
    protected $fillable = ['id','nama'];
}
