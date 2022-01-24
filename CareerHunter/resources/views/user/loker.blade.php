@extends("layout.body.body")

@section('title', 'Lowongan Pekerjaan')

@section('body')
<div class="bg-white bg-gradient px-5 vh-100 mb-5" style="padding-top:7rem;">
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    @if (session('fail'))
    <div class="alert alert-danger" role="alert">
        {{ session('fail') }}
    </div>
    @endif

    <form class="form" method="get" action="{{ route('search') }}">
        <div class="form-group col-md-10 mb-3">
            <div class="row">
                <input type="text" name="posisi" class="form-control col-md-5" id="posisi" placeholder="Cari Posisi">
                <input type="text" name="kota" class="form-control col-md-5" id="kota" placeholder="Kota">
                <button type="submit" class="btn btn-primary mb-1 col-md-2">Search</button>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-3">
                <div class="p-3 rounded shadow" style="border-top: 10px solid var(--bs-primary);">
                    <p class="fw-bold">Filter Pencarian</p>
                    <div class="row">
                        <div class="col-2" style="min-width:200px;">
                            <p>Tipe Pekerjaan</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="semua" name="jenis_pekerjaan" id="flexRadioDefault1" {{($_GET["jenis_pekerjaan"] ?? "") == "semua" ? "checked":"" }}>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Semua
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="fulltime" name="jenis_pekerjaan" id="flexRadioDefault2" {{(($_GET["jenis_pekerjaan"] ?? "") == "fulltime") ? "checked":"" }}>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Full-Time
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="parttime" name="jenis_pekerjaan" id="flexRadioDefault3" {{(($_GET["jenis_pekerjaan"] ?? "") == "parttime") ? "checked":"" }}>
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Part-Time
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="internship" name="jenis_pekerjaan" id="flexRadioDefault4" {{(($_GET["jenis_pekerjaan"] ?? "") == "internship") ? "checked":"" }}>
                                <label class="form-check-label" for="flexRadioDefault4">
                                    Internship
                                </label>
                            </div>
                        </div>

                        <div class="col" style="min-width:200px;">
                            <label>Umur</label>
                            <div class="d-flex">
                                <select required name="usia" class="form-control mt-2 mb-2">
                                    @for ($i = 18; $i < 60; $i++) <option value="{{ $i }}" {{(intval($_GET["usia"] ?? "") == $i) ? "selected":""}}>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col" style="min-width:200px;">
                            <label>Pengalaman Minimal</label>
                            <div class="d-flex">
                                <input name="pengalaman" type="number" class="form-control mt-2 mb-2" value="{{$_GET["pengalaman"]??""}}" id="exampleFormControlInput1">
                            </div>
                        </div>

                        <div class="col" style="min-width:200px;">
                            <label>Gaji</label>
                            <div class="d-flex">
                                <input name="gaji" type="number" class="form-control mt-2 mb-2" value="{{$_GET["gaji"]??""}}" id="exampleFormControlInput1">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-8">
                @if (($_GET["gaji"] ?? null) != null)
                @foreach ($loker as $d)
                <div class="col mt-4 d-flex justify-content-left">
                    <div class="card shadow" style="width: 28rem;">
                        <div class="row">
                            <div class="col">
                                <img src="{{url("/img/profil/".$d->foto_profil)}}" class="card-img-top p-3 rounded h-100" alt="...">
                            </div>
                            <div class="col p-3">
                                <p>{{$d->nama_perusahaan}}</p>
                                <p class="card-title fw-bold">{{$d->posisi}}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <p class="card-text mb-0">{{ucwords($d->jenis_pekerjaan)}}</p>
                                    @isset($d->gaji_min)
                                    <p class="card-text mb-0">Rp.{{$d->gaji_min}} - Rp.{{$d->gaji_max}}</p>
                                    @endisset
                                    <p class="card-text mb-0">Kota {{$d->kota}}</p>
                                </div>
                                <div class="col">

                                    <a href="{{route("loker.lihat",["id"=>$d->id])}}" class="btn btn-primary float-end">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div>
                    <h2 class="fw-bold">Perusahaan</h2>
                    <div class="row">
                        @foreach ($perusahaan as $d)
                        <div class="col d-flex justify-content-left">
                            <div class="card" style="width: 15rem;">
                                <a href="{{route("perusahaan.lihat",["id"=>$d->id])}}"><img src="{{url("/img/profil/".$d->foto_profil)}}" class="card-img-top p-3" alt="..."></a>
                                <div class="card-body">
                                    <p class="card-title text-center">{{$d->nama_perusahaan}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-5">
                    <h2 class="fw-bold"><span class="text-primary">Job</span></h2>
                    <div class="row">
                        @foreach ($jobpopuler as $d)
                        <div class="col-sm-6 mt-4 d-flex justify-content-left">
                            <div class="card shadow" style="width: 28rem;">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{url("/img/profil/".$d->foto_profil)}}" class="card-img-top p-3 rounded h-100" alt="...">
                                    </div>
                                    <div class="col p-3">
                                        <p>{{$d->nama_perusahaan}}</p>
                                        <p class="card-title fw-bold">{{$d->posisi}}</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <p class="card-text mb-0">{{ucwords($d->jenis_pekerjaan)}}</p>
                                            @isset($d->gaji_min)
                                            <p class="card-text mb-0">Rp.{{$d->gaji_min}} - Rp.{{$d->gaji_max}}</p>
                                            @endisset
                                            <p class="card-text mb-0">Kota {{$d->kota}}</p>
                                        </div>
                                        <div class="col">

                                            <a href="{{route("loker.lihat",["id"=>$d->id])}}" class="btn btn-primary float-end">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                @endif
            </div>
        </div>
    </form>

    <form method="get">
        <!-- <div class="row">
            <div class="col">
                <div class="col" style="min-width:200px;">
                    <input value="{{$_GET["posisi"] ?? ""}}" name="posisi" type="text" placeholder="Cari Posisi" class="form-control" id="ss">
                </div>

            </div>
            <div class="col">
                <div class="col" style="min-width:200px;">
                    <input value="{{$_GET["kota"] ?? ""}}" name="kota" type="text" placeholder="Kota" class="form-control" id="ss">
                </div>
            </div>
            <div class="col-2">
                <button class="btn btn-primary w-100">Cari</button>
            </div>
        </div> -->

        <!-- <div class="row mt-3">
            <div class="col-3">
                <div class="p-3 rounded shadow" style="border-top: 10px solid var(--bs-primary);">
                    <p class="fw-bold">Filter Pencarian</p>
                    <div class="row">
                        <div class="col-2" style="min-width:200px;">
                            <p>Tipe Pekerjaan</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="semua" name="jenis_pekerjaan" id="flexRadioDefault1" {{($_GET["jenis_pekerjaan"] ?? "") == "semua" ? "checked":"" }}>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Semua
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="fulltime" name="jenis_pekerjaan" id="flexRadioDefault2" {{(($_GET["jenis_pekerjaan"] ?? "") == "fulltime") ? "checked":"" }}>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Full-Time
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="parttime" name="jenis_pekerjaan" id="flexRadioDefault3" {{(($_GET["jenis_pekerjaan"] ?? "") == "parttime") ? "checked":"" }}>
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Part-Time
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="internship" name="jenis_pekerjaan" id="flexRadioDefault4" {{(($_GET["jenis_pekerjaan"] ?? "") == "internship") ? "checked":"" }}>
                                <label class="form-check-label" for="flexRadioDefault4">
                                    Internship
                                </label>
                            </div>
                        </div>

                        <div class="col" style="min-width:200px;">
                            <label>Umur</label>
                            <div class="d-flex">
                                <select required name="usia" class="form-control mt-2 mb-2">
                                    @for ($i = 18; $i < 60; $i++) <option value="{{ $i }}" {{(intval($_GET["usia"] ?? "") == $i) ? "selected":""}}>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col" style="min-width:200px;">
                            <label>Pengalaman Minimal</label>
                            <div class="d-flex">
                                <input name="pengalaman" type="number" class="form-control mt-2 mb-2" value="{{$_GET["pengalaman"]??""}}" id="exampleFormControlInput1">
                            </div>
                        </div>

                        <div class="col" style="min-width:200px;">
                            <label>Gaji</label>
                            <div class="d-flex">
                                <input name="gaji" type="number" class="form-control mt-2 mb-2" value="{{$_GET["gaji"]??""}}" id="exampleFormControlInput1">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-8">
                @if (($_GET["gaji"] ?? null) != null)
                @foreach ($loker as $d)
                <div class="col mt-4 d-flex justify-content-left">
                    <div class="card shadow" style="width: 28rem;">
                        <div class="row">
                            <div class="col">
                                <img src="{{url("/img/profil/".$d->foto_profil)}}" class="card-img-top p-3 rounded h-100" alt="...">
                            </div>
                            <div class="col p-3">
                                <p>{{$d->nama_perusahaan}}</p>
                                <p class="card-title fw-bold">{{$d->posisi}}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <p class="card-text mb-0">{{ucwords($d->jenis_pekerjaan)}}</p>
                                    @isset($d->gaji_min)
                                    <p class="card-text mb-0">Rp.{{$d->gaji_min}} - Rp.{{$d->gaji_max}}</p>
                                    @endisset
                                    <p class="card-text mb-0">Kota {{$d->kota}}</p>
                                </div>
                                <div class="col">

                                    <a href="{{route("loker.lihat",["id"=>$d->id])}}" class="btn btn-primary float-end">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div>
                    <h2 class="fw-bold">Perusahaan</h2>
                    <div class="row">
                        @foreach ($perusahaan as $d)
                        <div class="col d-flex justify-content-left">
                            <div class="card" style="width: 15rem;">
                                <a href="{{route("perusahaan.lihat",["id"=>$d->id])}}"><img src="{{url("/img/profil/".$d->foto_profil)}}" class="card-img-top p-3" alt="..."></a>
                                <div class="card-body">
                                    <p class="card-title text-center">{{$d->nama_perusahaan}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-5">
                    <h2 class="fw-bold"><span class="text-primary">Job</span> Populer</h2>
                    <div class="row">
                        @foreach ($jobpopuler as $d)
                        <div class="col mt-4 d-flex justify-content-left">
                            <div class="card shadow" style="width: 28rem;">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{url("/img/profil/".$d->foto_profil)}}" class="card-img-top p-3 rounded h-100" alt="...">
                                    </div>
                                    <div class="col p-3">
                                        <p>{{$d->nama_perusahaan}}</p>
                                        <p class="card-title fw-bold">{{$d->posisi}}</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <p class="card-text mb-0">{{ucwords($d->jenis_pekerjaan)}}</p>
                                            @isset($d->gaji_min)
                                            <p class="card-text mb-0">Rp.{{$d->gaji_min}} - Rp.{{$d->gaji_max}}</p>
                                            @endisset
                                            <p class="card-text mb-0">Kota {{$d->kota}}</p>
                                        </div>
                                        <div class="col">

                                            <a href="{{route("loker.lihat",["id"=>$d->id])}}" class="btn btn-primary float-end">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                @endif
            </div>
        </div> -->
    </form>




</div>
@endsection