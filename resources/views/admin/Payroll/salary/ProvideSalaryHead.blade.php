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
            <h5>Salary <small> </small></h5>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        @if (\Session::has('msg0'))
                        <div class="alert alert-success" role="alert">
                            Successfully Added Salary Head....
                        </div>
                        @endif
                        @if (\Session::has('msg'))
                        <div class="alert alert-warning" role="alert">
                            This Salary Head is Already Added....
                        </div>
                        @endif
                        <form method="post" action="{{route('admin.submitSHead')}}">
                        @csrf
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                    <thead>
                                        <tr>
                                            <th><input class="form-check-input" id="checkall" name="applicable_for_all" type="checkbox" ></th>
                                            <th>SL</th>
                                            <th>Employee ID</th>
                                            <th>Employee Code</th>
                                            <th>Employee Name</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $count=0;
                                        @endphp

                                        @foreach($employee as $emp)
                                        @php
                                        $count++;
                                        @endphp
                                        <tr>
                                            <td><input value="{{$emp->Id}}"class="form-check-input checkboxes" id="applicable-for-all" name="ID[]" type="checkbox" onchange="checkboxChecked(this)" ></td>
                                            <td>{{$count}}</td>
                                            <td>{{$emp->Id}}</td>
                                            <td>{{$emp->Employee_Code}}</td>
                                            <td>{{$emp->EmpFirstName}}&nbsp;&nbsp;{{$emp->EmpMiddleName}}&nbsp;&nbsp;{{$emp->EmpLastName}}</td>
                                            <td><a href="{{route('admin.viewsalary',$emp->Id)}}"><i class="fas fa-eye"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="ibox-content">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <caption><h3># Salary Head</h3></caption>
                                            </div>
                                            <div class="col-sm-3">
                                                <select class="form-control" name="SHead" required  >
                                                    <option>Select</option>
                                                    @foreach($head as $hd)
                                                    <option value="{{$hd->ID}}">{{$hd->HeadName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-1">
                                                <label>Through</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="form-control" id="perge" >
                                                    <option>Select</option>
                                                    <option value="Y">percentage</option>
                                                    <option value="N">fixed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" id="Yes">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-5">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>Percentage</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="float" class="form-control" name="percentage">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" id="No">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-5">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>Amount</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="number" class="form-control" name="Amount">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                           <button tupe="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
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
$(document).ready(function(){
    $('#Yes').hide();
    $('#No').hide();
    $('#perge').change(function(){
        if($('#perge').val()=='Y'){
            $('#Yes').show();
            $('#No').hide();
        }else{
            $('#No').show();
            $('#Yes').hide();
        }
    });
});
</script>
<script>
$("#checkall").click(function (){
    if ($("#checkall").is(':checked')){
        $(".checkboxes").not("[disabled]").each(function (){
            $(this).prop("checked", true);
            });
    }else{
        $(".checkboxes").not("[disabled]").each(function (){
            $(this).prop("checked", false);
        });
    }
});
</script>



@endsection


