<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPengampu extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika berbeda dari penamaan model
    protected $table = 'dosenpengampu';

    protected $primaryKey = 'id';
    public $incrementing = true;

    // Menentukan kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'kode_mk',
        'nidn_dosen',
    ];

    // Relasi ke JadwalKuliah
    public function mataKuliah()
    {
        return $this->belongsTo(JadwalKuliah::class, 'kode_mk');
    }

    // Relasi ke Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn_dosen');
    }
}
