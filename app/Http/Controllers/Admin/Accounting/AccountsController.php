<?php

namespace App\Http\Controllers\Admin\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\atcbhd08;
use App\Models\Admin\atcbdt;
use App\Models\Admin\achead;
use App\Models\Admin\acgroup;
use App\Models\Admin\acsubgrp;
use App\Models\Admin\acgenled;
use DB;

class AccountsController extends Controller
{
    public function DailyCashbookSummery(Request $request){
        $fromdate=date('Y-m-d');
        $todate  =date('Y-m-d');
        if(isset($request->s_month)){
            $fromdate=$request->s_month;
        }
        if(isset($request->e_month)){
            $todate=$request->e_month;
        }
        // $summary=atcbdt::groupby(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"))
        //                     ->whereBetween(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"), [$fromdate, $todate])
        //                     ->join('acgenled','acgenled.DescId','=','atcbdt.DescId')
        //                     ->join('acsubgrp','acsubgrp.AcSubGrpId','=','acgenled.AcSubGrpId')
        //                     ->groupby('SubGrp')
        //                     ->selectRaw("sum(CASE WHEN DrCr='D' THEN Amt ELSE 0 END) as totaldr,
        //                                sum(CASE WHEN DrCr='C' THEN Amt ELSE 0 END) as totalcr,VoucherDt,SubGrp,acgenled.DescId")
        //                     ->get();

        $summary=atcbdt::groupby(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"))
                            ->whereBetween(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"), [$fromdate, $todate])
                            ->join('acgenled','acgenled.DescId','=','atcbdt.DescId')
                            // ->join('acsubgrp','acsubgrp.AcSubGrpId','=','acgenled.AcSubGrpId')
                            ->groupby('acgenled.DescId')
                            ->selectRaw("sum(CASE WHEN DrCr='D' THEN Amt ELSE 0 END) as totaldr,
                                       sum(CASE WHEN DrCr='C' THEN Amt ELSE 0 END) as totalcr,VoucherDt,acgenled.Desc,acgenled.DescId")
                            ->get();
        // dd($summary)
        $drAmt=atcbdt::where(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"),'<',$fromdate)->where('DrCr','D')
                        ->selectRaw('sum(Amt) as totalamt')->first();
        $crAmt=atcbdt::where(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"),'<',$fromdate)->where('DrCr','C')
                        ->selectRaw('sum(Amt) as totalamt')->first();
        $ob_til=$crAmt->totalamt-$drAmt->totalamt;
        return view('admin.accounting.daily_cashbook_sum',compact('summary','ob_til'));
    }

    public function CashbookPerDate(Request $request){
        $fromdate=date('Y-m-d');
        $todate  =date('Y-m-d');
        if(isset($request->s_month)){
            $fromdate=$request->s_month;
        }
        if(isset($request->e_month)){
            $todate=$request->e_month;
        }
        $cbperdate=atcbdt::select('atcbdt.*','acsubgrp.SubGrp')
                            ->whereBetween(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"), [$fromdate, $todate])
                            ->join('acgenled','acgenled.DescId','=','atcbdt.DescId')
                            ->join('acsubgrp','acsubgrp.AcSubGrpId','=','acgenled.AcSubGrpId')
                            ->orderby('VoucherDt')->get();

        // if(isset($cbperdate[0]->id)){

        //     $ob_till=$cbperdate[0]->id;
        // }else{
        //     // dd($fromdate);
        //     $ob_till=atcbdt::where(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"),'<',$fromdate)
        //                     ->max('id');
        // }
        $drAmt=atcbdt::where(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"),'<',$fromdate)->where('DrCr','D')
                        ->selectRaw('sum(Amt) as totalamt')->first();
        $crAmt=atcbdt::where(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"),'<',$fromdate)->where('DrCr','C')
                        ->selectRaw('sum(Amt) as totalamt')->first();
        $ob_til=$crAmt->totalamt-$drAmt->totalamt;
        // dd( $drAmt,$crAmt);
        // dd($ob_til);
        return view('admin.accounting.cashbook_perday',compact('cbperdate','fromdate','ob_til','todate'));
    }


    public function CashVoucher(Request $request){
        $voucher_no=\App\Helpers\Helper::nextslno_c('C');

        // $voucher_no=$voucher_no['VoucherNo'];
        $descids=acgenled::get();
        $balance=\App\Helpers\Helper::balance_till('C');
        return view('admin.accounting.voucher.cash_voucher',compact('voucher_no','balance','descids'));
    }

    public function BankVoucher(Request $request){
        $bankname=acsubgrp::where('AcSubGrpId',4)->with('acledger')->first();
        $voucher_no=\App\Helpers\Helper::nextslno_c('B');
        // dd($voucher_no);
        // $voucher_no=$voucher_no['VoucherNo'];
        $balance=\App\Helpers\Helper::balance_till('B');
        return view('admin.accounting.voucher.bank_voucher',compact('voucher_no','balance','bankname'));
    }

    public function JournalEntry(Request $request){ //Check is N or Else
        $voucher_no=\App\Helpers\Helper::nextslno_c('N');
        $voucher_no=$voucher_no['VoucherNo'];
        $balance=\App\Helpers\Helper::balance_till('N');
        return view('admin.accounting.voucher.journal_entry',compact('voucher_no','balance'));
    }

    public function ContraEntry(Request $request){ ///Check is N or Else
        $voucher_no=\App\Helpers\Helper::nextslno_c('N');
        $voucher_no=$voucher_no['VoucherNo'];
        $balance=\App\Helpers\Helper::balance_till('N');
        return view('admin.accounting.voucher.contra_entry',compact('voucher_no','balance'));
    }

    public function VoucherSave(Request $request){
        // dd($request->all());
        DB::beginTransaction();
        try {
            $datashare=[
                'HeadId'        =>  $request->HeadId,
                'TType'         =>  $request->Ttype,
                'VoucherNo'     =>  $request->voucher_no,
                'VoucherDt'     =>  $request->voucher_date,
                'Amt'           =>  $request->amount,
                'DC'            =>  $request->d_c,
                'DescId'        =>  $request->descid,
                // 'RefType'       =>  $RefType,
                // 'ReffId'        =>  $memid,
                'Narration'     =>  $request->narration,
                'IntNo'         =>  0,
                'lslno'         =>  $request->lslno,
            ];
            atcbhd08::create($datashare);
            if($request->d_c=="D"){
                $dc0='C';
            }else{
                $dc0='D';
            }

            $datashare2=[
                'DtlId'         =>  $request->HeadId,
                'HeadId'        =>  $request->HeadId,
                'Type'          =>  $request->Ttype,
                'VoucherNo'     =>  $request->voucher_no,
                'VoucherDt'     =>  $request->voucher_date,
                'Amt'           =>  $request->amount,
                'DrCr'          =>  $dc0,
                'DescId'        =>  $request->descid,
                // 'RefType'       =>  $RefType,
                'Narration'     =>  $request->narration,
            ];
            atcbdt::create($datashare2);
            DB::commit();
            return redirect()->back()->with('success','successfully Done Voucher Entry');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error','Something Went Wrong');

        }
    }

    public function LedgerMaster(Request $request){
         $achead=achead::with('acgroup.acsubgroup.acledger')->get();
        // $achead1=acgroup::with('acsubgroup')->get();
        // dd($achead);
        return view('admin.accounting.ledgermaster',compact('achead'));
    }

    public function BalanceSheetDtl(Request $request){
        $fromdate=date('Y-m-d');
        $todate  =date('Y-m-d');
        if(isset($request->s_month)){
            $fromdate=$request->s_month;
        }
        if(isset($request->e_month)){
            $todate=$request->e_month;
        }
        $achead=achead::with('acgroup.acsubgroup.acledger')
                        // ->whereBetween(DB::raw("str_to_date(atcbdt.VoucherDt, '%Y-%m-%d')"), [$fromdate, $todate])
                        ->get();

        return view('admin.accounting.balancesheetdetail',compact('achead','fromdate','todate'));
   }

    public function BankBook(Request $request){
        $banks=acsubgrp::where('AcSubGrpId',4)->with('acledger')->first();
        return view('admin.accounting.bankbook',compact('banks'));

    }
    public function BankBookDtl(Request $request){ //'G0047'
        // $fromdate=date('Y-m-d');
        // $todate  =date('Y-m-d');
        // if(isset($request->s_month)){
        //     $fromdate=$request->s_month;
        // }
        // if(isset($request->e_month)){
        //     $todate=$request->e_month;
        // }
        $heading = acgenled::where('DescId',$request->t1)->first();
        $values  = atcbdt::where('DescId',$request->t1)
                            ->whereBetween(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"), [$request->s_date, $request->e_date])
                            ->get();
        return response()->json(array('success'=>$heading,'data'=>$values));
    }
    public function ProfitLoss(Request $request){
        // dd("ok");
        $fromdate=date('Y-m-d');
        $todate  =date('Y-m-d');
        if(isset($request->s_month)){
            $fromdate=$request->s_month;
        }
        if(isset($request->e_month)){
            $todate=$request->e_month;
        }
        $income=acgroup::join('acsubgrp','acsubgrp.AcGroupId','=','acgroup.ACGroupId')
                        ->join('acgenled','acgenled.AcSubGrpId','=','acsubgrp.AcSubGrpId')
                        ->join('atcbdt','atcbdt.DescId','=','acgenled.DescId')
                        ->where('acgroup.ACHeadId',3)
                        ->whereBetween(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"), [$fromdate, $todate])
                        ->groupby('acsubgrp.AcSubGrpId')
                        ->groupby('acgenled.DescId')
                        ->selectRaw("sum(CASE WHEN DrCr='D' THEN Amt ELSE 0 END) as totaldr,
                                   sum(CASE WHEN DrCr='C' THEN Amt ELSE 0 END) as totalcr,acsubgrp.SubGrp,acgenled.Desc,acgenled.DescId")
                        ->get();

        $expanse=acgroup::join('acsubgrp','acsubgrp.AcGroupId','=','acgroup.ACGroupId')
                        ->join('acgenled','acgenled.AcSubGrpId','=','acsubgrp.AcSubGrpId')
                        ->join('atcbdt','atcbdt.DescId','=','acgenled.DescId')
                        ->groupby('acsubgrp.AcSubGrpId')
                        ->where('acgroup.ACHeadId',2)
                        ->whereBetween(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"), [$fromdate, $todate])
                        ->groupby('acgenled.DescId')
                        ->selectRaw("sum(CASE WHEN DrCr='D' THEN Amt ELSE 0 END) as totaldr,
                                   sum(CASE WHEN DrCr='C' THEN Amt ELSE 0 END) as totalcr,acsubgrp.SubGrp,acgenled.Desc,acgenled.DescId")
                        ->get();
        return view('admin.accounting.profitnloss',compact('income','expanse'));
    }

    public function GeneralLedger(Request $request){
        // dd("ok");
        $fromdate=date('Y-m-d');
        $todate  =date('Y-m-d');
        if(isset($request->s_month)){
            $fromdate=$request->s_month;
        }
        if(isset($request->e_month)){
            $todate=$request->e_month;
        }
        $generalled=atcbdt::where('DescId','G0040')
                        ->whereBetween(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"), [$fromdate, $todate])
                        ->get();
        // dd($generalled);
        $drAmt=atcbdt::where('DescId','G0040')->where(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"),'<',$fromdate)->where('DrCr','D')
                        ->selectRaw('sum(Amt) as totalamt')->first();
        $crAmt=atcbdt::where('DescId','G0040')->where(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"),'<',$fromdate)->where('DrCr','C')
                        ->selectRaw('sum(Amt) as totalamt')->first();
        $ob_til=$drAmt->totalamt-$crAmt->totalamt;
        return view("admin.accounting.general_ledger",compact('generalled','ob_til'));
    }

    public function LedgerSummery(Request $request){
        // dd("ok");
        $fromdate=date('Y-m-d');
        $todate  =date('Y-m-d');
        if(isset($request->s_month)){
            $fromdate=$request->s_month;
        }
        if(isset($request->e_month)){
            $todate=$request->e_month;
        }
        $ledsumm1=atcbdt::whereIn('atcbdt.DescId',['C0001','G0002','G0086','G0157','G0165'])
                    ->join('acgenled','acgenled.DescId','=','atcbdt.DescId')
                    ->groupby('atcbdt.DescId')
                    ->whereBetween(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"), [$fromdate, $todate])
                    ->groupby('VoucherDt')
                    ->selectRaw("sum(CASE WHEN DrCr='D' THEN Amt ELSE 0 END) as totaldr,
                                   sum(CASE WHEN DrCr='C' THEN Amt ELSE 0 END) as totalcr,atcbdt.VoucherDt,atcbdt.DescId,acgenled.Desc")
                    ->get();
        // dd($ledsumm1);
        return view("admin.accounting.ledger_summery",compact('ledsumm1'));
    }
    public function MemberSavings(Request $request){
        // dd($request->all());
        $fromdate=date('Y-m-d');
        $todate  =date('Y-m-d');
        if(isset($request->s_month)){
            $fromdate=$request->s_month;
        }
        if(isset($request->e_month)){
            $todate=$request->e_month;
        }

        $savings_rep=DB::table('cust_trans_new')->groupby('AccountId')
                        ->join('accountmaster','accountmaster.AccountId','=','cust_trans_new.AccountId')
                        ->whereBetween(DB::raw("str_to_date(date, '%Y-%m-%d')"), [$fromdate, $todate])
                        ->selectRaw("sum(CASE WHEN PTYPE ='WITHDRAWAL' THEN amount ELSE 0 END) as returned,
                                     sum(CASE WHEN PTYPE ='DEPOSIT' THEN amount ELSE 0 END) as collected,cust_trans_new.AccountId,AccountName,AccountNo")
                        ->get();
        // dd($savings_rep);
        return view("admin.accounting.member_savings",compact('savings_rep'));
    }

}
