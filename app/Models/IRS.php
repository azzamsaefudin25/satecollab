<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IRS extends Model
{
    use HasFactory;

    protected $table = 'irs';
    
    public $incrementing = false;

    protected $fillable = ['nim','kode_ruang', 'kode_mk', 'nama_kelas','status','status_approve'];

      // Relasi dengan Mahasiswa
      public function mahasiswa()
      {
          return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
      }
  
      // Relasi dengan Ruang Perkuliahan
      public function ruangPerkuliahan()
      {
          return $this->belongsTo(RuangPerkuliahan::class, 'kode_ruang', 'kode_ruang');
      }
  
      // Relasi dengan Mata Kuliah
      public function mataKuliah()
      {
          return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
      }
  
      // Relasi dengan Kelas
      public function kelas()
      {
          return $this->belongsTo(Kelas::class, 'nama_kelas', 'nama_kelas');
      }
}
