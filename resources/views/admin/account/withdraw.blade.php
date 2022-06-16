@extends('admin.layout.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Amount Withdrawal</h5>
                        {{-- <form class="navbar-form navbar-left" role="search" method="GET" action="{{route("admin.member", ["memid" => request("memid")])}}">
                            <div class="form-group">
                                <input type="text" class="form-control" name ="memid" id="memid" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </form> --}}

                        <div class="ibox-content">
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-sm-6 b-r">
                                    <form name="frm2" action="{{route('admin.account.withdrwal')}}" method="post">
                                        @csrf
                                            {{-- <div class="form-group col-md-2">
                                                <button type="button" href="" class="btn info " data-toggle="modal" data-target="#myModal">See Transactions</button>
                                            </div> --}}

                                        <div class="row col-md-12">
                                            <div class="form-group col-md-4">
                                                <label>Account Number</label>
                                            </div>
                                            <div class="form-group col-md-6">
                                                {{-- <datalist id="A/C_No">
                                                    @foreach($accountholder as $dda)
                                                    <option value="{{$dda->AccountNo}}  {{$dda->AccountName}}"></option>
                                                        @endforeach
                                                </datalist>
                                                <input type="text" list="A/C_No" class="form-control" name="accountid" id="accountid"> --}}
                                                <select class="js-example-basic-single" name="accountid" id="accountid" required style="width:100%;">
                                                    <option>------select------</option>
                                                    @foreach($accountholder as $dda)
                                                         <option value="{{$dda->AccountId}}" {{Request()->get('accountid') == $dda->AccountId ? 'selected' : '' }}>{{$dda->AccountName}}({{$dda->AccountNo}})({{$dda->AccountId}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="alert alert-success col-md-6 message">
                                        </div> --}}
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-4">
                                                <label>Withdrawal Amount</label>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" name="withdrawamt" id="withdrawamt">
                                                <input type="hidden" class="form-control" name="depositedamt" id="depositedamt">
                                                <input type="hidden" class="form-control" name="acctholder" id="acctholder">
                                            </div>
                                        </div>

                                        <div class="row col-md-12">
                                            <div class="form-group col-md-4">
                                                <label>Withdrawn Date</label>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" class="form-control" name="dow" id="dow" value="{{date("Y-m-d")}}">
                                            </div>
                                        </div>

                                        <div class="row col-md-12">
                                            <div class="form-group col-md-4">
                                                <label>Mode of Withdrawal</label>
                                            </div>
                                            <div class="form-group col-md-6" >
                                                <select class="form-control" name="mode" id="mode">
                                                    <option value="0">Select One </option>
                                                    <option value="Cash">Cash </option>
                                                    <option value="Cheque">Cheque </option>
                                                    <option value="Transfer">Transfer </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row col-md-12 modeofwithdraw">
                                            <div class="form-group col-md-4">
                                                <label>Cheque No</label>
                                                <input type="text" name="chqno" class="form-control" id="chqno">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Bank Name </label>
                                                <select name="bankname" id="bankname" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach($banks->acledger as $bnk)
                                                        <option value="{{$bnk->DescId}}">{{$bnk->Desc}}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input type="text" name="bankname" class="form-control" id="bankname"> --}}
                                            </div>
                                            {{-- <div class="form-group col-md-2">
                                                <label>Branch Name </label>
                                                <input type="text" name="branchname" class="form-group" id="branchname">
                                            </div> --}}
                                        </div>
                                        <div class="row col-md-12 modeofwithdraw">
                                            <div class="form-group col-md-4">
                                                <label>Cheque Date </label>
                                                <input type="text" name="chqdate" id="chqdate" class="form-control" id="chqdate">
                                            </div>
                                        </div>
                                        <div class="row col-md-12 modeoftransfer">
                                                <div class="form-group col-md-4">
                                                    <label>Transfer to</label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    {{-- <select class="form-control" name="transferac" id="transferac">
                                                        <option value="0">Select One</option>
                                                           @foreach($accountholder as $dda)
                                                              <option value="{{$dda->AccountId}}">{{$dda->AccountId}}</option>
                                                           @endforeach
                                                    </select> --}}
                                                    <select class="js-example-basic-single" name="transferac" id="transferac" required style="width:100%;">
                                                        <option value="0">------select------</option>
                                                        @foreach($accountholder as $dda)
                                                             <option value="{{$dda->AccountId}}">{{$dda->AccountName}}({{$dda->AccountNo}})({{$dda->AccountId}})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-12 " id="hide_it">
                                            <table class="table table-striped table-bordered table-hover" style="font-size: 11px !important">
                                                <thead>
                                                    <tr>
                                                        <th>A/C No</th>
                                                        <th>Name</th>
                                                        <th>Member Id</th>
                                                        <th>Available Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody02">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row col-md-12 modeoftransfer">
                                                <div class="form-group col-md-4">
                                                    <label></label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="hidden" name="acholdername" class="form-control" id="acholdername">
                                                </div>
                                         </div>
                                            {{-- </div>
                                            {{-- <div class="ibox-title"> --}}
                                        <div class="ibox-content">
                                            <div class="row col-md-12">
                                                <div class="form-group col-md-2" style="margin-left:25%">
                                                    {{-- <button type="button" name="btncoll" id="btncoll" class="btn btn-primary">Withdraw</button> --}}
                                                    <button id="submit" type="submit" name="Submit" class="btn btn-primary" style="padding-left: 5%; padding-right: 5%;" onclick="return ChrckVal()">Withdraw</button><br>
                                                </div>
                                            </div>
                                        </div>
                                  </form>
                                </div>
                                <div class="col-sm-6">
                                        <h3>Check Details</h3>
                                        <div class="col-sm-12 ">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important">
                                                <thead>
                                                    <tr>
                                                        <th>A/C No</th>
                                                        <th>Name</th>
                                                        <th>Member Id</th>
                                                        <th>Available Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody01">
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="row col-md-12">
                                            <div class="form-group col-md-8" >
                                                <button type="button" class="btn btn-primary" onclick="openPhoto()">Photo</button>
                                                <button type="button" class="btn btn-primary" onclick="openSignature()">Signature</button>

                                                {{-- <img alt="photo" id="photo" src="" width="460" height="345"> --}}
                                            </div>
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-4" >
                                                <img alt="signature"  id="signature" src="" width="460" height="345">
                                            </div>
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-4" >
                                                <img alt="photo" id="photo" src="" width="460" height="345">
                                            </div>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$('#hide_it').hide();
$(document).ready(function() {
   // $('#memberid').change(function(){
        $('.js-example-basic-single').select2();
        $('#dow').Zebra_DatePicker();
  //});
});
    $(document).ready(function() {
       $('#photo').hide();
       $('#signature').hide();
    });

function openPhoto() {
  var x = document.getElementById("photo");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function openSignature() {
  var x = document.getElementById("signature");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

$(document).ready(function () {
    $('#doc').Zebra_DatePicker();
    $('#chqdate').Zebra_DatePicker();
    $('.modeofwithdraw').hide();
    $('.modeoftransfer').hide();
    $("#accountid").change(function() {
        var t = $(this).val();
        $('#signature').attr("src","");
        $('#photo').attr("src","");

       $.ajax({
            'url'       : '{{route('admin.getaccountdata')}}',
            'type'      : 'get',
            'data'      : {'t1'  : t},
            'dataType' : 'json',
            'success'   :  function(response){
                if(response.success==true){
                        $('#acctholder').val(response.accdata.AccountName);
                        $('#amount').val(response.depoamt.DAmt);
                        $('#withdrawamt').val(response.totamt);
                        $('#depositedamt').val(response.totamt);
                        $('#atype').html(response.accdata.AType);
                        var id=response.accdata.AccountId;
                        var res='';
                        res +=
                        '<tr>'+
                            '<td>'+response.accdata.AccountNo+'</td>'+
                            '<td>'+response.accdata.AccountName+'</td>'+
                            '<td>'+response.accdata.MemberId+'</td>'+
                            '<td>'+response.totamt+'</td>'+
                        '</tr>';
                        $('#tbody01').html(res);
                        $('#signature').attr("src",response.documents.signature);
                        $('#photo').attr("src",response.documents.photo);
                   }
            },
            'error'     : function(response) {
                console.log(response);
            }
       });
    });
    $("#transferac").change(function() {
        var t = $(this).val();
        $('#hide_it').show();
       $.ajax({
            'url'       : '{{route('admin.transferac')}}',
            'type'      : 'get',
            'data'      : {'t1'  : t},
            'dataType' : 'json',
            //'headers'   : {"Authorization": localStorage.getItem('token')},
            'success'   :  function(response){
                if(response.success==true){
                        $('#acholdername').val(response.accdata.AccountName);
                        var res='';
                        res +=
                        '<tr>'+
                            '<td>'+response.accdata.AccountNo+'</td>'+
                            '<td>'+response.accdata.AccountName+'</td>'+
                            '<td>'+response.accdata.MemberId+'</td>'+
                            '<td>'+response.totamt+'</td>'+
                        '</tr>';
                        $('#tbody02').html(res);
                        }
                  console.log(response.accdata.AccountName);
            },
            'error'     : function(response) {
                console.log(response);
            }
       });
    });


    $('#mode').change(function(){
        var selmode=$('#mode :selected').text();

        if(selmode.trim()=='Cheque'){
            $('.modeofwithdraw').show();
            $('.modeoftransfer').hide();
        }
        if(selmode.trim()=='Transfer'){
            $('.modeoftransfer').show();
            $('.modeofwithdraw').hide();
        }
        if(selmode.trim()=='Cash'){
            $('.modeofwithdraw').hide();
            $('.modeoftransfer').hide();
        }
    });

    $("#btncoll").click(function(e) {
        e.preventDefault();
        if($("#doc").val()==""){
            alert("Date of Collection cannot be null or Less");
        }
        if($("#withdrawamt").val()==""){
            alert("Withdrwal Amount cannot be null or Less");
        }
        if($("#mode").val()=="0"){
            alert("Please select mode of withdraw");
            return false;
        }
       // debugger;
        if(parseFloat($("#withdrawamt").val())==parseFloat($('#depositedamt').val())){
            var conf=confirm("Do you want to close the Account ?.. Click 'OK' to confirm 'Cancel' to abort");
            if(conf==true){
                $closeac='y';
                $acid=$("#accountid").val();
                $acno=$("#acctholder").val();
                //$doc=$("#doc").val();
                $withdrawamount=$("#withdrawamt").val();
                $chqno=$("#chqno").val();
                $bankid=$("#bankname").val();
                $chqdate=$('#chqdate').val();
                $transferac=$('#transferac').val();

                //alert($("#withdrawamt").val());
                $.ajax({
                'url'   :  '{{route('admin.account.withdrwal')}}',
                'type'  : 'get',
                'data'  : {"_token": "{{ csrf_token() }}",'accntid':$acid,'accntno':$acno,'amt':$withdrawamount,
                'chqno':$chqno,'bankid':$bankid,'chqdate':$chqdate,'transferac':$transferac,'closeac':$closeac},
                'success':function(response){
                    console.log(response.success==true);
                    alert('Widrown Successfully');
                    $("#acctholder").val("");
                    $("#amount").val("");
                    $("#withdrawamt").val("");
                    $("#depositedamt").val("");
                    $("#atype").val("");
                    $("#frm2")[0].reset();
                },
                'error':function(e){
                    console.log(e);
                },
            });
            }
        }
        if(parseFloat($("#withdrawamt").val()) < parseFloat($('#depositedamt').val())){
            var conf=confirm("Do you want to close the Account ?.. Click 'OK' to confirm 'Cancel' to abort");
            if(conf==true){
                $closeac='y';
                $acid=$("#accountid").val();
                $acno=$("#acctholder").val();
                //$doc=$("#doc").val();
                $withdrawamount=$("#withdrawamt").val();
                $chqno=$("#chqno").val();
                $bankid=$("#bankname").val();
                $chqdate=$('#chqdate').val();
                $transferac=$('#transferac').val();

                //alert($("#withdrawamt").val());
                $.ajax({
                'url'   :  '{{route('admin.account.withdrwal')}}',
                'type'  : 'get',
                'data'  : {"_token": "{{ csrf_token() }}",'accntid':$acid,'accntno':$acno,'amt':$withdrawamount,
                'chqno':$chqno,'bankid':$bankid,'chqdate':$chqdate,'transferac':$transferac,'closeac':$closeac},
                'success':function(response){
                    console.log(response.success==true);
                    alert('Widrown Successfully');
                    $("#acctholder").val("");
                    $("#amount").val("");
                    $("#withdrawamt").val("");
                    $("#depositedamt").val("");
                    $("#atype").val("");
                    $("#frm2")[0].reset();
                },
                'error':function(e){
                    console.log(e);
                },
            });
            }
        }


        else if(parseFloat($("#withdrawamt").val()) > parseFloat($('#depositedamt').val())){
                alert('Please Check the Widrawal and Deposited Amount');
                return false;
            }


    });
});

$(document).on('click', '.edit', function(e) {
  e.preventDefault();
  var acc_id = $(this).attr('data-id');
  alert(acc_id);
});
</script>
@endsection


