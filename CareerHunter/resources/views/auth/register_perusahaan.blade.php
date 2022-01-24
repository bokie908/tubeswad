<!-- #req6 halaman register -->
@extends("layout.body.body")

@section('title', 'Register')

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
        <form method="post" enctype="multipart/form-data" action="{{route("process.perusahaan.register")}}" style="background-color: rgba(75, 123, 245, 0.7); padding: 15px;">
            @csrf
            <h3 class="fw-bold">Register Perusahaan</h3>
            <div class="mb-3">
                <label for="a" class="form-label">Nama Perusahaan</label>
                <input name="nama_perusahaan" required type="text" required class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Nama Penanggung Jawab</label>
                <input name="nama_pj" required type="text" required class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">No HP Penanggung Jaab</label>
                <input name="no_hp_pj" required type="number" required class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Email Perusahaan</label>
                <input name="email_perusahaan" required type="email" required class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Nomor Perusahaan</label>
                <input name="no_perusahaan" required type="number" required class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Username</label>
                <input name="username" required type="text" required class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Password</label>
                <input name="password" required type="password" required class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Kota</label>
                <input name="kota" required type="text" required class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Alamat</label>
                <input name="alamat" required type="text" required class="form-control" style="border-left: 4px solid var(--bs-warning);" id="a" placeholder="">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Foto Akta Pendirian Usaha</label>
                <input name="foto_akta" required class="form-control" type="file" id="formFile">
            </div>
            <button class="btn mb-5 btn-warning">Register Perusahaan</button><br>
            <a class="mb-5 text-white" href="{{route("auth.register")}}"">Register User</a>
            </form>
        </div>
    </div>
@endsection