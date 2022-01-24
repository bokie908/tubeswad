<!-- #req9 melihat list loker-->
<div class="bg-white bg-gradient px-5" style="padding-top:7rem;padding-bottom: 5rem;">
    <a href="{{route("perusahaan.loker.tambah")}}" class="btn btn-primary mb-3">Posting Lowongan Kerja</a>
    <table class="table table-bordered shadow-sm">
        <thead>
            <tr>
                <th colspan="6">List Lowongan Kerja</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Posisi Pekerjaan</th>
                <th>Deskripsi Pekerjaan</th>
                <th>Jumlah Pengajuan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($up as $d)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$d->posisi}}</td>
                <td>{{$d->job_desc}}</td>
                <td>
                    @php
                    $hm = DB::select("select id from request_posisi where loker_id = ?",[$d->id]);
                    echo count($hm);
                    @endphp
                </td>
                <td>
                    @switch($d->status_loker)

                    @case("avail")

                    <p class="text-success">Available</p>

                    @break

                    @case("lolos tahap 1")

                    <p class="text-success">Seleksi Tahap 1</p>

                    @break
                    @case("lolos tahap 2")

                    <p class="text-success">Seleksi Tahap 2</p>

                    @break
                    @case("lolos tahap 3")

                    <p class="text-success">Seleksi Tahap 3</p>

                    @break
                    @case("lolos tahap 4")

                    <p class="text-success">Seleksi Tahap 4</p>

                    @break
                    @case("diterima")

                    <p class="text-success">Diterima</p>

                    @break
                    @case("not avail")

                    <p class="text-danger">Not Available</p>

                    @break
                    @endswitch
                </td>
                <td>
                    @switch($d->status_loker)

                    @case("avail" || "lolos tahap 1")

                    <a href="{{ route('loker.detail',$d->id)}}">

                        <button type="button" class="btn btn-primary my-button m-1">Detail</button>

                    </a>

                    <a href="{{ route('loker.stop',$d->id)}}">

                        <button type="button" class="btn btn-danger my-button m-1">Stop</button>

                    </a>

                    @break
                    @case("not avail")

                    <p class="text-danger">Not Available</p>

                    @break
                    @endswitch
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>