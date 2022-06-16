<?php

namespace App\Http\Controllers\Admin\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\dbo_loanmst;
use App\Models\Admin\dbo_loandtl;
use App\Models\Admin\dbo_loanapplication;
use App\Models\Admin\accountmaster;
use App\Models\Admin\ddcollection;
use App\Models\Admin\rdcollection;
use App\Models\Admin\Ddwithdrawal;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use App\Helpers\Helper;
use DateTime;


class Disbursement extends Controller
{
    public function index($id)
    {
        // dd("ok");
        $id=Crypt::decrypt($id);


        $values=DB::table('dbo_loanapplication')->where('LoanAppId',$id)->first();
        $MemberId=$values->MemberId;
        $values1=DB::table('dbo_loanapplicationdetail')->where('LoanAppId',$id)->first();
        $values2=DB::table('dbo_loanmst')->where('MemberId',$MemberId)->first();
        $Name=DB::table('accountmaster')->select('AccountName')->where('MemberId',$MemberId)->first();
        $Gauname=DB::table('accountmaster')->select('AccountName')->where('MemberId',$values->GuarantorId)->first();
        $acno=DB::table('accountmaster')->select('AccountNo','AType','AccountId')->where('MemberId',$values->MemberId)->get();
        $intst=DB::table('dbo_loantypemst')->where('loantypeid',$values->loantypeid)->first();
        $eomst=DB::table('eomst')->where('EOId',$values->AppUId)->first();
        $CenterName = DB::table('dbo_marketmst')->select('Market')->where('Eoid',$values->AppUId)->first();
        $purpose = DB::table('dbo_loanpurposemst')->where('LPurposeId',$values->PurposeId)->first();

        //dd($eomst);
        //dd($acno);
        foreach($acno as $ac){
        if($ac->AType=='DD'){
            $transactions = DB::select('
            SELECT t.date,t.PTYPE , t.amount, t.AccountId, if(t.PTYPE = "DEPOSIT", @running_total:=@running_total + t.amount, @running_total:=@running_total - t.amount) AS cumulative_sum FROM ( SELECT * FROM cust_trans_new ) t JOIN (SELECT @running_total:=0) r where t.AccountId = ? ORDER BY t.date
            ', [$values->AccountId]);
        }elseif($ac->AType=='MD'){
            $transactions = DB::select('
            SELECT t.date,t.PTYPE , t.amount, t.AccountId, if(t.PTYPE = "DEPOSIT", @running_total:=@running_total + t.amount, @running_total:=@running_total - t.amount) AS cumulative_sum FROM ( SELECT * FROM customermd_transactions ) t JOIN (SELECT @running_total:=0) r where t.AccountId = ? ORDER BY t.date
            ', [$values->AccountId]);
        }}
        //dd($transactions);
        $count=count($transactions)-1;
        if($values->MultipleDisbYN=='Y'){
            $muldis=DB::table('dbo_loanapplicationdetail')->where('LoanAppId',$id)->orderBy('SlNo')->get();
            return view('admin.Loan.disbursement',compact('values','values1','values2','Name','intst','eomst','CenterName','purpose','acno','count','transactions','Gauname','muldis'));
        }else{
            return view('admin.Loan.disbursement',compact('values','values1','values2','Name','intst','eomst','CenterName','purpose','acno','count','transactions','Gauname'));
        }


    }

    public function updateapprove(Request $request){
        // dd($request->all());
        if($request->Approve=='Y'){
            $disburs=$request->disburse_amt;
            if($disburs!=null){
          $len=count($disburs);
                for($i=0;$i< $len;$i++){
                    if($disburs[$i]){
                        $loandtl=[
                            'BreakupAmt'      => $disburs[$i],
                        ];
                        DB::table('dbo_loanapplicationdetail')->where('LoanAppId',$request->loan_app_no)->update($loandtl);
                    }
                }
            }

            DB::table('dbo_loanapplication')->where('LoanAppId',$request->loan_app_no)
            ->update(['Approved' => $request->Approve,'ApprovedAmt'=>$request->Aloan_amt]);
            return redirect()->route("admin.ApplicantList")->with("success", "Successfully Approved.");
        }else{
            DB::table('dbo_loanapplication')->where('LoanAppId',$request->loan_app_no)
            ->update(['Approved' => $request->Approve]);
            return redirect()->route("admin.ApplicantList")->with("success", "Successfully Canceled.");
        }
    }


    public function updatedisburs(Request $request){

        // if($request->Pro_fee > 0){
        //    dd($request->Pro_fee);
        // }else{
        //     dd("opps");
        // }
        // dd($request->all());
        $check=DateTime::createFromFormat('m-d-Y', $request->start_date)->format('Y-m-d');
        $flatallrecord=json_decode($request->flatarr[0], true);
        $redallrecord=json_decode($request->redarr[0], true);
        if($request->loan_type=='Flat'){
            $records= $flatallrecord;
        }else{
            $records= $redallrecord;
        }

        // dd( $redallrecord);
        //loan id &loan no generation
        $slno = dbo_loanmst::select('LoanId')->max('LoanId');
        $ary=explode("-",$slno);
        $lst=$ary[1]+1;
        $len=strlen((string)$lst);
        if($len==1){
            $loanId="111"."-"."0000"."$lst";
            $loanNo="111"."0000"."$lst";}
        if(($len)==2){
            $loanId="111"."-"."000"."$lst";
            $loanNo="111"."000"."$lst";}
        if(($len)==3){
            $loanId="111"."-"."00"."$lst";
            $loanNo="111"."00"."$lst";}
        if(($len)==4){
            $loanId="111"."-"."0"."$lst";
            $loanNo="111"."0"."$lst";}
        if(($len)==5){
            $loanId="111"."-"."$lst";
            $loanNo="111"."$lst";}
        //ends here
        DB::beginTransaction();
        try {
                DB::table('dbo_loanmst')->where('LoanAppId',$request->loan_app_no)->update(['Status'=>'C']);
                $temp=DB::table('dbo_loanmst')->select('LoanAmt')->where('LoanAppId',$request->loan_app_no)->first();
                if($temp!=null){
                    $temp=$temp->LoanAmt;
                }else{
                    $temp=0;
                }

                $loanmster=[
                    'LoanId'     => $loanId,
                    'LoanNo'     => $loanNo,
                    'LoanAppId'  => $request->loan_app_no,
                    'MemberId'   => $request->mem_no,
                    'LoanAmt'    => $temp+$request->disburse_amt,
                    'LoanDt'     => $check,
                    'IntAmt'     => $request->interest_amt,
                    'PstDtCheqe' => 'N',
                    'dose'       => 1,
                    'Period'     => $request->interest_period,
                    'IntRate'    => $request->rate_of_interest,
                    'LOSAmt'     => $request->Aloan_amt,        //starting amount
                    'IOSAmt'     => $request->interest_amt,    //starting interest
                    'LOSDate'    => $request->start_date,
                    'Status'     => 'O',
                    'procintfee' => $request->Pro_feep,
                    'procfee'    => $request->Pro_fee,
                    'rskint'     => "0",
                    'rskfee'     => "0",
                    'PurposeId'  => $request->pid,
                    'LoanTypeId' => $request->ltid,
                    'TotalInstNo'  => $request->installment_no,
                    'CashOrChq'    => $request->rdoPT,
                    'chqno'        => $request->chq_no,
                    'chqdt'        => $request->checquedt,
                    'BankId'       => $request->bank_id,
                    'SFId'         => $request->SFId,
                    'DevlopentAmt'      => 0,
                    'DevlopentP'        => 0,
                    'DeathP'            => 0,
                    'DeathAmt'          => 0,
                    'UpfP'              => 0,
                    'UpfAmt'            => 0,
                    'PenalRate'         => 0,
                    'PenalUnit'         => 'Year',
                    'LoanRegFee'        => 0,
                    'AdminCharge'       => 0,
                    'AdminChargeP'      => 0,
                    'BankCharge'        => 0,
                    'BankChargeP'       => 0,
                    'TSCharge'          => 0,
                    'TSChargeP'         => 0,
                    'RSchedule'         => 'M',
                    'DisburseAmt'       => $request->disburse_amt,
                    'DisburseSlNo'      => $request->dose,
                    'DisburseMode'      => 'S',//incomplete
                    // 'CashDisburse'      => $request->loan_no,
                    // 'ChqDisburse'       => $request->loan_no,
                    // 'MulIntAmt'         => $request->loan_no,
                    'InstallmentAmt'    => $request->MonthlyEMI,
                    'ac_no'             => $request->Ac_no,
                    'ac_id'             => $request->Ac_id
                ];
                // dd($loanmster);
                // DB::table('dbo_loanmst')->when('LoanAppId',$request->loan_app_no)->update(['Status'=>'C']);
                DB::table('dbo_loanmst')->insert($loanmster);
                $loanappdtl=[
                    'IsDisbursed'=>'Y',
                    'DisburseLoanId'=>$loanId,
                    'DisburseDate'  =>date('Y-m-d'),
                ];
                DB::table('dbo_loanapplicationdetail')->where('LoanAppId',$request->loan_app_no)
                                                            ->where('SlNo',$request->dose)
                                                            ->update($loanappdtl);
                $check=DB::table('dbo_loanapplicationdetail')->where('LoanAppId',$request->loan_app_no)->where('IsDisbursed','N')->first();
                // dd($check);
                // if($check->has('id')){
                if($check==null){
                    DB::table('dbo_loanapplication')->where('LoanAppId',$request->loan_app_no)
                    ->update(['Approved' =>'D']);
                }
                foreach($records as $key=>$rec){
                    $dt=DateTime::createFromFormat('m-d-Y', $rec[1])->format('Y-m-d');
                    $loandtl=[
                        'LoanId' => $loanId,
                        'InstNo' => $rec[0],
                        'ResAmt' => $rec[2],
                        'Outstanding' =>$rec[5],
                        'DueDt'       =>$dt,
                        'DefaultDate' =>$dt,
                        //  'RDt'
                        'PrinceAmt'   =>$rec[4],
                        'InstAmt'     =>$rec[3],
                        'Realised'    =>'N',
                    ];
                DB::table('dbo_loandtl')->insert($loandtl);
                }

                // Voucher Entry
                    $descidsub=DB::table('dbo_loanparameter')->where('LoanTypeid',$request->ltid)->first();
                    $naration='Being the amt of Loan Disbursed for '.$request->name.'Loan No ('.$request->loan_app_no.')';
                    $descid=['atcbhd08'=>'C0001', 'atcbdt'=>$descidsub->PrincipalLoanAc];
                    $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($request->accountid,$request->disburse_amt,$naration,'C','C','DC',$descid);
                    if($request->Pro_fee > 0){
                        $naration='Being the amt of Processing Fee collected for '.$request->name.'Loan No ('.$request->loan_app_no.')';
                        $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'C0001'];
                        $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($request->accountid,$request->Pro_fee,$naration,'C','D','DC',$descid);
                    }
                // Ends Here
                // DB::commit();
        }catch(\Exception $e)
        {

            // dd($e);
            DB::rollback();
            return redirect()->route("admin.ApplicantList")->with('error','Somthing Went Wrong....');
        }
        DB::commit();
        // dd("ok");
        return redirect()->route("admin.ApplicantList")->with("success", "Successfully Disbursed.");
    }


    public function approve($id)
    {
        $id=Crypt::decrypt($id);

        $values=DB::table('dbo_loanapplication')->where('LoanAppId',$id)->first();
        $MemberId=$values->MemberId;
        $muldis=DB::table('dbo_loanapplicationdetail')->where('LoanAppId',$id)->get();
        $values2=DB::table('dbo_loanmst')->where('MemberId',$MemberId)->first();
        $Name=DB::table('accountmaster')->select('AccountName')->where('MemberId',$values->MemberId)->first();
        $Gauname=DB::table('accountmaster')->select('AccountName')->where('MemberId',$values->GuarantorId)->first();
        $acno=DB::table('accountmaster')->select('AccountNo','AType','AccountId')->where('MemberId',$values->MemberId)->get();
        $intst=DB::table('dbo_loantypemst')->where('loantypeid',$values->loantypeid)->first();
        $eomst=DB::table('eomst')->where('EOId',$values->AppUId)->first();
        $CenterName = DB::table('dbo_marketmst')->select('Market')->where('Eoid',$values->AppUId)->first();
        $purpose = DB::table('dbo_loanpurposemst')->where('LPurposeId',$values->PurposeId)->first();



        return view('admin.Loan.approve',compact('values','muldis','values2','Name','intst','eomst','CenterName','purpose','acno','Gauname'));
    }


    public function availbalance(Request $request)
    {
        $amttilldate = Helper::GetAccountBal($request->id);
        return response()->json(['success'=>true,'transactions'=>collect($amttilldate)->last()]);
    }


    public function DisbursedList(Request $request){
        $loanofficer=DB::table('eomst')->get();
        $query8=DB::table('dbo_loanmst')->select('dbo_loanmst.*','membermaster.MemberName','dbo_loanapplication.AppUId','dbo_loanapplication.AppLoanNo')
                    ->join('membermaster','membermaster.MemberId','=','dbo_loanmst.MemberId')
                    ->join('dbo_loanapplication','dbo_loanapplication.LoanAppId','=','dbo_loanmst.LoanAppId')
                    // ->join('accountmaster','accountmaster.AccountId','dbo_loanmst.ac_id')
                    ->when($request->LoanId,function($query) use($request){
                    return $query->where('LoanId',$request->LoanId);
                    })
                    ->when($request->Loan_officer,function($query) use($request){
                    return $query
                                //  ->join('dbo_loanapplication','dbo_loanapplication.LoanAppId','=','dbo_loanmst.LoanAppId')
                                 ->where('dbo_loanapplication.AppUId',$request->Loan_officer);
                    })
                    ->when($request->LoanAmt,function($query) use($request){
                    return $query->where('dbo_loanmst.LoanAmt','LIKE','%'.$request->LoanAmt.'%');
                    })
                    ->when($request->MLoanId,function($query) use($request){
                    return $query->where('dbo_loanapplication.AppLoanNo',$request->MLoanId);
                        })
                    ->where('dbo_loanmst.Status','O')
                    ->orderby('LoanNo','DESC')
                    ->get();
        // dd($query8);
        return view('admin.Loan.activeloans',compact('query8','loanofficer'));
    }



    public function LoanEmi($id){
        $id = Crypt::decrypt($id);
        $keyLoan=DB::table('dbo_loanmst')->where('LoanId',$id)
                ->join('dbo_loanpurposemst','dbo_loanpurposemst.LPurposeId','dbo_loanmst.PurposeId')
                ->join('dbo_loantypemst','dbo_loantypemst.loantypeid','dbo_loanmst.LoanTypeId')
                ->first();
        $loanemi=DB::table('dbo_loandtl')->where('LoanId',$id)->get();
        $records=DB::table('collectiondtl')
                ->where('LoanId',$id)
                ->orderby('SlNo')
                ->get();

        $len=count($records)-1;
        //dd($records[$len]->PrincDue);
        $recovered=DB::table('collectiondtl')
                ->select(DB::raw('sum(collectiondtl.IntCollAmt) as tot_IntCollAmt'),DB::raw('sum(collectiondtl.PrinCollAmt) as tot_PrinCollAmt'),DB::raw('sum(collectiondtl.CollAmt) as total'))
                ->where('LoanId',$id)
                ->first();
        $acno=accountmaster::select('AccountNo','AccountId')->where('MemberId',$keyLoan->MemberId)->get();
        $acbal=Helper::GetAccountBal($keyLoan->ac_id);
        $flag=0;
        if(count($records)==0){
            $instno=1;
            $instno_v1=1;
            $principalout=0;
        }
        elseif(count($records)>=count($loanemi)){
            $flag=1;
            $instno=count($loanemi);
            $instno_v1=count($records)+1;
            $principalout=$records[$instno-2]->BalanceAmt;
        }
        else{
            $instno=count($records)+1;
            $instno_v1=count($records)+1;
            $principalout=$records[$instno-2]->BalanceAmt;
        }
        return view('admin.Loan.collect',compact('keyLoan','loanemi','instno','principalout','records','recovered','acno','acbal','len','instno_v1'));
    }


    public function ChangeACno(Request $request){
        $pieces = explode(" ",$request->ac_id);
        DB::table('dbo_loanmst')->where('LoanAppId',$request->app_no)->update(['ac_id'=>$pieces[0],'ac_no'=>$pieces[2]]);
        return redirect()->back()->with('success','Successfully changed A/C No');
    }


    public function SaveEmiDtl(Request $request){
        // dd($request->all());
            $balance=DB::table('collectiondtl')
                    ->where('LoanId',$request->loan_Id)
                    ->orderby('SlNo','DESC')
                    ->first();
            $validate=DB::table('dbo_loandtl')->where('LoanId',$request->loan_Id)->where('InstNo',$request->ins_no)->first();
            //dd($validate);
            DB::beginTransaction();
            try {
                if($balance==null){
                    $balance_1=$request->loan_amt-$request->c_prin;
                }else{
                    $balance_1=$balance->BalanceAmt-$request->c_prin;
                    if($balance_1<=0){
                        DB::table('dbo_loanmst')->where('LoanId',$request->loan_Id)->update(['Status'=>'C','ClosingType'=>'P']);
                    }
                }
                $PrincDue = 0;
                $InstDue  = 0;
                #Amount Validation
                    #if amt. is less
                    if($validate->PrinceAmt > $request->c_prin){
                    $PrincDue = $validate->PrinceAmt - $request->c_prin;
                    $PrincDue = $PrincDue + $balance->PrincDue;
                    }
                    if($validate->InstAmt > $request->c_intst){
                    $InstDue = $validate->InstAmt - $request->c_intst;
                    $InstDue = $InstDue + $balance->InstDue;
                    }
                    #else
                    if($validate->PrinceAmt < $request->c_prin){
                        $PrincDue = $request->c_prin - $validate->PrinceAmt;
                        $PrincDue = $balance->PrincDue - $PrincDue;
                        if($PrincDue<0){
                            $PrincDue=0;
                        }
                    }
                    if($validate->InstAmt < $request->c_intst){
                        $InstDue = $request->c_intst - $validate->InstAmt;
                        $InstDue = $balance->InstDue - $InstDue;
                        if($InstDue<0){
                            $InstDue=0;
                        }
                    }
                #Ends Here

                $value=[
                    'AccDate'        => $request->date,
                    'RecDate'        => $request->date,
                    'MemberId'       => $request->memberid,
                    'LoanId'         => $request->loan_Id,
                    'LoanTypeId'     => $request->loan_type,
                    'CollectionType' => 'F',
                    'NoofInst'       => $request->ins_no,
                    'BalanceAmt'     => $balance_1,
                    'IntCollAmt'     => $request->c_intst,
                    'PrinCollAmt'    => $request->c_prin,
                    'PenCollAmt'     => $request->c_penalty,
                    'CollAmt'        => $request->c_total,
                    'IntRate'        => $request->int_rt,
                    'SlNo'           => $request->ins_no,
                    'DescId'         => 'C0001',
                    'p_mode'         => $request->col_mode,
                    'CheckNo'        => $request->cheque_no,
                    'CheckDate'      => $request->checque_date,
                    'ac_type'        => $request->ac_type,
                    'ac_no'          => $request->ac_no,
                    'ac_id'          => $request->ac_id_v1,
                    'date'           => $request->cash_date,
                    'bank_name'      => $request->bank_name,
                    'PrincDue'       => $PrincDue,
                    'InstDue'        => $InstDue,
                    'TotalDue'       => $PrincDue+$InstDue
                ];

                if($request->col_mode=='T'){
                    $deductBal=Helper::WithdrowAmt($request->ac_id_v1,$request->c_total);
                    $acctdata=accountmaster::where('AccountId',$request->ac_id_v1)->first();
                    $actypeOP=$acctdata->AType;
                }elseif($request->col_mode=='C'){
                    $actypeOP="Cash";
                }elseif($request->col_mode=='B'){
                    $actypeOP="Bank";
                }
                DB::table('collectiondtl')->insert($value);


                // Voucher Entery
                $memname=accountmaster::where('MemberId',$request->memberid)->first();
                $descidsub=DB::table('dbo_loanparameter')->where('LoanTypeid',$request->loan_type)->first();
                // for interest
                    $naration='Being the Amt of Loan Interest Collection Adjusted With '.$actypeOP.' Amt. '.$memname->AccountName.' Loan Id '.$request->loan_Id;
                    $descid=['atcbhd08'=>'C0001', 'atcbdt'=>$descidsub->LoanIntAc];
                    $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($request->loan_Id,$request->c_intst,$naration,'J','D','DC',$descid);
                // for principal
                    $naration='Being the Amt of Loan Principal Collection Adjusted With '.$actypeOP.' Amt. '.$memname->AccountName.' Loan Id '.$request->loan_Id;
                    $descid=['atcbhd08'=>'C0001', 'atcbdt'=>$descidsub->PrincipalLoanAc];
                    $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($request->loan_Id,$request->c_prin,$naration,'J','D','DC',$descid);
                //

                DB::commit();
                return redirect()->back()->with("success", "EMI Collected Successfully...");
            }catch(\Exception $e)
            {
                // dd($e);
                DB::rollback();
                return redirect()->back()->with('error','Somthing Went Wrong....');
            }

        }


    public function CollectEmiAll(Request $request){

        DB::beginTransaction();
        try {

            $loan_id=$request->loanid;
            foreach($loan_id as $id){
                $slno=1;
                $records=DB::table('collectiondtl')->where('LoanId',$id)->max('SlNo');
                if($records!=null){
                    $slno=$slno+$records;
                }
                $loanemi=DB::table('dbo_loandtl')->where('LoanId',$id)->where('InstNo',$slno)->first();
                $mastdata=DB::table('dbo_loanmst')->where('LoanId',$id)->first();
                if($records!=null){
                    $balanceamt=DB::table('collectiondtl')->where('LoanId',$id)->where('SlNo',$records)->first();
                    $balance=$balanceamt->BalanceAmt;
                }else{
                    $balance=$mastdata->LoanAmt;
                }
                $EMI=$loanemi->InstAmt + $loanemi->PrinceAmt;
                $value=[
                    'AccDate'        => date("Y-m-d"),
                    'RecDate'        => date("Y-m-d"),
                    'MemberId'       => $mastdata->MemberId,
                    'LoanId'         => $loanemi->LoanId,
                    'LoanTypeId'     => $mastdata->LoanTypeId,
                    'CollectionType' => 'F',
                    'NoofInst'       => $slno+1,
                    'BalanceAmt'     => $balance-$loanemi->PrinceAmt,
                    'IntCollAmt'     => $loanemi->InstAmt,
                    'PrinCollAmt'    => $loanemi->PrinceAmt,
                    'PenCollAmt'     => 0,
                    'CollAmt'        => $EMI,
                    'IntRate'        => $mastdata->IntRate,
                    'SlNo'           => $slno+1,
                    'DescId'         => 'C0001'
                ];
                DB::table('collectiondtl')->insert($value);
                $deductBal=Helper::WithdrowAmt($mastdata->ac_id,$EMI);

                $acctdata=accountmaster::where('AccountId',$mastdata->ac_id)->first();
                if($acctdata->AType=="DD"){
                    $actypeOP='DD';
                }elseif($acctdata->AType=="RD"){
                    $actypeOP='MD';
                }
                $descidsub=DB::table('dbo_loanparameter')->where('LoanTypeid',$mastdata->LoanTypeId)->first();
                // dd($descidsub);
                // for interest
                $naration='Being the Amt of Loan Interest Collection Adjusted With '.$actypeOP.' Amt. '.$acctdata->AccountName.' Loan Id '.$id;
                $descid=['atcbhd08'=>'C0001', 'atcbdt'=>$descidsub->LoanIntAc];
                $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($mastdata->ac_id,$loanemi->InstAmt,$naration,'J','D','DC',$descid);
                // for principal
                $naration='Being the Amt of Loan Principal Collection Adjusted With '.$actypeOP.' Amt. '.$acctdata->AccountName.' Loan Id '.$id;
                $descid=['atcbhd08'=>'C0001', 'atcbdt'=>$descidsub->PrincipalLoanAc];
                $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($mastdata->ac_id,$loanemi->PrinceAmt,$naration,'J','D','DC',$descid);


            }
        }catch(\Exception $e){
            dd($e);
            DB::rollback();
            return redirect()->back()->with('error','Somthing Went Wrong....');
        }
        DB::commit();



        return redirect()->back()->with("success", "EMI Collected Successfully...");
    }


}


