@extends("layout.body.body")

@section("title", "Home")

@section("body")
<div class="bg-white bg-gradient px-5 mb-5 vh-100" style="padding-top:9rem;">
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
    
    <div class="mx-5 bg-gradient">
        <div class="row">
            <div class="p-5 col bg-white shadow" style="border-top: 10px solid var(--bs-primary);">
                <img src="{{url("/img/profil/".$up->foto_profil)}}" width="200px" class="rounded shadow mb-3">
                <h1 class="mb-3">{{$up->nama_perusahaan}}</h1>
                @if ($up->website)
                <p><span style="color: gray; margin-right: 1rem;">Website</span> <a href="{{$up->website}}">{{$up->website}}</a></p>
                @else
                
                <p><span style="color: gray; margin-right: 1rem;">Website</span> Tidak ada</p>
                @endif
                <p><span style="color: gray; margin-right: 1rem;">Lokasi</span> {{$up->kota}}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col me-3 p-5 bg-white shadow">
                <h2 class="fw-bold">Detail Perusahaan</h2>
                <p class="fw-bold">Deskripsi</p>
                <hr>
                <div class="mb-5" style="white-space: pre-wrap">{{$up->deskripsi}}</div>
                <p class="fw-bold">Tujuan</p>
                <hr>
                <div class="mb-5" style="white-space: pre-wrap">{{$up->tujuan}}</div>
                <p class="fw-bold">Alamat</p>
                <hr>
                <p>{{$up->kota}}, {{$up->alamat}}</p>
            </div>
            <div class="col-3 p-5 bg-white shadow">
                <h2 class="fw-bold">Galeri</h2>
            </div>
        </div>
    </div>
</div>
@endsection

