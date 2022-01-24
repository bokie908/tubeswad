<!-- req16 -->
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

    <div class="bg-white bg-gradient px-5" style="padding-top:7rem;padding-bottom: 5rem;">
        <table class="table table-bordered shadow-sm">
            <thead>
                <tr>
                    <th colspan="6">List Lowongan Kerja</th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Posisi Pekerjaan</th>
                    <th>Deskripsi Pekerjaan</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuan as $d)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$d->posisi}}</td>
                    <td>{{$d->job_desc}}</td>
                    <td>
                        @if($d->status_request == "avail")
                        <p class="text-warning">Proses Seleksi Administrasi</p>
                        @endif

                        @if($d->status_request == "lolos tahap 1")

                        <p class="text-success">Seleksi Psikotes</p>
                        @endif

                        @if($d->status_request == "lolos tahap 2")

                        <p class="text-success">Ujian Tulis</p>
                        @endif
                        @if($d->status_request == "lolos tahap 3")

                        <p class="text-success">Test Skill</p>

                        @endif
                        @if($d->status_request == "lolos tahap 4")

                        <p class="text-success">Wawancara</p>

                        @endif
                        @if($d->status_request == "diterima")

                        <p class="text-success">Selamat anda diterima</p>

                        @endif
                        @if($d->status_request == "ditolak")

                        <p class="text-danger">Ditolak</p>

                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailLoker">
                            Detail
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="detailLoker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        @if($d->status_request == "avail")

                                        <p>Proses Seleksi Administrasi</p>

                                        @endif
                                        @if($d->status_request == "lolos tahap 1")

                                        <p>{{$d->info_tahap1}}</p>
                                        <p>{{$d->tanggal_tahap1}}</p>

                                        @endif
                                        @if($d->status_request == "lolos tahap 2")

                                        <p>{{$d->info_tahap2}}</p>
                                        <p>{{$d->tanggal_tahap2}}</p>

                                        @endif
                                        @if($d->status_request == "lolos tahap 3")

                                        <p>{{$d->info_tahap3}}</p>
                                        <p>{{$d->tanggal_tahap3}}</p>

                                        @endif
                                        @if($d->status_request == "lolos tahap 4")

                                        <p>{{$d->info_tahap4}}</p>
                                        <p>{{$d->tanggal_tahap4}}</p>

                                        <p class="text-success">wawancara dilaksanakan secara {{$d->wawancara}}</p>

                                        @endif
                                        @if($d->status_request == "diterima")

                                        <p class="text-success">Selamat anda diterima</p>

                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection