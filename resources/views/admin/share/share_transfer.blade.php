
@extends('admin.layout.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <form>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-3"><h3>Enter Share Holder Details </h3></label>
                                        <div class="col-md-3">
                                            <select class="js-example-basic-single" name="accountid" id="accountid" required style="width:100%;">
                                                <option value=""></option>
                                                @foreach($ShareList as $dda)
                                                     <option value="{{$dda->MemberId}}">{{$dda->MemberName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <div class="ibox-content" id="table_view">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Member ID</th>
                                        <th>Member Name</th>
                                        <th>No Of Shares</th>
                                        <th>Date of Purchase </th>
                                        <th>Price</th>
                                        <th>Certificate</th>
                                    </tr>
                                </thead>
                                <tbody id="tabledata">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m-4">
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title_pop"></h4>
        </div>
        <form action="{{route('admin.share.sharewithdrow')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="modal-body">
                    <div class="row" id="model_data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <label class="col-md-4">Share Holder Name</label>
                                <div class="col-md-5"><input type="text" name="holder_name" id="holder_name" class="form-control"></div>
                                <input type="hidden" name="mem_id" id="mem_id" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <label class="col-md-4">Total Shares</label>
                                <div class="col-md-5"><input type="text" name="tot_shares" id="tot_shares" class="form-control"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <label class="col-md-4">Share Purchase Amount</label>
                                <div class="col-md-5"><input type="text" name="pur_amt" id="pur_amt" class="form-control"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <label class="col-md-4">Share Current Value</label>
                                <div class="col-md-5"><input type="text" name="cur_amt" id="cur_amt" class="form-control" value="0.00"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <label class="col-md-4">Withdrawn Mode</label>
                                <div class="col-md-5">
                                    <select name="mode" id="w_mode" class="form-control">
                                        <option value="">-Select-</option>
                                        <option value="C">Cheque</option>
                                        <option value="T">Transfer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" ID="select_a_c_no">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <label class="col-md-4">Check A/C No</label>
                                <div class="col-md-5">
                                    <select class="form-control" name="a_c_id" id="a_c_id">
                                    </select>
                                </div>
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
            </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
$(document).ready(function(){
    $('.js-example-basic-single').select2();
    $('#table_view').hide();
    $('#select_a_c_no').hide();
})

$('#w_mode').change(function(){
if($('#w_mode').val()=='T'){
    $('#select_a_c_no').show();
}
})

$('#accountid').change(function(){
    var val = $('#accountid').val();
    // $('#table_view').show();
    $.ajax({
        'type': "get",
        'url': "{{route('admin.share.sharetransfer')}}",
        'data': {'t1'  : val},
        'dataType': "json",
        'success': function(success){
            //console.log(success.success);
            $("#tabledata").empty();
            $('#table_view').show();
            if(success.success.length>0){
                var total=0;
                $.each(success, function (i){
                    $.each(success[i], function (k, v){
                        total=(+total)+(+v.shareamount);
                      //  console.log(v);
                        var html =
                            `<tr>
                                <td>`+(k+1)+`</td>
                                <td>`+v.MemberId+`</td>
                                <td>`+v.MemberName+`</td>
                                <td>`+v.shares+`</td>
                                <td>`+moment(v.created_at).format('DD-MM-YYYY')+`</td>
                                <td style="text-align:right">`+v.shareamount+`</td>
                                <form method="post" action="#" >
                                <td><a href="#" class="btn btn-sm btn-primary" onclick="MyPopup(`+v.id+`)">Withdraw</a></td>
                                </form>
                            </tr>`
                        $("#tabledata").append(html);
                    });
                });
                var html =
                            `<tr>
                                <th colspan=5 style="text-align:right">Total Amount</th>
                                <th style="text-align:right">`+total+`</th>
                                <td></td>
                            </tr>`
                        $("#tabledata").append(html);
            }else{
                var html = `<tr>
                                <td colspan=7 style="text-align:center"> No Records Found</td>
                            </tr>`
                $("#tabledata").append(html);
            }
        }
    });
});

function MyPopup(id){
   // console.log(id);
    $.ajax({
        'url'     : "{{route('admin.share.sharepopup')}}",
        'type'    : 'get',
        'dataType':'json',
        'data'    :{'t1' : id},
        'success' : function(success){
            //console.log(success.value);
            $('#myModal').modal('show');
            $('#title_pop').empty();
            $('#a_c_id').empty();
            $('#title_pop').append(success.data.MemberName);
            $('#holder_name').val(success.data.MemberName);
            $('#pur_amt').val(success.data.shareamount);
            $('#tot_shares').val(success.data.shares);
            $('#cur_amt').val((+success.data.shares)*(+success.value));
            $('#mem_id').val(success.data.MemberId);
            // console.log(success.ac_no);
            $('#a_c_id').append(`<option value="">Select</option>`);
            $.each(success.ac_no, function (k, v){
                console.log(v);
                $('#a_c_id').append(`
                    <option value="`+v.AccountId+`,`+v.AType+`">`+v.AccountNo+`</option>
                `);
            });
        }

    });
}
</script>
@endsection


