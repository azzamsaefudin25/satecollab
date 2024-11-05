<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KHS extends Model
{
    use HasFactory;

    protected $table = 'khs';


    public $incrementing = false;

    protected $keyType = 'string'; // Tipe primary key adalah string

    protected $fillable =
    [
        'nim',
        'kode_mk',
        'status',
        'sks',
        'nilai',
        'bobot',
        'nidn_dosen',
    ];
}
