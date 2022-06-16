@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                            {{-- <form class="navbar-form navbar-left" role="search" method="GET" action="{{route("admin.member", ["memid" => request("memid")])}}">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name ="memid" id="memid" placeholder="Search">
                                    </div>
                                    <button type="submit" class="btn btn-default">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                            </form> --}}
                        <div class="ibox-title">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-3"><h3>Search By Loan Officer</h3></label>
                                </div>
                            <form method="get" action="{{route('admin.member.get_member')}}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select id="sel_officer" name="Loan_officer" id="Loan_officer" class="form-control" required>
                                            <option value="">Select One Loan Officer </option>
                                            @foreach($loname as $lo)
                                            <option value="{{$lo->GroupId}}"> {{$lo->EOName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" name="search" value="Search" class="btn btn-sm btn-primary">
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>

                    @if($memrecsno!=1)
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important">
                                <caption> <h4>LO Name : {{$name->EOName}}<h4></caption>

                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>ID</th>
                                        <th>Member No</th>
                                        <th>Joining</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th colspan="3">Action</th>
                                    </tr>
                                </thead>
                                @if($memrecs)
                                @php
                                 $cnt=1;
                                @endphp
                            @foreach ($memrecs as $mem )
                            <tr class="gradeX {{$mem->deleted_at ? " text-danger" : ""}}">
                                    <td>{{$cnt}}</td>
                                    <td>{{$mem->MemberId}}</td>
                                    <td>{{$mem->MemberNo}}</td>
                                    <td>{{date('d-m-Y',strtotime($mem->AdmissionDate))}}</td>
                                    <td>{{$mem->MemberName}}</td>
                                    <td>{{$mem->Gender}}</td>
                                    <td>{{$mem->MemAge}}</td>
                                    {{-- <td>
                                        @if(!$mem->deleted_at)
                                        <a href="{{route('admin.member.delete',['id'=>$mem->ID,'memid'=>$mem->MemberId])}}"> <i class="fa fa-trash"></i></a></td>
                                        @endif --}}
                                    <td>
                                        @if(!$mem->deleted_at)
                                        <a href="{{route('admin.member.edit',['id'=>$mem->ID,'memid'=>$mem->MemberId])}}"> <i class="fa fa-edit"></i></a></td>
                                        @endif
                                    <td>
                                        @if(!$mem->deleted_at)
                                        {{-- <a href="{{route('admin.member.view',['id'=>$mem->ID,'memid'=>$mem->MemberId])}}"> <i class="fa fa-eye"></i></a></td> --}}
                                        <a href="{{route('admin.member.View_Member_details',[$mem->MemberId])}}"><i class="fa fa-eye"></i></a></td>
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
                    <a class="btn btn-primary" href="?export=excel&Loan_officer={{request("Loan_officer")}}">Export All Members to excel </a>
                    <a class="btn btn-primary" href="?export=PDF&Loan_officer={{request("Loan_officer")}}">Export to PDF</a>
                        </div>
                    @endif
                    </div>
                </div>
                {{-- Excel ends here --}}
            </div>
        </div>
    </div>
</div>
@endsection
 @section('scripts')
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
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
