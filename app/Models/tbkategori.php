<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tbkategori extends Model
{
    use HasFactory;
    protected $table = 'tbkategori';
    protected $fillable = ['id','nama'];
}
