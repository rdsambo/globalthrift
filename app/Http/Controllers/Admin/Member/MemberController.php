<?php

namespace App\Http\Controllers\Admin\Member;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\members\memberswithgroup;
use App\Models\members\memberswithqualification;
use App\Models\Admin\membermaster;
use App\Models\Admin\accountmaster;
use App\Models\Admin\memberdocument;
use App\Models\Admin\groupmaster;
use App\Models\Admin\atcbhd08;
use App\Models\members\eomaster;
use App\Models\Admin\eogroup;
use App\Models\Admin\feemaster;
use App\Models\Admin\shares;
use App\Models\misc\finyear;
use Illuminate\Support\Facades\Validator;
use DB;
use PDF;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $memrecs = memberswithgroup::query()
                                    ->when($request->option, function ($query) use ($request) {
                                        return $query->where($request->option, $request->value);
                                    });



        $memrecs->when((request("t") && request("t1")), function($query){
            $query->whereBetween('groupid', [request("t"), request("t1")]);
        });
        $memrecs->when(request("memid"),function($query){
            $query->where('memberid','=', request("memid"))->first();
        });
        $memrecs = $memrecs->orderBy('MemberId','ASC')->withTrashed()->paginate(20);
        if($request->get("export") == "excel"){
            return $this->exportExcel01($request);
        }
        if($request->get("export") == "PDF"){
            return $this->exportPDF01($request);
        }
        // dd($memrecs);
        return view('admin.member.index',compact('memrecs'));
    }
    private function exportPDF01(Request $request)
    {
        $memrecs = memberswithgroup::query();
        $memrecs->when((request("t") && request("t1")), function($query){
            $query->whereBetween('groupid', [request("t"), request("t1")]);
        });
        $memrecs->when(request("memid"),function($query){
            $query->where('memberid','=', request("memid"))->first();
        });
        $memrecs = $memrecs->orderBy('MemberId','ASC')->withTrashed()->get();;
        view()->share('employee',$memrecs);
        $pdf = PDF::loadView('admin.member.indexPDF', compact('memrecs'));
        return $pdf->download('pdf_file.pdf');

    }
    private function exportExcel01(Request $request){
        $excel   = memberswithgroup::query();
        $excel->when((request("t") && request("t1")), function($query){
            $query->whereBetween('groupid', [request("t"), request("t1")]);
        });

        $excel->when(request("memid"),function($query){
            $query->where('memberid','=', request("memid"))->first();
        });
        $excel = $excel->orderBy('MemberId','ASC')->withTrashed()->get();
        $fileName = 'tasks.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('SL', 'ID', 'Member No', 'Date', 'Name','Gender','Age');

        $callback = function() use($excel, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $count=0;
            foreach ($excel as $task) {
                $count=$count+1;
                $row['SL']      = $count;
                $row['ID']      = $task->MemberId;
                $row['Member No']    = $task->MemberNo;
                $row['Date']    = date('d-m-Y',strtotime($task->AdmissionDate));
                $row['Name']    = $task->MemberName;
                $row['Gender']  = $task->Gender;
                $row['Age']     = $task->MemAge;

                fputcsv($file, array($row['SL'], $row['ID'], $row['Member No'], $row['Date'], $row['Name'], $row['Gender'], $row['Age']));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }





    public function delete(Request $request)
    {

        $id = $request->memid;
        $delrec = membermaster::where("MemberId", $id)->first();
        if (!$delrec) {
            abort(404);
        }
        $delrec->delete();
        return redirect()->back()->with("success", "Successfully deleted.");
    }

    // public function view(Request $request)
    // {
    //     $memid=$request->memid;
    //     $memdetails=membermaster::where("memberid",'=',$memid)->first();

    //     return View('admin.member.view',compact('memdetails'));
    // }
    public function ViewDetails($id) {
        //dd($id);
        $member = membermaster::where('MemberId',$id)
                 ->join('eo_group','eo_group.GroupId','=','membermaster.GroupId')
                 ->join('relationmaster','relationmaster.relation_id','=','membermaster.NomRelationId')
                 ->join('qualificationmaster','qualificationmaster.QualificationId','=','membermaster.QualificationId')
                 ->join('villagemaster','villagemaster.villageid','=','membermaster.VillageId')
                 ->join('occupationmst','occupationmst.occupationid','=','membermaster.OccupationId')
                 ->first();
        $document=1;
        //$document = memberdocument::where('member_id',$id)->first();
        //dd($member);
        return view('admin.member.IndividualMembers',compact('member','document'));
      }





    public function edit(Request $request)
    {
        $eomember=eomaster::get();
        $id = $request->memid;
        $submit = 'Update';
        $finyr = finyear::where('status', 1)->first();

        $memid= membermaster::selectRaw('max(memberid)+1 as memberid')->first();
        $feedetails=feemaster::where('session','=',$finyr->finyear)->get();
        $editprofile = membermaster::where("MemberId", $id)->first();
        $memberdocument=memberdocument::where('member_id',$id)->first();
        $splitName = explode(' ', $editprofile->MemberName, 2); // Restricts it to only 2 values, for names like Billy Bob Jones

        $first_name = $splitName[0];
        $last_name = !empty($splitName[1]) ? $splitName[1] : '';
        $employee = DB::table('eo_group')->where('EOId',$editprofile->MemberId)->first();

        return view('admin.member.edit',compact('editprofile','eomember','submit','employee','first_name','last_name','memberdocument','feedetails'));
    }

    public function update(Request $request,$member_id)
    {

        $eomember=eomaster::get();
        $id = $request->member_id;
        $submit = 'Update';

        $editprofile = membermaster::where("MemberId", $id)->first();
        $data=[

            'MemSrNo'       =>  $request->membersrno,
            'MemberNo'      =>  $request->groupno.$request->membersrno,

            'AdmissionDate' =>  date('Y-m-d'),

            'TargetNo'      =>  $request->targetno,
            'MemberName'    =>   $request->txtfname.' '.$request->txtlname,
            'Gender'        =>  $request->gender,
            'MemAge'        =>  $request->age,
            'MemberDOB'     =>  $request->dob,
            'Caste'         =>  $request->mstatus,
            'Rlgn'          =>  $request->mreligion,
            'QualificationId'=> $request->mqualification,
            'OccupationId'  =>  $request->occupation,
            'ResAdd1'       =>  $request->txtpresenthouseno,
            'ResAdd2'       =>  $request->txtroadname,

            'NomName'       =>   $request->nominee,
            'NomRelationId' =>  $request->nomrelation,
            'adhaar_card_no'=>$request->adhaar_card_no??'',
            'driving_licence_no'=>$request->driving_licence_no??'',
            'pancard_no'=>$request->pancard_no??'',
            'ration_card_no'=>$request->ration_card_no??'',
            'voter_card_no'=>$request->voter_card_no??'',


        ];

        $editprofile->update($data);

         return redirect()->back()->with("success", "Successfully updated.");


    }
    public function addmember(Request $request)
    {

        $eomember=eomaster::all();
        $submit = 'Add';
        $finyr = finyear::where('status', 1)->first();

        $memid= membermaster::selectRaw('max(memberid)+1 as memberid')->first();
        $feedetails=feemaster:://where('session','=',$finyr->finyear)->
                              get();


        return view("admin.member.addmember",compact('eomember','submit', 'memid', 'feedetails'));
    }

    public function savemember(Request $request)
    {
        // dd($request->all());
        $rules=[
            'dob'           => 'required|date',
            'nos'           => 'required|numeric',
            // 'membersrno'    => 'required|numeric',
        ];
        $checkvalid=Validator::make($request->all(),$rules);

        if(!$checkvalid->fails()){

            DB::beginTransaction();

            try {

                $feeadmission=feemaster::where('feeid','=',1)->first();
                $feesale=feemaster::where('feeid', '=', 2)->first();

                $nextmemid = membermaster::selectRaw("max(MemberId) +1 as nextmemid,max(id) + 1 as nextid")->first();
                $grpid=groupmaster::select('groupid')->where('GroupCode','=', $request->groupno)->first();


                if($request->hasFile('memberphoto')){

                    $path1="";
                    $path = public_path() . '/images/memberphoto/';

                    $file=$request->file('memberphoto');
                    $imageName = date('dmyhis') . 'memberphoto.' . $file->getClientOriginalExtension();
                //dd( $imageName);
                    $file->move($path, $imageName);
                    $path1 = url('/') . '/images/memberphoto/' . $imageName;


                }
                if ($request->hasFile('signature')) {
                    $path2="";
                    $path = public_path() . '/images/signature/';
                    $file=$request->file('signature');
                    $imageName = date('dmyhis') . 'signature.' . $file->getClientOriginalExtension();
                    $file->move($path, $imageName);
                    $path2 = url('/') . '/images/signature/' . $imageName;

                }
                if ($request->hasFile('adhaar')) {
                    $path3 = "";
                    $path = public_path() . '/images/adhaar/';
                    $file=$request->file('adhaar');
                    $imageName = date('dmyhis') . 'adhaar.' . $file->getClientOriginalExtension();
                    $file->move($path, $imageName);
                    $path3 = url('/') . '/images/adhaar/' . $imageName;

                }

                if ($request->hasFile('votercard')) {
                    $path4="";
                    $path = public_path() . '/images/votercard/';
                    $file=$request->file('votercard');
                    $imageName = date('dmyhis') . 'votercard.' . $file->getClientOriginalExtension();
                    $file->move($path, $imageName);
                    $path4 = url('/') . '/images/votercard/' . $imageName;
                }

                if ($request->hasFile('passport')) {
                    $path5="";
                    $path = public_path() . '/images/passport/';
                    $file=$request->file('passport');
                    $imageName = date('dmyhis') . 'passport.' . $file->getClientOriginalExtension();
                    $file->move($path, $imageName);
                    $path5 = url('/') . '/images/passport/' . $imageName;
                }

                if ($request->hasFile('ration')) {
                    $path6="";
                    $path = public_path() . '/images/ration/';
                    $file=$request->file('ration');
                    $imageName = date('dmyhis') . 'ration.' . $file->getClientOriginalExtension();
                    $file->move($path, $imageName);
                    $path6 = url('/') . '/images/ration/' . $imageName;

                }

                if ($request->hasFile('driving')) {
                    $path7="";
                    $path = public_path() . '/images/driving/';
                    $file=$request->file('driving');
                    $imageName = date('dmyhis') . 'driving.' . $file->getClientOriginalExtension();
                    $file->move($path, $imageName);
                    $path7 = url('/') . '/images/driving/' . $imageName;

                }

                if ($request->hasFile('pancard')) {
                    $path7="";
                    $path = public_path() . '/images/pancard/';
                    $file=$request->file('pancard');
                    $imageName = date('dmyhis') . 'pancard.' . $file->getClientOriginalExtension();
                    $file->move($path, $imageName);
                    $path7 = url('/') . '/images/pancard/' . $imageName;

                }

                $data=[
                    'id'            =>  $nextmemid->nextid,
                    'MemberId'      =>  $nextmemid->nextmemid,
                    'MemSrNo'       =>  $request->membersrno,
                    'MemberNo'      =>  $request->groupno.$request->membersrno,
                    'GroupId'       =>  $grpid->groupid,
                    'AdmissionDate' =>  date('Y-m-d'),
                    'Adminfee'      =>  $feeadmission->amount,
                    'TargetNo'      =>  $request->targetno,
                    'MemberName'    =>  $request->txtfname.' '.$request->txtlname,
                    'Gender'        =>  $request->gender,
                    'MemAge'        =>  $request->age,
                    'MemberDOB'     =>  $request->dob,
                    'Caste'         =>  $request->mcaste,
                    'Rlgn'          =>  $request->mreligion,
                    'QualificationId'=> $request->mqualification,
                    'OccupationId'  =>  $request->occupation,
                    'ResAdd1'       =>  $request->txtpresenthouseno,
                    'ResAdd2'       =>  $request->txtroadname,
                    'District'      =>  $request->txtdistrict,
                    'State'         =>  $request->textstate,
                    'country'       =>  $request->textcountry,
                    'SalebleFee'    =>  $feesale->amount,
                    'NomName'       =>  $request->nominee,
                    'NomRelationId' =>  $request->nomrelation,
                    'HouseType'     =>  $request->assettype,
                    'Spouce'        =>  $request->spouse,
                    'SpouceAge'     =>  $request->spage,
                    'BankName'      =>  $request->bank,
                    'acno'          =>  $request->bankaccountno,
                    'YearlyIncome'  =>  $request->earnings,
                    'NomAge'        =>  $request->nomage,
                    'NomSex'        =>  $request->nomineegender,
                    'NomDOB'        =>  $request->nomdob,
                    'PerAdd1'       =>  $request->txtpermahouseno,
                    'PerAdd2'       =>  $request->txtpermaroadname,
                    'introducer_name'=>$request->introducer_name,
                    'introducer_membership_no'=>$request->introducer_membership_no,
                    'introducers_account_no'=>$request->introducers_account_no,
                    'adhaar_card_no'=>$request->adhaar_card_no??'',
                    'driving_licence_no'=>$request->driving_licence_no??'',
                    'pancard_no'=>$request->pancard_no??'',
                    'ration_card_no'=>$request->ration_card_no??'',
                    'voter_card_no'=>$request->voter_card_no??'',
                    'MembershipNo' => $request->membership_no,
                ];

                membermaster::create($data);

                $insmemdocument=[
                    'member_id'     =>     $nextmemid->nextmemid,
                    'photo'         =>      $path1??null,
                    'signature'     =>      $path2??null,
                    'pancard'       =>      $path8??null,
                    'adhaar'        =>      $path3??null,
                    'voter'         =>      $path4??null,
                    'passport'      =>      $path5??null,
                    'ration'        =>      $path6??null,
                    'drivinglic'    =>      $path7??null,
                ];

                memberdocument::create($insmemdocument);

                $naration='Being the amt of Admission fee received from' .$request->memtype.",".$request->txtfname.' '.$request->txtlname;
                $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'G0005'];
                $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($nextmemid->nextmemid,$feeadmission->amount,$naration,'C','D','M',$descid);


                $naration='Being the amt of Saleble fee received from' .$request->memtype.",".$request->txtfname.' '.$request->txtlname;
                $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'G0024'];
                $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($nextmemid->nextmemid,$feesale->amount,$naration,'C','D','M',$descid);

                if($request->nos){
                    $naration='Being the amt of Share received from' .$request->memtype.",".$request->txtfname.' '.$request->txtlname;
                    $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'G0065'];
                    $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($nextmemid->nextmemid,$request->nos*100,$naration,'C','D','M',$descid);

                    $insshare = [
                        'MemberId'      =>      $nextmemid->nextmemid,
                        'MemSrNo'       =>      $request->membersrno,
                        'MemberNo'      =>      $request->groupno . $request->membersrno,
                        'shares'        =>      $request->nos,
                        'shareamount'   =>      $request->nos * 100,
                        'voucher_no'    =>      $voucharno,
                    ];
                    shares::create($insshare);
                }
                // dd("ok");
                // dd($request->all());
                DB::commit();
                return view('admin.member.savedmember')->with('success','Member Successfully added');

            } catch (\Exception $e) {
                dd($e);
                DB::rollback();
                return redirect()->back()->with('error',"Somethong Went Wrong Please try Again");
            }


        }else{
            return redirect()->back()->withErrors($checkvalid);

        }



    }
    public function ddmember(Request $request)
    {
        $gr1=$request->t;
        $gr2=$request->t1;
        $ddmember=memberswithgroup::whereBetween('groupid',[$gr1,$gr2])->get();
        if(!$ddmember->isEmpty())
            return response()->json(array('success'=>true,'memberdata'=>$ddmember),200);
        else
            return response()->json(array('success' => false), 200);
    }
    public function CloseOpen(Request $request)
    {
        $accdata=accountmaster::where('AccountId',$request->id)->first();
        return response()->json(['success' => true,'msg' => $accdata]);
    }

    public function CloseOpenSubmit(Request $request)
    {
        if($request->reopen){
            $accdata=accountmaster::where('AccountId',$request->ac_id)->update(['Status'      => 'O',
                                                                             'ClosingNote' => '',
                                                                             'ClosingType' => '']);
            return redirect()->back()->with('success','Successfully Reopend A/C..');
        }else{
            $accdata=accountmaster::where('AccountId',$request->ac_id)->update(['Status'      => 'C',
                                                                             'ClosingNote' => $request->cmt,
                                                                             'ClosingType' => $request->type]);
            return redirect()->back()->with('success','Successfully Closed A/C..');
        }

    }

    public function getmember(Request $request)
    {
        $memid=$request->member;

        $ddmember = membermaster::where('MemberId', $memid)->first();
        //dump($ddmember);
        $relation = Helper::getrelation($ddmember->NomRelationId);
        $ddmember['relation']= isset($relation->relation) ? $relation->relation : "NA";
        //dd($ddmember['relation']->);
        if ($ddmember)
            return response()->json(array('success' => true, 'memberdata' => $ddmember), 200);
        else
            return response()->json(array('success' => false), 200);

    }

    public function getMemberBySerialNo(Request $request){
        $serial_no=$request->serial_no;
        $member_details = membermaster::where('MemSrNo', $serial_no)->first();
        if ($member_details)
        return response()->json(array('success' => true, 'memberdata' => $member_details), 200);
    else
        return response()->json(array('success' => false), 200);

    }
    public function geteo(Request $request)
    {
        $eomember = eogroup::where('EOId', '=', $request->member)->first();
        if ($eomember) {
            return response()->json(array('success' => true, 'memberdata' => $eomember), 200);
        } else
            return response()->json(array('success' => false), 200);

    }

    //14/12/2021
    public function LoWiseMember(Request $request)
    {
       //dd("welcome");
    //    $memrecs = DB::table('membermaster')
    //    ->where('membermaster.GroupId','=',$request->Loan_officer)
    //    ->orderBy('membermaster.MemberId','ASC')
    //    ->paginate(20);
       $memrecsno=1;
       $loname=DB::table('eo_group')->get();
       //dd($loname);
       return view('admin.member.LoWise.LoWiseMember',compact('loname','memrecsno'));

    }

    public function LoWiseMemberGet(Request $request)
    {
        $memrecs = DB::table('membermaster')
                    ->where('membermaster.GroupId','=',$request->Loan_officer)
                    ->orderBy('membermaster.MemberId','ASC')
                    ->paginate(20);
        $excel = collect();
        $loname=DB::table('eo_group')->get();
        $name=DB::table('eo_group')->where('eo_group.GroupId',$memrecs[0]->GroupId)->first();
        if($request->get("export") == "excel"){
            return $this->exportExcel($request);
        }
        if($request->get("export") == "PDF"){
            return $this->exportLoPDF($request);
        }
        //dd($name);
        $memrecsno=2;
        return view('admin.member.LoWise.LoWiseMember',compact('loname','memrecs','memrecsno','name'));

    }
    private function exportLoPDF(Request $request)
    {
        $memrecs = DB::table('membermaster')
                    ->where('membermaster.GroupId','=',$request->Loan_officer)
                    ->orderBy('membermaster.MemberId','ASC')
                    ->get();
        $name=DB::table('eo_group')->where('eo_group.GroupId',$memrecs[0]->GroupId)->first();
        view()->share('employee',$memrecs);
        $pdf = PDF::loadView('admin.member.LoWise.PDF', compact('memrecs','name'));
        return $pdf->download('pdf_file.pdf');

    }

    private function exportExcel(Request $request){
        $excel   = DB::table('membermaster')
        ->where('membermaster.GroupId','=',$request->Loan_officer)
        ->orderBy('membermaster.MemberId','ASC')
        ->get();
        $fileName = 'tasks.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('SL', 'ID', 'Member No', 'Date', 'Name','Gender','Age');

        $callback = function() use($excel, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $count=0;
            foreach ($excel as $task) {
                $count=$count+1;
                $row['SL']      = $count;
                $row['ID']      = $task->MemberId;
                $row['Member No']    = $task->MemberNo;
                $row['Date']    = date('d-m-Y',strtotime($task->AdmissionDate));
                $row['Name']    = $task->MemberName;
                $row['Gender']  = $task->Gender;
                $row['Age']     = $task->MemAge;

                fputcsv($file, array($row['SL'], $row['ID'], $row['Member No'], $row['Date'], $row['Name'], $row['Gender'], $row['Age']));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


}

