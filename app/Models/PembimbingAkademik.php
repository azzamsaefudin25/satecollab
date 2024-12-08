<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembimbingAkademik extends Model
{
    use HasFactory;

    protected $table = 'pembimbingakademik';

    protected $primaryKey = 'nidn_pembimbingakademik'; // Primary key adalah NIDN Pembimbing Akademik

    public $incrementing = false;

    protected $keyType = 'string'; // Tipe primary key adalah string

    protected $fillable = [
        'nidn_pembimbingakademik',
        'nama_pembimbingakademik',
        'email',
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'nidn_pembimbingakademik', 'nidn_pembimbingakademik');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn_pembimbingakademik', 'nidn_dosen');
    }

}
