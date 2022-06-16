<?php

namespace App\Http\Controllers\Admin\Shares;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Admin\membermaster;
use App\Models\Admin\accountmaster;
use App\Models\Admin\shares;
use Illuminate\Http\Request;
use DB;

class ShareController extends Controller
{
    public function ExtraShare(){
        $member=membermaster::get();
        $value = DB::table('global_value')->where('id',1)->first();
        $value=$value->value;
        return view('admin.share.extrashare',compact('member','value'));
    }

    public function ExSMem(Request $request){
        $memberdtl= membermaster::where('MemberId',$request->id)->first();
        $shares = shares::where('MemberId',$request->id)->first();

        return response()->json(array('success' => $memberdtl,'member' => $shares));
    }

    public function SaveExShare(Request $request){
        $memberdtl=membermaster::where('MemberId',$request->mem_id)->first();
        $naration='Being the amt of Share received from '.$memberdtl->MemberType.",".$memberdtl->MemberName;
        $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'G0065'];
        $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($request->mem_id,$request->new_share_amount,$naration,'C','D','M',$descid);
        $data=[
            'MemberId'   => $request->mem_id,
            'MemSrNo'    => $memberdtl->MemSrNo,
            'MemberNo'   => $memberdtl->MemberNo,
            'shares'     => $request->new_share,
            'shareamount'=> $request->new_share_amount,
            'voucher_no' => $voucharno,
        ];
        shares::create($data);
        return redirect()->back()->with('success','Succesfully Purchesed Share');
    }

    public function ShareTransfer(Request $request){
        $ShareList = membermaster::get();
        // dd($ShareList);
        return view('admin.share.share_transfer', compact('ShareList'));
    }
    public function ShareHolderDtl(Request $request){
        $shareholder = Shares::select('shares.*','membermaster.MemberName')->join('membermaster','membermaster.MemberId','=','shares.MemberId')->where('shares.MemberId',$request->t1)->get();
        return response()->json(array('success'=>$shareholder));
    }
    public function SharePopUp(Request $request){
        $shareholder = Shares::select('shares.*','membermaster.MemberName')->join('membermaster','membermaster.MemberId','=','shares.MemberId')->where('shares.id',$request->t1)->where('shares.share_status',1)->first();
        $ac_no =accountmaster::where('MemberId',$shareholder->MemberId)->get();
        $share_value = DB::table('global_value')->where('head_id','share')->first();

        return response()->json(array('data'=>$shareholder,'ac_no'=>$ac_no, 'value'=>$share_value->value));
    }

    public function ShareWithDrow(Request $request){
        $act_dtl = explode(",", $request->a_c_id);
        dd($act_dtl[0]);
        if($request->a_c_id==null){
            $data=[
                'share_status'=>0
            ];
        }else{
            $data=[
                'share_status'=>0
            ];
            \App\Helpers\Helper::depodit($actype,$request->a_c_id,$request->cur_amt,$date);
        }
        $naration='Being the amt of Share Withdrown from '.$request->holder_name;
        $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($request->mem_id,$request->cur_amt,$naration,'C','D','M');
    }

}
