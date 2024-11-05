<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dekan extends Model
{
    use HasFactory;

    protected $table = 'dekan';
    protected $primaryKey = 'nidn_dekan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nidn_dekan',
        'nama_dekan',
        'email',
    ];
   /**
    * Relasi belongs-to dengan Fakultas.
    */

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn_dekan', 'nidn');
    }
}