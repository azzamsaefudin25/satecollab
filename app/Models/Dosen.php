<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // Mengatur primary key (default di Laravel adalah 'id', jadi kita sesuaikan)
    protected $primaryKey = 'nidn';
    public $incrementing = false; // Primary key tipe string, bukan integer yang auto-increment
    
    protected $keyType = 'string'; // Tipe data dari primary key adalah string

    // Tentukan tabel yang terkait dengan model ini (jika nama tabel berbeda dari plural model)
    protected $table = 'dosen';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nidn',
        'nama_dosen',
        'email',
        'id_programstudi',
    ];

    // Relasi dengan model User (email adalah foreign key)
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    // Relasi dengan model ProgramStudi (id_programstudi adalah foreign key)
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_programstudi', 'id_programstudi');
    }

    public function dekan()
    {
        return $this->hasOne(Dekan::class, 'nidn_dekan', 'nidn');
    }

    /**
     * Relasi dengan ketua program studi.
     * Satu user bisa menjadi satu ketua program studi.
     */
    public function ketuaProgramStudi()
    {
        return $this->hasOne(KetuaProgramStudi::class, 'nidn_ketuaprogramstudi', 'nidn');
    }

    /**
     * Relasi dengan pembimbing akademik.
     * Satu user bisa menjadi satu pembimbing akademik.
     */
    public function pembimbingAkademik()
    {
        return $this->hasOne(PembimbingAkademik::class, 'nidn_pembimbingakademik', 'nidn');
    }

}
