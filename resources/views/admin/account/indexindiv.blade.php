@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                            <form class="navbar-form navbar-left" role="search" method="GET" action="{{route("admin.account.ddlistindiv", ["accountid" => request("memid")])}}">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name ="memid" id="memid" placeholder="Search">
                                    </div>
                                    <button type="submit" class="btn btn-default">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                            </form>
                        <div class="ibox-title">
                            <h5>Account Holder List</h5>

                            <div class="row col-md-12">
                                {{-- <div class="text-left col-md-1">
                                    <a href="{{route("admin.member", ["t" => 1, "t1" => 5])}}">
                                    <button type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-filter"></i> DD Member</button>
                                </a>
                                </div>
                                <div class="text-left col-md-1 pl-3">
                                    <a href="{{route("admin.member", ["t" => 6, "t1" => 6])}}">
                                    <button type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-filter"></i> MD Member</button>
                                </a>
                                </div> --}}
                            </div>
                        </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                <caption>{{$total}} records found</caption>
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>ID</th>
                                        <th>Account No</th>
                                        {{-- <th>Account ID</th> --}}
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Date Opening</th>
                                        <th>Member ID</th>
                                        <th colspan="3"></th>
                                    </tr>
                                </thead>

                                    <tbody>
                                @if($accountrecs)
                                        @php
                                         $cnt=1;
                                        @endphp
                                   {{--  @foreach ($accountrecs as $mem ) --}}
                                    <tr class="gradeX {{-- {{$accountrecs->deleted_at ? " text-danger" : ""}} --}}">
                                            <td>{{$cnt}}</td>
                                            <td>{{$accountrecs->ID}}</td>
                                            <td>{{$accountrecs->AccountNo}}</td>
                                            {{-- <td>{{$mem->AccountId}}</td> --}}
                                            <td>{{$accountrecs->AccountName}}</td>
                                            <td>{{$accountrecs->Gender}}</td>
                                            <td>{{date('d-m-Y',strtotime($accountrecs->AdmissionDate))}}</td>
                                            <td>{{$accountrecs->MemberId}}</td>
                                    <td><button type="button" class="button btn-primary"><a href="{{route('admin.accountreport',['acid'=>$accountrecs->AccountNo])}}">Daily Deposit Report</a></button>
                                        </tr>
                                        @php
                                         $cnt++;
                                        @endphp
                                   {{--  @endforeach --}}
                                @else
                                        <tr>
                                            <td colspan="5">No records Found</td>
                                        </tr>
                                @endif
                                    </tbody>
                            </table>
                            {{-- {{ $accountrecs->appends(request()->all()) }} --}}
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
$(document).ready(function () {
   $(".checkbox").change(function() {
       if($(this).is(":checked")){
           var t=1;
           $.ajax({
                'url'   : '{{route('admin.getdd-data')}}',
                'type'  : 'get',
                'data'  :  {t:1,t1:5},
                success: function(data){
                   if(data.success==true){
                        var html="";
                   }
                    console.log(data);
                }
           });
       }
   })
});
</script>
@endsection


