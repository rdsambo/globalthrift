<?php

namespace App\Http\Controllers\Admin\loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\dbo_productmst;
use App\dbo_loantypemst;
use DB;
class loancontroller extends Controller
{
    public function index()
    {
        $product_data=dbo_productmst::all();
        //dd($product_data);
        return view('admin.Loan.loan_calculator',compact('product_data'));
    }

    public function getLoanType(Request $request){
        $loan_type = DB::table('dbo_loantypemst')->select('LoanType','loantypeid')->where('ProductId',$request->id)->get();
        if(!$loan_type->isEmpty()){
            return response()->json(['success'=>true,'loan_type'=>$loan_type]);
        }
        else{
            return response()->json(['success'=>false]);
        }

    }
    public function loanCalculate(Request $request){

        $loan_calculate = DB::table('dbo_loantypemst')->select('Loan_interest','Loan_duration','FlatLoanFlg','ReduceLoanFlg')->where('loantypeid',$request->id)->get();
        if(!$loan_calculate->isEmpty()){
        return response()->json(['success'=>true,'loan_calculate'=>$loan_calculate]);
         }
    }



}
