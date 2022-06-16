@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <a href="{{route('admin.AddHead')}}" class="btn btn-primary">Add Column</a>
                        </div>
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            <span style="font-size: medium">{{Session::get('success')}}</span>
                        </div>
                        @endif
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <div class="col-sm-10">
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>ID</th>
                                        <th>head Name</th>
                                        <th>Short Name</th>
                                        <th>Status</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $c=0;
                                    @endphp
                                    @foreach($head as $hd)
                                    @php
                                    $c=$c+1;
                                    @endphp
                                    <tr><form>
                                        <td>{{$c}}</td>
                                        <td>{{$hd->ID}}</td>
                                        <td>{{$hd->HeadName}}</td>
                                        <td>{{$hd->HeadSName}}</td>
                                        <td>@if($hd->Status==1)
                                            Income
                                            @else
                                            Deduction
                                            @endif
                                        </td>
                                        <td> <a href="{{route('admin.Payroll.EditHead',[$hd->ID])}}"><i class="fa fa-edit"></i></td>
                                            <td> <a href="{{route('admin.Payroll.DeleteHead',[$hd->ID])}}" onclick="return confirm('Are you sure?')"><i class="far fa-trash-alt"></i></td>
                                    </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
<script>
$('#alert').load(function(){
    alert('Already Exist');
})
</script>
@endsection


