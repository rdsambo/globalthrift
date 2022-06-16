<?php

namespace App\Http\Controllers\Admin\loan;
use App\Models\Admin\dbo_loanapplication;
use App\Models\Admin\accountmaster;
use App\Models\Admin\ddcollection;
use App\Models\Admin\rdcollection;
use App\Models\Admin\Ddwithdrawal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\Helper;
class accountholderloa extends Controller
{
    public function index()
    {
        $records = DB::table("accountmaster")
        ->select("AccountId","AccountNo","AccountName","Gender", DB::raw("DATE_FORMAT(EntryDate, '%d-%m-%Y') AS EntryDate,MemberId"))
        ->orderBy("AccountId", "asc")
        ->paginate(100);
        //dd($records);
        return view('admin.Loan.accountlist', compact('records'));
    }
    //for filter accountlist
    public function filter(Request $request)
    {
        $records = DB::table("accountmaster")
        ->select("AccountId","AccountNo","AccountName","Gender", DB::raw("DATE_FORMAT(EntryDate, '%d-%m-%Y') AS EntryDate,MemberId"))
        ->where($request->SearchBy,$request->valueToSearch)
        ->orderBy("AccountId", "asc")
        ->paginate(100);
        //dd($records);
        return view('admin.Loan.accountlist', compact('records'));

    }



    //apply for loan
    public function apply($id,$name,$AcNo,$MemId){
        $date = Carbon::now();
        $fyr = $this->CurrentFinancialSFYear($date);
        $app_id = $this->GenerateAppId($fyr);
        $J1 = $this->GenerateAppId1();
        // foreach($J1 as $j){
        //     dd($j->sl);
        // }
        //dd($id);
        $amttilldate = Helper::GetAccountBal($id);
        $loanofficer = DB::table('eomst')->select('EOId','EOName')->get();
        $gaurenter   = DB::table('accountmaster')->select('MemberId','AccountName')->orderBy("MemberId", "asc")->get();
        $loanscheme  = DB::table('dbo_loantypemst')->select('loantypeid','LoanType','ProductId')->get();
        $purpose     = DB::table('dbo_loanpurposemst')->select('Purpose','LPurposeId')->get();
        $Business    = DB::table('dbo_businesstypemst')->select('BusinessTypeId','BusinessType')->get();
        $loanamount  = DB::table('dbo_loanmst')->select('LoanAmt','LoanNo')->where('MemberId',$id)->first();
        //dd($loanamount);

        return view('admin.Loan.Loan_apply', compact('id','name','MemId','AcNo', 'loanofficer','gaurenter','loanscheme','purpose','Business','loanamount','app_id','J1','amttilldate'));
    }

    //Show gauranter name
    public function mname(Request $request){
        $GauName = DB::table('accountmaster')->select('AccountName')->where('MemberId',$request->id)->first();
        return response()->json(['success'=>true,'GauName'=>$GauName]);
    }

    public function CurrentFinancialSFYear($date){
        $month = date('m', strtotime($date));
        $Y = date('Y', strtotime($date));
        $y = date('y', strtotime($date));
            if (intval($month) >= 4) {      //On or After April (FY is current year - next year)
                $financial_year = $y . '-' . ($y+1);
            } else {                        //On or Before March (FY is previous year - current year)
                $financial_year = ($y-1) . '-' . $y;
            }

             return $financial_year;
        }

    public function GenerateAppId($fyr)
    {
		$query = DB::select("SELECT ifnull(max(cast(right(`LoanAppId`,6) as SIGNED)),0)+1 as sl FROM dbo_loanapplication where left(LoanAppId,5) = '".$fyr."'");
        $sql = "SELECT ifnull(max(cast(right(`LoanAppId`,6) as SIGNED)),0)+1 as sl FROM dbo_loanapplication where left(LoanAppId,5) = '".$fyr."'";
        // $result = mysqli_query($cn, $sql);
		 $row = $query[0]->sl;
        $n = $row;
        $z = "";
        for($c = strlen($n);$c<6;$c++)
        {
            $z.="0";
        }
        $app_id =  $fyr."/".$z.$n;
        return $app_id;
    }

    public static function GenerateAppId1(){
        // global $cn;
        $sql1=DB::select("select max(cast(AppLoanNo AS SIGNED))+1 AS sl from dbo_loanapplication");
        //$sql1 = "select max(cast(AppLoanNo AS SIGNED))+1 AS sl from dbo_loanapplication";
        // if ($result1 = mysqli_query($cn, $sql1)) {
        //   while ($row = mysqli_fetch_assoc($result1)) {
        //     $n = $row['sl'];
        //       }
        //    }
        return $sql1;
    }

    public function center(Request $request){
        $CenterName = DB::table('dbo_marketmst')->select('Eoid','Market')->where('Eoid',$request->id)->get();
        return response()->json(['success'=>true,'CenterName'=>$CenterName]);
    }


    public function GuarantorDetails(Request $request){
        $ac_id=accountmaster::select('AccountId','AccountNo')->where('MemberId',$request->id)->get();
        $json_send=[];
        foreach($ac_id as $acid){
            $amttilldate = Helper::GetAccountBal($request->id);
            $data=[
                'acno'=>$acid->AccountNo,
                'bal' =>$amttilldate
            ];
            array_push($json_send,$data);
            // return response()->json(array('success' => true, 'accdata' => $acctdata,'totamt'  =>  $amttilldate));
        }
        $status=dbo_loanapplication::where('GuarantorId',$request->id)->count();
        return response()->json(['success'=>true,'values'=>$json_send,'status'=>$status]);
    }


    public function group(Request $request){
        //$sql = "SELECT GroupId,GroupName,GroupCode FROM groupmst WHERE EOId=".$eo;
        $group = DB::table('groupmst')->select('GroupId','GroupName','GroupCode')->where('EOId',$request->id)->get();
        //dd($group);
        return response()->json(['success'=>true,'group'=>$group]);
    }
    public function submit(Request $request,$id){
        // dd("ok");
        if($request->app_loan_amt==array_sum($request->dis_amt)){
            if($request->muldis=='Y'){
                $len=count($request->dis_amt);
                $disburs=$request->dis_amt;
                for($i=0; $i < $len; $i++){
                    $loandtl=[
                        'LoanAppId'       => $request->app_no,
                        'SlNo'            => $i+1,
                        'LoanAppAmt'      => $request->app_loan_amt,
                        'BreakupAmt'      => $disburs[$i],
                        'IsDisbursed'     => 'N',
                    ];
                // dump($loandtl);
                DB::table('dbo_loanapplicationdetail')->insert($loandtl);
                }
            }
            // dd($len);
            DB::table('dbo_loanapplication')->insert(['LoanAppId'=>$request->app_no,
                                                      'AppDate'=>$request->DOV,
                                                      'MemberId'=>$request->mem_no,
                                                      'GuarantorId'=>$request->guarantor_no,
                                                      'loantypeid'=>$request->loan_scheme,
                                                      'LoanAppAmt'=>$request->app_loan_amt,
                                                      'Cancel'=>'N',
                                                      'AppUId'=>$request->sel_officer,
                                                      'PurposeId'=> $request->loan_purpose,
                                                      'IncomeType'=>'M',
                                                      'BusinessType'=>$request->business_type,
                                                      'AppLoanNo'=>$request->loan_no,
                                                      'MultipleDisbYN'=>$request->muldis,
                                                      'loantype'=>$request->loan_type,
                                                      'AccountId'=>$id]);
           return redirect()->route("admin.AccountholderList")->with("success", "Successfully applied.");;
        }else{
            dd("Data Mismatched");
        }
    }
    public function DisbursedList(){
        dd("OK");
    }
}
