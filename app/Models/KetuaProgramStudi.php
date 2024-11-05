<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ketuaprogramstudi extends Model
{
    use HasFactory;

    // Mengatur primary key (default di Laravel adalah 'id', jadi kita sesuaikan)
    protected $primaryKey = 'nidn_ketuaprogramstudi';
    public $incrementing = false; // Primary key tipe string, bukan integer yang auto-increment
    
    protected $keyType = 'string'; // Tipe data dari primary key adalah string

    // Tentukan tabel yang terkait dengan model ini (jika nama tabel berbeda dari plural model)
    protected $table = 'ketuaprogramstudi';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nidn_ketuaprogramstudi',
        'nama_ketuaprogramstudi',
        'email',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn_ketuaprogramstudi', 'nidn_dosen');
    }
}
