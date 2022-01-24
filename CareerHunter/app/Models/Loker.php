<?php
// #req8 model loker

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Loker extends Model
{
    use HasFactory;
    public static function tambah(Request $r)
    {
        $loker = new Loker;
        $loker->perusahaan_id = session("id");
        $loker->posisi = $r->post("posisi");
        $loker->job_desc = $r->post("job_desc");
        $loker->persyaratan = $r->post("persyaratan");
        $loker->jenis_pekerjaan = $r->post("jenis_pekerjaan");
        $loker->usia_min = $r->post("usia_min");
        $loker->usia_max = $r->post("usia_max");
        $loker->gaji_min = $r->post("gaji_min");
        $loker->gaji_max = $r->post("gaji_max");
        $loker->kualifikasi = $r->post("kualifikasi");
        $loker->pengalaman_min = $r->post("pengalaman_min");
        $loker->status_loker = "avail";
        $loker->save();
    }
    protected $fillable = [
        "id",
        "perusahaan_id",
        "posisi",
        "job_desc",
        "persyaratan",
        "jenis_pekerjaan",
        "usia_min",
        "usia_max",
        "kualifikasi",
        "pengalaman_min",
        "status_loker",
    ];
}
