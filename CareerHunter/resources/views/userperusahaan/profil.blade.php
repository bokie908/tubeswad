@extends("layout.body.body")

@section('title', 'Profil Perusahaan')

@section('body')
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
            <p class="fw-bold">Edit Perusahaan</p>
            <form method="post" enctype="multipart/form-data" action="{{route("process.perusahaan.edit_profile")}}">
                @csrf
                <div class="mb-3">
                    <label for="formFile" class="form-label">Foto Profil ({{$sessionNow->foto_profil ?? "Tidak ada foto"}})</label>
                    <input name="foto_profil" class="form-control" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="a" class="form-label">Nama Penanggung Jawab</label>
                    <input value="{{$sessionNow->nama_pj}}"name="nama_pj" required type="text" required class="form-control" style="border-left: 4px solid var(--bs-warning);"
                        id="a" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="a" class="form-label">No HP Penanggung Jaab</label>
                    <input value="{{$sessionNow->no_hp_pj}}" name="no_hp_pj" required type="number" required class="form-control" style="border-left: 4px solid var(--bs-warning);"
                        id="a" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="a" class="form-label">Email Perusahaan</label>
                    <input value="{{$sessionNow->email_perusahaan}}" name="email_perusahaan" required type="email" required class="form-control" style="border-left: 4px solid var(--bs-warning);"
                        id="a" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="a" class="form-label">Username</label>
                    <input value="{{$sessionNow->username}}" name="username" required type="text" required class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="a" class="form-label">Ganti Password (Abaikan jika tidak ingin ganti password)</label>
                    <input name="password" type="password" class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="a" class="form-label">Website</label>
                    <input value="{{$sessionNow->website}}" name="website" type="text" class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Perusahaan</label>
                    <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$sessionNow->deskripsi}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Tujuan Perusahaan</label>
                    <textarea name="tujuan" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$sessionNow->tujuan}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="a" class="form-label">Konfirmasi Password</label>
                    <input name="cpassword" required type="password" required class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
                </div>
                <button class="btn mb-5 btn-warning">Edit Perusahaan</button><br>
            </form>
        </div>
    </div>
@endsection
