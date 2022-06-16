@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
					@if(Session::has('success'))
					<div class="alert alert-success">
                        <span style="font-size: medium">{{Session::get('success')}}</span>
                    </div>
				    @endif
					<div class="ibox-title">
						<h5>Filter For Bank Book Detail    <small> </small></h5>
					</div>
					<div class="ibox-content">
                    <div class="row">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 text-right">Select Bank</label>
                                <div class="col-md-4">
                                    <select name="b_name" id="b_name" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($banks->acledger as $bnk)
                                            <option value="{{$bnk->DescId}}">{{$bnk->Desc}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 text-right">Select Starting Date</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control"id="startdate" name="s_month" value="{{date('Y-m-d')}}">
                                </div>
                                <label class="col-md-2 text-right">Select Ending Date</label>
                                <div class="col-md-3">
                                <input type="text"  id="enddate" class="form-control" name="e_month" value="{{date('Y-m-d')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-left:50%">
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="submit" id="search" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{route('admin.accounts.bankbook')}}" class="btn btn-sm btn-primary">Reset</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group" id="onsearch">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-title">
                    <h5 id="heading"></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
                                <thead>
                                <tr>
                                    <th style="text-align:center">Date</th>
                                    <th style="text-align:center">Voucher No</th>
                                    <th style="text-align:center">Narration </th>
                                    <th style="text-align:center">Dr.</th>
                                    <th style="text-align:center">Cr.</th>
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
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
$('#onsearch').hide();
$('#search').click(function(){
    var id=$('#b_name').val();
    var fromdate =$('#startdate').val();
    var todate =$('#enddate').val();
    // alert(fromdate);
    $.ajax({
        'url'     : "{{route('admin.accounts.bankbook_dtl')}}",
        'type'    : 'get',
        'dataType':'json',
        'data'    :{'t1' : id,'s_date': fromdate,'e_date': todate},
        'success' : function(success){
            $('#onsearch').show();
            $('#heading').empty();
            $("#tabledata").empty();
            $('#heading').append(success.success.Desc);
            // console.log(success.data);
            if(success.data.length>0){
                var CrTot=0;
                var DrTot=0;
                $.each(success.data, function (k, v){
                    console.log(v);
                    var Cr='C';
                    var html =
                                `<tr>
                                    <td>`+moment(v.VoucherDt).format('DD-MM-YYYY')+`</td>
                                    <td>`+v.VoucherNo+`</td>
                                    <td>`+v.Narration+`</td>
                                    <td id="Dr`+k+`"></td>
                                    <td id="Cr`+k+`"></td>
                                </tr>`
                            $("#tabledata").append(html);
                                if(v.DrCr==Cr){
                                    $(`#Dr`+k+``).append(v.Amt);
                                    $(`#Cr`+k+``).append(0);
                                    DrTot=(+DrTot)+(+v.Amt);
                                }else{
                                    $(`#Dr`+k+``).append(0);
                                    $(`#Cr`+k+``).append(v.Amt);
                                    CrTot=(+CrTot)+(+v.Amt);
                                }
                });
                var html1=`<tr>
                        <th colspan=3 style="text-align:right">Total :</th>
                        <th>`+DrTot+`</th>
                        <th>`+CrTot+`</th>
                    </tr>`
                    $("#tabledata").append(html1);
                // alert(DrTot);
            }else{
                var html = `<tr>
                                <td colspan=5 style="text-align:center"> No Records Found</td>
                            </tr>`
                $("#tabledata").append(html);
            }

        }

    });
})
</script>
<script>
     $('#startdate').Zebra_DatePicker({ format : 'd-m-Y',readonly_element:false, direction: -1,
            onSelect: function() {
                $(this).change();
            }
        });
        $('#enddate').Zebra_DatePicker({ format : 'd-m-Y',readonly_element:false, direction: -1,
            onSelect: function() {
                $(this).change();
            }
        });
</script>

@endsection
