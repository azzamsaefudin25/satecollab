<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    // Tabel yang digunakan oleh model ini
    protected $table = 'matakuliah';

    // Primary key untuk tabel matakuliah
    protected $primaryKey = 'kode_mk';

    public $incrementing = false;

    protected $keyType = 'string';
    // Atribut yang bisa diisi (fillable)
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'semester',
        'sks',
        'semester_aktif',
        'jenis',
    ];

    // Relasi dengan Jadwal Kuliah
    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'kode_mk', 'kode_mk');
    }

}
