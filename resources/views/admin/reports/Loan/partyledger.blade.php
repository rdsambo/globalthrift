@extends('admin.layout.master')
@section('content')
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
						<h5>Filter For Loans    <small> </small></h5>
					</div>
					<div class="ibox-content">
                    <form>
                    <div class="row">
                        <div class="form-group">
                            <div class="row">
                                 <label class="col-md-2 text-right">Select Starting From</label>
                                 <div class="col-md-3">
                                     <input type="date" class="form-control" name="s_month" value="{{Request()->get('s_month')}}">
                                 </div>
                                 <label class="col-md-2 text-right">Select Ending To</label>
                                 <div class="col-md-3">
                                    <input type="date" class="form-control" name="e_month" value="{{Request()->get('e_month')}}">
                                 </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-title">
                    <div class="col-md-10"><h5 style="align: center;">Party Ledger,</h5><h5 style="align: center;"> &nbsp;&nbsp;Branch : 111 COPERATIVE</h5><br/></div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                            <div class="row">
                                <label class="col-md-3">Disburs No: {{$emi->LoanNo}}</label>
                                <label class="col-md-3">Loan Date: {{$emi->LOSDate}}</label>
                                <label class="col-md-3">Loan Amtount: {{$emi->LOSAmt+$emi->IOSAmt}}</label>
                            </div>
                            <div class="row">
                                <label class="col-md-3">Loan Number: {{$emi->AppLoanNo}}</label>
                                <label class="col-md-3">Member: {{$emi->MemberName}}</label>
                                <label class="col-md-3">Status:{{$emi->Status}}  @if($emi->Status=="O")Open @else Closed @endif</label>
                            </div>
                            <div class="row">
                                <label class="col-md-5">Loan Scheme: {{$emi->LoanType}}</label>
                            </div>
                            <div class="row">
                                <label class="col-md-3">Address: {{$emi->ResAdd1}}</label>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
                                    <thead>
                                    <tr >
                                        <th rowspan='2'><br/>#</th>
                                        <th rowspan='2'><br/>Deu Dt.</th>
                                        <th rowspan='2'><br/>EMI</th>
                                        <th rowspan='2'><br/>#</th>
                                        <th rowspan='2'><br/>Rec. Dt.</th>
                                        <th colspan='3'>Received Amount</th>
                                        <th colspan='3'>Outstanding Amount</th>
                                    </tr>
                                    <tr>
                                        <th>Principal</th>
                                        <th>Interest</th>
                                        <th>Tot.</th>
                                        <th>Principal</th>
                                        <th>Interest</th>
                                        <th>Tot.</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $interest=$emi->IntAmt;
                                        @endphp
                                        <tr>
                                            <th></th><th></th><th></th>
                                            <th>0</th><th>{{$emi->LoanDt}}</th>
                                            <th>0</th><th>0</th><th>0</th>
                                            <th>{{$emi->LoanAmt}}</th>
                                            <th>{{$interest}}</th>
                                            <th>{{$emi->LoanAmt+$interest}}</th>
                                        </tr>
                                        @forelse($PartyL as $pa)
                                        @php
                                            $interest=$interest-$pa->IntCollAmt;
                                        @endphp
                                        <tr>
                                            <th>{{$pa->SlNo}}</th>
                                            <th>{{$pa->AccDate}}</th>
                                            <th>{{$emi->InstallmentAmt}}</th>
                                            <th>{{$pa->SlNo}}</th>
                                            <th>{{$pa->RecDate}}</th>
                                            <th>{{$pa->PrinCollAmt}}</th>
                                            <th>{{$pa->IntCollAmt}}</th>
                                            <th>{{$pa->CollAmt}}</th>
                                            <th>{{$pa->BalanceAmt}}</th>
                                            <th>{{$interest}}</th>
                                            <th>{{$pa->BalanceAmt+$interest}}</th>

                                        </tr>
                                        @empty
                                        <tr><th style="text-align:center ">No Records Found</th></tr>
                                        @endforelse

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan='5' style="text-align: right;">Total :</th>
                                            <th>{{ number_format($PartyL->sum('PrinCollAmt'), 2, '.', '')}}</th>
                                            <th>{{ number_format($PartyL->sum('IntCollAmt'), 2, '.', '')}}</th>
                                            <th>{{ number_format($PartyL->sum('IntCollAmt')+$PartyL->sum('PrinCollAmt'), 2, '.', '')}}</th>
                                            <th colspan='3'></th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
		    </div>
		</div>
	</div>
</div>
@endsection
