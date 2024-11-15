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
        'hari',
        'jam_mulai',
        'jam_selesai',
        'jenis',
        'semester',
        'sks',
        'semester_aktif',
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

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'jadwal_dosen', 'id_jadwal', 'nidn_dosen');
    }

    public function dosen1()
    {
        return $this->belongsTo(Dosen::class, 'nidn_dosen1', 'nidn_dosen');
    }

    public function dosen2()
    {
        return $this->belongsTo(Dosen::class, 'nidn_dosen2', 'nidn_dosen');
    }

    public function dosen3()
    {
        return $this->belongsTo(Dosen::class, 'nidn_dosen3', 'nidn_dosen');
    }

    public function dosen4()
    {
        return $this->belongsTo(Dosen::class, 'nidn_dosen4', 'nidn_dosen');
    }

    public function dosen5()
    {
        return $this->belongsTo(Dosen::class, 'nidn_dosen5', 'nidn_dosen');
    }
    
}
