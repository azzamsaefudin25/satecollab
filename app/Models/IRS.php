<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IRS extends Model
{
    use HasFactory;

    protected $table = 'irs';
    
    public $incrementing = false;

    protected $fillable = [
        'nim',
        'kode_mk',
        'nama_kelas',
        'sks',
        'kode_ruang',
        'status',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'nidn_dosen',
        'nidn_pembimbingakademik',
        'status_approve',
    ];

      // Relasi dengan Mahasiswa
      public function mahasiswa()
      {
          return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
      }

 
}
