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
            <label>Claimed Salary :</label>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
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
                                    <form method="post" action="{{route("admin.changeattendence",['id'=>$leave->Id,'code'=>$leave->Emp_code])}}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <label>No of Leave :</label>
                                                </div>
                                                <div class="col-sm-1">
                                                <input readonly class="form-control" name="Title" id="Title" value="{{$leave->NoOfAbsent}}">
                                                </div>
                                                <div class="col-sm-1">
                                                    <a onclick="myFunction0('attendence')"><i class="fa fa-edit"></i></a>
                                                </div>
                                                <div style="display:none" id='attendence'>
                                                    <div class="col-sm-1" type="hidden">
                                                        <input type="number" name="newleave" class="form-control" style="text-align:right" required>
                                                    </div>
                                                    <div class="col-sm-2" type="hidden">
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
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
                                                            <input type="number" name="newAmt" class="form-control" style="text-align:right"  required>
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
                                <form action="{{route('admin.SaveFromTemp')}}" method="post">
                                @csrf
                                    <div class="form-group row" style="margin-left:10%">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="hidden" name="ID[]" value="{{$name->Employee_Code}}">
                                                    <button class="btn btn-primary" onclick="return confirm('Are you sure you want to Save? After Submit You Can`t change Anything..');">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            {{-- </div> --}}
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
    function myFunction0(id){
        document.getElementById(id).style.display = 'block'
    }
</script>
@endsection


