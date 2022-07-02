<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\accountmaster;
use App\Models\Admin\globalvalue;
use Illuminate\Support\Carbon;
use App\Helpers\Helper;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        #dd($request->all());
        $YearlyInt=accountmaster::whereDay('AdmissionDate', '=', date('d'))
                                  ->whereMonth('AdmissionDate', '=', date('m'))
                                  ->where('tempstatus',0)
                                  ->where('Status','O')->get();
        //dd($YearlyInt);
        foreach($YearlyInt as $Int){
            $acbal=Helper::GetAccountBal($Int->AccountId);
            $Int['AcBal']=$acbal;
            if($Int->AType=='DD'){
                $interest=globalvalue::where('head_id','DD Interest')->first();
                $yearlyint=number_format((float)$acbal*$interest->value/100,2,'.','');
                $Int['yearlyint']=$yearlyint;
            }elseif($Int->AType=='MD'){
                //dump($acbal);
                $interest=globalvalue::where('head_id','MD Interest')->first();
                $yearlyint=number_format((float)$acbal*$interest->value/100,2,'.','');
                $Int['yearlyint']=$yearlyint;
            }
        }
        return view("admin.index",compact('YearlyInt'));
    }

    public function ProvideInt(Request $request){
        $name=accountmaster::where('tempstatus',1)->update(['tempstatus'=>0]);
        $YearlyInt=accountmaster::whereDay('AdmissionDate', '=', date('d'))->whereMonth('AdmissionDate', '=', date('m'))->where('Status','O')->where('tempstatus',0)->get();
        foreach($YearlyInt as $Int){
            $acbal=Helper::GetAccountBal($Int->AccountId);
            if($Int->AType=='DD'){
                $interest=globalvalue::where('head_id','DD Interest')->first();
                $yearlyint=number_format((float)$acbal*$interest->value/100,2,'.','');
                $atype='DD';
                $descid='G0008';
            }elseif($Int->AType=='MD'){
                $atype='MD';
                $descid='G0008';
                $interest=globalvalue::where('head_id','MD Interest')->first();
                $yearlyint=number_format((float)$acbal*$interest->value/100,2,'.','');
            }
            $save=Helper::DepositAmt($Int->AccountId,$Int->AType,$yearlyint);
            if($save=='successfull'){
                accountmaster::where('AccountId',$Int->AccountId)->update(['tempstatus'=>1]);
            }
            // voucher Entry
            $naration='Being the amt of '.$atype.' Yearly Interest Provided for '.$Int->AccountName;
            $descid=['atcbhd08'=>'C0001', 'atcbdt'=>$descid];
            $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($Int->AccountId,$yearlyint,$naration,'C','C',$atype,$descid);
            // ends voucher
        }
        return redirect()->back()->with('success','successfully Yearly Interest Provided ....');
    }
}
