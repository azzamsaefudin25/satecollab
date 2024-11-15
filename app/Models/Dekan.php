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
        return $this->belongsTo(Dosen::class, 'nidn_dekan', 'nidn_dosen');
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