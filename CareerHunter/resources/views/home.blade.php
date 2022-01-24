
@extends("layout.body.body")
@section("title", "Home")
@if (session("role"))
    @if (session("role") == "admin")
        @section("body")
        @include("layout.home.admin")
        @endsection
    @elseif (session("role") == "userperusahaan")
        @section("body")
        @include("userperusahaan.home")
        @endsection
    @else
        @section("body")
        @include("layout.home.basic")
        @endsection
    @endif

@else
    @section("body")
    @include("layout.home.basic")
    @endsection
@endif


