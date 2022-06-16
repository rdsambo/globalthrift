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
                        <h5>MD Collection</h5>
                        {{-- <form class="navbar-form navbar-left" role="search" method="GET" action="{{route("admin.member", ["memid" => request("memid")])}}">
                            <div class="form-group">
                                <input type="text" class="form-control" name ="memid" id="memid" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </form> --}}

                               <form name="frm2" action="{{route('admin.collection.md')}}" method="post">
                                    @csrf
                                    <div class="ibox-content">
                                        @if(session()->has('success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('success') }}
                                            </div>
                                        @endif
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-2">
                                                <label>Account Number</label>
                                            </div>
                                            <div class="form-group col-md-3" >
                                                    {{-- <datalist id="A/C_no">
                                                        @foreach($mdaccount as $dda)
                                                            <option value="{{$dda->AccountNo}} {{$dda->AccountName}}">
                                                        @endforeach
                                                    </datalist>
                                                    <input type="text" list="A/C_no"  class="form-control" name="accountid" id="accountid"> --}}
                                                    <select class="js-example-basic-single" name="accountid" id="accountid" required style="width:100%;">
                                                        <option>------select------</option>
                                                        @foreach($mdaccount as $dda)
                                                             <option value="{{$dda->AccountId}}" {{Request()->get('accountid') == $dda->AccountId ? 'selected' : '' }}>{{$dda->AccountName}}({{$dda->AccountNo}})({{$dda->AccountId}})</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                        {{-- <div class="alert alert-success col-md-6 message">
                                        </div> --}}
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-2">
                                                <label>A/C Holder Name</label>
                                            </div>
                                            <div class="form-group col-md-3" >
                                                <input type="text" class="form-control" name="acctholder" id="acctholder">
                                            </div>
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-2">
                                                <label>Amount</label>
                                            </div>
                                            <div class="form-group col-md-3" >
                                                <input type="text" class="form-control" name="amount" id="amount">
                                            </div>
                                            <div class="form-group col-md-2" >
                                                <label>Date of Deposit</label>
                                            </div>
                                            <div class="form-group col-md-3" >
                                                <input type="text" class="form-control" name="doc" id="doc" value="{{date("Y-m-d")}}">
                                            </div>
                                        </div>

                                    </div>
                                            {{-- </div>
                                            {{-- <div class="ibox-title"> --}}
                                    <div class="ibox-content">
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-2" style="margin-left:50%">
                                                {{-- <button type="button" name="btncoll" id="btncoll" class="btn btn-primary">Collect</button> --}}
                                                <button id="submit" type="submit" name="Submit" class="btn btn-primary" style="padding-left: 5%; padding-right: 5%;" onclick="return ChrckVal()">Save</button><br>
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
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

$(document).ready(function() {
   // $('#memberid').change(function(){
        $('.js-example-basic-single').select2();
  //});
});
$(document).ready(function () {
    selectedAccountID = "";
    $('#doc').Zebra_DatePicker();
    $("#accountid").change(function() {
        var t = $(this).val();console.log(t);

       $.ajax({
            'url'       : '{{route('admin.getaccountdatamd')}}',
            'type'      : 'get',
            'data'      : {'t1'  : t},
            'dataType' : 'json',
            //'headers'   : {"Authorization": localStorage.getItem('token')},
            'success'   :  function(response){
                if(response.success==true){
                        selectedAccountID =response.accdata.AccountId;
                       // $('#accountid').val(response.accdata.AccountId);
                        $('#acctholder').val(response.accdata.AccountName);
                        $('#amount').val(response.depoamt.DAmt);

                   }
                   $(".message").html("");
                //console.log(response.accdata.AccountName);
            },

            'error'     : function(response) {
                console.log(response);
            }
       });
    });
    // $("#btncoll").click(function(e) {
    //     console.log(selectedAccountID);
    //     e.preventDefault();
    //     if($("#doc").val()==""){
    //         alert("Date of Collection cannot be null or Less");
    //     }
    //     if($("#amount").val()==""){
    //         alert("Deposit Amount cannot be null or Less");
    //     }

    //         $acno=$("#accountid").val();
    //         //alert($acno);
    //         $doc=$("#doc").val();
    //         $amount=$("#amount").val();
    //         $.ajax({
    //             'url'   :  '{{route('admin.collection.md')}}',
    //             'type'  : 'post',
    //             'data'  : {"_token": "{{ csrf_token() }}",'accntid':selectedAccountID,'doc':$doc,'amt':$amount},
    //             'success':function(response){
    //                 console.log(response.success==true);
    //                 //$(".message").html(response.msg);
    //                 alert("Deposit Successfully Collected");
    //                 $("#accountid").val("");
    //                 $("#amount").val("");
    //                 $("#acctholder").val("");
    //             },
    //             'error':function(e){
    //                 console.log(e);
    //             },
    //         });

    // });
});

function ChrckVal(){
    if($("#accountid").val()!="" && $("#amount").val()>0 && $("#doc").val()!=""){
            return confirm('Are you sure you want to submit ?');
        }else{
            alert("Any one of the field cannot be null or Less");
            return false;
        }
}
</script>
@endsection


