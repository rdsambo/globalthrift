<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\members\eomaster;

class MemberController extends Controller
{
    public function addmember()
    {
            dd("reached");
        //return view('users.member.index');
    }

    public function viewmember()
    {
        return view('users.member.index');
    }

    public function addmem(Request $request)
    {
        dd($request->all());
    }
    public function getlomember(Request $request)
    {

        $lorecs=eomaster::where('EOId','=',$request->id)->first();

        return response()->json(['success'=>true,"data" => $lorecs]);
    }
}
