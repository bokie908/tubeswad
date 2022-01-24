<!-- #req8 menambah loker -->
@extends("layout.body.body")

@section("title", "Verifikasi User Perusahaan")

@section("body")
<div class="bg-white bg-gradient px-5 vh-100" style="padding-top:7rem;">
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

    <form method="post" action="{{route("process.perusahaan.loker.tambah")}}" style="background-color: rgba(75, 123, 245, 0.7); padding: 15px;">
        @csrf
        <h3 class="fw-bold">Tambah Lowongan Pekerjaan</h3>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Posisi Pekerjaan</label>
            <input required name="posisi" type="text" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Pekerjaan</label>
            <textarea required name="job_desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Persyaratan</label>
            <textarea required name="persyaratan" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Kualifikasi</label>
            <textarea required name="kualifikasi" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Pekerjaan</label>
            <select required name="jenis_pekerjaan" class="form-control">
                <option value="fulltime">Full-Time</option>
                <option value="parttime">Part-Time</option>
                <option value="internship">Internship</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Jarak Usia</label>
            <div class="d-flex">
                <select required name="usia_min" class="form-control">
                    @for ($i=18;$i<60;$i++) <option value="{{$i}}">{{$i}}</option>
                        @endfor
                </select>
                <p class="mt-3 mx-3">Sampai</p>
                <select required name="usia_max" class="form-control">
                    @for ($i=18;$i<60;$i++) <option value="{{$i}}">{{$i}}</option>
                        @endfor
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Rentang Gaji (Opsional)</label>
            <div class="d-flex">
                <input name="gaji_min" type="number" class="form-control" id="exampleFormControlInput1">
                <p class="mt-3 mx-3">Sampai</p>
                <input name="gaji_max" type="number" class="form-control" id="exampleFormControlInput1">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Minimal Pengalaman</label>
            <input required name="pengalaman_min" type="number" class="form-control" id="exampleFormControlInput1">
        </div>

        <button type="submit" class="btn btn-primary mb-3">Tambah</button>
    </form>
</div>
@endsection