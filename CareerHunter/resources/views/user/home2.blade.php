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
    <div class="">
        <h3 class="fw-bold">Halo, {{$sessionNow->nama_lengkap}}!</h3>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="Cari perusahaan / job">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Kota">
            </div>
            <div class="col-2">
                <button class="btn btn-primary w-100">Cari</button>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div>
            <h2 class="fw-bold">Perusahaan</h2>
            <div class="row">
                @foreach ($perusahaan as $d)
                <div class="col d-flex justify-content-center">
                    <div class="card" style="width: 15rem;">
                        <img src="{{url("/img/profil/".$d->foto_profil)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{$d->nama_perusahaan}}</h5>
                            <p>
                            <a href="{{route("perusahaan.lihat",["id"=>$d->id])}}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div>
            <h2 class="fw-bold"><span class="text-primary">Job</span> Populer</h2>
            <div class="row">
                @foreach ($jobpopuler as $d)
                <div class="col d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        {{-- <img src="..." class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{$d->posisi}}</h5>
                            @isset($d->gaji_min)
                                <p class="card-text">Rp.{{$d->gaji_min}} - Rp.{{$d->gaji_max}}</p>
                            @endisset
                            <p class="card-text">Kota {{$d->kota}}</p>
                            <p class="card-text">{{$d->job_desc}}</p>
                            <a href="{{route("loker.lihat",["id"=>$d->id])}}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div>
            <h2 class="fw-bold"><span class="text-primary">Job</span> untukmu</h2>
            @foreach ($jobuntukmu as $d)
            <div class="col d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{$d->posisi}}</h5>
                        @isset($d->gaji_min)
                            <p class="card-text">Rp.{{$d->gaji_min}} - Rp.{{$d->gaji_max}}</p>
                        @endisset
                        <p class="card-text">Kota {{$d->kota}}</p>
                        <p class="card-text">{{$d->job_desc}}</p>
                        <a href="{{route("loker.lihat",["id"=>$d->id])}}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

