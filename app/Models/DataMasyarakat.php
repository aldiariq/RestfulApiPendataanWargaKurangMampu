<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMasyarakat extends Model
{
    use HasFactory;

    protected $table = 'data_masyarakats';
    
    protected $fillable = [
        'no_kartu_keluarga',
        'no_ktp_kepala_keluarga',
        'nama_kepala_keluarga',
        'pekerjaan_kepala_keluarga',
        'penghasilan_kepala_keluarga',
        'jumlah_tanggungan',
        'foto_kepala_keluarga',
        'notel_kepala_keluarga',
        'status_tempat_tinggal',
        'id_rukun_tetangga'
    ];
}
