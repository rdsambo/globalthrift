@extends('admin.layout.master')
<style>
    .Zebra_DatePicker_Icon_Wrapper{
        width:100% !important;
    }
    </style>
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>New Account Opening</h5>
                    </div>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    </div>
                    @if(Session::has('success'))
                    <div class="alert alert-success"><span style="font-size: medium">{{Session::get('success')}}</span></div>
                    @endif
                    <form name="frm1" method="get" action="{{route('admin.account.create')}}" enctype="multipart/form-data">
                    <div class="ibox-content">
                        <div class="form-group row">
                            @csrf
                            <div class="row col-md-12">
                                <div class="form-group  col-md-2">
                                    <label class="form-group">Member NO.</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" id="slno" class="form-control" name ="slno" value="">
                                </div>
                                    <button type="button" onclick="memberDetails()" class="btn btn-info">find</button>
                            </div>
                            <div id="member_div" style="display:none;">
                                <div class="row col-md-12">
                                    <div class="form-group  col-md-2">
                                        <label class="form-group">Account No</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        @if($type=="M")
                                            <input type="text" id="acctno" class="form-control" name ="acctno" value="{{"M".$nextacno->nextacno}}">
                                            @else
                                            <input type="text" id="acctno" class="form-control" name ="acctno" value="{{$nextacno->nextacno}}">
                                        @endif
                                    </div>
                                    <div class="form-group  col-md-2">
                                        <label class="form-group">Opening Date</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" id="accountopendt" class="form-control" name ="accountopendt" value="{{date('Y-m-d')}}">
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="form-group col-md-2">
                                        <label class="form-group">LO</label>
                                    </div>
                                    <div class="form-group  col-md-3">
                                        @if($eomaster)
                                            <select class="form-control" name="eomember" id="eomember" readonly>
                                                @foreach($eomaster as $eom)
                                                    <option value="{{$eom->EOId}}">{{$eom->EOName}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="form-group  col-md-2">
                                        <label class="form-group">Center Name </label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" id="center"  class="form-control" name="center" readonly>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="form-group col-md-2">
                                        <label class="form-group">Group No</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text"  id="groupno"  class="form-control" name="groupno" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-group">Member</label>
                                    </div>
                                    <div class="form-group  col-md-3">
                                        @if($member)
                                            <select class="form-control" name="member" id="member" disabled>
                                                @foreach($member as $mem)
                                                    <option value="{{$mem->MemberId}}">{{$mem->MemberName}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="form-group  col-md-2">
                                        <label class="form-group">Member type</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="memtype" class="form-control" readonly>
                                    </div>
                                    {{-- <div class="form-group col-md-2">
                                        <label class="form-group">Member SlNo.</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="slno" class="form-control" readonly>
                                    </div> --}}
                                    <div class="form-group col-md-2" style="display:none;">
                                        <label class="form-group label-css">Member ID.</label>
                                    </div>
                                    <div class="form-group col-md-2" style="display:none;">
                                        <input type="text" id="memid"  class="form-control" name="memid" readonly>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="form-group col-md-2">
                                        <label class="form-group label-css">Interest</label> <span style="color: red">*</span>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="rate" class="form-control" name="rate" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-group label-css">Deposit Amount</label><span style="color: red">*</span>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="amount" class="form-control" name="amount" required >
                                    </div>
                                    {{-- <div class="form-group col-md-2">
                                        <label class="form-group label-css">Minimum Balance</label><span style="color: red">*</span>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="mmbal" class="form-control" name="mmbal" required >
                                    </div> --}}
                                </div>
                                <div class="row col-md-12">
                                    <div class="form-group  col-md-2">
                                        <label class="form-group label-css">Deposit Type</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <select name='deposittype'  class="form-control">
                                            @if($type=="D")
                                            <option value="DD">DD</option>
                                            @else
                                            <option value="MD">MD</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-group label-css">PAN No.</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="panno" name ="panno" class="form-control">
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="form-group  col-md-2">
                                        <label class="form-group label-css">Nominee Name</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="nominee" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-group label-css">Relation</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="relation" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-group label-css">Gender</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="gender" name="gender" class="form-control">
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="form-group  col-md-2">
                                        <label class="form-group">Address</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="address" name="address"class="form-control" >
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="form-group  col-md-2">
                                        <label class="form-group label-css">Introduced By</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="introducer" name="introducer" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-group label-css">Introducer Account No.</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="intacno" name="intacno" class="form-control">
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="form-group col-md-2">
                                        <label class="form-group label-css"> Entry Date</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" name ="doe" id="doe" value="{{date('Y-m-d')}}">
                                    </div>
                                </div>

                                <div class="row col-md-12">
                                    <div class="form-group col-md-2">
                                        <label class="form-group label-css">Minimum Balance</label><span style="color: red">*</span>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" id="mmbal" class="form-control" name="mmbal" required >
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input name="radio" type="radio" value="1"/><label class="form-group label-css">Applicable</label>
                                    </div>
                                    <div class="form-group col-md-2">
										<input name="radio" type="radio" value="0"/><label class="form-group label-css">Not Applicable</label>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="form-group col-md-2">
                                        <button type="submit" class="btn btn-primary" id="btnsave">Create Account</label>
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
</div>

@endsection
@section('scripts')

<script>
    $(document).ready(function ()  {
        $('#accountopendt').Zebra_DatePicker({
            direction: 0,
            //format: date('Y-m-d',strtotime(date())),

        });
        $("#doe").Zebra_DatePicker({
            direction: 0,
        });
    });


$(document).ready(function() {
    $("#eomember").change(function() {
        var t=($(this).val());
        $.ajax({
            'url' : '{{route('admin.geteo-data')}}',
            'type' : 'get',
            'data'  : {member: t},
            'dataType' : 'json',
            'success' : function(response) {
                    $("#center").val(response.memberdata.GroupName);
                    $("#groupno").val(response.memberdata.GroupCode);
                    // $("#memid").val(response.memberdata.MemberId);
                console.log(response)
            },
            'error': function(response) {
                console.log(response)
            }
        });
    });


    $("#btnsave").click(function() {
        if($("#groupno").val()==""){
            alert("Group Cannot Go blank");
            return false;
        }
        if($("#accountopendt").val()==""){
            alert("Please Select Opening Date");
            return false;
        }
        if($("#rate").val()==""){
            alert("Please Enter Rate of Interest");
            return false;
        }
        if($("#amount").val()==""){
            alert("Please Enter Deposit Amount");
            return false;
        }


    });

});
</script>
<script>
    function memberDetails() {
        $("#member_div").show();
        var serial_no= $("#slno").val();
        $.ajax({
            'url' : '{{route('admin.getmember-data-serial-no')}}',
            'type' : 'get',
            'data'  : {serial_no: serial_no},
            'dataType' : 'json',
            'success' : function(response) {
                console.log(response.memberdata);
                    $("#memtype").val(response.memberdata.MemberType);
                    $("#slno").val(response.memberdata.MemSrNo);
                    $("#memid").val(response.memberdata.MemberId);
                    $("#nominee").val(response.memberdata.NomName);
                    $("#relation").val(response.memberdata.relation);
                    $("#address").val(response.memberdata.ResAdd1);
                    $("#gender").val(response.memberdata.Gender);
                    $("#panno").val(response.memberdata.PANCardNo);
                    $("#member").val(response.memberdata.MemberId);

                console.log(response)
            },
            'error': function(response) {
                console.log(response)
            }
        });

}
    </script>
@endsection
