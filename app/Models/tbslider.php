<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbslider extends Model
{
    use HasFactory;

    protected $table ='tbsliders';
    protected $fillable = ['id','foto','pajang','tglmasuk'];
}
