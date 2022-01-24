<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\RequestPosisi;
use App\Models\User;
use App\Models\UserPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /*
    |-----------------------------
    |		#req18		
    |-----------------------------
    */
    public function login()
    {
        return view("auth.login");
    }

    public function register()
    {
        return view("auth.register");
    }

    public function home2()
    {
        $perusahaan = UserPerusahaan::inRandomOrder()->limit(5)->get();
        $jobpopuler = Loker::inRandomOrder()->limit(5)->get();
        $jobuntukmu = Loker::inRandomOrder()->limit(5)->get();
        return view("user.home2", ["perusahaan" => $perusahaan, "jobpopuler" => $jobpopuler, "jobuntukmu" => $jobuntukmu, "sessionNow" => User::getCurrentUser(session("id"))]);
    }

    public function loker(Request $r)
    {
        $jenis_pekerjaan = ($r->get("jenis_pekerjaan") == "semua") ? null : $r->get("jenis_pekerjaan");

        $loker = DB::select(
            "select lokers.*,perusahaan_users.nama_perusahaan,perusahaan_users.kota,perusahaan_users.foto_profil from lokers left join perusahaan_users on lokers.perusahaan_id = perusahaan_users.id;",
            []
        );

        if ($r->get("usia")) {
            $loker = DB::select(
                "SELECT lokers.*,perusahaan_users.nama_perusahaan,perusahaan_users.kota,perusahaan_users.foto_profil from lokers right join perusahaan_users on lokers.perusahaan_id = perusahaan_users.id where lokers.jenis_pekerjaan = ? and lokers.posisi like ? and ? >= lokers.pengalaman_min and ? >= lokers.usia_min and ? <= lokers.usia_max and ? >= lokers.gaji_min and ? <= lokers.gaji_max and perusahaan_users.kota like ?",
                [$jenis_pekerjaan, "%" . $r->get("posisi") . "%", $r->get("pengalaman"), $r->get("usia"), $r->get("usia"), $r->get("gaji"), $r->get("gaji"), "%" . $r->get("kota") . "%"]
            );
        }

        if ($jenis_pekerjaan == null) {
            $loker = DB::select(
                "SELECT lokers.*,perusahaan_users.nama_perusahaan,perusahaan_users.kota,perusahaan_users.foto_profil from lokers right join perusahaan_users on lokers.perusahaan_id = perusahaan_users.id where lokers.posisi like ? and ? >= lokers.pengalaman_min and ? >= lokers.usia_min and ? <= lokers.usia_max and ? >= lokers.gaji_min and ? <= lokers.gaji_max and perusahaan_users.kota like ?",
                ["%" . $r->get("posisi") . "%", $r->get("pengalaman"), $r->get("usia"), $r->get("usia"), $r->get("gaji"), $r->get("gaji"), "%" . $r->get("kota") . "%"]
            );
        }

        $perusahaan = UserPerusahaan::inRandomOrder()->limit(5)->get();
        $jobpopuler =  DB::select(
            "select lokers.*,perusahaan_users.nama_perusahaan,perusahaan_users.kota,perusahaan_users.foto_profil from lokers left join perusahaan_users on lokers.perusahaan_id = perusahaan_users.id;",
            []
        );
        $jobuntukmu = Loker::inRandomOrder()->limit(5)->get();

        return view("user.loker", ["perusahaan" => $perusahaan, "jobpopuler" => $jobpopuler, "jobuntukmu" => $jobuntukmu, "loker" => $loker, "sessionNow" => User::getCurrentUser(session("id"))]);
    }

    public function profile()
    {
        return view("user.profile", ["sessionNow" => User::getCurrentUser(session("id"))]);
    }

    /*
    |-----------------------------
    |		#req18	
    |-----------------------------
    */
    public function editProfile(Request $r)
    {
        // Ambil data user yang sekarang lagi login
        $user = User::getCurrentUser(session("id"));

        if ($r->post("cpassword") != $user->password) {
            return redirect()->route("user.profil")->with("fail", "Konfirmasi password salah!");
        }

        if ($r->file("foto_ktp")) {
            $file = $r->file("foto_ktp");
            $file_path = rand(0, 999999) . "_" . $file->getClientOriginalName();
            move_uploaded_file($file->getPathname(), "img/ktp/" . $file_path);
        } else {
            $file_path = $user->foto_ktp;
        }

        if ($r->file("cv")) {
            $file = $r->file("cv");
            $file_path_cv = rand(0, 999999) . "_" . $file->getClientOriginalName();
            move_uploaded_file($file->getPathname(), "img/cv/" . $file_path_cv);
        } else {
            $file_path_cv = $user->cv;
        }

        $user->nama_lengkap = $r->post("nama_lengkap");
        $user->no_hp = $r->post("no_hp");
        $user->password = ($r->post("password") == null) ? $user->password : $r->post("password");
        $user->tanggal_lahir = $r->post("tanggal_lahir");
        $user->kelamin = $r->post("kelamin");
        $user->foto_ktp = $file_path;
        $user->tentang = ($r->post("tentang") == null) ? $user->tentang : $r->post("tentang");
        $user->website = ($r->post("website") == null) ? $user->website : $r->post("website");
        $user->experience = ($r->post("experience") == null) ? $user->tentang : $r->post("experience");
        $user->cv = $file_path_cv;
        $user->save();

        return redirect()->route("user.profil")->with("success", "Profil berhasil di update");
    }

    public function processRegister(Request $r)
    {
        $check = User::where("email", $r->post("email"))->get();
        if (count($check) > 0) {
            return redirect()->route("auth.register")->with("fail", "Email sudah dipakai");
        }

        // simpan foto ke img/ktp
        $file = $r->file("foto_ktp");
        $file_path = rand(0, 999999) . $file->getClientOriginalName();
        move_uploaded_file($file->getPathname(), "img/ktp/" . $file_path);

        // buat user baru
        $user = new User;
        $user->nama_lengkap = $r->post("nama_lengkap");
        $user->email = $r->post("email");
        $user->no_hp = $r->post("no_hp");
        $user->password = $r->post("password");
        $user->tanggal_lahir = $r->post("tanggal_lahir");
        $user->kelamin = $r->post("kelamin");
        $user->foto_ktp = $file_path;
        $user->save();

        //pergi ke login
        return redirect()->route("auth.login")->with("success", "Berhasil membuat akun, silahkan login");
    }

    public function ajukanPosisi($user_id, $loker_id, $status_request)
    {
        $check = RequestPosisi::where("user_id", $user_id)->where("loker_id", $loker_id)->get();
        if (count($check)) {
            return redirect()->route("loker.lihat", ["id" => $loker_id])->with("fail", "Kamu sudah merequest ini sebelumnya, silahkan tunggu");
        }

        DB::insert("INSERT INTO request_posisi (user_id,loker_id,status_request) VALUES (?,?,?)", [$user_id, $loker_id, $status_request]);

        return redirect()->route("loker")->with("success", "Request dikirim silahkan tunggu");
    }

    /*
    |-----------------------------
    |		#req18		
    |-----------------------------
    */
    public function processLogin(Request $r)
    {
        $user = User::where("email", $r->post("email"))->where("password", $r->post("password"))->get();

        if (count($user) > 0) {
            session([
                "id" => $user[0]->id,
                "role" => "user",
            ]);

            return redirect()->route("home");
        }

        return redirect()->route('auth.login')->with("success", "Gagal masuk");
    }

    /*
    |-----------------------------
    |		#req18		
    |-----------------------------
    */
    public function logout(Request $r)
    {
        $r->session()->flush();
        return redirect()->route("home");
    }

    public function listPengajuan()
    {
        // $pengajuan = RequestPosisi::where("user_id", session("id"))->get();
        $pengajuan = DB::table('request_posisi')
            ->join('users', 'request_posisi.user_id', '=', 'users.id')
            ->join('lokers', 'request_posisi.loker_id', '=', 'lokers.id')
            ->select('request_posisi.*', 'users.*', 'lokers.*')
            ->where('users.id', session("id"))
            ->get();
        // var_dump($pengajuan);
        // die();
        return view("user/list_pengajuan", ["pengajuan" => $pengajuan, "sessionNow" => User::getCurrentUser(session("id"))]);
    }
}
