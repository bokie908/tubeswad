<?php
// #req6 model userperusahaan

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPerusahaan extends Model
{
    use HasFactory;

    public static function getCurrentUser($id)
    {
        return UserPerusahaan::where("id", $id)->get()[0] ?? null;
    }

    protected $table = "perusahaan_users";
    protected $fillable = [
        'nama_pj',
        'no_hp_pj',
        'foto_profil',
        'nama_perusahaan',
        'email_perusahaan',
        'no_perusahaan',
        'username',
        'password',
        'kota',
        'alamat',
        'foto_akta',
        'website',
        'deskripsi',
        'tujuan',
        'status_verifikasi',
    ];
}
