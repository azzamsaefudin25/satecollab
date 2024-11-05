<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    // Mengatur nama tabel secara eksplisit (jika nama tabel tidak sesuai konvensi plural Laravel)
    protected $table = 'fakultas';

    // Tentukan primary key (default Laravel adalah 'id', jadi kita ubah sesuai dengan 'id_fakultas')
    protected $primaryKey = 'id_fakultas';

    // Tentukan tipe dari primary key (karena id_fakultas adalah bigInteger, secara default sudah integer)
    public $incrementing = true; // Menggunakan auto-increment (default adalah true, jadi bisa diabaikan)

    protected $keyType = 'int'; // Primary key adalah tipe integer

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_fakultas',
    ];


    // Relasi dengan ProgramStudi (jika ada)
    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'id_fakultas', 'id_fakultas');
    }

    public function bagianAkademik()
    {
        return $this->hasOne(BagianAkademik::class, 'id_fakultas', 'id_fakultas');
    }

}

