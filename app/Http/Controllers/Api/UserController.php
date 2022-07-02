<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\user;
use App\Models\Admin\UserPermission;
use App\Models\misc\finyear;
use App\Models\TempDeposite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = request(['username', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                "status" => false,
                'message' => "credential doesn't match"
            ]);
        }

         $user = user::where('username', $request->username)->with('user_role')->first();
        // dd($user);

        if (!Hash::check($request->password, $user->password, [])) {
            throw new \Exception("Error login");
        }

        $tokenResult = $user->createToken('token')->plainTextToken;
        if($user->user_role){
        return response()->json([
            "status" => true,
            'message' => "Hurry !! You are sucessfully login",
            'user' => $user->only(['id','username','contactno','role']),
            'permission'=>$user->user_role->only(['loan','banking','hr','house_keeping','reporting']),
            'token' => $tokenResult,
        ]);
       }else{
        return response()->json([
            "status" =>false,
            'message' => "You are not a lO",

        ]);
       }
    }
    public function fin_year()
    {
        $finyr = finyear::where('status', 1)->get();
        return response()->json([
            "status" => true,
            'message' => " you sucessfully found financial year",
            'year' =>  $finyr,

        ]);
    }
    public function master()
    {
        $user      = auth()->user();
        $permission = UserPermission::where('user_id', $user->id)->first();
        $to_day_date=date("Y-m-d");
        $yesterday_date = date('Y-m-d',strtotime("-1 days"));

        $today_collection=TempDeposite::where('collected_date',$to_day_date)->sum('amount_collected');
        $yesterday_collection=TempDeposite::where('collected_date',$yesterday_date)->sum('amount_collected');
        return response()->json([
            "status" => true,
            'message' => " you sucessfully found User Permission",
            'permission'=>$permission->only(['loan','banking','hr','house_keeping','reporting']),
            'today_collection'=> $today_collection,
            'yesterday_collection'=>$yesterday_collection


        ]);
    }
}
