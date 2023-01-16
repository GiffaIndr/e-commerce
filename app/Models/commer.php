<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barang',
        'jumlah',
        'image',
        'harga',
        'status',
        'done_time',
        'tipe',
        'jenis',
        'description',
    ];
}
