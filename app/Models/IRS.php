<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IRS extends Model
{
    use HasFactory;

    protected $table = 'irs';
    
    protected $primaryKey = 'id_irs';
    public $incrementing = true;

    protected $fillable = [
        'id_jadwal',
        'nim',
        'kode_mk',
        'nama_kelas',
        'sks',
        'kode_ruang',
        'status',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'tahun_ajaran',
        'nidn_pembimbingakademik',
        'priority',
        'status_approve',
    ];

      // Relasi dengan Mahasiswa
      public function mahasiswa()
      {
          return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
      }
      public function jadwalKuliah()
      {
          return $this->belongsTo(JadwalKuliah::class, 'id_jadwal', 'id_jadwal');
      }
}
