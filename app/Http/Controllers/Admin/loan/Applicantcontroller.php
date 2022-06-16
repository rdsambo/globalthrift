<?php

namespace App\Http\Controllers\Admin\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\dbo_loanapplication;
use Illuminate\Support\Facades\DB;

class Applicantcontroller extends Controller
{
    public function index()
    {

        // dd("ok");

        // "SELECT Purpose from LPurposeId where LPurposeId=$ID4";
        $query5 = DB::table('dbo_loanapplication')
            ->select("dbo_loanapplication.*", "accountmaster.*","dbo_loantypemst.LoanType","dbo_loanpurposemst.Purpose")
            ->join('accountmaster',
                   'dbo_loanapplication.AccountId',  '=', 'accountmaster.AccountId')
            ->join('dbo_loantypemst',
                   'dbo_loanapplication.loantypeid','=', 'dbo_loantypemst.loantypeid')
            ->join('dbo_loanpurposemst',
                   'dbo_loanapplication.PurposeId','=', 'dbo_loanpurposemst.LPurposeId')
            ->where('Cancel','N')
            ->whereNull('Approved')
            ->orderBy('LoanAppId')
            ->get();

            //dd($query5);

        $query6 = DB::table('dbo_loanapplication')
            ->select("dbo_loanapplication.*", "accountmaster.*","dbo_loantypemst.LoanType","dbo_loanpurposemst.Purpose")
            ->join('accountmaster',
                   'dbo_loanapplication.AccountId',  '=', 'accountmaster.AccountId')
            ->join('dbo_loantypemst',
                   'dbo_loanapplication.loantypeid','=', 'dbo_loantypemst.loantypeid')
            ->join('dbo_loanpurposemst',
                   'dbo_loanapplication.PurposeId','=', 'dbo_loanpurposemst.LPurposeId')
            ->where('Approved','Y')

            ->orderBy('AppDate','DESC')
            ->paginate(10);
        // dd($query6);

        // $query6 = DB::table('dbo_loanapplicationdetail')
        //         ->join('dbo_loanapplication','dbo_loanapplication.LoanAppId','dbo_loanapplicationdetail.LoanAppId')
        //         ->join('accountmaster',
        //          'dbo_loanapplication.AccountId',  '=', 'accountmaster.AccountId')
        //         ->join('dbo_loantypemst',
        //                 'dbo_loanapplication.loantypeid','=', 'dbo_loantypemst.loantypeid')
        //         ->join('dbo_loanpurposemst',
        //                 'dbo_loanapplication.PurposeId','=', 'dbo_loanpurposemst.LPurposeId')
        //         ->where('Approved','Y')
        //         ->orderBy('AppDate','DESC')
        //         ->paginate(10);
        // dd($query6);




		$query7 = DB::table('dbo_loanapplication')
            ->select("dbo_loanapplication.*", "accountmaster.*","dbo_loantypemst.LoanType","dbo_loanpurposemst.Purpose")
            ->join('accountmaster',
               'dbo_loanapplication.AccountId',  '=', 'accountmaster.AccountId')
            ->join('dbo_loantypemst',
               'dbo_loanapplication.loantypeid','=', 'dbo_loantypemst.loantypeid')
            ->join('dbo_loanpurposemst',
               'dbo_loanapplication.PurposeId','=', 'dbo_loanpurposemst.LPurposeId')
            ->where('Approved','N')
            ->orderBy('AppDate','DESC')
            ->paginate(10);


        // $query8 = DB::table('dbo_loanapplication')
        //     ->select("dbo_loanapplication.*", "accountmaster.*","dbo_loantypemst.LoanType","dbo_loanpurposemst.Purpose")
        //     ->join('accountmaster',
        //            'dbo_loanapplication.AccountId',  '=', 'accountmaster.AccountId')
        //     ->join('dbo_loantypemst',
        //            'dbo_loanapplication.loantypeid','=', 'dbo_loantypemst.loantypeid')
        //     ->join('dbo_loanpurposemst',
        //            'dbo_loanapplication.PurposeId','=', 'dbo_loanpurposemst.LPurposeId')
        //     ->where('Approved','D')
        //     ->orderBy('AppDate','DESC')
        //     ->paginate(10);

        //dd($query8);
        return view('admin.Loan.applicantlist',compact('query5','query6','query7'));
    }
    public function index2(Request $request)
    {
        //dd($freom,$to);

        // "SELECT Purpose from LPurposeId where LPurposeId=$ID4";
        $query5 = DB::table('dbo_loanapplication')
            ->select("dbo_loanapplication.*", "accountmaster.*","dbo_loantypemst.LoanType","dbo_loanpurposemst.Purpose")
            ->join('accountmaster',
                   'dbo_loanapplication.AccountId',  '=', 'accountmaster.AccountId')
            ->join('dbo_loantypemst',
                   'dbo_loanapplication.loantypeid','=', 'dbo_loantypemst.loantypeid')
            ->join('dbo_loanpurposemst',
                   'dbo_loanapplication.PurposeId','=', 'dbo_loanpurposemst.LPurposeId')
            ->where('Cancel','N')
            ->whereNull('Approved')
            ->where('dbo_loanapplication.AppDate',">=", $request->post_at)
            ->where('dbo_loanapplication.AppDate', "<=", $request->post_at_to_date)
            ->orderBy('LoanAppId')
            ->get();

            // dd($query5);

        // $query6 = DB::table('dbo_loanapplication')
        //     ->select("dbo_loanapplication.*", "accountmaster.*","dbo_loantypemst.LoanType","dbo_loanpurposemst.Purpose")
        //     ->join('accountmaster',
        //            'dbo_loanapplication.AccountId',  '=', 'accountmaster.AccountId')
        //     ->join('dbo_loantypemst',
        //            'dbo_loanapplication.loantypeid','=', 'dbo_loantypemst.loantypeid')
        //     ->join('dbo_loanpurposemst',
        //            'dbo_loanapplication.PurposeId','=', 'dbo_loanpurposemst.LPurposeId')
        //     ->where('Approved','Y')
        //     ->where('dbo_loanapplication.AppDate',">=", $request->post_at)
        //     ->where('dbo_loanapplication.AppDate', "<=", $request->post_at_to_date)
        //     ->orderBy('AppDate','DESC')
        //     ->paginate(10);

        $query6 = DB::table('dbo_loanapplicationdetail')
                ->join('dbo_loanapplication','dbo_loanapplication.LoanAppId','dbo_loanapplicationdetail.LoanAppId')
                ->join('accountmaster',
                 'dbo_loanapplication.AccountId',  '=', 'accountmaster.AccountId')
                ->join('dbo_loantypemst',
                        'dbo_loanapplication.loantypeid','=', 'dbo_loantypemst.loantypeid')
                ->join('dbo_loanpurposemst',
                        'dbo_loanapplication.PurposeId','=', 'dbo_loanpurposemst.LPurposeId')
                ->where('Approved','Y')
                ->where('dbo_loanapplication.AppDate',">=", $request->post_at)
                ->where('dbo_loanapplication.AppDate', "<=", $request->post_at_to_date)
                ->orderBy('AppDate','DESC')
                ->paginate(10);
        // dd($query6);


		$query7 = DB::table('dbo_loanapplication')
            ->select("dbo_loanapplication.*", "accountmaster.*","dbo_loantypemst.LoanType","dbo_loanpurposemst.Purpose")
            ->join('accountmaster',
               'dbo_loanapplication.AccountId',  '=', 'accountmaster.AccountId')
            ->join('dbo_loantypemst',
               'dbo_loanapplication.loantypeid','=', 'dbo_loantypemst.loantypeid')
            ->join('dbo_loanpurposemst',
               'dbo_loanapplication.PurposeId','=', 'dbo_loanpurposemst.LPurposeId')
            ->where('Approved','N')
            ->where('dbo_loanapplication.AppDate',">=", $request->post_at)
            ->where('dbo_loanapplication.AppDate', "<=", $request->post_at_to_date)
            ->orderBy('AppDate','DESC')
            ->paginate(10);



         $query8 = DB::table('dbo_loanapplication')
            ->select("dbo_loanapplication.*", "accountmaster.*","dbo_loantypemst.LoanType","dbo_loanpurposemst.Purpose")
            ->join('accountmaster',
                   'dbo_loanapplication.AccountId',  '=', 'accountmaster.AccountId')
            ->join('dbo_loantypemst',
                   'dbo_loanapplication.loantypeid','=', 'dbo_loantypemst.loantypeid')
            ->join('dbo_loanpurposemst',
                   'dbo_loanapplication.PurposeId','=', 'dbo_loanpurposemst.LPurposeId')
            ->where('Approved','D')
            ->where('dbo_loanapplication.AppDate',">=", $request->post_at)
            ->where('dbo_loanapplication.AppDate', "<=", $request->post_at_to_date)
            ->orderBy('AppDate','DESC')
            ->paginate(10);

        //dd($query5);

        return view('admin.Loan.applicantlist',compact('query5','query6','query7','query8'));


    }
}
