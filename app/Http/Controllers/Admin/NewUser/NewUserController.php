<?php

namespace App\Http\Controllers\Admin\NewUser;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
//use App\Models\Admin\accountmaster;
//use App\Models\Admin\atcbhd08;
//use App\Models\Admin\ddcollection;
//use App\Models\Admin\rdcollection;
//use App\Models\TempDeposite;
use App\Models\Admin\eomaster;
use App\User;
use App\Users;
use App\Models\Admin\UserRole;
//use App\eomst;
//use app\user_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\UserPermission;
class NewUserController extends Controller
{
    public function index()
    {
        $account_data=eomaster::all();
        $UsersList=DB::table('users')
        ->select('users.userid','users.username','users.userid','eomst.EOName')
        ->join('eomst','users.userid','=','eomst.EOId')
        ->where('role','lo')->get();
        //dd($UsersList);
        return view('admin.collection.new',compact('account_data','UsersList'));
    }
    public function validateform(Request $request) {
        $account_data=eomaster::all();

        $this->validate($request,[
           'user_id'=>'required|unique:user_roles',
           'username'=>'required|unique:users|max:100',
           'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
           'password_confirmation' => 'min:8'
        ]);


        $username=$request->username;
        $userid=$request->user_id;
        $password=$request->password;
        $password = bcrypt($password);
        $role='lo';

        $user=  users::create(['username'=>$username,'userid'=>$userid,'password'=>$password,'role'=>$role]);
        UserRole::create(['user_id'=>$userid,'loan'=>'1','banking'=>'1','hr'=>'1','house_keeping'=>'1','reporting'=>'1']);
        UserPermission::create(['user_id'=>$user->id,'loan'=>'1','banking'=>'1','hr'=>'1','house_keeping'=>'1','reporting'=>'1']);
        $UsersList=DB::table('users')
        ->select('users.userid','users.username','users.userid','eomst.EOName')
        ->join('eomst','users.userid','=','eomst.EOId')
        ->where('role','lo')->get();

        return redirect()->back()->with("success", "Successfully Deleted.");
        //return view("admin.collection.new",compact('account_data','UsersList'))->with("success", "Successfully Sign Up.");

    }
    public function delete($id)
    {

        users::where('userid', [$id])->delete();
        UserRole::where('user_id', [$id])->delete();
        UserPermission::where('user_id', [$id])->delete();
        //DB::delete('DELETE FROM users WHERE id = ?', [$id]);


        return redirect()->back()->with("success", "Successfully Deleted.");

    }

}
