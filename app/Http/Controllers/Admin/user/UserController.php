<?php

namespace App\Http\Controllers\Admin\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\user;


class UserController extends Controller
{
    public function index()
    {
        $userrecs=user::all();
        return view('admin.user.manage',compact('userrecs'));
    }
}
