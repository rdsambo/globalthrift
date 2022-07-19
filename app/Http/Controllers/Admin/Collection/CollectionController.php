<?php

namespace App\Http\Controllers\Admin\Collection;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Admin\accountmaster;
use App\Models\Admin\atcbhd08;
use App\Models\Admin\ddcollection;
use App\Models\Admin\rdcollection;
use App\Models\TempDeposite;
use App\User;
use Illuminate\Http\Request;

class CollectionController extends Controller
{

    public $pagignate=20;
    public function index()
    {
        $role = 'lo';
        $lo   = User::where('role', $role)->get();

        if (request('collection_type')) {
            $temp_deposite = TempDeposite::query()
                ->with('user', 'account_no')
                ->customFilter()
                ->paginate('20');

        }else{

            $temp_deposite = TempDeposite::query()
                ->with('user', 'account_no')
                ->where('collection_type', 'DD')
                ->customFilter()
                ->paginate('20');

        }

        // dd($temp_deposite);
        return view('admin.collection.index', compact('temp_deposite', 'lo'));

    }

    public function store(Request $request)
    {
        // dd("ok");
        $lenght = count($request->id);
        // dd($lenght);
        for ($i = 0; $i < $lenght; $i++) {

            $value = TempDeposite::where('id', $request->id[$i])->first();

            if ($value->collection_type == 'DD') {
                $account_details = accountmaster::where('id', $value->accountmaster_id)->first();

                $nextslno = ddcollection::selectRaw('max(slno) + 1 as nextslno')
                    ->where('accountid', $value->accountmaster_id)->first();

                $data = [
                    'AccountId' => $account_details->AccountId,
                    'slno'      => $nextslno->nextslno,
                    'damt'      => $value->deposite_amount,
                    'userid'    => Auth()->user()->id,
                    'ColDate'   => $value->collected_date,
                ];

                $memberdetails = accountmaster::where('accountid', $account_details->AccountId)->first();
                // dump($memberdetails->AccountName);
                // $mnextslno  = atcbhd08::selectRaw('max(lslno) + 1 as nextslno')->first();
                // $acct       = str_pad($mnextslno->nextslno, 7, '0', STR_PAD_LEFT);
                // $fnyr       = explode("-", Helper::getFinYear()->finyear);
                // $fyr1       = substr($fnyr[0], 2, 2);
                // $voucherno  = 'C/111-' . $acct . "/" . $fyr1 . "-" . $fnyr[1];
                // $headid     = atcbhd08::selectRaw('max(SUBSTRING_INDEX(HeadId, "-" , -1)) + 1 as nextheadid')->first();
                // $nextheadid = '111-' . str_pad($headid->nextheadid, 8, 0, STR_PAD_LEFT);

                // $datavoucher = [
                //     'HeadId'    => $nextheadid,
                //     'TType'     => 'C',
                //     'VoucherNo' => $voucherno,
                //     'Amt'       => $request->amt,
                //     'DC'        => 'D',
                //     'DescId'    => 'C0001',
                //     'RefType'   => 'DC',
                //     'ReffId'    => $account_details->AccountId . "-" . $nextslno->nextslno,
                //     'Narration' => 'Being the amt of Daily Deposit received from ' . $account_details->AccountId,
                //     'IntNo'     => 0,
                //     'finyear'   => Helper::getFinYear()->finyear,
                //     'lslno'     => $mnextslno->nextslno,
                // ];

                $result = ddcollection::create($data);

                // if ($result) {
                //     atcbhd08::create($datavoucher);
                // }

                $naration='Being the amt of Daily Deposit received from ' . $account_details->AccountName.($account_details->AccountId);
                $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'C0001'];
                $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($account_details->AccountId,$request->amt,$naration,'C','D','DC',$descid);


                TempDeposite::where('id', $request->id[$i])->update(['transfer_status' => 1]);
            } else {

                $account_details = accountmaster::where('id', $value->accountmaster_id)->first();

                $nextslno = rdcollection::selectRaw('max(slno) + 1 as nextslno')
                    ->where('accountid', $request->accntno)->first();

                $data = [
                    'AccountId' => $account_details->AccountId,
                    'slno'      => $nextslno->nextslno,
                    'damt'      => $value->deposite_amount,
                    'userid'    => Auth()->user()->id,
                    'ColDate'   => $value->collected_date,
                ];

                $memberdetails = accountmaster::where('accountid', $account_details->AccountId)->first();
                // dump($memberdetails->AccountName);
                // $mnextslno  = atcbhd08::selectRaw('max(lslno) + 1 as nextslno')->first();
                // $acct       = str_pad($mnextslno->nextslno, 7, '0', STR_PAD_LEFT);
                // $fnyr       = explode("-", Helper::getFinYear()->finyear);
                // $fyr1       = substr($fnyr[0], 2, 2);
                // $voucherno  = 'C/111-' . $acct . "/" . $fyr1 . "-" . $fnyr[1];
                // $headid     = atcbhd08::selectRaw('max(SUBSTRING_INDEX(HeadId, "-" , -1)) + 1 as nextheadid')->first();
                // $nextheadid = '111-' . str_pad($headid->nextheadid, 8, 0, STR_PAD_LEFT);

                // $datavoucher = [
                //     'HeadId'        =>  $nextheadid,
                //     'TType'         =>  'C',
                //     'VoucherNo'     =>  $voucherno,
                //     'Amt'           =>  $request->amt,
                //     'DC'            =>  'M',
                //     'DescId'        =>  'C0001',
                //     'RefType'       =>  'MC',
                //     'ReffId'        =>  $request->accntno . "-" . $nextslno->nextslno,
                //     'Narration'     => 'Being the amt of Daily Deposit received from ' . $request->accntno,
                //     'IntNo'         =>  0,
                //     'finyear'       =>  Helper::getFinYear()->finyear,
                //     'lslno'         =>  $mnextslno->nextslno,
                // ];

                $result = rdcollection::create($data);
                if ($result) {
                    $naration='Being the amt of Monthly Deposit received from ' . $account_details->AccountName.($account_details->AccountId);
                    $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'C0001'];
                    $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($account_details->AccountId,$request->amt,$naration,'C','D','DC',$descid);
                }
                TempDeposite::where('id', $request->id[$i])->update(['transfer_status' => 1]);


            }
        }

        return redirect()->back()->with("success", "Successfully Transfered.");

    }
    public function destroy(Request $request,$id)
    {
        TempDeposite::where('id', [$id])->delete();
        //DB::delete('DELETE FROM users WHERE id = ?', [$id]);

        return redirect()->back()->with("success", "Successfully Deleted.");
    }

    public function edit(Request $request,$id)
    {
       $temp_deposite = TempDeposite::find($id);
       return view("admin.collection.update", compact("temp_deposite"));

        // return redirect()->back()->with("success", "Successfully updated.");
    }
    public function update(Request $request,$id)
    {
        $newamt=$_POST['new_amount'];
        TempDeposite::where('id', [$id])->update(['amount_collected' => $newamt]);
        return redirect()->route("admin.collection.index")->with("success", "Successfully Updated.");
        //return view('admin.collection.index', compact('temp_deposite', 'lo'));

    }
}
