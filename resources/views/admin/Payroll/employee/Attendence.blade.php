@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <form>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <caption><h3>Select Year & Month  :</h3></caption>
                                        </div>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="year" required>
                                                <option>Select</option>
                                                   @for($i=2020;$i<=2040;$i++)
                                                   <option value="{{$i}}">{{$i}}</option>
                                                   @endfor
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="month" required>
                                                <option>Select</option>
                                                    @foreach($monthname as $mon)
                                                    <option value='{{$mon->id}}'>{{$mon->M_name}}&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="submit" class="btn btn-primary" value="Search">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @isset($alert)
                        <div class="alert alert-danger" role="alert">
                            Attendence List Doesnot Exist.....
                        </div>
                        @endisset
                    </div>
                    @isset($employee)
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <div class="col-sm-10">
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
                                            <td>{{$emp->NoOfAbsent}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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


