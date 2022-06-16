@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <form>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3"><h3>Search Member By </h3></label>
                                <div class="col-md-3">
                                    <select name="option" class="form-control">
                                        <option value="MembershipNo">Membership No</option>
                                        <option value="MemberName">Member Name</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="value" class="form-control" placeholder="Enter ">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-filter"></i>Search </button>
                                </div>
                            </div>
                        </div>
                        </form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="{{route("admin.member", ["t" => 1, "t1" => 5])}}">
                                    <button type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-filter"></i> DD Member</button></a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{route("admin.member", ["t" => 6, "t1" => 6])}}">
                                        <button type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-filter"></i> MD Member</button>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-sm btn-primary"><a href="{{route('admin.member.add')}}">Add Member</a></button>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="text-right">
                            <button type="button" class="btn btn-sm btn-primary"><a href="{{route('admin.member.add')}}">Add Member</a></button>
                        </div>
                        <div class="row col-md-12">
                            <div class="text-left col-md-1">
                                <a href="{{route("admin.member", ["t" => 1, "t1" => 5])}}">
                                <button type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-filter"></i> DD Member</button>
                            </a>
                            </div>
                            <div class="text-left col-md-1 pl-3">
                                <a href="{{route("admin.member", ["t" => 6, "t1" => 6])}}">
                                <button type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-filter"></i> MD Member</button>
                            </a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                <caption>{{$memrecs->total()}} records found</caption>
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Membership No</th>
                                        <th>Member No</th>
                                        <th>Joining</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th colspan="3">Action</th>
                                    </tr>
                                </thead>

                                    <tbody>
                                @if($memrecs)
                                        @php
                                         $cnt=1;
                                        @endphp
                                    @foreach ($memrecs as $mem )
                                    <tr class="gradeX {{$mem->deleted_at ? " text-danger" : ""}}">
                                            <td>{{$cnt}}</td>
                                            <td>{{$mem->MembershipNo}}</td>
                                            <td>{{$mem->MemberNo}}</td>
                                            <td>{{date('d-m-Y',strtotime($mem->AdmissionDate))}}</td>
                                            <td>{{$mem->MemberName}}</td>
                                            <td>{{$mem->Gender}}</td>
                                            <td>{{$mem->MemAge}}</td>
                                            <td>
                                                @if(!$mem->deleted_at)
                                                <a href="{{route('admin.member.delete',['id'=>$mem->ID,'memid'=>$mem->MemberId])}}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></a></td>
                                                @endif

                                                {{-- <script>
                                                    function myFunction() {
                                                           var txt;
                                                           var r = confirm("Please Confirm");
                                                               if (r == true) {
                                                                   window.location.href="{{route('admin.member.delete',['id'=>$mem->ID,'memid'=>$mem->MemberId])}}";
                                                               } else {
                                                                   txt = "You pressed can!";
                                                                   }
                                                               document.getElementById("demo").innerHTML = txt;
                                                           }
                                               </script> --}}
                                            <td>
                                                @if(!$mem->deleted_at)
                                                <a href="{{route('admin.member.edit',['id'=>$mem->ID,'memid'=>$mem->MemberId])}}"> <i class="fa fa-edit"></i></a></td>
                                                @endif
                                            <td>
                                                @if(!$mem->deleted_at)
                                                {{-- <a href="{{route('admin.member.view',['id'=>$mem->ID,'memid'=>$mem->MemberId])}}"> <i class="fa fa-eye"></i></a></td> --}}
                                                <a href="{{route('admin.member.View_Member_details2',$mem->MemberId)}}"><i class="fa fa-eye"></i></a></td>
                                                @endif

                                        </tr>
                                        @php
                                         $cnt++;
                                        @endphp
                                    @endforeach
                                @else
                                        <tr>
                                            <td colspan="5">No records Found</td>
                                        </tr>
                                @endif
                                    </tbody>
                            </table>
                            {{ $memrecs->appends(request()->all()) }}
                            <a class="btn btn-primary" href="?export=excel&Loan_officer={{request("member")}}">Export All Members to excel </a>
                            <a class="btn btn-primary" href="?export=PDF">Export to PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
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
<script>
    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('tbl_exporttable_to_xls');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
    }
</script>
<script>
    window.onload = function() {
    //alert("ok google");
    $("#tbl_exporttable_to_xls").hide();

}
</script>
@endsection


