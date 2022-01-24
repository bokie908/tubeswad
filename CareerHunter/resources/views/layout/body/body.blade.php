<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield("title")</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" src="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel=stylesheet>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/dataTables.bootstrap4.min.css" rel=stylesheet>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
    </script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js">
    </script>

    <script src="{{ url('/css/table.css') }}"></script>

    <script src="{{ url('/js/jquery.min.js') }}"></script>
    <style>
        body {

            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light   position-fixed w-100" style="background-image: url('https://i.ibb.co/jyjQSPH/Untitled-2.png');z-index:99;background-repeat: no-repeat; background-size: 100% 100%;background-color:#4B7BF5;">
        <div class="container-fluid my-2 mx-4">
            <a class="navbar-brand" href="{{ route('home') }}"><b>CareerHunter</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>

                    @if (session("role") == "admin")
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            User Perusahaan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route("admin.verifikasi_user_perusahaan")}}">Verifikasi User Perusahaan</a></li>
                        </ul>
                    </li>
                    @endif
                    @if (session("role") == "user")
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("listPengajuan")}}">List Pengajuan</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("loker")}}">Lowongan Pekerjaan</a>
                    </li>
                </ul>
                <form style="margin-left: auto;">
                    @if (session('id') && session('role') == 'user')
                    <div class=" dropdown me-3">
                        <button class="btn btn-outline-primary text-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $sessionNow->nama_lengkap }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item text-dark" href="{{route("user.profil")}}">Edit Profil</a></li>
                            <li><a class="dropdown-item text-dark" href="{{route("logout")}}">Logout</a></li>
                        </ul>
                    </div>
                    @elseif (session('id') && session('role') == 'admin')
                    <div class="dropdown me-3">
                        <button class="btn btn-outline-primary text-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            profile
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item text-dark" href="{{route("logout")}}">Logout</a></li>
                        </ul>
                    </div>
                    @elseif (session('id') && session('role') == 'userperusahaan')
                    <div class="dropdown me-3">
                        <button class="btn btn-outline-primary text-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            profile
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item text-dark" href="{{route("perusahaan.profil")}}">Edit Profil</a></li>
                            <li><a class="dropdown-item text-dark" href="{{route("logout")}}">Logout</a></li>
                        </ul>
                    </div>
                    @else
                    <a href="{{ route('auth.login') }}" class="btn btn-default text-white" type="submit">Login</a>
                    <a href="{{ route('auth.register') }}" class="btn btn-default text-white" type="submit">Register</a>
                    <a href="{{ route('auth.perusahaan.register') }}" class="btn btn-default text-white" type="submit">Register User Perusahaan</a>
                    @endif
                </form>
            </div>
        </div>
    </nav>
    @yield("body")
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
    </script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js></script>
    <script src="{{ url('/js/bootstrap.bundle.js') }}"></script>
</body>

</html>