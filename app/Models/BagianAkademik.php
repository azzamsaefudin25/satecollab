<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagianAkademik extends Model
{
    use HasFactory;

    protected $table = 'bagianakademik';

    protected $primaryKey = 'nidn_bagianakademik'; // Primary key adalah NIDN Bagian Akademik

    public $incrementing = false;

    protected $keyType = 'string'; // Tipe primary key adalah string

    protected $fillable = [
        'nip', 
        'nama_bagianakademik', 
        'email', 
        'id_fakultas'
    ];

    /**
     * Relasi belongs-to dengan User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    /**
     * Relasi belongs-to dengan Fakultas.
     */
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas', 'id_fakultas');
    }

}