<?php
namespace App\Helpers;
use App\Models\Members\groupmaster;
use App\Models\members\qualifications;
use App\Models\Members\villagemaster;
use App\Models\members\eomaster;
use App\Models\Admin\relationmaster;
use App\Models\Admin\membermaster;
use App\Models\Admin\accountmaster;
use App\Models\Admin\ddcollection;
use App\Models\Admin\rdcollection;
use App\Models\Admin\Ddwithdrawal;
use App\Models\Admin\Rdwithdrawal;
use App\Models\Admin\atcbhd08;
use App\Models\Admin\atcbdt;
use DB;
use Request;
use Illuminate\Support\Carbon;

class Helper{

public static function getamountToRupees($amt){
        $no = round($amt);
        $point = round($amt - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
        '0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety'
        );
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) { $divider=($i==2) ? 10 : 100; $amt=floor($no % $divider); $no=floor($no / $divider); $i +=($divider==10) ? 1 : 2; if ($amt) { $plural=(($counter=count($str)) && $amt> 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($amt < 21) ? $words[$amt] . " " . $digits[$counter] . $plural . " " . $hundred : $words[floor($amt / 10) * 10] . " " . $words[$amt % 10] . " " . $digits[$counter] . $plural . " " . $hundred; } else $str[]=null; } $str=array_reverse($str); $f=implode('', $str); $points=($point) ? "." . $words[$point / 10] . " " . $words[$point=$point % 10] : '' ;
            return $f;
    }

        public static function getgroupno($gpid)
        {
            $groupdet=groupmaster::select('GroupCode','GroupName')->where('GroupId','=',$gpid)->first();

            return $groupdet;
        }

    public static function getcaste($castid)
    {
        $getcast="";
        if($castid==1)
            $getcast = 'General';
        elseif($castid == 2)
            $getcast ='SC';
        elseif ($castid == 3)
            $getcast = 'ST';
        elseif ($castid == 4)
            $getcast = 'OBC';
        elseif ($castid == 5)
            $getcast = 'MOBC';


        return $getcast;
    }

    public static function getreligion($relid)
    {
        $getreli="";
        if ($relid == 1)
            $getreli = 'Muslim';
        elseif ($relid == 2)
            $getreli = 'Hindu';
        elseif ($relid == 3)
            $getreli = 'Sikh';
        elseif ($relid == 4)
            $getreli = 'Jain';



        return $getreli;
    }

    public static function getqualification($qid)
    {
        $getqualification="";
        if($qid==0)
            $getqualification='N/A';
        else
            $getqualification=qualifications::where('QualificationId','=',$qid)->first()->Qualification;

            return $getqualification;
    }

    public static function getvillage($vid)
    {
        if($vid==0)
            $getvillage="N/A";
        else
            $getvillage = villagemaster::where('villageid', '=', $vid)->first()->getvillage;

            return $getvillage;
    }

    public static function geteodetails($gid)
    {
        $getqualification = eomaster::where('groupid', '=', $gid)->first();
        return $getqualification;
    }

    public static function gethousetype($hid)
    {
        if($hid==0)
            $gethousetype="N/A";
        elseif($hid==1)
            $gethousetype="PUCCA";
         elseif ($hid==2)
            $gethousetype = "Assam Type";
        elseif ($hid == 3)
            $gethousetype = "KATCHHA";

        return $gethousetype;
    }


    public static function gethousestatus($hstatusid)
    {

        if ($hstatusid == 0)
        $gethousestatus = "OWN";
        elseif ($hstatusid == 1)
        $gethousestatus = "Rented";


        return $gethousestatus;
    }

    public static function getgender($genid)
    {

        $getgender="";
        if ($genid == 1)
            $getgender = "Male";
        elseif ($genid == 2)
            $getgender = "Female";


        return $getgender;
    }
    public static function getFinYear(){
        return \DB::table("financialyears")->where("id", session('finyr'))->first();
    }

    public static function getrelation($relaid)
    {
        $relation=relationmaster::where('relation_id','=',$relaid)->first();
        return $relation;
    }

    public static function getmembername($memid)
    {
        $memname=membermaster::where('memberid','=',$memid)->first();
        return $memname->MemberName;
    }
    //today
    public static function CurrentFinancialSFYear($date) {
        //echo "<br> Month: ".date_format($date,"m");
        $month = date('m', strtotime($date));
        $Y = date('Y', strtotime($date));
        $y = date('y', strtotime($date));
            if (intval($month) >= 4) {//On or After April (FY is current year - next year)
                $financial_year = $y . '-' . ($y+1);
            } else {//On or Before March (FY is previous year - current year)
                $financial_year = ($y-1) . '-' . $y;
            }

             return $financial_year;
        }

    public static function GenerateAppId1(){
        global $cn;
        $sql1 = "select max(cast(AppLoanNo AS SIGNED))+1 AS sl from dbo_loanapplication";
        if ($result1 = mysqli_query($cn, $sql1)) {
          while ($row = mysqli_fetch_assoc($result1)) {
            $n = $row['sl'];
          }

        }
        return $n;
    }

    public static function GetAccountBal($accountid){
        if($accountid!=null){
            $ldate = date('Y-m-d H:i:s');
            //$ac_no = explode(' ',$request->t1);
            $acctdata=accountmaster::where('AccountId','=',$accountid)->first();
            if($acctdata->AType=="DD"){
                 $amttilldate0=ddcollection::selectRaw('sum(DAmt) as totalamt')->where('ColDate','<=',$ldate)
                     ->where('accountid','=', $accountid)->first();
                 $amttilldate1=Ddwithdrawal::selectRaw('sum(WAmt) as totalamt')->where('WDate','<=',$ldate)
                     ->where('Accountid','=', $accountid)->first();
                 $amttilldate=($amttilldate0->totalamt)-($amttilldate1->totalamt);
            }else{
                $amttilldate=rdcollection::selectRaw('sum(DAmt) as totalamt')->where('ColDate','<=',$ldate)
                ->where('accountid','=',  $accountid)->first();
                $amttilldate=$amttilldate->totalamt;
            }
            return $amttilldate;
        }else{
            return 'a/c no not found';
        }
    }

    public static function WithdrowAmt($accountid,$AMT){
        $acctdata=accountmaster::where('AccountId',$accountid)->first();

        $mytime = Carbon::now()->format('Y-m-d');
        $withdrowdata=[
            'AccountId'=> $accountid,
            'WDate'    => $mytime,
            'WAmt'     => $AMT,
            'Atype'    => $acctdata->AType,
            'UserId'   => Auth()->user()->id,
            'Remarks'  =>'Amount Deduct For Loan EMI'
        ];
        if($acctdata->AType=="DD"){
            Ddwithdrawal::insert($withdrowdata);
        }elseif($acctdata->AType=="RD"){
            Rdwithdrawal::insert($withdrowdata);
        }
        return 'successfully Withdrown Amt';
    }

    public static function DepositAmt($accountid,$acType,$AMT){
        $mytime = Carbon::now()->format('Y-m-d');
        if($acType=="DD"){
            $slno=ddcollection::select('SlNo')->where('AccountId',$accountid)->max('SlNo');
            $depositdata=[
                'AccountId'=> $accountid,
                'SlNo'     => $slno,
                'ColDate'  => $mytime,
                'DAmt'     => $AMT,
                'UserId'   => Auth()->user()->id,
            ];
            ddcollection::insert($depositdata);
        }elseif($acType=="RD"){
            $slno=rdcollection::select('slno')->where('accountid ',$accountid)->max('slno');
            $depositdata=[
                'accountid '=> $accountid,
                'slno'      => $slno,
                'coldate'   => $mytime,
                'DAmt'      => $AMT,
                'userid'    => Auth()->user()->id,
            ];
            rdcollection::insert($depositdata);
        }
        return 'successfull';
    }

     public static function nextslno_c($TType){
        $fnyr = explode("-", Helper::getFinYear()->finyear);
        $from=$fnyr[0] . "-" . '04' . "-" . '01';
        $to=20 . $fnyr[1] . "-" . '03' . "-" . '31';

        $mnextslno = atcbhd08::selectRaw('max(lslno) + 1 as nextslno')
                               ->where('TType',$TType)
                               ->whereBetween(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"), [$from, $to])
                               ->first();
        // dd($mnextslno);
        if($TType=='C'){
            $prefix='C/111-';
        }elseif($TType=='B'){
            $prefix='B/111-';
        }elseif($TType=='N'){
            $prefix='N/111-';
        }elseif($TType=='J'){
            $prefix='J/111-';
        }
        if($mnextslno->nextslno == null){
            $acct = "000001";
            $mnextslno->nextslno=1;
        }else{
            $acct = str_pad($mnextslno->nextslno, 7, '0', STR_PAD_LEFT);
        }
        $fyr1 = (substr($fnyr[0], 2, 2));
        $voucherno =  $prefix . $acct . "/" . $fyr1 . "-" . $fnyr[1];
        $headid = atcbhd08::selectRaw('max(SUBSTRING_INDEX(HeadId, "-" , -1)) + 1 as nextheadid')->first();
        $nextheadid = '111-' . str_pad($headid->nextheadid, 8, 0, STR_PAD_LEFT);
        return ['VoucherNo'=>$voucherno, 'HeadId'=>$nextheadid,'lslno'=>$mnextslno];
    }

    public static function InsertInto_atcbhd08($memid,$amount,$naration,$TType,$dc,$RefType,$descId){
        if($dc=="C"){
            $dc0="D";
        }else{
            $dc0="C";
        }
        DB::beginTransaction();
        try {

            $slno   = \App\Helpers\Helper::nextslno_c($TType);
            $datashare=[
                'HeadId'        =>  $slno["HeadId"],
                'TType'         =>  $TType,
                'VoucherNo'     =>  $slno["VoucherNo"],
                'VoucherDt'     =>  date('Y-m-d H:i:s'),
                'Amt'           =>  $amount,
                'DC'            =>  $dc,
                'DescId'        =>  $descId['atcbhd08'],
                'RefType'       =>  $RefType,
                'ReffId'        =>  $memid,
                'Narration'     =>  $naration,
                'IntNo'         =>  0,
                'lslno'         =>  $slno["lslno"]->nextslno,
            ];
            atcbhd08::create($datashare);


            $datashare2=[
                'DtlId'         =>  $slno["HeadId"],
                'HeadId'        =>  $slno["HeadId"],
                'Type'          =>  $TType,
                'VoucherNo'     =>  $slno["VoucherNo"],
                'VoucherDt'     =>  date('Y-m-d H:i:s'),
                'Amt'           =>  $amount,
                'DrCr'          =>  $dc0,
                'DescId'        =>  $descId['atcbdt'],
                'RefType'       =>  $RefType,
                'Narration'     =>  $naration,
            ];
            atcbdt::create($datashare2);
            DB::commit();
            return $slno["VoucherNo"];
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            return $e;
            dd($e);
        }
    }



    public static function depodit($actype,$accountid,$amount,$date){
        if($actype=='MD'){
            $nextslno = rdcollection::selectRaw('max(slno) + 1 as nextslno')->where('accountid', $accountid)->first();
            $data = [
                'AccountId'         =>  $accountid,
                'slno'              =>  $nextslno->nextslno,
                'damt'              =>  $amount,
                'userid'            =>  Auth()->user()->id,
                'ColDate'           =>  $date,
            ];
            $memberdetails = accountmaster::where('accountid', $accountid)->first();
            $result = rdcollection::create($data);
            // if ($result) {
            //     $naration='Being the amt received from '.$memberdetails->AccountName;
            //     $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'G0010'];
            //     $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($accountid."-".$nextslno->nextslno,$amount,$naration,'C','D','MC',$descid);
            // }
        }elseif($actype=="DD"){
            $nextslno=ddcollection::selectRaw('max(slno) + 1 as nextslno')
            ->where('accountid',$accountid)->first();
            $data=[
                'AccountId'         =>  $accountid,
                'slno'              =>  $nextslno->nextslno,
                'damt'              =>  $amount,
                'userid'            =>  1,
                'ColDate'           =>  $date,
            ];
            $memberdetails=accountmaster::where('accountid', $accountid)->first();
            $result=ddcollection::create($data);
            // if($result){
            //     $naration='Being the amt received from '.$accountid;
            //     $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'G0011'];
            //     $voucharno= \App\Helpers\Helper::InsertInto_atcbhd08($accountid."-".$nextslno->nextslno,$amount,$naration,'C','D','DC',$descid);
            // }
        }
    }


    public static function balance_till($voutype){
        // check whether it is correct or not
        $drAmt=atcbhd08::where('DC','D')->where('TType',$voutype)
                        ->selectRaw('sum(Amt) as totalamt')->first();
        $crAmt=atcbhd08::where('DC','C')->where('TType',$voutype)
                        ->selectRaw('sum(Amt) as totalamt')->first();
        $ob_til=$drAmt->totalamt-$crAmt->totalamt;
        return $ob_til;
    }


}
