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
                            <div class="col-sm-2">
                                <caption><h3>Select Year:</h3></caption>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" name="Year">
                                    <option>Select</option>
                                   @for($i=2020;$i<=2040;$i++)
                                       <option value="{{$i}}">{{$i}}</option>
                                   @endfor
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <input type="submit" class="btn btn-primary" value="Find">
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
                        @isset($check)
                        <div class="row">
                            <div class="col-sm-10">
                                <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important;" >
                                    <thead>
                                        <tr>
                                            {{-- <th>SL</th> --}}
                                            <th>Month & Year</th>
                                            <th>Salary Period</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($check as $ck)
                                        <tr>
                                            <th>{{$ck->month->M_name}}/{{$ck->Year}}</th>
                                            <th>{{$ck->Salary_From}} -to- {{$ck->Salary_To}}</th>
                                            {{-- <th><select class="form-control">
                                                  <option>Activate</option>
                                                  <option>deactivate</option>
                                                <select>
                                            </th>
                                            <th><button type="submit" class="btn btn-primary">Apply</button></th> --}}
                                            @if($ck->Status==0)
                                                <th><span class="btn btn-info">Waiting</span></th>
                                            @endif
                                            @if($ck->Status==1)
                                                <th><a href="{{route('admin.ProcessSalary',[$ck->id])}}" class="btn btn-success" onclick="return confirm('Are you sure you want to Process for this month?');">Click to Process Salary</a></th>
                                                @if(session()->has('msg'))
                                                <div class="alert alert-danger" role="alert">
                                                    Attendence List Doesnot Exist.....
                                                    <a href="{{route('admin.AttendenceProcess',[$ck->Month,$ck->Year])}}">Click here to Manage Attendence</a>
                                                </div>
                                                @endif
                                            @endif
                                            @if($ck->Status==2)
                                                <th><span class="btn btn-primary">Processed</span>&nbsp;&nbsp;&nbsp;<a href="{{route('admin.view_edit')}}" class="btn btn-success">Generate</a></th>
                                            @endif
                                            @if($ck->Status==3)
                                                <th><span class="btn btn-primary">Processed</span>&nbsp;&nbsp;&nbsp<a href="{{route('admin.PaySlip',['month'=>$ck->Month,'year'=>$ck->Year])}}" class="btn btn-success">View Pay Slip</a></th>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection


