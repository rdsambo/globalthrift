@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            {{-- <h3>Employeee Details</h3> --}}
                            <form>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-1"><h3>Filter </h3></label>
                                        <div class="col-md-3">
                                            <select name="option" class="form-control">
                                                <option value="Unpaid">Employee</option>
                                                <option value="ExEmp">Ex. Employee</option>
                                              </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-filter"></i>Search </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <div class="col-sm-10">
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>ID</th>
                                        <th>Employee Code</th>
                                        <th>Employee Name</th>
                                        <th colspan="3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count=0;
                                    @endphp
                                    @foreach($employeedetails as $list)
                                    @php
                                    $count=$count+1;
                                    @endphp
                                    @if($list->activestatus==1)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$list->Id}}</td>
                                        <td>{{$list->Employee_Code}}</td>
                                        <td>{{$list->Title}}&nbsp;&nbsp;{{$list->EmpFirstName}}&nbsp;&nbsp;{{$list->EmpMiddleName}}&nbsp;&nbsp;{{$list->EmpLastName}}</td>
                                        <td> <a href="{{route('admin.Payroll.View_details',[$list->Id])}}"><i class="fa fa-edit"></i></a></td>
                                        <td> <a href="{{route('admin.Payroll.Show_O',[$list->Id])}}"><i class="fa fa-eye"></a></td>
                                    </tr>
                                    @else
                                    <tr style="color:#800000">
                                        <td>{{$count}}</td>
                                        <td>{{$list->Id}}</td>
                                        <td>{{$list->Employee_Code}}</td>
                                        <td>{{$list->Title}}&nbsp;&nbsp;{{$list->EmpFirstName}}&nbsp;&nbsp;{{$list->EmpMiddleName}}&nbsp;&nbsp;{{$list->EmpLastName}}</td>
                                        <td> <a href="{{route('admin.Payroll.View_details',[$list->Id])}}"><i class="fa fa-edit"></i></a></td>
                                        <td> <a href="{{route('admin.Payroll.Show_O',[$list->Id])}}"><i class="fa fa-eye"></a></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $employeedetails->appends(request()->all()) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection


