<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Models\Admin\accountmaster;
use App\Models\members\memberswithgroup;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
public function daily_collection(){
    $daily='DD';
    $memrecs = accountmaster::select('ID','AccountNo','AccountName','DepositAmt','MemberId')->where('AType',$daily)->where('ID','>',request("id"))->where('Status','O')->paginate('50');
    return response()->json([
        "status" => true,
        'message' => " you sucessfully found member List",
        'member' =>   $memrecs,


    ]);
}
public function monthly_collection(){
    $monthly='MD';
    $memrecs = accountmaster::select('ID','AccountNo','AccountName','DepositAmt','MemberId')->where('AType',$monthly)->where('ID','>',request("id"))->where('Status','O')->paginate('50');
    return response()->json([
        "status" => true,
        'message' => " you sucessfully found member List",
        'member' =>$memrecs,


    ]);
}

}
