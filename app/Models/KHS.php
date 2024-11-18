<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KHS extends Model
{
    use HasFactory;

    protected $table = 'khs';


    protected $primaryKey = 'id_khs';
    public $incrementing = true;

    protected $keyType = 'string'; // Tipe primary key adalah string

    protected $fillable =
    [
        'nim',
        'kode_mk',
        'status',
        'sks',
        'nilai',
        'bobot',
    ];
}
