<!-- #req9 melihat pelamar dan filter-->
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
    <h3>List Pelamar</h3>
    <table class="table-bordered table-hover table-inverse table-striped" id="example" width="100%">
        <!-- <table class="table table-bordered shadow-sm"> -->
        <thead>
            <tr style="height: 50px;">
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requestPosisi as $posisi)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$posisi->nama_lengkap}}</td>
                <td>{{$posisi->email}}</td>
                <!-- #req11-->
                <td>
                    @switch($posisi->status_request)

                    @case("avail")

                    <p class="text-success">Seleksi administrasi</p>

                    @break
                    @case("lolos tahap 1")

                    <p class="text-success">Seleksi Pisikotes</p>

                    @break
                    @case("lolos tahap 2")

                    <p class="text-success">Seleksi Tulis</p>

                    @break
                    @case("lolos tahap 3")

                    <p class="text-success">Seleksi Skill</p>

                    @break
                    @case("lolos tahap 4")

                    <p class="text-success">Seleksi Wawancara</p>

                    @break
                    @case("diterima")

                    <p class="text-success">Pelamar diterima</p>

                    @break
                    @case("ditolak")

                    <p class="text-danger">Ditolak</p>

                    @break
                    @endswitch
                </td>
                <td>
                    @if($posisi->status_request!="ditolak")

                    @if($posisi->cv != '')

                    <button type="button" class="btn btn-info  my-button m-1" data-toggle="modal" data-target="#myModal">CV</button>
                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">

                                    <embed src="{{asset('img/cv/'.$posisi->cv)}}" frameborder="0" width="100%" height="400px">

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    @endif
                    <!-- #req10 & req12 & req13-->
                    @if($posisi->status_request==$posisi->status_loker && $posisi->status_request!="diterima")
                    <a href="{{ route('loker.acc',$posisi->id_requestposisi)}}">

                        <button type="button" class="btn btn-primary my-button m-1">Accept</button>

                    </a>
                    @endif

                    <a href="{{ route('loker.dcc',$posisi->id_requestposisi)}}">

                        <button type="button" class="btn btn-danger my-button m-1">Decline</button>

                    </a>
                    @endif
                </td>
            </tr>
            <!-- req14 -->
            <div class="modal fade" id="statusLokerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('loker.next')}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $posisi->id }}">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Info</label>
                                    <textarea class="form-control" name="info" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="example-date-input">Date</label>
                                    <input class="form-control" name="tanggal" type="date" id="example-date-input">
                                </div>
                                @if($posisi->status_loker=="lolos tahap 3")
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="wawancara" id="exampleRadios1" value="online" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Wawancara Online
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="wawancara" id="exampleRadios2" value="offline">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Wawancara Offline
                                    </label>
                                </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
    @if($posisi->status_loker!='diterima')
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#statusLokerModal">
        Next Tahap {{$posisi->status_loker}}
    </button>
    @endif
</div>
@endsection