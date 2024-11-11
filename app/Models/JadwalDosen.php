<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDosen extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika berbeda dari penamaan model
    protected $table = 'jadwal_dosen';

    protected $primaryKey = 'id';
    public $incrementing = true;

    // Menentukan kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'id_jadwal',
        'nidn_dosen',
    ];

    // Relasi ke JadwalKuliah
    public function jadwalKuliah()
    {
        return $this->belongsTo(JadwalKuliah::class, 'id_jadwal');
    }

    // Relasi ke Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn_dosen');
    }
}
