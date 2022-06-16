<?php

namespace App\Http\Controllers\Admin\Account;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\membermaster;
use App\Models\Admin\accountmaster;
use App\Models\Admin\acsubgrp;
use App\Models\Admin\ddcollection;
use App\Models\Admin\rdcollection;
use App\Models\Admin\eomaster;
//use App\Models\Admin\ddwithdrawal;
use App\Models\Admin\Ddwithdrawal;
use App\Models\Admin\Rdwithdrawal;
use App\Models\Admin\mdwithdrawal;
use App\Models\Admin\memberdocument;
use App\Models\Admin\atcbhd08;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Carbon\Carbon;



class AccountController extends Controller
{
    public function index()
    {

        $member=membermaster::select('MemberId', 'MemberName')->get();
        $eomaster=eomaster::select('EOId', 'EOName')->get();
        $nextacno=accountmaster::selectRaw("max(cast(substr(trim(AccountNo),1) AS UNSIGNED))+1 as nextacno")
        ->first();
        $type = "D";
        return view('Account.index',compact('member','eomaster', 'nextacno','type'));
    }

    public function indexm()
    {
        $member = membermaster::select('MemberId', 'MemberName')->get();
        $eomaster = eomaster::select('EOId', 'EOName')->get();
        $nextacno = accountmaster::selectRaw("max(cast(substr(trim(AccountNo),1) AS UNSIGNED))+1 as nextacno")
        ->first();

        $type="M";
        return view('Account.index', compact('member', 'eomaster', 'nextacno','type'));
    }

    public function mdaccountlist(Request $request)
    {
        // dump($request->all());
        $accountrecs=accountmaster::where('AType','=','MD')
                    ->when($request->name,function($query) use($request){
                        return $query->where('AccountName',$request->name);
                        })
                    ->when($request->ac_no,function($query) use($request){
                        return $query->where('AccountNo',$request->ac_no);
                        })
                    ->when($request->actype,function($query) use($request){
                        return $query->where('Status',$request->actype);
                        })
                    ->paginate(100);
        //dd($accountrecs);
        $total = accountmaster::where('AType', '=', 'MD')
                ->when($request->name,function($query) use($request){
                    return $query->where('AccountName',$request->name);
                    })
                ->when($request->ac_no,function($query) use($request){
                    return $query->where('AccountNo',$request->ac_no);
                    })
                ->when($request->actype,function($query) use($request){
                    return $query->where('Status',$request->actype);
                    })
                ->count();
        $which=1;
        return view("admin.account.index",compact('accountrecs','total','which'));

    }

    public function ddaccountlist(Request $request)
    {
        $accountrecs = accountmaster::where('AType','=','DD')->orderBy(DB::raw('CAST(AccountNo as UNSIGNED)', "ASC"))
                    ->when($request->name,function($query) use($request){
                        return $query->where('AccountName',$request->name);
                        })
                    ->when($request->ac_no,function($query) use($request){
                        return $query->where('AccountNo',$request->ac_no);
                        })
                    ->when($request->actype,function($query) use($request){
                        return $query->where('Status',$request->actype);
                        })
                    ->paginate(100);
       // dd($accountrecs);
        $total = accountmaster::where('AType', '=', 'DD')
                                ->when($request->name,function($query) use($request){
                                    return $query->where('AccountName',$request->name);
                                    })
                                ->when($request->ac_no,function($query) use($request){
                                    return $query->where('AccountNo',$request->ac_no);
                                    })
                                ->when($request->actype,function($query) use($request){
                                    return $query->where('Status',$request->actype);
                                    })
                                ->count();
        $which=2;
        return view("admin.account.index", compact('accountrecs', 'total','which'));
    }



    public function ddaccountlistindiv(Request $request)
    {
        $accountrecs = accountmaster::where('AType', '=', 'DD')->where('accountno',$request->memid)
        ->orWhere('accountid', $request->memid)->first();
        //dd($accountrecs);
        $total = accountmaster::where('AType', '=', 'DD')->count();
        return view("admin.account.indexindiv", compact('accountrecs', 'total'));
        //return view("admin.account.index", compact('accountrecs', 'total'));
    }

    public function mdcollection()
    {
        $mdaccount = accountmaster::where('AType', '=', 'MD')->orderby('AccountNo')->get();
        //dd($accountrecs);
        $total = accountmaster::where('AType', '=', 'MD')->count();
        return view("admin.account.mdcollection", compact('mdaccount', 'total'));
    }

    public function ddcollection()
    {
        $ddaccount=accountmaster::where('AType', '=', 'DD')->orderby('AccountNo')->get();
        return view('admin.account.ddcollection',compact('ddaccount'));
    }

    public function EditMinbal(Request $request)
    {
        // dd($request->all());
        if($request->has('ID')){
            foreach($request->ID as $id){
                if($request->amt!=null){
                    accountmaster::where('AccountId',$id)->update(['MAmount'=>$request->amt,'MBalFlag'=>$request->flag]);
                }else{
                    accountmaster::where('AccountId',$id)->update(['MBalFlag'=>$request->flag]);
                }
            }
            return redirect()->back()->with('success','Successfully Updated Minimun A/C Balance');
        }else{
           return redirect()->back()->with('success','Select At Least One A/C.....');
        }

    }

    public function collectiondd(Request $request)
    {
        $nextslno=ddcollection::selectRaw('max(slno) + 1 as nextslno')
                               ->where('accountid',$request->accountid)->first();
        $data=[
            'AccountId'         =>  $request->accountid,
            'slno'              =>  $nextslno->nextslno,
            'damt'              =>  $request->amount,
            'userid'            =>  1,
            'ColDate'           =>  $request->doc,
        ];
        $memberdetails=accountmaster::where('accountid', $request->accountid)->first();
        $result=ddcollection::create($data);
        if($result){
            $naration='Being the amt of Dily Deposit collection for '.$request->acctholder;
            $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'G0010'];
            $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($request->accountid."-".$nextslno->nextslno,$request->amount,$naration,'C','D','DC',$descid);
        }
        return redirect()->back()->with('success','Deposit Successfully Collected');
    }


    public function collectionmd(Request $request)
    {
        $nextslno = rdcollection::selectRaw('max(slno) + 1 as nextslno')
        ->where('accountid', $request->accountid)->first();
        $data = [
            'AccountId'         =>  $request->accountid,
            'slno'              =>  $nextslno->nextslno,
            'damt'              =>  $request->amount,
            'userid'            =>  Auth()->user()->id,
            'ColDate'           =>  $request->doc,
        ];

        $memberdetails = accountmaster::where('accountid', $request->accountid)->first();
        $result = rdcollection::create($data);
        if ($result) {
            $naration='Being the amt of Monthly Deposit collection from '.$request->acctholder;
            $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'G0011'];
            $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($request->accountid."-".$nextslno->nextslno,$request->amount,$naration,'B','D','MC',$descid);
        }
        return redirect()->back()->with('success','Deposit Successfully Collected');
    }





    public function getacctdata(Request $request)
    {
        $ldate = date('Y-m-d H:i:s');
        $ac_no = explode(' ',$request->t1);
        $acctdata=accountmaster::where('AccountId','=',$ac_no[0])->first();
        if($acctdata->AType=="DD"){
            $depositamt=ddcollection::where('accountid','=', $request->t1)->orderBy('SlNo','DESC')->first();
            $amttilldate0=ddcollection::selectRaw('sum(DAmt) as totalamt')->where('ColDate','<=',$ldate)
                 ->where('accountid','=', $request->t1)->first();
            $amttilldate1=Ddwithdrawal::selectRaw('sum(WAmt) as totalamt')->where('WDate','<=',$ldate)
                 ->where('Accountid','=', $request->t1)->first();
            $amttilldate=($amttilldate0->totalamt)-($amttilldate1->totalamt);
        }else{
            $depositamt=rdcollection::where('accountid','=', $request->t1)->orderBy('SlNo','DESC')->first();
            $amttilldate=rdcollection::selectRaw('sum(DAmt) as totalamt')->where('ColDate','<=',$ldate)
            ->where('accountid','=', $request->t1)->first();
            $depositamt=rdCollection::where('accountid','=', $request->t1)->orderBy('SlNo','DESC')->first();
        }
        $documents=memberdocument::where('member_id','=', $acctdata->MemberId)->first();
        return response()->json(array('success' => true, 'accdata' => $acctdata,'depoamt'  => $depositamt,'totamt'  =>  $amttilldate,'documents'=>$documents));
    }





    public function transferdata(Request $request)
    {

        $ldate = date('Y-m-d H:i:s');
        $ac_no = explode(' ',$request->t1);
        $acctdata=accountmaster::where('AccountId','=',$ac_no[0])->first();
        if($acctdata->AType=="DD"){
            $depositamt=ddcollection::where('accountid','=', $request->t1)->orderBy('SlNo','DESC')->first();
            $amttilldate0=ddcollection::selectRaw('sum(DAmt) as totalamt')->where('ColDate','<=',$ldate)
                 ->where('accountid','=', $request->t1)->first();
            $amttilldate1=Ddwithdrawal::selectRaw('sum(WAmt) as totalamt')->where('WDate','<=',$ldate)
                 ->where('Accountid','=', $request->t1)->first();
            $amttilldate=($amttilldate0->totalamt)-($amttilldate1->totalamt);
        }else{
            $depositamt=rdcollection::where('accountid','=', $request->t1)->orderBy('SlNo','DESC')->first();
            $amttilldate=rdcollection::selectRaw('sum(DAmt) as totalamt')->where('ColDate','<=',$ldate)
            ->where('accountid','=', $request->t1)->first();
            $depositamt=rdCollection::where('accountid','=', $request->t1)->orderBy('SlNo','DESC')->first();
        }
        $documents=memberdocument::where('member_id','=', $acctdata->MemberId)->first();
        return response()->json(array('success' => true, 'accdata' => $acctdata,'depoamt'  => $depositamt,'totamt'  =>  $amttilldate,'documents'=>$documents));

    }


//Changes 16-12-2021
    public function popup_pass(Request $request){

         $acctdata=accountmaster::where('AccountNo',$request->id)->first();
         if($acctdata->AType=='DD'){
            $transactions = DB::select('
            SELECT t.date,t.PTYPE , t.amount, t.AccountId, if(t.PTYPE = "DEPOSIT", @running_total:=@running_total + t.amount, @running_total:=@running_total - t.amount) AS cumulative_sum FROM ( SELECT * FROM cust_trans_new ) t JOIN (SELECT @running_total:=0) r where t.AccountId = ? ORDER BY t.date
            ', [$request->accountid]);
        }elseif($acctdata->AType=='MD'){
            $transactions = DB::select('
            SELECT t.date,t.PTYPE , t.amount, t.AccountId, if(t.PTYPE = "DEPOSIT", @running_total:=@running_total + t.amount, @running_total:=@running_total - t.amount) AS cumulative_sum FROM ( SELECT * FROM customermd_transactions ) t JOIN (SELECT @running_total:=0) r where t.AccountId = ? ORDER BY t.date
            ', [$request->accountid]);
        }
        // $count=count($transactions)-1;
        // $start=$count-9;

        return response()->json(array('success' => true, 'accdata' => $acctdata,'transactions'=>$transactions));

    }


    public function getacctdatamd(Request $request)
    {
        //dd( $request->t1);
        $accno = explode(" ", $request->get("t1"))[0];
        $acctdata = accountmaster::where('AccountId', '=', $accno)->first();
        $depositamt = rdcollection::where('accountid', '=', $acctdata->AccountId)->orderBy('SlNo', 'DESC')->first();
        return response()->json(array('success' => true, 'accdata' => $acctdata, 'depoamt'  => $depositamt));
    }

    public function accountreportdd(Request $request)
    {
        //dd($request->all());
        if($request->status=='DD'){
            $acctrpt=accountmaster::with(['ddcollection' => function($query){
                return $query->orderBy('ColDate','ASC');
            }])->where(['AccountId'=>$request->acid])
            ->get();
            // dd($acctrpt);
            if($acctrpt){
                return view('admin.account.indivreport',compact('acctrpt'));
            }else{
                return redirect()->back()->with('error','No Data Found');
            }
        }
        if($request->status=='MD'){
            $acctrpt=accountmaster::with(['rdcollection' => function($query){
                return $query->orderBy('ColDate','ASC');
            }])->where(['AccountId'=>$request->acid])
            ->get();
            // dd($acctrpt);
            if($acctrpt){
                return view('admin.account.indivreport',compact('acctrpt'));
            }else{
                return redirect()->back()->with('error','No Data Found');
            }
        }


    }

    public function pdfview($download,$Id)
    {
        //$acctrpt = ddcollection::where(['AccountId' => $Id])->orderBy('SlNo', 'ASC')->get();
        $acctrpt=accountmaster::with(['ddcollection' => function($query){
            return $query->orderBy('ColDate','ASC');
        }])->where(['accountno'=>$Id,'status'=>'O'])
        ->get();
        //dd($acctrpt);
        $pdf = \PDF::loadView('admin.account.indivreportpdf', compact('acctrpt'));
        return $pdf->download('admin.account.indivreportpdf.pdf');
    }



    public function withdraw()
    {
        $accountholder = accountmaster::where('status', '=', 'O')->get();
        $banks=acsubgrp::where('AcSubGrpId',4)->with('acledger')->first();
        // dd($banks);
        return view('admin.account.withdraw',compact('accountholder','banks'));
    }


    public function create(Request $request)
    {
        // dd($request->all());
        $rules=[
            'acctno'        =>      'required',
            'accountopendt' =>      'required',
            'memid'         =>      'required',
            'amount'        =>      'required',
        ];
        $customMessages = [
            'required' => 'The :attribute field can not be blank.'
        ];
        $validator=Validator::make($request->all(),$rules, $customMessages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{
            DB::beginTransaction();

            try {

                $nextaccountid=accountmaster::selectRaw('max(accountid) + 1 as nextaccntid')->first();
                $acno=$request->acctno;
                $memname= \App\Helpers\Helper::getmembername($request->memid);
                $dataaccntmaster=[
                    'accountid'     =>  $nextaccountid->nextaccntid,
                    'AccountNo'     =>  $acno,
                    'Atype'         =>  $request->deposittype,
                    'AccountName'   =>  $memname,
                    'MemberId'      =>  $request->memid,
                    'intrate'       =>  $request->rate,
                    'DepositAmt'    =>  $request->amount,
                    'AdmissionDate' =>  date('Y-m-d',strtotime($request->accountopendt)),
                    'pan'           =>  $request->panno,
                    'gender'        =>  $request->gender,
                    'IntroducerName'=>  $request->introducer,
                    'IntroducerACNo'=>  $request->intacno,
                    'EntryDate'     =>  $request->doe,
                    'userid'        =>  Auth()->user()->id,
                    'MAmount'       =>  $request->mmbal,
                    'MBalFlag'      =>  $request->radio
                ];
                accountmaster::create($dataaccntmaster);

                //find transaction id from ddcollection against the account no
                $nextd_id=ddcollection::selectRaw('max(slno) + 1 as nextddslno')->where('Accountid','=', $nextaccountid)->first();
                if($nextd_id){
                        $nextd_id->nextddslno=1;
                }
                    $insddcollection=[
                    'accountid'     =>  $nextaccountid->nextaccntid,
                    'SlNo'          =>  $nextd_id->nextddslno,
                    'ColDate'       =>  date('Y-m-d', strtotime($request->accountopendt)),
                    'DAmt'          =>  $request->amount,
                    'UserId'        =>  Auth()->user()->id,
                    ];

                ddcollection::create($insddcollection);
                $naration='Being the amt of Share received from '.$memname;
                $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($nextaccountid->nextaccntid."-".$nextd_id->nextddslno,$request->amount,$naration,'C','D','C');

            }catch(\Exception $e)
            {
                return Redirect::back()->with('success', "Something Went Wrong");
            }

            DB::commit();

        }
        //find account id from accountmaster


        return redirect()->back()->with('success', "Account Successfully opened");
    }

    //Changes Passbook function
    public function passbook(Request $request)
    {
        // dd($request->all());
        $datefrom=$request->get("datefrom");
        $dateto=$request->get("dateto");
        $account_data = new accountmaster ;
        $transactions = collect();

        if($request->has("accountid")){
            $accid = explode(" ", $request->get("accountid"))[0];
            $account_data=accountmaster::where('AccountId',$accid)
                ->first();
            if($account_data->AType=='DD'){
                $transactions = DB::select('
                SELECT t.date,t.PTYPE , t.amount, t.AccountId, if(t.PTYPE = "DEPOSIT", @running_total:=@running_total + t.amount, @running_total:=@running_total - t.amount) AS cumulative_sum FROM ( SELECT * FROM cust_trans_new ) t JOIN (SELECT @running_total:=0) r where t.AccountId = ? ORDER BY t.date
                ', [$request->accountid]);
            }elseif($account_data->AType=='MD'){
                $transactions = DB::select('
                SELECT t.date,t.PTYPE , t.amount, t.AccountId, if(t.PTYPE = "DEPOSIT", @running_total:=@running_total + t.amount, @running_total:=@running_total - t.amount) AS cumulative_sum FROM ( SELECT * FROM customermd_transactions ) t JOIN (SELECT @running_total:=0) r where t.AccountId = ? ORDER BY t.date
                ', [$request->accountid]);
            }
        }
        $count=count($transactions)-1;
        $start=$count-9;

        // $acctdata=accountmaster::where('Status','O')->get();
        $acctdata=accountmaster::where('Status','O')->orderby('AccountNo')->get();
        return view('admin.account.passbook',compact('acctdata', "account_data", "transactions","count","start","datefrom","dateto"));
    }

    public function withdrawal(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $accountdtl=accountmaster::where('AccountId',$request->accountid)->first();
            if($request->mode=="Cash"){
                $data=[
                    'AccountId' =>  $request->accountid,
                    'WDate'     =>  $request->dow,
                    'WAmt'      =>  $request->withdrawamt,
                    'Atype'     =>  $accountdtl->AType,
                    'UserId'    =>   Auth()->user()->id,
                ];
                if($accountdtl->AType=="DD"){
                    $atcbdt='G0010';
                    $naration='Being the amt DD Refund Withdrowl from '.$request->acctholder;
                }else{
                    $atcbdt='G0011';
                    $naration='Being the amt MD Refund Withdrowl from '.$request->acctholder;
                }
                $descid=['atcbhd08'=>'C0001', 'atcbdt'=>$atcbdt];
                $voucharno= Helper::InsertInto_atcbhd08($request->accountid,$request->withdrawamt,$naration,'C','C',$accountdtl->AType,$descid);
                $msg="Amount Withdrown Succesfully By Cash";
            }
            elseif($request->mode=="Cheque"){
                $data=[
                    'AccountId' =>  $request->accountid,
                    'WDate'     =>  $request->dow,
                    'WAmt'      =>  $request->withdrawamt,
                    'WChqNo'    =>  $request->chqno,
                    'WChqDate'  =>  $request->chqdate,
                    'Atype'     =>  $accountdtl->AType,
                    'UserId'    =>   Auth()->user()->id,
                ];
                if($accountdtl->AType=="DD"){
                    $atcbdt=$request->bankname;
                    $naration='Being the amt DD Refund Withdrowl from '.$request->acctholder.' Checque';
                }else{
                    $atcbdt=$request->bankname;
                    $naration='Being the amt MD Refund Withdrowl from '.$request->acctholder.' Checque';
                }
                $descid=['atcbhd08'=>'C0001', 'atcbdt'=>$atcbdt];
                $voucharno= Helper::InsertInto_atcbhd08($request->accountid,$request->withdrawamt,$naration,'C','C',$accountdtl->AType,$descid);
                $msg="Amount Withdrown Succesfully By Cheque";
            }
            elseif($request->mode=="Transfer"){
                $data=[
                    'AccountId' =>  $request->accountid,
                    'WDate'     =>  $request->dow,
                    'WAmt'      =>  $request->withdrawamt,
                    'Atype'     =>  $accountdtl->AType,
                    'UserId'    =>   Auth()->user()->id,
                ];
                $recepentdtl=accountmaster::where('AccountId',$request->transferac)->first();
                $voucharno= \App\Helpers\Helper::depodit($recepentdtl['AType'],$request->transferac, $request->withdrawamt,$request->dow);
                $msg="Amount Transfed Succesfully";
            }

            if($accountdtl->AType=="DD"){
                $result=ddwithdrawal::insert($data);
                // $descid=['atcbhd08'=>'C0001', 'atcbdt'=>$atcbdt];
                // $voucharno= Helper::InsertInto_atcbhd08($request->accountid,$request->withdrawamt,$naration,'C','C',$accountdtl->AType,$descid);
            }elseif($accountdtl->AType=="MD"){
                $result=Rdwithdrawal::insert($data);
                // $descid=['atcbhd08'=>'C0001', 'atcbdt'=>$atcbdt];
                // $voucharno= Helper::InsertInto_atcbhd08($request->accountid,$request->withdrawamt,$naration,'C','C',$accountdtl->AType,$descid);
            }

            DB::commit();
            return redirect()->back()->with('success',$msg);

        }
        catch(\Exception $e)
        {
            dd($e);
            DB::rollback();
            return Redirect::back()->with('success','Somthing Went Wrong....');
        }




    }
}


// elseif($account_data->AType=='MD'){
//     $transactions = DB::select('
//     SELECT t.date,t.PTYPE , t.amount, t.AccountId, if(t.PTYPE = "DEPOSIT", @running_total:=@running_total + t.amount, @running_total:=@running_total - t.amount) AS cumulative_sum FROM ( SELECT * FROM customermd_transactions ) t JOIN (SELECT @running_total:=0) r where t.AccountId = ? ORDER BY t.date
//     ', [$request->accountid]);
// }
// public function withdrawalTest(Request $request)
    // {
    //     dd($request->all());
    //     $mytime = Carbon::now()->format('Y-m-d');
    //     //$acno=$request->accntno;
    //     $acid=$request->accountid;
    //     $wdate=$request->doc;
    //     $acctdata=accountmaster::where('AccountId','=',$acid)->first();
    //     if($acctdata->AType=="DD"){
    //         $data=[
    //             'AccountId' =>  (Int)$acid,
    //             'WDate'     =>  $mytime,
    //             'WAmt'      =>  $request->amt,
    //             'WBankId'   =>  $request->bankid,
    //             'WChqNo'    =>  $request->chqno,
    //             'WChqDate'  =>  $request->chqdate,
    //             'Atype'     =>  'DD',
    //             'UserId'    =>   Auth()->user()->id,
    //         ];
    //         if($request->closeac=='y'){
    //             $data['remarks']='Closed Account';
    //         }else{
    //             $data['remarks']='Partial Withdrawal';
    //         }
    //         if($request->transferac!='0'){
    //             $data['AdjAccountId']=$request->transferac;
    //             $transferAType=accountmaster::where('AccountId',$request->transferac)->first();
    //             if($transferAType->AType=='DD'){
    //                 $slno=ddcollection::selectRaw('max(slno) + 1 as nextslno')->first();
    //                 $datadeposit=[
    //                     'AccountId' => $request->transferac,
    //                     'SlNo'      => $slno->nextslno,
    //                     'ColDate'   => $wdate,
    //                     //'WDate'     =>  $mytime,
    //                     'DAmt'      => $request->amt,
    //                     'UserId'    => Auth()->user()->id,
    //             ];
    //             $result=ddcollection::create($datadeposit);
    //             }elseif($transferAType->AType=='MD'){
    //                 $slno=rdcollection::selectRaw('max(slno) + 1 as nextslno')->first();
    //                 $datadeposit=[
    //                     'AccountId' => $request->transferac,
    //                     'SlNo'      => $slno->nextslno,
    //                     'ColDate'   =>  $wdate,
    //                     'DAmt'      =>  $request->amt,
    //                     'UserId'    =>  Auth()->user()->id,
    //                 ];
    //                 $result=rdcollection::create($datadeposit);
    //             }
    //         }
    //         $result=ddwithdrawal::create($data);
    //         if($request->closeac=='y'){
    //             $accountmaster= accountmaster::where('AccountId',$acid)->first();
    //             $accountmaster->Status='C';
    //             $accountmaster->save();
    //         }
    //         if($result){
    //             return response()->json(array('success'  => true,'msg'   =>  'Withdrawal Successfull'));
    //         }
    //     }
    //     if($acctdata->AType=="MD"){
    //         $data=[
    //             'AccountId' => (Int)$acid,
    //             'WDate'     =>  $wdate,
    //             'WAmt'      =>  $request->amt,
    //             'WBankId'   =>  $request->bankid,
    //             'WChqNo'    =>  $request->chqno,
    //             'WChqDate'  =>  $request->chqdate,
    //             'Atype'     =>  'MD',
    //             'UserId'    =>   Auth()->user()->id,
    //         ];
    //         if($request->closeac=='y'){
    //             $data['remarks']='Closed Account';
    //         }else{
    //             $data['remarks']='Partial Withdrawal';
    //         }
    //         if($request->transferac!='0'){
    //             $data['AdjAccountId']=$request->transferac;
    //             $transferAType=accountmaster::where('AccountId',$request->transferac)->first();
    //             if($transferAType->AType=='DD'){
    //                 $slno=ddcollection::selectRaw('max(slno) + 1 as nextslno')->first();
    //                 $datadeposit=[
    //                     'AccountId' => $request->transferac,
    //                     'SlNo'      => $slno->nextslno,
    //                     'ColDate'   =>  $wdate,
    //                     'DAmt'      =>  $request->amt,
    //                     'UserId'    =>  Auth()->user()->id,
    //                 ];
    //                 $result=ddcollection::create($datadeposit);
    //             }elseif($transferAType->AType=='MD'){
    //                 $slno=rdcollection::selectRaw('max(slno) + 1 as nextslno')->first();
    //                 $datadeposit=[
    //                     'AccountId' => $request->transferac,
    //                     'SlNo'      => $slno->nextslno,
    //                     'ColDate'   =>  $wdate,
    //                     'DAmt'      =>  $request->amt,
    //                     'UserId'    =>  Auth()->user()->id,
    //                 ];
    //                 $result=rdcollection::create($datadeposit);
    //             }
    //         }
    //         $result=Rdwithdrawal::create($data);
    //         if($request->closeac=='y'){
    //             $accountmaster= accountmaster::where('AccountId',$acid)->first();
    //             $accountmaster->status='C';
    //             $accountmaster->save();
    //         }
    //         if($result){
    //             return response()->json(array('success'  => true,'msg'   =>  'Withdrawal Successfull'));
    //         }
    //     }
    // }

