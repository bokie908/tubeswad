@extends("layout.body.body")

@section("title", "Home")

@section("body")
<div class="bg-white bg-gradient px-5 mb-5 vh-100" style="padding-top:7rem;">
    @if(session("success"))
    <div class="alert alert-success" role="alert">
        {{session("success")}}
    </div>
    @endif
    @if(session("fail"))
    <div class="alert alert-danger" role="alert">
        {{session("fail")}}
    </div>
    @endif

    <div class="mx-5 p-5 bg-light shadow bg-gradient" style="border-top: 10px solid var(--bs-primary);">
        <h1 class="mb-3">{{$loker->nama_perusahaan}}</h1>
        <p>Jenis Pekerjaan : {{ucwords($loker->jenis_pekerjaan)}}</p>
        <p>Jarak Usia : {{$loker->usia_min}} - {{$loker->usia_max}}</p>
        @if ($loker->gaji_min)
        <p>Rentang Gaji : Rp.{{$loker->gaji_min}} - Rp.{{$loker->gaji_max}}</p>
        @endif
        <p>Posisi Pekerjaan : {{$loker->posisi}}</p>
        <p>Deskripsi Pekerjaan :</p>
        <div class="mb-3" style="white-space: pre-wrap">{{$loker->job_desc}}</div>
        <p>Kualifikasi :</p>
        <div class="mb-3" style="white-space: pre-wrap">{{$loker->kualifikasi}}</div>
        @php
        $idp = DB::select("select * from perusahaan_users where nama_perusahaan = ?",[$loker->nama_perusahaan])[0];
        @endphp
        <a href="{{route("perusahaan.lihat",["id"=>$idp->id])}}" class="btn btn-primary">Lihat Detail Perusahaan</a>
        <a href="{{route("ajukanposisi",["user_id"=>session("id"),"loker_id"=>$loker->id,"status_request"=>"avail"])}}" class="btn btn-primary">Ajukan Posisi</a>
    </div>
</div>
@endsection