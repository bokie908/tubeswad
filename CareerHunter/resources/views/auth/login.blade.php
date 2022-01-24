@extends("layout.body.body")

@section("title", "Login")

@section("body")
<div class="bg-transparent bg-gradient px-5 vh-100" style="padding-top:9rem;background-color: transparent;">
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
    <div class=" bg-transparent p-4" style="background-color: transparent;">
        
        <form style=""method="post" action="{{route("process.login")}}">
            @csrf
            <center>
            <div class="mb-3">
                
            <i class="fa fa-user fa-lg"></i> <input class="w-25" name="email" type="email" required class="form-control"  style="border-radius:10px;background-color: #C2E2F5;" id="a" placeholder="Email">
            </div>
            
            <div class="mb-3">
                
            <i class="fa fa-lock fa-lg"></i> <input class="w-25" name="password" type="password" required class="form-control"  style="border-radius:10px;background-color: #C2E2F5;" id="a" placeholder="Password">
            </div>
            <button type="submit" class="mb-5 btn btn-primary w-25 ">Login</button><br>
            <a class="mb-5" href="{{route("auth.perusahaan.login")}}"">Login User Perusahaan</a><br>
            <a href="{{route("auth.admin.login")}}"">Login Admin</a>
            </center>
        </form>
    </div>
</div>
@endsection

