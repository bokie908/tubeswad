<!-- #req7 melakukan veriv perusahaan -->
@extends("layout.body.body")

@section("title", "Verifikasi User Perusahaan")

@section("body")
<div class="bg-white bg-gradient px-5 vh-100" style="padding-top:8rem;">
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
    <p>Verifikasi User Perusahaan</p>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Perusahaan</th>
                <th>Foto Akta</th>
                <th>Nama Penanggung Jawab</th>
                <th>No HP Penanggung Jawab</th>
                <th>No Perusahaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($up as $d)
            <tr>
                <td>{{$d->nama_perusahaan}}</td>
                <td><img onclick="window.open('{{url('/img/akta_pendirian_usaha/'.$d->foto_akta)}}')" src="{{url("/img/akta_pendirian_usaha/".$d->foto_akta)}}" width="100px"></td>
                <td>{{$d->nama_pj}}</td>
                <td>{{$d->no_hp_pj}}</td>
                <td>{{$d->no_perusahaan}}</td>
                <td>
                    <a href="{{route("admin.terima.perusahaan",["id"=>$d->id])}}" class="btn btn-success">Terima</a>
                    <a href="{{route("admin.tolak.perusahaan",["id"=>$d->id])}}" class="btn btn-danger">Tolak</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection