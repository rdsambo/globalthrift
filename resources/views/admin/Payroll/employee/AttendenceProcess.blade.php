@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                         <label>Employee Attendence for the {{$employee[0]->M_name}} / {{$employee[0]->Year}}</label>
                    </div>
                    @isset($employee)
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <div class="col-sm-8">
                            <form method="POST" action="{{route('admin.editattendence',[$employee[0]->Month,$employee[0]->Year])}}">
                            @csrf
                                <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>ID</th>
                                            <th>Employee Code</th>
                                            <th>Employee Name</th>
                                            <th>Month</th>
                                            <th>No of Absent Days</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee as $emp)
                                        <tr>
                                            @csrf
                                            <td>{{1}}</td>
                                            <td>{{$emp->Id}}</td>
                                            <td>{{$emp->Employee_Code}}</td>
                                            <td>{{$emp->EmpFirstName}}{{$emp->EmpMiddleName}}{{$emp->EmpLastName}}</td>
                                            <td>{{$emp->M_name}} -- {{$emp->Year}}</td>
                                            <td><input type="number" name="{{$emp->Employee_Code}}"class="form-control" value="{{$emp->NoOfAbsent}}" ></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary" style="margin-left:65%">Save</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection


