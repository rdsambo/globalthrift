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
                    @if(Session::has('error'))
					<div class="alert alert-danger">
                        <span style="font-size: medium">{{Session::get('error')}}</span>
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
                                     <select name="Loan_officer" class="form-control" >
                                        <option value="">Select</option>
                                        @foreach($loanofficer as $lo)
                                            <option value="{{$lo->EOId}}"{{Request()->get('Loan_officer') == $lo->EOId ? 'selected' : '' }}>{{$lo->EOName}}</option>
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
                                <label class="col-md-2 text-right">Search By Loan Id</label>
                                <div class="col-md-3">
                                    <input type="text" name="LoanId" placeholder="Enter Loan No" class="form-control" value="{{Request()->get('LoanId')}}" >
                                </div>
                                <label class="col-md-2 text-right">Search By Laon Amount</label>
                                <div class="col-md-3">
                                    <input type="text" name="LoanAmt" placeholder="Enter Loan Amt." class="form-control" value="{{Request()->get('LoanAmt')}}">
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
                                    <a href="{{route('admin.Activeloans')}}" class="btn btn-sm btn-primary">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- <div class="form-group">
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
						<h5>Collect By Select<small> </small></h5>
					</div>
					<div class="ibox-content">
                    <form>
                    <div class="row">
                        <div class="form-group" style="margin-left:50%">
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{route('admin.Activeloans')}}" class="btn btn-sm btn-primary">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}



<form action="{{route('admin.CollectEmiAll')}}" method="post">
    @csrf
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-title">
                    <h5>Loans List<small></small></h5> &nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-primary" value="Collect For Selective" onclick="return confirm('Are you sure you want to Collect..');">
                </div>
                <div class="ibox-content">
                    <div class="row">
                            <div class="table-responsive">
                                @if(!empty($query8))
                                <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
                                    <thead>
                                    <tr>

                                        <th colspan="2">All &nbsp;&nbsp;<input class="form-check-input" id="checkall" name="applicable_for_all" type="checkbox" ></th>
                                        <th>App No</th>
                                        <th>Loan No</th>
                                        <th>Manual No</th>
                                        <th>EMI</th>
                                        <th>A/C Bal</th>
                                        <th>Member Name & ID</th>
                                        <th>Principal Amt.</th>
                                        <th>Interest Amt.</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sl=1;
                                            $primary=0;
                                            $int=0;
                                        @endphp
                                        @foreach($query8 as $key=>$q8)
                                            @php
                                                $ac_bal=\App\Helpers\Helper::GetAccountBal($q8->ac_id);
                                            @endphp
                                            {{-- <input type="hidden" class="form-control checkbal" name="balance" value="{{$q8->MemberId}}"> --}}
                                            <tr>
                                                <th>{{$sl}}</th>
                                                @if($q8->InstallmentAmt+500 < $ac_bal)
                                                    <th><input value="{{$q8->LoanId}}" class="form-check-input checkboxes" name="loanid[]" id="applicable-for-all" type="checkbox" onchange="checkboxChecked(this)" ></th>
                                                @else
                                                    <th><input value="{{$q8->LoanId}}" disabled class="form-check-input checkboxes" name="loanid[]" id="applicable-for-all" type="checkbox" onchange="checkboxChecked(this)" ></th>
                                                @endif
                                                <th>{{$q8->LoanAppId}}</th>
                                                <th><a href="{{route('admin.partyledger',[$q8->LoanId])}}">{{$q8->LoanNo}}</a></th>
                                                <th>{{$q8->AppLoanNo}}</th>
                                                <th>{{$q8->InstallmentAmt}}</th>
                                                <th>{{$ac_bal}}</th>
                                                <th>{{$q8->MemberName}}&nbsp;&nbsp;({{$q8->MemberId}})</th>
                                                <th>{{$q8->LoanAmt}}</th>
                                                <th>{{$q8->IntAmt}}</th>
                                                <th>{{$q8->IntAmt+$q8->LoanAmt}}</th>
                                                @php $id= Crypt::encrypt($q8->LoanId); @endphp
                                                <th><a href="{{route('admin.CollectEmi',[$id])}}" class="btn btn-primary">Collect</a></th>
                                                @php
                                                   $sl++;
                                                   $primary=$primary+$q8->LoanAmt;
                                                   $int=$int+$q8->IntAmt;
                                                @endphp
                                            <tr>
                                        @endforeach
                                            <tr>
                                                <th colspan="6" style="text-align:right"> Grand Total :</th>
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
</form>
@endsection
@section('scripts')
<script>
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
</script>
@endsection
