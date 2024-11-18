<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    protected $table = 'jadwalkuliah';

    protected $primaryKey = 'id_jadwal';
    public $incrementing = true;

    protected $fillable = [
        'kode_mk',
        'kode_ruang',
        'nama_kelas',
        'semester',
        'sks',
        'jenis',
        'semester_aktif',
        'tahun_ajaran',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'terisi',
        'nidn_dosen1',
        'nidn_dosen2',
        'nidn_dosen3' ,
        'nidn_dosen4' ,
        'nidn_dosen5',
        'status',
    ];

    // Relasi dengan Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'nama_kelas', 'nama_kelas');
    }

    // Relasi dengan Mata Kuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
    }

    // Relasi dengan Ruang Perkuliahan
    public function pengalokasianRuang()
    {
        return $this->belongsTo(PengalokasianRuang::class, 'kode_ruang', 'kode_ruang');
    }


    public function dosen1()
    {
        return $this->belongsTo(DosenPengampu::class, 'nidn_dosen1', 'nidn_dosen');
    }

    public function dosen2()
    {
        return $this->belongsTo(DosenPengampu::class, 'nidn_dosen2', 'nidn_dosen');
    }

    public function dosen3()
    {
        return $this->belongsTo(DosenPengampu::class, 'nidn_dosen3', 'nidn_dosen');
    }

    public function dosen4()
    {
        return $this->belongsTo(DosenPengampu::class, 'nidn_dosen4', 'nidn_dosen');
    }

    public function dosen5()
    {
        return $this->belongsTo(DosenPengampu::class, 'nidn_dosen5', 'nidn_dosen');
    }
    
}
