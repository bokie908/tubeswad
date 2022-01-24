<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\User;
use App\Models\RequestPosisi;
use App\Models\UserPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LokerController extends Controller
{
    /*
    |-----------------------------
    |		#req9 proses menampilkan loker 		
    |-----------------------------
    */
    public function lihatLoker($id)
    {
        if (session("id") == null) {
            return view("auth.login");
        }
        // $loker = DB::select("select * from lokers right join perusahaan_users on lokers.perusahaan_id = perusahaan_users.id where lokers.id = ?", [$id])[0];
        // $loker = DB::select("select * from lokers right join perusahaan_users on lokers.perusahaan_id = perusahaan_users.id where lokers.id = $id");
        $loker = DB::table('lokers')
            ->join('perusahaan_users', 'lokers.perusahaan_id', '=', 'perusahaan_users.id')
            ->select('perusahaan_users.*', 'lokers.*')
            ->where('lokers.id', $id)
            ->first();
        return view("user.lihat_loker", ["loker" => $loker, "sessionNow" => User::getCurrentUser(session("id"))]);
    }

    /*
    |-----------------------------
    |		#req9 proses menampilkan pelamar 		
    |-----------------------------
    */
    public function detailLoker($id)

    {

        // $requestPosisi = RequestPosisi::find($id);
        $requestPosisi = DB::table('request_posisi')
            ->join('users', 'request_posisi.user_id', '=', 'users.id')
            ->join('lokers', 'request_posisi.loker_id', '=', 'lokers.id')
            ->select('request_posisi.*', 'users.*', 'lokers.*', 'request_posisi.id as id_requestposisi', 'users.id as user_id', 'lokers.id as loker_id')
            ->where('loker_id', $id)
            ->get();

        return view('userperusahaan/detail_loker', ['requestPosisi' => $requestPosisi, "sessionNow" => User::getCurrentUser(session("id"))]);
    }

    /*
    |-----------------------------
    |		#req10 & req11 & req13 proses memberikan konfirmasi lolos bagi pelamar 		
    |-----------------------------
    */
    public function AccLoker($id)

    {

        $RequestPosisi = RequestPosisi::find($id);
        if ($RequestPosisi->status_request == "avail") {
            $RequestPosisi->status_request = "lolos tahap 1";
        } else if ($RequestPosisi->status_request == "lolos tahap 1") {
            $RequestPosisi->status_request = "lolos tahap 2";
        } else if ($RequestPosisi->status_request == "lolos tahap 2") {
            $RequestPosisi->status_request = "lolos tahap 3";
        } else if ($RequestPosisi->status_request == "lolos tahap 3") {
            $RequestPosisi->status_request = "lolos tahap 4";
        } else if ($RequestPosisi->status_request == "lolos tahap 4") {
            $RequestPosisi->status_request = "diterima";
        }
        $RequestPosisi->save();

        $loker = Loker::find($RequestPosisi->loker_id);
        return redirect()->route('home', ['up' => $loker, "sessionNow" => User::getCurrentUser(session("id"))]);
    }

    /*
    |-----------------------------
    |		#req10 proses memberikan konfirmasi tidak lolos bagi pelamar 		
    |-----------------------------
    */
    public function DccLoker($id)

    {

        $RequestPosisi = RequestPosisi::find($id);
        $RequestPosisi->status_request = "ditolak";
        $RequestPosisi->save();

        $loker = Loker::find($RequestPosisi->loker_id);

        return redirect()->route('home', ['up' => $loker, "sessionNow" => User::getCurrentUser(session("id"))]);
    }

    public function StopLoker($id)

    {

        $loker = Loker::find($id);
        $loker->status_loker = "not avail";

        $loker->save();

        return redirect()->route('home', ['up' => $loker, "sessionNow" => User::getCurrentUser(session("id"))]);
    }

    /*
    |-----------------------------
    |		#req12		
    |-----------------------------
    */

    public function NextLoker(Request $request)

    {

        $loker = Loker::find($request->post("id"));
        if ($loker->status_loker == "avail") {
            $loker->status_loker = "lolos tahap 1";
            $loker->info_tahap1 = $request->post("info");
            $loker->tanggal_tahap1 = $request->post("tanggal");
            $RequestPosisiDB = DB::table('request_posisi')->where('status_request', '<>', 'lolos tahap 1')->get();
            foreach ($RequestPosisiDB as $posisi) {
                $RequestPosisi = RequestPosisi::find($posisi->id);
                $RequestPosisi->status_request = "ditolak";
                $RequestPosisi->save();
            }
        } else if ($loker->status_loker == "lolos tahap 1") {
            $loker->status_loker = "lolos tahap 2";
            $loker->info_tahap2 = $request->post("info");
            $loker->tanggal_tahap2 = $request->post("tanggal");
            $RequestPosisiDB = DB::table('request_posisi')->where('status_request', '<>', 'lolos tahap 2')->get();
            foreach ($RequestPosisiDB as $posisi) {
                $RequestPosisi = RequestPosisi::find($posisi->id);
                $RequestPosisi->status_request = "ditolak";
                $RequestPosisi->save();
            }
        } else if ($loker->status_loker == "lolos tahap 2") {
            $loker->status_loker = "lolos tahap 3";
            $loker->info_tahap3 = $request->post("info");
            $loker->tanggal_tahap3 = $request->post("tanggal");
            $RequestPosisiDB = DB::table('request_posisi')->where('status_request', '<>', 'lolos tahap 3')->get();
            foreach ($RequestPosisiDB as $posisi) {
                $RequestPosisi = RequestPosisi::find($posisi->id);
                $RequestPosisi->status_request = "ditolak";
                $RequestPosisi->save();
            }
        } else if ($loker->status_loker == "lolos tahap 3") {
            //req14
            $loker->status_loker = "lolos tahap 4";
            $loker->info_tahap4 = $request->post("info");
            $loker->tanggal_tahap4 = $request->post("tanggal");
            $loker->wawancara = $request->post("wawancara");
            $RequestPosisiDB = DB::table('request_posisi')->where('status_request', '<>', 'lolos tahap 4')->get();
            foreach ($RequestPosisiDB as $posisi) {
                $RequestPosisi = RequestPosisi::find($posisi->id);
                $RequestPosisi->status_request = "ditolak";
                $RequestPosisi->save();
            }
        } else if ($loker->status_loker == "lolos tahap 4") {
            //req15
            $loker->status_loker = "diterima";
            $RequestPosisiDB = DB::table('request_posisi')->where('status_request', '<>', 'diterima')->get();
            foreach ($RequestPosisiDB as $posisi) {
                $RequestPosisi = RequestPosisi::find($posisi->id);
                $RequestPosisi->status_request = "ditolak";
                $RequestPosisi->save();
            }
        }
        $loker->save();
        return redirect()->route('home', ['up' => $loker, "sessionNow" => User::getCurrentUser(session("id"))]);
    }

    public function search(Request $request)
    {
        $posisi = $request->input('posisi');
        $kota = $request->input('kota');
        $jenis_pekerjaan = $request->input('jenis_pekerjaan');
        $usia = $request->input('usia');
        $pengalaman = $request->input('pengalaman');
        $gaji = $request->input('gaji');

        $loker = DB::table('lokers')
            ->join('perusahaan_users', 'lokers.perusahaan_id', '=', 'perusahaan_users.id')
            ->select('lokers.*', 'perusahaan_users.*')
            ->where('posisi', 'LIKE', "%{$posisi}%")
            ->where('kota', 'LIKE', "%{$kota}%")
            ->where('jenis_pekerjaan', 'LIKE', "%{$jenis_pekerjaan}%")
            ->where('usia_min', 'LIKE', "%{$usia}%")
            ->where('pengalaman_min', 'LIKE', "%{$pengalaman}%")
            ->get();

        $perusahaan = UserPerusahaan::inRandomOrder()->limit(5)->get();
        $jobpopuler =  DB::select(
            "select lokers.*,perusahaan_users.nama_perusahaan,perusahaan_users.kota,perusahaan_users.foto_profil from lokers left join perusahaan_users on lokers.perusahaan_id = perusahaan_users.id;",
            []
        );

        return view("user.loker", ["perusahaan" => $perusahaan, "jobpopuler" => $loker, "sessionNow" => User::getCurrentUser(session("id"))]);
    }
}
