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
						<h5>Filter For Loans    <small> </small></h5>
					</div>
					<div class="ibox-content">
                    <form>
                    <div class="row">
                        <div class="form-group">
                            <div class="row">
                                 <label class="col-md-2 text-right">Select Loan officer</label>
                                 <div class="col-md-3">
                                     <select name="Loan_officer" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($loanofficer as $lo)
                                            <option value="{{$lo->EOId}}" {{Request()->get('Loan_officer') == $lo->EOId ? 'selected' : '' }}>{{$lo->EOName}}</option>
                                        @endforeach
                                    </select>
                                 </div>
                                <label class="col-md-2 text-right">Select Collection Type</label>
                                <div class="col-md-3">
                                    <select name="Collection" class="form-control">
                                        <option value="">Select</option>
                                        <option value="">DD Collection</option>
                                        <option value="">MD Collection</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 text-right">Search By Loan No</label>
                                <div class="col-md-3">
                                    <input type="text" name="LoanNo" placeholder="Enter Loan No" class="form-control" value="{{Request()->get('LoanNo')}}">
                                </div>
                                <label class="col-md-2 text-right">Search By Laon Amount</label>
                                <div class="col-md-3">
                                    <input type="text" name="LoanAmt" placeholder="Enter Loan Amt." class="form-control" value="{{Request()->get('LoanAmt')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 text-right">Search By Active/Closed</label>
                                <div class="col-md-3">
                                    <select name="Active" class="form-control">
                                        <option value="">Select</option>
                                        <option value="O">Active</option>
                                        <option value="C">Closed</option>
                                    </select>
                                </div>
                                <label class="col-md-2 text-right">Search By Loan Type</label>
                                <div class="col-md-3">
                                    <select name="loantype" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($loantype as $type)
                                            <option value="{{$type->loantypeid}}" {{Request()->get('loantype') == $type->loantypeid ? 'selected' : '' }}>{{$type->LoanType}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 text-right">Search By Manual Id</label>
                                <div class="col-md-3">
                                    <input type="text" name="MLoanId" placeholder="Enter Loan Id" class="form-control" value="{{Request()->get('MLoanId')}}" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-left:50%">
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{route('admin.loanreports')}}" class="btn btn-sm btn-primary">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-title">
                    <h5>Loans List    <small> </small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                            <div class="table-responsive">
                                @if(!empty($query8))
                                <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>App No</th>
                                        <th>Loan No</th>
                                        <th>Manual No</th>
                                        <th>start Dt.</th>
                                        <th>Membership No</th>
                                        <th>Member Name</th>
                                        <th>Date</th>
                                        <th>Principal Amt.</th>
                                        <th>Interest Amt.</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sl=1;
                                            $primary=0;
                                            $int=0;
                                        @endphp
                                        @foreach($query8 as $key=>$q8)
                                        @if($q8->Status=='O')
                                            <tr>
                                                <th>{{$sl}}</th>
                                                <th>{{$q8->LoanAppId}}</th>
                                                {{-- <th onclick="MyFun('{{$q8->LoanId}}')"><a>{{$q8->LoanNo}}</a></th> --}}
                                                <th><a href="{{route('admin.partyledger',[$q8->LoanId])}}">{{$q8->LoanNo}}</a></th>
                                                <th>{{$q8->AppLoanNo}}</th>
                                                <th>{{$q8->LOSDate}}</th>
                                                <th>{{$q8->MemberId}}</th>
                                                <th>{{$q8->MemberName}}</th>
                                                <th>{{$q8->LoanDt}}</th>
                                                <th>{{$q8->LoanAmt}}</th>
                                                <th>{{$q8->IntAmt}}</th>
                                                <th>{{$q8->IntAmt+$q8->LoanAmt}}</th>
                                                <th><span class="badge badge-success">Active</span></th>
                                                {{-- @php $id= Crypt::encrypt($q8->LoanAppId); @endphp --}}
                                                {{-- <th><a href="{{route('admin.CollectEmi',[$id])}}" class="btn btn-primary">Collect</a></th> --}}
                                                @php
                                                   $sl++;
                                                   $primary=$primary+$q8->LoanAmt;
                                                   $int=$int+$q8->IntAmt;
                                                @endphp
                                            <tr>
                                        @endif
                                        @if($q8->Status=='C' && $q8->ClosingType=='P')
                                            <tr>
                                                <th>{{$sl}}</th>
                                                <th>{{$q8->LoanAppId}}</th>
                                                {{-- <th onclick="MyFun('{{$q8->LoanId}}')"><a>{{$q8->LoanNo}}</a></th> --}}
                                                <th><a href="{{route('admin.partyledger',[$q8->LoanId])}}">{{$q8->LoanNo}}</a></th>
                                                <th>{{$q8->AppLoanNo}}</th>
                                                <th>{{$q8->LOSDate}}</th>
                                                <th>{{$q8->MemberId}}</th>
                                                <th>{{$q8->MemberName}}</th>
                                                <th>{{$q8->LoanDt}}</th>
                                                <th>{{$q8->LoanAmt}}</th>
                                                <th>{{$q8->IntAmt}}</th>
                                                <th>{{$q8->IntAmt+$q8->LoanAmt}}</th>
                                                <th> <span class="badge badge">Closed</span></th>
                                                @php
                                                   $sl++;
                                                   $primary=$primary+$q8->LoanAmt;
                                                   $int=$int+$q8->IntAmt;
                                                @endphp
                                            <tr>
                                        @endif
                                        @endforeach
                                            <tr>
                                                <th colspan="7" style="text-align:right"> Grand Total :</th>
                                                <th>{{$primary}}</th>
                                                <th>{{$int}}</th>
                                                <th colspan="2">{{$primary+$int}}</th>
                                            </tr>
                                    </tbody>
                                </table>
                                {{-- {{$query8->links()}} --}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
		    </div>
		</div>
	</div>
</div>
<div class="m-4">
    <!-- Button HTML (to Trigger Modal) -->
    {{-- <a href="#" id="myBtn" role="button" class="btn btn-lg btn-primary" data-bs-toggle="modal">Launch Demo Modal</a> --}}

    <!-- Modal HTML -->
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="titleup"></h4>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
                <thead>
                    <tr>
                        <th>Sl no.</th>
                        <th>Date</th>
                        <th>Principal</th>
                        <th>Interest</th>
                        <th>Balance Prin.</th>
                    </tr>
                </thead>
                <tbody id="ReoprtLoan">
                </tbody>
            </table>
        </div>
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
{{-- <script>
    function MyFun(id){
        $('#myModal').modal('show');
        $.ajax({
        url:"{{route('admin.loan_details')}}",
        type:"get",
        datatype:"json",
        data:{id:id},
            success:function(resp){
                var table_body = '';

                $('#titleup').empty().append('Previous Collection Report of App. Id: '+id+'');
                    if(resp.success == false){
                        table_body+='<tr>';
                            table_body +='<td colspan="5" style="text-align:center">';
                                table_body +='No Transaction Found';
                            table_body +='</td>';
                        table_body+='</tr>';
                    }else{
                        $.each(resp.loan_calculate, function(k, v) {
                            table_body+='<tr>';
                                table_body +='<td>';
                                    table_body +=v.NoofInst;
                                table_body +='</td>';
                                table_body +='<td>';
                                    table_body +=v.RecDate;
                                table_body +='</td>';
                                table_body +='<td>';
                                    table_body +=v.PrinCollAmt;
                                table_body +='</td>';
                                table_body +='<td>';
                                    table_body +=v.IntCollAmt;
                                table_body +='</td>';
                                table_body +='<td>';
                                    table_body +=v.BalanceAmt;
                                table_body +='</td>';
                            table_body+='</tr>';
                        });
                     }
                $('#ReoprtLoan').html(table_body);

            },
            error:function(resp){
                console.log(resp);
            }
        })
    }
</script> --}}
@endsection
