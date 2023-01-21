<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank',
        'pemilik',
        'nominal',
        'bukti',
        'done_time',
        'status',
        'user_id',
        'nama'
    ];
}
