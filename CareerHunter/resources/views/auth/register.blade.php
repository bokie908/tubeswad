@extends("layout.body.body")

@section('title', 'Register')

@section('body')
<div class="bg-transparent px-5 vh-100" style="padding-top:9rem;">
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
    <div class="bg-transparent p-4" style="">



        <form method="post" enctype="multipart/form-data" action="{{route("process.register")}}">
            @csrf
            <center>
                <p class="fw-bold">Register</p>
                <div class="mb-3">
                    <label for="a" style="text-align:left;" class="form-label">Nama Lengkap</label><br>
                    <input class="w-25" name="nama_lengkap" required type="text" required class="form-control" style="border-radius:10px;background-color: #C2E2F5;" id="a" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="a" class="form-label">Email</label><br>
                    <input class="w-25" name="email" required type="email" required class="form-control" style="border-radius:10px;background-color: #C2E2F5;" id="a" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="a" class="form-label">No HP</label><br>
                    <input class="w-25" name="no_hp" required type="number" required class="form-control" style="border-radius:10px;background-color: #C2E2F5;" id="a" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="a" class="form-label">Password</label><br>
                    <input class="w-25" name="password" required type="password" required class="form-control" style="border-radius:10px;background-color: #C2E2F5;" id="a" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="a" class="form-label">Tanggal Lahir</label><br>
                    <input class="w-25" name="tanggal_lahir" required type="date" class="form-control" style="border-radius:10px;background-color: #C2E2F5;">
                </div>
                <div class="mb-3">
                    <p>Jenis Kelamin</p><br>
                    <select class="w-25" name="kelamin" required class="form-select" aria-label="Default select example" style="border-radius:10px;background-color: #C2E2F5;">
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Foto KTP</label><br>
                    <input class="w-25" name="foto_ktp" required class="form-control" type="file" id="formFile" style="border-radius:10px;background-color: #C2E2F5;">
                </div>
                <button class="mb-5 btn btn-primary">Register</button><br>
                <a class="mb-5" href="{{route("auth.perusahaan.register")}}"">Register User Perusahaan</a>
                </center>
            </form>
            
        </div>
    </div>
@endsection