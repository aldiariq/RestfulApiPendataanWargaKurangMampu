<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRukunTetangga extends Model
{
    use HasFactory;

    protected $table = 'data_rukun_tetanggas';

    protected $fillable = [
        'no_ktp_rukun_tetangga',
        'no_rukun_tetangga',
        'nama_rukun_tetangga',
        'notel_rukun_tetangga'
    ];
}
