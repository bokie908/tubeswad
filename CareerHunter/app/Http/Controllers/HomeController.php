<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Loker;
use App\Models\User;
use App\Models\UserPerusahaan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (session("role") == "admin") {
            return view("home", ["sessionNow" => Admin::getCurrentUser(session("id"))]);
        } elseif (session("role") == "userperusahaan") {
            $up = Loker::where("perusahaan_id", session("id"))->get();
            return view("home", ["up" => $up, "sessionNow" => UserPerusahaan::getCurrentUser(session("id"))]);
        } else {
            return view("home", ["sessionNow" => User::getCurrentUser(session("id"))]);
        }
    }
}
