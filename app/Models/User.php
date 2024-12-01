<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'tb_user';
    protected $primaryKey = 'email';
    // // Non-incrementing karena email adalah string
    public $incrementing = false;

    // // Tipe primary key adalah string
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];

 /**
     * Relasi dengan mahasiswa.
     * Satu user bisa menjadi satu mahasiswa.
     */
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'email', 'email');
    }

    /**
     * Relasi dengan bagian akademik.
     * Satu user bisa menjadi satu bagian akademik.
     */
    public function bagianAkademik()
    {
        return $this->hasOne(BagianAkademik::class, 'email', 'email');
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'email', 'email');
    }

    // public function cekdosen()
    // {
    //     return $this->hasOne(Dosen::class, 'user_id', 'id');
    // }

    // public function dekan()
    // {
    //     return $this->hasOne(Dekan::class, 'email', 'email');
    // }

    public function ketuaProgramStudi()
    {
        return $this->hasOne(KetuaProgramStudi::class, 'email', 'email');
    }
    // public function pembimbingAkademik()
    // {
    //     return $this->hasOne(PembimbingAkademik::class, 'email', 'email');
    // }

    public function programStudi()
{
    return $this->belongsTo(ProgramStudi::class, 'id_programstudi', 'id');
}

}
