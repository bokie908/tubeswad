@extends("layout.body.body")

@section("title", "Loker")

@section("body")
<div class="bg-white bg-gradient px-5 vh-100" style="padding-top:9rem;">
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
    <div class="shadow-sm bg-white p-4" style="border-top: 4px solid var(--bs-warning);">
        <p class="fw-bold">Edit Profil</p>
        <form method="post" enctype="multipart/form-data" action="{{route("process.edit_profile")}}">
            @csrf
            <div class="mb-3">
                <label for="a" class="form-label">Nama Lengkap</label>
                <input value="{{$sessionNow->nama_lengkap}}" name="nama_lengkap" required type="text" required class="form-control" style="border-left: 4px solid var(--bs-warning);"
                    id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Email</label>
                <input value="{{$sessionNow->email}}" disabled type="email" required class="form-control" style="border-left: 4px solid var(--bs-warning);"
                    id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">No HP</label>
                <input value="{{$sessionNow->no_hp}}" name="no_hp" type="number" class="form-control" style="border-left: 4px solid var(--bs-warning);"
                    id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Ganti Password (lewati jika tidak ingin ganti password)</label>
                <input name="password" type="password" class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Tanggal Lahir</label>
                <input value="{{$sessionNow->tanggal_lahir}}" name="tanggal_lahir" required type="date" class="form-control">
            </div>
            <div class="mb-3">
                <p>Jenis Kelamin</p>
                <select name="kelamin" required class="form-select" aria-label="Default select example">
                    <option value="pria" {{($sessionNow->kelamin == "pria") ? "selected":""}}>Pria</option>
                    <option value="wanita" {{($sessionNow->kelamin == "wanita") ? "selected":""}}>Wanita</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Foto KTP</label>
                <input name="foto_ktp" class="form-control" type="file" id="formFile">
                <img src="{{url("/img/ktp/".$sessionNow->foto_ktp)}}" width="200px">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Tentang Saya</label>
                <textarea name="tentang" placeholder="Ceritakan tentangmu" class="form-control" id="a" rows="3">{{$sessionNow->tentang}}</textarea>
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Pengalaman Saya</label>
                <textarea name="experience" placeholder="Ceritakan Pengalamanmu" class="form-control" id="a" rows="3">{{$sessionNow->experience}}</textarea>
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Website</label>
                <input value="{{$sessionNow->website}}" name="website" type="text" required class="form-control" style="border-left: 4px solid var(--bs-warning);"
                    id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload CV/Resume ({{$sessionNow->cv}})</label>
                <input name="cv" class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Konfirmasi Password</label>
                <input name="cpassword" type="password" required class="form-control" style="border-left: 4px solid var(--bs-primary);" id="a" placeholder="">
            </div>
            <button class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection

