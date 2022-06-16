@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h3>Generate Salary</h3>
                        </div>
                        @isset ($success)
                        <div class="alert alert-success" role="alert">
                            <label>{{$success}}</label>
                        </div>
                        @endisset
                        @isset ($error)
                        <div class="alert alert-danger" role="alert">
                            <label>{{$error}}</label>
                        </div>
                        @endisset
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <div class="col-sm-10">
                                <form action="{{route('admin.SaveFromTemp')}}" method="post">
                                    @csrf
                                    <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                        <thead>
                                            <tr>
                                                {{-- <th>SL</th> --}}
                                                <th>#&nbsp;<input class="form-check-input" id="checkall" name="applicable_for_all" type="checkbox" ></th>
                                                <th>Employee Code </th>
                                                <th>Employee Name</th>
                                                {{-- <th>Total</th> --}}
                                                <th colspan="3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($employee as $key=>$emp)
                                            <tr>
                                                @if($emp->SalaryStatus==0)
                                                <th>{{++$key}}&nbsp;&nbsp;<input value="{{$emp->Employee_Code}}"class="form-check-input checkboxes" id="applicable-for-all" name="ID[]" type="checkbox" onchange="checkboxChecked(this)" ></th>
                                                @else
                                                <th>{{++$key}}&nbsp;&nbsp;<input value="{{$emp->Employee_Code}}"class="form-check-input checkboxes" id="applicable-for-all" name="ID[]" type="checkbox" disabled  ></th>
                                                @endif

                                                <th>{{$emp->Employee_Code}}</th>
                                                <th>{{$emp->Title}}&nbsp;&nbsp;{{$emp->EmpFirstName}}&nbsp;&nbsp;{{$emp->EmpMiddleName}}&nbsp;&nbsp;{{$emp->EmpLastName}}</th>
                                                @if($emp->SalaryStatus==0)
                                                <th><a href="{{route('admin.ClaimedSalary',[$emp->Employee_Code])}}"><i class="btn btn-primary">Edit & Generate Individually</i></th>
                                                @else
                                                {{-- <th><a href="{{route('admin.ClaimedSalary',[$emp->Employee_Code])}}"><i class="fa fa-eye"></i></th> --}}
                                                <th><i class="btn btn-primary">Generated</i></th>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h5>Submit For Selective</h5>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="submit" value="submit" id="submit" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

    // function Validate() {
    //     var x=document.getElementsByName("ID[]").length;
    //     alert(x);
    //     if(length.x>0){
    //         return confirm('Are you sure you want to Generate for all ?');
    //     }else{
    //         alert('Please select atleast one Employee');
    //         return false;
    //     }
    // }
    </script>
@endsection


