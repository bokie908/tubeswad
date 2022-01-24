<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\User;
use App\Models\UserPerusahaan;
use Illuminate\Http\Request;

class UserPerusahaanController extends Controller
{

    /*
    |-----------------------------
    |		#req6 login 		
    |-----------------------------
    */
    //digunakan untuk menampilkan form login
    public function login()
    {
        return view("auth.login_perusahaan");
    }

    /*
    |-----------------------------
    |		#req6 register 		
    |-----------------------------
    */
    //digunakan untuk menampilkan form register
    public function register()
    {
        return view("auth.register_perusahaan");
    }

    public function profil()
    {
        return view("userperusahaan.profil", ["sessionNow" => UserPerusahaan::getCurrentUser(session("id"))]);
    }

    /*
    |-----------------------------
    |		#req18 		
    |-----------------------------
    */
    public function editProfile(Request $r)
    {
        // Ambil data user yang sekarang lagi login
        $up = UserPerusahaan::getCurrentUser(session("id"));

        if ($r->post("cpassword") != $up->password) {
            return redirect()->route("perusahaan.profil")->with("fail", "Konfirmasi password salah!");
        }

        if ($r->file("foto_profil")) {
            $file = $r->file("foto_profil");
            $file_path = rand(0, 999999) . "_" . $file->getClientOriginalName();
            move_uploaded_file($file->getPathname(), "img/profil/" . $file_path);
        } else {
            $file_path = $up->foto_profil;
        }

        $up->nama_pj = $r->post("nama_pj");
        $up->no_hp_pj = $r->post("no_hp_pj");
        $up->password = ($r->post("password") == null) ? $up->password : $r->post("password");
        $up->email_perusahaan = $r->post("email_perusahaan");
        $up->username = $r->post("username");
        $up->foto_profil = $file_path;
        $up->website = $r->post("website");
        $up->deskripsi = $r->post("deskripsi");
        $up->tujuan = $r->post("tujuan");
        $up->save();

        return redirect()->route("perusahaan.profil")->with("success", "Profil berhasil di update");
    }

    public function formTambahLoker()
    {
        return view("userperusahaan.tambah_loker", ["sessionNow" => UserPerusahaan::getCurrentUser(session("id"))]);
    }

    public function lihatPerusahaan($id)
    {
        $up = UserPerusahaan::where("id", $id)->get()[0];
        return view("user.lihat_perusahaan", ["up" => $up, "sessionNow" => User::getCurrentUser(session("id"))]);
    }

    /*
    |-----------------------------
    |		#req6 proses register 		
    |-----------------------------
    */
    //digunakan untuk menyimpan form register ke db
    public function processRegister(Request $r)
    {
        $check = UserPerusahaan::where("email_perusahaan", $r->post("email_perusahaan"))->get();
        if (count($check) > 0) {
            return redirect()->route("auth.perusahaan.register")->with("fail", "Email sudah dipakai");
        }

        // simpan foto ke img/ktp
        $file = $r->file("foto_akta");
        $file_path = rand(0, 999999) . $file->getClientOriginalName();
        move_uploaded_file($file->getPathname(), "img/akta_pendirian_usaha/" . $file_path);

        // buat user baru
        $userperusahaan = new UserPerusahaan;
        $userperusahaan->nama_pj = $r->post("nama_pj");
        $userperusahaan->no_hp_pj = $r->post("no_hp_pj");
        $userperusahaan->email_perusahaan = $r->post("email_perusahaan");
        $userperusahaan->no_perusahaan = $r->post("no_perusahaan");
        $userperusahaan->nama_perusahaan = $r->post("nama_perusahaan");
        $userperusahaan->username = $r->post("username");
        $userperusahaan->password = $r->post("password");
        $userperusahaan->kota = $r->post("kota");
        $userperusahaan->alamat = $r->post("alamat");
        $userperusahaan->foto_akta = $file_path;
        $userperusahaan->save();

        //pergi ke login
        return redirect()->route("auth.perusahaan.login")->with("success", "Berhasil membuat akun perusahaan, silahkan login");
    }

    /*
    |-----------------------------
    |		#req18		
    |-----------------------------
    */
    public function processLogin(Request $r)
    {
        $user = UserPerusahaan::where("username", $r->post("username"))->where("password", $r->post("password"))->get();

        if (count($user) > 0) {
            if ($user[0]->status_verifikasi == "belum") {
                return redirect()->route('auth.perusahaan.login')->with("fail", "Akun perusahaan belum diverifikasi silahkan tunggu hingga admin sudah memverifikasinya");
            }

            session([
                "id" => $user[0]->id,
                "role" => "userperusahaan",
            ]);

            return redirect()->route("home");
        }

        return redirect()->route('auth.perusahaan.login')->with("fail", "Gagal masuk salah username atau password");
    }

    /*
    |-----------------------------
    |		#req8 proses post menambah loker 		
    |-----------------------------
    */
    //digunakan untuk menyimpan loker ke db
    public function postLowonganPekerjaan(Request $r)
    {
        Loker::tambah($r);
        return redirect()->route("perusahaan.loker.tambah")->with("success", "Berhasil menambahkan lowongan kerja!");
    }
}
