<?php

namespace App\Http\Controllers\admin\Payroll;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reports\employeemaster;
use App\Models\Reports\employeedocuments;
use App\Models\Reports\tempsalary;
use App\Models\Reports\empattendence;
use Redirect;
use App\Models\Reports\employeetransactions;
use App\Models\Reports\salaryprocess_period;
use App\Models\Reports\employeemonthlymaster;
use DB;
use PDF;

class PayrollController extends Controller
{
    public function index(){

       $designation=DB::table('designationmaster')->get();
       $department=DB::table('departmentmaster')->get();
       $section = DB::table('sectionmaster')->get();
       //dd($designation);

       return view('admin.Payroll.employee.AddEmployee',compact('designation','department','section'));
    }


    public function save(Request $request){
        // $test=employeemaster::first();
        // dd($test);
        $this->validate($request,[
            'Employee_Code'=>'required|unique:employeemaster',
         ]);
        $data = [
            'Employee_Code'  => $request->Employee_Code,
            'Title'          => $request->title,
            'EmpFirstName'   => $request->first_Name,
            'EmpMiddleName'  => $request->middle_name,
            'EmpLastName'    => $request->last_Name,
            'DesignationID'  => $request->designation,
            'DOB'            => $request->DOB,
            'DOJoining'      => $request->DOJ,
            'SalaryMonthy'   => $request->month,
            'SalaryYear'     => $request->year,
            'DORetirement'   => $request->DOR,
            'DepartmentID'   => $request->department,
            'qualification'  => $request->qualification,
            'SectionID'      => $request->section,
            'PresentAdd1'    => $request->preadd,
            'PrePO'          => $request->PO,
            'PrePin'         => $request->zip,
            'PrePS'          => $request->PS,
            'PreDIS'         => $request->Dis,
            'PreSTAT'        => $request->State,
            'PermanantAaa'   => $request->preadd1,
            'PerPO'          => $request->PO1,
            'PerPin'         => $request->zip1,
            'PerPS'          => $request->PS1,
            'PerDIS'         => $request->Dis1,
            'PerSTAT'        => $request->State1,
            'Email'          => $request->Email,
            'Phone1'         => $request->Pnumber,
            'Phone2'         => $request->Alt,
            'BasicPay'       => $request->Bpay,
            //'GradePay'       => $request->Gpay,
            'DA'             => $request->DA,
            'TA'             => $request->TA,
            'ESIC'           => $request->esic,
            'BankAc_No'      => $request->AcNo,
            'BankName'       => $request->BName,
            'IFSC'           => $request->IFSC,
            'BranchName'     => $request->Branch,
            'PanNo'          => $request->PNo,
            'activestatus'   =>1,
            'SalaryStatus'   =>0,
        ];
        employeemaster::create($data);
        if($request->hasFile('image')){
            $path1="";
            $dir = '/images/employee/image/';
            $path = public_path() . $dir;

            $file=$request->file('image');
            $imageName = date('dmyhis') . 'image.' . $file->getClientOriginalExtension();
            $file->move($path, $imageName);
            $path1 = url('/') . $dir . $imageName;
        }
        if ($request->hasFile('signature')) {
            $path2="";
            $dir2='/images/employee/signature/';
            $path = public_path() . $dir2;
            $file=$request->file('signature');
            $imageName = date('dmyhis') . 'signature.' . $file->getClientOriginalExtension();
            $file->move($path, $imageName);
            $path2 = url('/') . $dir2 . $imageName;
        }
        $documents=[
            'Employee_Code' =>    $request->Employee_Code,
            'photo'         =>    $path1??null,
            'signature'     =>    $path2??null,
        ];
        employeedocuments::create($documents);

        $ID=employeemaster::where('Employee_Code',$request->Employee_Code)->first();
        //dd($ID->Id);
        $salary0=[
            'Emp_ID'        => $ID->Id,
            'Emp_Code'      => $request->Employee_Code,
            'SalaryHeadID'  => 1,
            'SalaryHeadCode'=> 'Basic',
            'Amount'        => $request->Bpay,
            'Income'        => 1,
            'Deduction'     => 0,
            'Order'         => 1,
            'Months'        => $request->month,
            'years'         => $request->year,
        ];
        //dd($salary);
        tempsalary::create($salary0);
        $salary1=[
            'Emp_ID'        => $ID->Id,
            'Emp_Code'      => $request->Employee_Code,
            'SalaryHeadID'  => 2,
            'SalaryHeadCode'=> 'DA',
            'Amount'        => $request->DA,
            'Income'        => 1,
            'Deduction'     => 0,
            'Order'         => 2,
            'Months'        => $request->month,
            'years'         => $request->year,
        ];
        //dd($salary);
        tempsalary::create($salary1);
        $salary2=[
            'Emp_ID'        => $ID->Id,
            'Emp_Code'      => $request->Employee_Code,
            'SalaryHeadID'  => 3,
            'SalaryHeadCode'=> 'TA',
            'Amount'        => $request->TA,
            'Income'        => 1,
            'Deduction'     => 0,
            'Order'         => 3,
            'Months'        => $request->month,
            'years'         => $request->year,
        ];
        //dd($salary);
        tempsalary::create($salary2);

        return redirect()->back();
     }

     public function employeelist(Request $request){
         if($request->has('option')){
             if($request->option=='ExEmp'){
                $employeedetails=employeemaster::where('activestatus',0)->orderby('Id')->paginate(10);
             }else{
                $employeedetails=employeemaster::where('activestatus',1)->orderby('Id')->paginate(10);
             }

         }else{
            $employeedetails=employeemaster::orderby('Id')->paginate(10);
         }
         return view('admin.Payroll.employee.Employeelist',compact('employeedetails'));
     }


     public function EditFaFA($id){
        $designation=DB::table('designationmaster')->get();
        $department=DB::table('departmentmaster')->get();
        $section = DB::table('sectionmaster')->get();
        $values=employeemaster::
                            join('designationmaster','employeemaster.DesignationID','=','designationmaster.DesignarionID')
                            ->join('departmentmaster','employeemaster.DepartmentID','=','departmentmaster.DepartmentID')
                            ->join('sectionmaster','employeemaster.SectionID','=','sectionmaster.SectionID')
                            ->join('employeedocuments','employeedocuments.Employee_Code','=','employeemaster.Employee_Code')
                            ->where('employeemaster.Id',$id)
                            ->first();
        //dd($values);
        return view("admin.Payroll.employee.ViewDetails",compact('values','designation','department','section'));
     }


     public function Edit(Request $request){
         //dd($request->all());
        // $this->validate($request,[
        //     'Employee_Code'=>'required|unique:employeemaster',
        //  ]);
        $data = [
            'Employee_Code'  => $request->Employee_Code,
            'Title'          => $request->title,
            'EmpFirstName'   => $request->first_Name,
            'EmpMiddleName'  => $request->middle_name,
            'EmpLastName'    => $request->last_Name,
            'DesignationID'  => $request->designation,
            'DOB'            => $request->DOB,
            'DOJoining'      => $request->DOJ,
            'DORetirement'   => $request->DOR,
            'DepartmentID'   => $request->department,
            'qualification'  => $request->qualification,
            'SectionID'      => $request->section,
            'PresentAdd1'    => $request->preadd,
            'PrePO'          => $request->PO,
            'PrePin'         => $request->zip,
            'PrePS'          => $request->PS,
            'PreDIS'         => $request->Dis,
            'PreSTAT'        => $request->State,
            'PermanantAaa'   => $request->preadd1,
            'PerPO'          => $request->PO1,
            'PerPin'         => $request->zip1,
            'PerPS'          => $request->PS1,
            'PerDIS'         => $request->Dis1,
            'PerSTAT'        => $request->State1,
            'Grade'          => $request->grade,
            'Email'          => $request->Email,
            'Phone1'         => $request->Pnumber,
            'Phone2'         => $request->Alt,
            'BasicPay'       => $request->Bpay,
            // 'GradePay'       => $request->Gpay,
            'DA'             => $request->DA,
            'TA'             => $request->TA,
            'ESIC'           => $request->esic,
            'BankAc_No'      => $request->AcNo,
            'BankName'       => $request->BName,
            'IFSC'           => $request->IFSC,
            'BranchName'     => $request->Branch,
            'PanNo'          => $request->PNo,
            'AdharNo'        => $request->AdharNo,
        ];
        //dd($data);
        if($request->has('status')){
            $data2=[
                'activestatus'   => $request->status,
            ];
            employeemaster::where('Employee_Code',$request->Employee_Code)->update($data2);
        }
        employeemaster::where('Employee_Code',$request->Employee_Code)->update($data);




        return redirect()->back();
     }

//for Edit Employee Details
     public function eyeFaFA($id){
        $designation=DB::table('designationmaster')->get();
        $department=DB::table('departmentmaster')->get();
        $section = DB::table('sectionmaster')->get();
        $values=employeemaster::
                            join('designationmaster','employeemaster.DesignationID','=','designationmaster.DesignarionID')
                            ->join('departmentmaster','employeemaster.DepartmentID','=','departmentmaster.DepartmentID')
                            ->join('sectionmaster','employeemaster.SectionID','=','sectionmaster.SectionID')
                            ->join('employeedocuments','employeedocuments.Employee_Code','=','employeemaster.Employee_Code')
                            ->where('employeemaster.Id',$id)
                            ->first();
        //dd($values);
        return view("admin.Payroll.employee.ShowDetails",compact('values','designation','department','section'));

     }
     //

     public function SalaryHead(){
         $head=DB::table('salaryhead')->get();
       return view("admin.Payroll.SalaryHead",compact('head'));

     }
     public function AddHead(Request $request){
        if($request->has('HName')){
            $value=[
                'HeadName' =>  $request->HName,
                'HeadSName'=>  $request->SName,
                'Status'   =>  $request->Satus,
                // 'Order'    =>  $request->Order
            ];
            DB::table('salaryhead')->insert($value);
            return redirect()->route('admin.salaryhead')->with('success','Successfully Add Salary Head..');
        }
        return view("admin.Payroll.AddSalaryHead");


    }
    public function EditHead(Request $request,$id){
        $details=DB::table('salaryhead')->where('ID',$id)->first();
        //dd($details);
        if($request->has('HName')){

            $value=[
                'HeadName' =>  $request->HName,
                'HeadSName'=>  $request->SName,
                'Status'   =>  $request->Satus,
                'Order'    =>  $request->Order
            ];
            //dd($value);
            DB::table('salaryhead')->where('ID',$id)->update($value);
            return Redirect()->back()->with('msg', 'Successfully updated');
        }
        return view("admin.Payroll.EditSalaryHead",compact('details'));
    }

    public function DeleteHead($id){
        DB::table('salaryhead')->where('ID',$id)->delete();
        return redirect()->back();
    }

    public function Psalary(){
       $employee = employeemaster::where('activestatus','1')->get();
       $head     = DB::table('salaryhead')->get();
       return view("admin.Payroll.salary.ProvideSalaryHead",compact('employee','head'));
    }



    public function submitSH(Request $request){
        $status=0;
        foreach($request->ID as $ID){
            $values=employeemaster::select('Employee_Code','SalaryMonthy','SalaryYear','BasicPay')
                               ->where('employeemaster.ID','=',$ID)
                               ->first();
            //$basic=tempsalary::where('Emp_ID',$ID)->where('SalaryHeadID','1')->first();
            // dd($basic->Amount);
            if($request->percentage!=null){
                $Amt=($values->BasicPay)*($request->percentage/100);
            }else{
                $Amt=$request->Amount;
            }
            $values2=DB::table('salaryhead')->where('ID',$request->SHead)->first();
            if($values2->Status==1){
                $income=1;
                $deductrion=0;
            }else{
                $income=0;
                $deductrion=1;
            }
            $data=[
                'Emp_ID'        => $ID,
                'Emp_Code'      => $values->Employee_Code,
                'SalaryHeadID'  => $values2->HeadSName,
                'SalaryHeadCode'=> $values2->HeadName,
                'Amount'        => $Amt,
                'Income'        => $income,
                'Deduction'     => $deductrion,
                'Months'        => $values->SalaryMonthy,
                'years'         => $values->SalaryYear,
                'status'        => 0,
                'Order'         => $values2->Order,
            ];

           $validate=tempsalary::where('Emp_ID',$ID)->where('SalaryHeadID', $values2->HeadSName)
           ->where('Months',$values->SalaryMonthy)->where('years',$values->SalaryYear)->first();
           //dd($validate);
           if($validate==null){
               tempsalary::create($data);
           }else{
               $status=1;
           }
        }
        if($status==0){
        return redirect()->back()->with('msg0', 'Success');
        }else{
        return redirect()->back()->with('msg', 'Success');
        }
        //die();
     }


     public function viewsalary(Request $request,$id){
            $empname= employeemaster::where('Id',$id)->first();
            //dd($empname);
            $details = tempsalary::where('Emp_ID',$id)
                   ->where('SalaryHeadID','!=','Basic')
                   ->where('SalaryHeadID','!=','DA')
                   ->where('SalaryHeadID','!=','TA')
                   ->get();
            return view("admin.Payroll.salary.ShowHead",compact('details','empname'));
     }

     public function ProcessAttendence(Request $request,$month,$year){

        $employee = employeemaster:: where('activestatus',1)
            ->join('empattendence','empattendence.Emp_id','=','employeemaster.Id')
            ->where('empattendence.Month',$month)
            ->where('empattendence.Year',$year)
            ->get();
        $MName = DB::table('monthmaster')->where('Month',$month)->first();

            if($employee->isEmpty()){
               $emp=employeemaster::select('Id','Employee_Code')->where('activestatus',1)->get();
               foreach($emp as $empl){
                 $values=[
                     'Emp_id'  => $empl->Id,
                     'Emp_code'=> $empl->Employee_Code,
                     'Month'   => $request->month,
                     'M_name'  => $MName->M_name,
                     'Year'    => $request->year,
                     'NoOfAbsent' => 0,
                 ];
                 empattendence::create($values);
                 $employee = employeemaster:: where('activestatus',1)
                        ->join('empattendence','empattendence.Emp_id','=','employeemaster.Id')
                        ->where('empattendence.Month',$request->month)
                        ->where('empattendence.Year',$request->year)
                        ->get();
               }
            }
       return view('admin.Payroll.employee.AttendenceProcess',compact('employee'));
    }
    public function Attendence(Request $request){
        $monthname=DB::table('monthmaster')->get();
        if($request->has('month')){
            $employee = employeemaster::
                join('empattendence','empattendence.Emp_id','=','employeemaster.Id')
                ->where('empattendence.Month',$request->month)
                ->where('empattendence.Year',$request->year)
                ->get();
            $MName = DB::table('monthmaster')->where('Month',$request->month)->first();

                if($employee->isEmpty()){
                    $alert='Not found';
                    return view('admin.Payroll.employee.Attendence',compact('monthname','alert'));
                }
           return view('admin.Payroll.employee.Attendence',compact('employee','monthname'));
        }else{
            return view('admin.Payroll.employee.Attendence',compact('monthname'));
        }


    }

    public function EditClaimed(Request $request){
        $newAmt=[
           'Amount' => $request->newAmt,
        ];
        tempsalary::where('Emp_Code',$request->code)->where('SalaryHeadID',$request->id)->update($newAmt);
        return redirect()->back();
            //->to(route("abc.", ["year" => 2, "month" => 1253]));
    }

    public function SaveTempVal(Request $request){
        // dd($request->all());
        if($request->has("ID")){
            foreach($request->ID as $id){
                $tempSal=tempsalary::where('Emp_Code',$id)->get();
                $employee=employeemaster::where('Employee_Code',$id)->first();

                $employee_data=$employee->toArray();
                unset($employee_data["Id"]);
                //dd($employee_data);
                employeemonthlymaster::create($employee_data);
                //dd($tempSal[0]->year);
                $year=1947;
                $totsal=0;
                foreach($tempSal as $temp){
                    $year=$temp->years;
                    if($temp->status==0){
                        $emptrans=[
                            'Emp_ID'         => $temp->Emp_ID,
                            'Emp_Code'       => $temp->Emp_Code,
                            'SalaryHeadID'   => $temp->SalaryHeadID,   //Escic
                            'SalaryHeadCode' => $temp->SalaryHeadCode,
                            'Amount'         => $temp->Amount,
                            'Income'         => $temp->Income,
                            'Deduction'      => $temp->Deduction,
                            'Months'         => $temp->Months,
                            'years'          => $temp->years,
                            'Order'          => $temp->Order,
                        ];
                        employeetransactions::create($emptrans);
                        $Status=[
                            'status' => 1,
                        ];
                        tempsalary::where('ID',$temp->ID)->update($Status);
                        $salstatus=[
                            'SalaryStatus'=>1,
                        ];
                        employeemaster::where('Employee_Code',$temp->Emp_Code)->update($salstatus);
                    }
                    // voucher entry
                    if($temp->SalaryHeadID=='ESIC'){
                        $naration='Being the amt of ESIC Contributrion for'.$employee->EmpFirstName.' '.$employee->EmpMiddleName.' '.$employee->EmpLastName;
                        $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'G0153'];
                        $voucharno= Helper::InsertInto_atcbhd08($id,$temp->Amount,$naration,'C','C','ESIC',$descid);
                    }else{
                        if($temp->Income==1){
                            $totsal+=$temp->Amount;
                        }else{
                            $totsal-=$temp->Amount;
                        }
                    }
                    // voucher entry ends here


                    //to ceck completion of payroll
                    $validate=tempsalary::select('tempsalary.status')
                        ->join('employeemaster','employeemaster.Employee_Code','=','tempsalary.Emp_Code')
                        ->where('employeemaster.activestatus',1)
                        ->get();
                        $flag=0;
                        foreach($validate as $val){
                            if($val->status==0){
                                $flag=1;
                                break;
                            }
                        }
                        if($flag==0){
                            $status2=[
                                'status' => 3,
                            ];
                            $status3=[
                                'status' => 1,
                            ];
                            salaryprocess_period::where('Month',$tempSal[0]->Months)->where('Year',$tempSal[0]->years)->update($status2);
                            $month = ($tempSal[0]->Months)+1;
                            if($month==13){
                                $month = 1;
                                $year  = ($tempSal[0]->years+1);
                            }else{
                                $year  = $tempSal[0]->years;
                            }
                            salaryprocess_period::where('Month',$month)->where('Year',$year)->update($status3);
                        }
                }
                $naration='Being the amt of Salary Paid for'.$employee->EmpFirstName.' '.$employee->EmpMiddleName.' '.$employee->EmpLastName;
                $descid=['atcbhd08'=>'C0001', 'atcbdt'=>'G0039'];
                $voucharno= Helper::InsertInto_atcbhd08($id,$totsal,$naration,'C','C','Salary',$descid);
            }
            $employee=employeemaster::where('activestatus',1)->get();
            $success='Successfully Salary Generated';
            return view('admin.Payroll.salary.ProcessedSalaryView',compact('employee','success'));
        }else{
            $employee=employeemaster::where('activestatus',1)->get();
            $error="Select Atleast One Employee";
            return view('admin.Payroll.salary.ProcessedSalaryView',compact('employee','error'));
        }
        ////////////

        //dd($employee);
        // $check=employeemaster::where('activestatus',1)->where('SalaryStatus',0)->get();
        // $check=count($check);
        // if($check>0){
            // return view('admin.Payroll.salary.ProcessedSalaryView',compact('employee'));
        // }else{
        //     return view('admin.Payroll.salary.ProcessedSalaryView',compact('employee'));
        //     // return redirect()->to(route("admin.SalaryProcessF", ["Year" => $year]));
        // }
    }

    public function GenerateSalAll(Request $request){
        dd($request->all());
    }




    public function PaySlipGen(Request $request){
        $month=DB::table('monthmaster')->get();
        // DB::listen(function($query){
        //     dump($query->sql);
        //     dump($query->bindings);
        // });
        if($request->has('month')){
            $payslipAll=employeemaster::join('employeetransactions','employeetransactions.Emp_Code','=','employeemaster.Employee_Code')
                    ->where('employeetransactions.Months','=',$request->month)
                    ->where('employeetransactions.years','=',$request->year)
                    ->orderby('employeetransactions.Order')
                    ->get();
            // $groupWise = $payslipAll->groupBy("Employee_Code");
            // dd($groupWise);
            $Employee=employeemaster::query()
            ->whereExists(function($query) use ($request){
                $query->from("employeetransactions")->whereColumn("employeetransactions.Emp_Code", 'employeemaster.Employee_Code')
                ->where("Months", $request->month)
                ->where("years", $request->year);
            })
            ->get();
            //dd($Employee);
            $monthof=$request->month;
            $yearof =$request->year;
            if($payslipAll->isempty()){
                return view("admin.Payroll.salary.Payslip",compact('month'));
            }else{
                return view("admin.Payroll.salary.Payslip",compact('month','Employee','payslipAll','monthof','yearof'));
            }
        }
       return view("admin.Payroll.salary.Payslip",compact('month'));
    }

    public function editattendence(Request $request,$month,$year){
        $emp=employeemaster::select('Employee_Code')->where('activestatus',1)->get();
        //dd($emp);
        foreach($emp as $code){
            $name=$code->Employee_Code;
            $attendence=[
             'NoOfAbsent' => $request->$name,
             'status'     => 1,
              ];
         empattendence::where('Emp_code',$code->Employee_Code)
                     ->where('Month',$month)
                     ->where('Year',$year)
                     ->update($attendence);
        }
        return redirect()->to(route("admin.SalaryProcessF", ["Year" => $year]));


     }
    public function SalaryProcessF(Request $request){
        if($request->has('Year')){
            $check=salaryprocess_period::with('month')->where('Year',$request->Year)->get();
            //dd($check);
            if($check->isEmpty()){
                for($i=1;$i<=12;$i++){
                    $month = $i;
                    $year = $request->Year;
                    $first_date  =  $year ."-" . str_pad($month, 2, STR_PAD_LEFT, 0) ."-01";
                    $last_date = date("Y-m-t", strtotime($first_date));
                    $data=[
                        'Month'       => $i,
                        'Year'        => $request->Year,
                        'Salary_From' => $first_date,
                        'Salary_To'   => $last_date,
                        'Status'      => 0,
                     ];
                     salaryprocess_period::create($data);
                }
                $check=salaryprocess_period::with('month')->where('Year',$request->Year)->get();
                //dd($check);
                return view('admin.Payroll.salary.SalaryProcessingF',compact('check'));
            }else{
                $check2=salaryprocess_period::with('month')->where('Year',$request->Year)->get();
                return view('admin.Payroll.salary.SalaryProcessingF',compact('check'));
            }
        }
        return view('admin.Payroll.salary.SalaryProcessingF');
    }


    public function ProcessSalary(Request $request,$id){

     $validate=salaryprocess_period::where('id',$id)->first();
     //dd($validate);
     $employee=DB::table('employeemaster')
                ->join('empattendence','employeemaster.Id','=','empattendence.Emp_id')
                ->where('empattendence.Month',$validate->Month)
                ->where('empattendence.Year',$validate->Year)
                ->where('empattendence.status',1)
                ->get();
     //dd($employee);
     if($employee->isEmpty()){
         $month=$validate->Month;
         $year =$validate->Year;
        return redirect()->back()->with('msg','maintain attendence');
     }
            foreach($employee as $emp){
                $oneday=($emp->BasicPay)/30;
                $newbasic=[
                    'Amount'=>round(($emp->BasicPay)-($oneday*$emp->NoOfAbsent),2),
                    'Months'=>$validate->Month,
                    'years' =>$validate->Year,
                ];
                $newmonth=[
                    'Months'=>$validate->Month,
                    'years' =>$validate->Year,
                    'status'=>0,
                ];
                //dd($newmonth);
                tempsalary::where('Emp_ID',$emp->Emp_id)
                        ->where('tempsalary.SalaryHeadID','Basic')
                        ->update($newbasic);
                tempsalary::where('Emp_Code',$emp->Employee_Code)->update($newmonth);
                $salstatus=[
                    'SalaryStatus'=>0,
                  ];
                  employeemaster::where('Employee_Code',$emp->Employee_Code)->update($salstatus);


            }
                $status=[
                    'Status'=> 2,
                ];
                $id2=$id+1;
                salaryprocess_period::where('id',$id)->update($status);
                //DB::table('salary_processing_month')->where('id',$request->data)->update($status);
     return redirect()->back();
    }

    public function edit_view(Request $request){
       //dd("ok");
       $employee=employeemaster::where('activestatus',1)->get();
       //dd($employee);
       //dd($employee);SalaryStatus
       return view('admin.Payroll.salary.ProcessedSalaryView',compact('employee'));

    }
    public function SalaryClaimed(Request $request,$id){
       //dd($id);
       $name=employeemaster::where('Employee_Code',$id)->first();
       $details=tempsalary::where('Emp_Code',$id)->get();
       //dd($details);
       $leave=empattendence::where('Month',$details[0]->Months)->where('Year',$details[0]->years)->first();
       //dd($leave);
       $gross=0;
       foreach($details as $dtl){
           if($dtl->Income==1){
               $gross=$gross+$dtl->Amount;
           }else{
               $gross=$gross-$dtl->Amount;
           }
       }
       return view('admin.Payroll.salary.ClaimedSalaryView',compact('name','details','leave'));
     }
     public function changeattendence(Request $request){
         $newatten=[
            'NoOfAbsent'=>$request->newleave,
         ];
        empattendence::where('Id',$request->id)->update($newatten);
        $Basic=employeemaster::select("BasicPay")->where("Employee_Code",$request->code)->first();
        $oneday=($Basic->BasicPay)/30;
        $newbasic=[
            'Amount'=>round(($Basic->BasicPay)-($oneday*$request->newleave),2),
        ];
        tempsalary::where('Emp_Code',$request->code)->where('SalaryHeadID','Basic')->update($newbasic);
        return redirect()->back();
      }


      public function printpayslip($id1,$id2){
        $month=DB::table('monthmaster')->get();

            $payslipAll=employeemaster::join('employeetransactions','employeetransactions.Emp_Code','=','employeemaster.Employee_Code')
                    ->where('employeetransactions.Months','=',$id1)
                    ->where('employeetransactions.years','=',$id2)
                    ->orderby('employeetransactions.Order')
                    ->get();
            $Employee=employeemaster::query()
            ->whereExists(function($query) use ($id1,$id2){
                $query->from("employeetransactions")->whereColumn("employeetransactions.Emp_Code", 'employeemaster.Employee_Code')
                ->where("Months", $id1)
                ->where("years", $id2);
            })
            ->get();
            $monthof=$id1;
            $yearof =$id2;
        $pdf = PDF::loadView('admin.Payroll.salary.PrintPayslip',compact('month','Employee','payslipAll','monthof','yearof'));
        return $pdf->stream('PayslipAll'.'.pdf');
     }

}
