<?php

namespace App\Http\Controllers\Home;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class HomeController extends Controller
{
    public function userindex()
    {

        return view('users.index');
    }
}
