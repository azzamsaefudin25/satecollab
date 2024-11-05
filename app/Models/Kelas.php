<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    
    protected $primaryKey = 'nama_kelas';

    public $incrementing = false;

    protected $keyType = 'string'; // Tipe primary key adalah string

    protected $fillable = [
        'nama_kelas',
        'kode_mk',
    ];

    // Relasi dengan Jadwal Kuliah
    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'nama_kelas', 'nama_kelas');
    }
}
