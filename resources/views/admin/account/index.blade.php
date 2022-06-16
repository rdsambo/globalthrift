@extends('admin.layout.master')
@section('content')
@if(Session::has('success'))
<div class="alert alert-success">
    <span style="font-size: medium">{{Session::get('success')}}</span>
</div>
@endif
<form method="get">
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Filter For A/C    <small> </small></h5>
					</div>
					<div class="ibox-content">
                    <form>
                    <div class="row">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 text-right">Search By A/C Type</label>
                                <div class="col-md-3">
                                    <select name="actype" class="form-control">
                                        <option value="">--Select--</option>
                                        <option value="O">Open</option>
                                        <option value="C">Closed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 text-right">Search By A/C Name</label>
                                <div class="col-md-3">
                                    <input type="text" name="name" placeholder="Enter A/C Name." class="form-control" value="{{Request()->get('name')}}" >
                                </div>
                                <label class="col-md-2 text-right">Search By A/C No</label>
                                <div class="col-md-3">
                                    <input type="text" name="ac_no" placeholder="Enter A/C No." class="form-control" value="{{Request()->get('ac_no')}}">
                                </div>
                                <div class="col-md-1">
                                    <input type="submit" value="Search" class="btn btn-primary">
                                </div>
                                <div class="col-md-1">
                                    @if($which==2)
                                    <a href="{{route('admin.account.ddlist')}}" class="btn btn-primary">Reset</a>
                                    @else
                                    <a href="{{route('admin.account.mdlist')}}" class="btn btn-primary">Reset</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">
                                    @if($which==2)
                                    <a href="{{route('admin.account.ddlist')}}" class="btn btn-sm btn-primary">Reset</a>
                                    @else
                                    <a href="{{route('admin.account.mdlist')}}" class="btn btn-sm btn-primary">Reset</a>
                                    @endif
                                </div>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</form>


<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                        {{-- <form class="navbar-form navbar-left" role="search" method="GET" action="{{route("admin.account.ddlistindiv", ["accountid" => request("memid")])}}">
                            <div class="form-group">
                                <input type="text" class="form-control" name ="memid" id="memid" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </form> --}}
                        <div class="ibox-title">
                            <h5>Account Holder List</h5>
                            <div class="row col-md-12">
                            </div>
                        </div>
                    <form action="{{route('admin.editminbal')}}" method="post">
                        @csrf
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                <caption>{{$total}} records found</caption> <button type="button" class="btn btn-primary" id="myBtn">Edit Minimum Balance</button>
                                <thead>
                                    <tr>
                                        <th>SL &nbsp;&nbsp;<input class="form-check-input" id="checkall" name="applicable_for_all" type="checkbox" ></th>
                                        <th>ID</th>
                                        <th>Account No</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Date Opening</th>
                                        <th>Member ID</th>
                                        <th colspan="2">Minm. Bal. / Applicable or not</th>
                                        <th colspan="1">Report</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($accountrecs as $key=>$mem )
                                    <tr class="gradeX {{-- {{$accountrecs->deleted_at ? " text-danger" : ""}} --}}">
                                        <td>
                                            @if($mem->Status=='O')
                                                {{$key+1}} &nbsp;&nbsp;&nbsp;&nbsp;<input value="{{$mem->AccountId}}"class="form-check-input checkboxes" id="for_all" name="ID[]" type="checkbox" onchange="checkboxChecked(this)" >
                                            @else
                                                {{$key+1}} &nbsp;&nbsp;&nbsp;&nbsp;<input value="{{$mem->AccountId}}"class="form-check-input checkboxes" id="for_all" name="ID[]" type="checkbox" disabled  onchange="checkboxChecked(this)" >
                                            @endif
                                        </td>
                                        <td>{{$mem->AccountId}}</td>
                                        <td>{{$mem->AccountNo}}</td>
                                        <td>{{$mem->AccountName}}</td>
                                        <td>{{$mem->Gender}}</td>
                                        <td>{{date('d-m-Y',strtotime($mem->AdmissionDate))}}</td>
                                        <td>{{$mem->MemberId}}</td>
                                        <td>{{$mem->MAmount}}</td>
                                        @if($mem->MBalFlag==0)<td>Not Applicable</td>
                                        @else <td>Applicable</td>
                                        @endif

                                        <td>
                                            @if($which==2)
                                                <button type="button" class="btn btn-pimary"><a href="{{route('admin.accountreport',['acid'=>$mem->AccountId,'status'=>'DD'])}}">DD Report</a></button>
                                            @else
                                            <button type="button" class="btn btn-pimary"><a href="{{route('admin.accountreport',['acid'=>$mem->AccountId,'status'=>'MD'])}}">MD Report</a></button>
                                            @endif
                                        <td>
                                            @if($mem->Status=='O')
                                                <button type="button" onclick="myfun('{{$mem->AccountId}}')" class="btn btn-pimary popup" style="color:rgb(4, 112, 4)">Open</button>
                                            @else
                                                <button type="button" onclick="myfun('{{$mem->AccountId}}')" class="btn btn-pimary popup02" style="color:rgb(134, 9, 9)">Closed</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">No records Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $accountrecs->appends(request()->all()) }}
                        </div>
                    </div>
                    <input type="hidden" name="amt" id="amt">
                    <input type="hidden" name="flag" id="flag">
                    <input type="submit" id="sub_form">
                    </form>
                    <div class="m-4">
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Minum A/C Balance</h4>
                                        <div id="xyz"></div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2" ></div>
                                                    <div class="col-md-4" >
                                                        <label>Applicable </label>
                                                    </div>
                                                    <div class="col-md-4" >
                                                        <input type="radio" name="applicable" id="applicable" value="1">&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2" ></div>
                                                    <div class="col-md-4">
                                                        <label>Not Applicable </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                       <input type="radio" name="applicable" id="not_applicable" value="0">&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{-- <div class="row">
                                                    <div class="col-md-4" >
                                                        <input type="radio" name="applicable" id="applicable" value="1">&nbsp;<label>Applicable </label>
                                                    </div>
                                                    <div class="col-md-4" >
                                                        <input type="radio" name="applicable" id="not_applicable" value="0">&nbsp;<label>Not Applicable </label>
                                                    </div>
                                                </div> --}}
                                                <div class="row">
                                                    <div class="col-md-2" ></div>
                                                    <label class="col-md-4">Enter Minimum Balance</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="minAmt" id="minAmt">
                                                        <input type="hidden" class="form-control" name="ac_nos" id="ac_nos">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-4">
                                                        <input type="button" class="btn btn-primary" value="submit" id="submit">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="m-4">
    <div id="myModalv2" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.close_open_submit')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><h4 id="title_up"></h4><h4 id="title_up_v_2"></h4>
                        <div id="xyz"></div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <label class="col-md-3">Closing Note</label>
                                    <div class="col-md-5" id="Closing_Note" ></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <label class="col-md-3">Closing Type</label>
                                    <div class="col-md-4" id="Closing_Type" ></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <label class="col-md-3" id="reopen"></label>
                                    <div class="col-md-4" id="reopen01" ></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <input type="submit" class="btn btn-primary" value="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$('#sub_form').hide();
$('#myBtn').click(function(){
        $('#myModal').modal('show');
    })
function myfun(id){
    $('#myModalv2').modal('show');
    $.ajax({
                'url'   :  '{{route('admin.close_open')}}',
                'type'  : 'get',
                'data'  : {"id": id},
                'success':function(response){
                    console.log(response.success==true);
                    console.log(response.msg);
                    $('#title_up').empty().append(`A/C Holder name : `+response.msg.AccountName+``);
                    $('#title_up_v_2').empty().append(`A/C No : `+response.msg.AccountNo+``);
                    if(response.msg.Status=='O'){
                        $('#Closing_Note').empty().append(`<textarea rows="3" class="form-control" cols="50" name="cmt"placeholder="Enter Reason...." required></textarea>
                                                           <input type="hidden" name="ac_id" value="`+response.msg.AccountId+`" > `)
                    }else{
                        $('#Closing_Note').empty().append(`<textarea rows="3" class="form-control" cols="50" name="cmt" readonly required>`+response.msg.ClosingNote+`</textarea>
                                                           <input type="hidden" name="ac_id" value="`+response.msg.AccountId+`" >`)
                    }
                    if(response.msg.Status=='O'){
                        $('#Closing_Type').empty().append(`<select class="form-control" name="type" placeholder="Enter Closing type" required>
                                                           <option value="">Select</option>
                                                           <option value="P">Permanent</option>
                                                           <option value="T">Temporary</option>
                                                           </select>`)
                    }else{
                        $('#Closing_Type').empty().append(`<input readonly class="form-control" name="type" value="`+response.msg.ClosingType+`" required>`)
                        $('#reopen').empty().append(`Reopen`)
                        $('#reopen01').empty().append(`<select class="form-control" name="reopen" required>
                                                           <option value="">Select</option>
                                                           <option value="O">Open</option>
                                                           </select>`)
                    }
                },
                'error':function(e){
                    console.log(e);
                },
            });
}

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
$("#submit").click(function (){
    var val=$('#minAmt').val();
    $('#amt').val(val);
    $("#sub_form").click();
});
$("#applicable").click(function (){
    $("#flag").val('1');
});
$("#not_applicable").click(function (){
    $("#flag").val('0');
});
</script>
@endsection


