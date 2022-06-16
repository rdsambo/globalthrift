@extends('admin.layout.master')
<style>

    .filter{
    padding-right: 44px;
    padding-left: 44px;
    padding-top: 44px;
    }
</style>
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox-title">
            <form>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <caption><h3>Select Month for Salary Processing :</h3></caption>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control" name="data">
                                    <option>Select</option>
                                    @foreach($month as $mon)
                                    <option value='{{$mon->id}}'>{{$mon->Month_text}}&nbsp;&nbsp;{{$mon->year}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <input type="submit" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        @isset($msg1)
                        <div class="alert alert-warning" role="alert">
                            Please Select Current Month...
                        </div>
                        @endisset
                        @isset($msg0)
                        <div class="alert alert-warning" role="alert">
                            Salary is already processed for this month....
                        </div>
                        @endisset
                        @isset($salaryEmp)
                            {{-- <div class="ibox-content"> --}}
                               <legend>Salary Claimed :</legend>

                                {{-- <form   method="post" action="{{route("admin.ClaimedEdit")}}"> --}}

                                <form>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <label>Select Name :</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-control" id="SalaryClaim" name="Emp_Code">
                                                        <option>--- SELECT ----</option>
                                                        @foreach($salaryEmp as $emp)
                                                        <option value="{{$emp->Employee_Code}}">{{$emp->EmpFirstName}}&nbsp;{{$emp->EmpMiddleName}}&nbsp;{{$emp->EmpLastName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        @endisset
                        @isset($name)
                        @php
                            $gross=0;
                        @endphp
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <label>Employee Name :</label>
                                                </div>
                                                <div class="col-sm-1">
                                                <input readonly class="form-control" name="Title" id="Title" value="{{$name->Title}}">
                                                </div>
                                                <div class="col-sm-2">
                                                    <input readonly class="form-control" name="Fname" id="Fname" value="{{$name->EmpFirstName}}">
                                                </div>
                                                <div class="col-sm-2">
                                                    <input readonly class="form-control" name="Mname" id="Mname" value="{{$name->EmpMiddleName}}">
                                                </div>
                                                <div class="col-sm-2">
                                                    <input readonly class="form-control" name="Lname" id="Lname" value="{{$name->EmpLastName}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 b-r">
                                    <legend>Income:</legend>
                                    @foreach($details as $dtl)
                                    <form method="post" action="{{route('admin.ClaimedEdit',['id'=>$dtl->SalaryHeadID,'code'=>$dtl->Emp_Code])}}">
                                        @csrf
                                        @if($dtl->Income==1)
                                            <div class="form-group row" id="income">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label>{{$dtl->SalaryHeadCode}} :</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input readonly class="form-control" value="{{$dtl->Amount}}" style="text-align:right">
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <a onclick="myFunction('{{$dtl->SalaryHeadID}}')"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div id="{{$dtl->SalaryHeadID}}" style="display:none">
                                                            <div class="col-sm-3" type="hidden">
                                                                <input type="number" name="newAmt" class="form-control" style="text-align:right" required>
                                                            </div>
                                                            <div class="col-sm-2" type="hidden">
                                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $gross=$gross+$dtl->Amount;
                                            @endphp
                                        @endif
                                    </form>
                                    @endforeach
                                    </div>
                                    <div class="col-sm-6 ">
                                    <legend>Deduction:</legend>
                                    @foreach($details as $dtl)
                                    <form method="post" action="{{route('admin.ClaimedEdit',['id'=>$dtl->SalaryHeadID,'code'=>$dtl->Emp_Code])}}">
                                    @csrf
                                    @if($dtl->Income==0)
                                        <div class="form-group row" id="income">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label>{{$dtl->SalaryHeadCode}} :</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input readonly class="form-control" value="{{$dtl->Amount}}" style="text-align:right">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <a onclick="myFunction('{{$dtl->SalaryHeadID}}')"><i class="fa fa-edit"></i></a>
                                                    </div>
                                                    <div id="{{$dtl->SalaryHeadID}}" style="display:none">
                                                        <div class="col-sm-3" type="hidden">
                                                            <input type="number" name="newAmt" class="form-control" style="text-align:right" required>
                                                        </div>
                                                        <div class="col-sm-2" type="hidden">
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                        $gross=$gross-$dtl->Amount;
                                    @endphp
                                    @endif
                                    </form>
                                    @endforeach
                                    </div>
                                    <div class="form-group row" style="margin-left:10%">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <label><h4>Gross Salary :-</h4></label>
                                                </div>
                                                <div class="col-sm-2">
                                                <input readonly class="form-control" name="GS" id="GS" value="{{$gross}}" style="text-align:right">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <form action="{{route('admin.SaveFromTemp',[$name->Employee_Code])}}" method="post">
                                @csrf
                                    <div class="form-group row" style="margin-left:10%">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                </div>
                                                <div class="col-sm-2">
                                                    <button class="btn btn-primary" onclick="return confirm('Are you sure you want to Save?');">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            {{-- </div> --}}
                    @endisset
                        <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
   function myFunction(id) {
       //alert(id);
       document.getElementById(id).style.display = 'block';
  //document.getElementById("demo").innerHTML = "Hello World";
}
</script>
@endsection


