@extends('admin.layout.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Extra Share Purchase</h5>
                    </div>
                    @if(Session::has('success'))
					<div class="alert alert-success">
                        <span style="font-size: medium">{{Session::get('success')}}</span>
                    </div>
				    @endif
                    <div class="ibox-content">
                        <div class="row">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-2 text-right">Enter Member Id/ Name</label>
                                    <div class="col-md-3">
                                        <select class="js-example-basic-single" name="guarantor_no" id="guarantor_no" required style="width:100%">
                                            <option>------select------</option>
                                            @foreach($member as $mem)
                                            <option value="{{$mem->MemberId}}">{{$mem->MemberName}}&nbsp;&nbsp;&nbsp;{{$mem->MemberId}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content" id="hide_and_seek">
                    <form method="post" class="form-horizontal"  name="updateForm" id="updateForm" action="{{route('admin.member.saveextrashare')}}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2">Member Name</label>
                                <div class="col-md-3">
                                    <input readonly class="form-control" name="mem_name" id="mem_name">
                                </div>
                                <label class="col-md-2">Member Id</label>
                                <div class="col-md-3">
                                    <input readonly class="form-control" id="mem_id" name="mem_id" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2">Total Share</label>
                                <div class="col-md-3">
                                    <input readonly class="form-control" id="tot_s" name="tot_s" value="0" required>
                                    <input type="hidden" class="form-control" id="value" name="value" value="{{$value}}" required>
                                </div>
                                <label class="col-md-2">Share Value</label>
                                <div class="col-md-3">
                                    <input readonly class="form-control" id="tot_s_v" value="0" name="tot_s_v" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2">New Share Purchase Number</label>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" id="new_share" name="new_share" required>
                                </div>
                                <label class="col-md-2">New Share Amount</label>
                                <div class="col-md-3">
                                    <input readonly class="form-control" id="new_share_amount" name="new_share_amount" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2">Total Share Value</label>
                                <div class="col-md-3">
                                    <input readonly class="form-control" id="tot_s_value" name="tot_s_value" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" class="btn btn-primary" value="Submit">
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
$('#hide_and_seek').hide();
$(document).ready(function(){
    $('.js-example-basic-single').select2();
    $('#hide_and_seek').hide();
    $('#mem_name').val();
    $('#mem_id').val();
    $('#tot_s').val();
    $('#tot_s_v').val();
});

$('#guarantor_no').change(function(){
    $.ajax({
        url: "{{route('admin.member.exsmem')}}",
        type: 'get',
        dataType: 'json',
        data: {id:$(this).val()},
        success:function(success){
            var share_price= $('#value').val();
            $('#hide_and_seek').show();
            $('#mem_name').val(success.success.MemberName);
            $('#mem_id').val(success.success.MemberId);
            $('#tot_s').val(success.member.shares);
            $('#tot_s_v').val(success.member.shares*share_price);
            console.log(success);
            console.log(success.member.shares);
        },
    });
});

$('#new_share').keyup(function(){
    console.log('biswa');
    var share_price= $('#value').val();
    $('#new_share_amount').val($(this).val()*share_price);
    $('#tot_s_value').val((+$('#new_share_amount').val())+(+$('#tot_s_v').val()));
});
</script>
@endsection


