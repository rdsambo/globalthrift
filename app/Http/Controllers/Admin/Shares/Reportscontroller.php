<?php

namespace App\Http\Controllers\Admin\Shares;

use App\Http\Controllers\Controller;
use App\Models\Admin\eomaster;
use App\Models\Admin\dbo_loanapplication;
use App\Models\Admin\membermaster;
use App\Models\Admin\shares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reports\MonthMaster;
use App\Models\Admin\dbo_loanmst;
use App\Models\Admin\CollectionDtl;
use app\Models\Admin\Vw_Eo_balance;
use PDF;
use Carbon\Carbon;

class Reportscontroller extends Controller
{
    public function index(Request $request)
    {
        if ($request->get("export") == "excel") {
            return $this->exportExcel($request);
        } else if ($request->option == "MemberId") {
            $ShareList = shares::select('shares.*','membermaster.MemberName')->join('membermaster', 'membermaster.MemberId', '=', 'shares.MemberId')
                ->where('shares.MemberId', '=', $request->Member_id)
                ->paginate(100);
        } else if ($request->option == "MemberName") {
            $ShareList = shares::select('shares.*','membermaster.MemberName')->join('membermaster', 'membermaster.MemberId', '=', 'shares.MemberId')
                ->where('membermaster.MemberName', '=', $request->Member_id)
                ->paginate(100);
        } else {
            $ShareList = shares::select('shares.*','membermaster.MemberName')->join('membermaster', 'membermaster.MemberId', '=', 'shares.MemberId')->paginate(20);
        }
        return view('admin.reports.Shares.Share', compact('ShareList'));
    }
    private function exportExcel(Request $request)
    {
        $excel    = shares::join('membermaster', 'membermaster.MemberId', '=', 'shares.MemberId')->get();
        $fileName = 'tasks.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        );

        $columns = array('SL', 'Member ID', 'Member Name', 'No Of Shares', 'Price', 'Date of Purchase');

        $callback = function () use ($excel, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $count = 0;
            foreach ($excel as $task) {
                $count                   = $count + 1;
                $row['SL']               = $count;
                $row['Member ID']        = $task->MemberId;
                $row['Member Name']      = $task->MemberName;
                $row['No Of Shares']     = $task->shares;
                $row['Price']            = $task->shareamount;
                $row['Date of Purchase'] = $task->created_at;

                fputcsv($file, array($row['SL'], $row['Member ID'], $row['Member Name'], $row['No Of Shares'], $row['Price'], $row['Date of Purchase']));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function createPDF()
    {
        // retreive all records from db
        $data = shares::join('membermaster', 'membermaster.MemberId', '=', 'shares.MemberId')->get();

        // share data to view
        view()->share('employee', $data);
        $pdf = PDF::loadView('admin.reports.Shares.PDF', compact('data'));

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }

    public function MemberDetails(Request $request)
    {
        if ($request->Member_id != null) {
            $member = membermaster::where($request->option, '=', $request->Member_id)->paginate(1);
            //dd($member);
            return view('admin.reports.Shares.MemberDetails', compact('member'));
        } else {
            $member = membermaster::paginate(20);
            return view('admin.reports.Shares.MemberDetails', compact('member'));
        }
    }
    public function ViewDetails($id)
    {
        //dd($id);
        $member = membermaster::where('MemberId', $id)
            ->join('eo_group', 'eo_group.GroupId', '=', 'membermaster.GroupId')
            ->join('relationmaster', 'relationmaster.relation_id', '=', 'membermaster.NomRelationId')
            ->join('qualificationmaster', 'qualificationmaster.QualificationId', '=', 'membermaster.QualificationId')
            ->join('villagemaster', 'villagemaster.villageid', '=', 'membermaster.VillageId')
            ->join('occupationmst', 'occupationmst.occupationid', '=', 'membermaster.OccupationId')
            ->first();
        $document = 1;
        //$document = memberdocument::where('member_id',$id)->first();
        //dd($member);
        return view('admin.reports.Shares.IndividualMembers', compact('member', 'document'));
    }

    public function ShareCer($id)
    {
        $person = shares::where('shares.MemberId', $id)
            ->join('membermaster', 'membermaster.MemberId', '=', 'shares.MemberId')
            ->first();

        //dd($person);
        return view('admin.reports.Shares.Certificate', compact('person'));
    }

    public function LoanReports(Request $request)
    {
        // dd($request->Active);
        $loanofficer = DB::table('eomst')->get();
        $loantype=DB::table('dbo_loantypemst')->get();
        $query8      = DB::table('dbo_loanmst')->select('dbo_loanmst.*', 'membermaster.MemberName','dbo_loanapplication.AppUId','dbo_loanapplication.AppLoanNo')
            ->join('membermaster', 'membermaster.MemberId', '=', 'dbo_loanmst.MemberId')
            ->join('dbo_loanapplication', 'dbo_loanapplication.LoanAppId', '=', 'dbo_loanmst.LoanAppId')
            ->when($request->Active == 'O', function ($query) use ($request) {
                return $query->where('dbo_loanmst.Status', $request->Active);
            })
            ->when($request->Active == 'C', function ($query) use ($request) {
                return $query->where('dbo_loanmst.Status', $request->Active)
                    ->where('dbo_loanmst.ClosingType', 'P');
            })
            ->when($request->LoanNo, function ($query) use ($request) {
                return $query->where('LoanNo', $request->LoanNo);
            })
            ->when($request->Loan_officer, function ($query) use ($request) {
                return $query
                ->join('dbo_loanapplication', 'dbo_loanapplication.LoanAppId', '=', 'dbo_loanmst.LoanAppId')
                    ->where('dbo_loanapplication.AppUId', $request->Loan_officer);
            })
            ->when($request->LoanAmt, function ($query) use ($request) {
                return $query->where('dbo_loanmst.LoanAmt', 'LIKE', '%' . $request->LoanAmt . '%');
            })
            ->when($request->loantype, function ($query) use ($request) {
                return $query->where('dbo_loanmst.LoanTypeId', $request->loantype);
            })
            ->when($request->MLoanId,function($query) use($request){
                return $query->where('dbo_loanapplication.AppLoanNo',$request->MLoanId);
            })
            ->orderby('LoanNo', 'DESC')
            ->get();
        return view('admin.reports.Loan.allloan', compact('query8', 'loanofficer','loantype'));
    }

    public function PartyLedger($id){
        $PartyL=CollectionDtl::where('LoanId',$id)->orderby('SlNo')->get();
        $emi=dbo_loanmst::where('LoanId',$id)
                        ->join('dbo_loanapplication','dbo_loanapplication.LoanAppId','dbo_loanmst.LoanAppId')
                        ->join('dbo_loantypemst','dbo_loantypemst.loantypeid','dbo_loanapplication.loantypeid')
                        ->join('membermaster','membermaster.MemberId','dbo_loanapplication.MemberId')
                        ->first();

        // dd($emi);
        return view('admin.reports.Loan.partyledger',compact('PartyL','emi'));
    }

    public function LoanDetails(Request $request){
        $records=DB::table('collectiondtl')
        ->where('LoanId',$request->id)
        ->orderby('SlNo')
        ->get();
        if(!$records->isEmpty()){
            return response()->json(['success'=>true,'loan_calculate'=>$records]);
        }
        return response()->json(['success'=>false]);
    }
    public function LoWise(Request $request)
    {
        // dd($request->s_month);
        $loanofficer     = DB::table('eomst')->get();
        $loanofficer_dtl = DB::table('eomst')->get();
        $month = MonthMaster::get();
        $list=[];
        $test = eomaster::get();
        foreach($test as $t){
            $temp=dbo_loanapplication::join('dbo_loanmst','dbo_loanmst.LoanAppId', '=', 'dbo_loanapplication.LoanAppId')
                                    ->where('dbo_loanapplication.AppUId',$t->EOId)
                                    ->where('dbo_loanmst.Status','O');
            $count= $temp->count();
            $principal=$temp->sum('LoanAmt');
            $interest=$temp->sum('IntAmt');
            $tempII=dbo_loanapplication::join('dbo_loanmst','dbo_loanmst.LoanAppId', '=', 'dbo_loanapplication.LoanAppId')
                                    ->join('collectiondtl', 'collectiondtl.LoanId', '=', 'dbo_loanmst.LoanId')
                                    ->when($request->s_month, function ($query) use ($request) {
                                        return $query->whereBetween('AccDate',[$request->s_month,$request->e_month]);
                                    })
                                    ->where('dbo_loanapplication.AppUId',$t->EOId)
                                    ->where('dbo_loanmst.Status','O');
            $PrinCollAmt=$tempII->sum('PrinCollAmt');
            $IntCollAmt =$tempII->sum('IntCollAmt');
            $tp1=[
                'loid'=>$t->EOId,
                'name'=>$t->EOName,
                'number'=>$count,
                'totpri'=>$principal,
                'totint'=>$interest,
                'pri_coll'=>$PrinCollAmt,
                'int_coll'=>$IntCollAmt,
            ];
            array_push($list,$tp1 );

        }
        return view('admin.reports.Loan.lowise_loan', compact('loanofficer', 'loanofficer_dtl','list','month'));
    }

    public function PerLo(Request $request,$id){
      $loname=eomaster::join('dbo_marketmst','dbo_marketmst.MarketId','=','eomst.EOId')
                          ->where('eomst.EOId',$id)->first();
        $temp=dbo_loanmst::with(['avg_PrinCollAmt'=>function($q) use ($request){
                            $q->when($request->s_month, function ($query) use ($request) {
                                return $query->whereBetween('collectiondtl.AccDate',[$request->s_month,$request->e_month]);
                            });
                        }])
                        ->join('dbo_loanapplication','dbo_loanapplication.LoanAppId','=','dbo_loanmst.LoanAppId')
                        ->join('membermaster','membermaster.MemberId','=','dbo_loanmst.MemberId')
                        ->where('dbo_loanmst.Status','O')
                        ->where('dbo_loanapplication.AppUId',$id)
                        ->get();
        return view('admin.reports.Loan.per_lowise_loan',compact('temp','loname','id'));
    }


    public function LoWiseDeposit(Request $request)
    {
        $amount=[];
        $fromdate=date('Y-m-d');
        $todate  =date('Y-m-d');
        if(isset($request->s_month)){
            $fromdate=$request->s_month;
        }
        if(isset($request->e_month)){
            $todate=$request->e_month;
        }
        $flag=0;
        if(isset($request->Collection)){
            if($request->Collection=="DD"){
                $flag=1;
                $rdcoll=0;
            }else{
                $flag=2;
                $ddcoll=0;
            }
        }
        $lo=eomaster::with('lowisemem','lowiseac')->get();
        if($flag!=2){
            $ddcoll= db::table('vw_ddcol_eo')
                    ->select('EOId',DB::raw('sum(DAmt) as totalAmt'))
                    ->whereBetween(DB::raw("str_to_date(ColDate, '%Y-%m-%d')"), [$fromdate, $todate])
                    ->groupBy('EOId')->get();
        }if($flag!=1){
            $rdcoll= db::table('vw_rdcol_eo')
                    ->select('EOId',DB::raw('sum(DAmt) as totalAmt'))
                    ->whereBetween(DB::raw("str_to_date(ColDate, '%Y-%m-%d')"), [$fromdate, $todate])
                    ->groupBy('EOId')->get();
        }
        return view('admin.reports.Lo.lowise_deposit',compact('lo','amount','ddcoll','rdcoll','flag','fromdate','todate'));
    }

}
