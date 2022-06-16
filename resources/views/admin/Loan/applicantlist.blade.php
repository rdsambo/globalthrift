@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
					@if(Session::has('success'))
					<div class="alert alert-success"><span style="font-size: medium">{{Session::get('success')}}</span></div>
				    @endif
                    @if(Session::has('error'))
					<div class="alert alert-danger"><span style="font-size: medium">{{Session::get('error')}}</span></div>
				    @endif
					<div class="ibox-title">
						<h5>Loan Applicants List    <small> </small></h5>
					</div>
					<div class="ibox-content">
                        <div class="row">
							<form method="POST" action="{{route('admin.applistfilter')}}">
                                @csrf
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">


											<p class="search_input">
												<input type="date" placeholder="From Date" id="post_at" name="post_at"  value="" class="input-control" />
												<input type="date" placeholder="To Date" id="post_at_to_date" name="post_at_to_date" style="margin-left:10px"  value="" class="input-control"  />
												<input type="submit" name="go" value="Search" >
											</p>

										</div>
										<div class="col-md-8">
											<input name="radio" type="radio" id="standard_1" onClick="toggleTables()" value="radio"/>New Applications&nbsp;&nbsp;&nbsp;
											<input name="radio" type="radio" id="standard_2" onClick="toggleTables()" value="radio"/><label style="color: green;">Approved Applications</label>&nbsp;&nbsp;&nbsp;
                                            {{-- <input name="radio" type="radio" id="standard_4" onClick="toggleTables()" value="radio"/><label style="color: green;">Disbursed Application</label>&nbsp;&nbsp;&nbsp; --}}
											<input name="radio" type="radio" id="standard_3" onClick="toggleTables()" value="radio"/><label style="color: red;">Cancelled Applications</label>
											<br />
										</div>
									</div>
								</div>

								<div class="ibox-content" id="standard" style="display: none">
									<h1>New Loan Applications</h1>
									<div class="table-responsive">
										@if(!empty($query5))
										<table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
											<thead>
											  <tr>
												<th>App No</th>
												<th>Date</th>
												<th>Membership No</th>
                                                <th>A/C No</th>
												{{-- <th>Target No</th> --}}
												<th>Member</th>
												<th>Loan Scheme</th>
												<th>Amount</th>
												<th>Loan Purpose</th>
												<th>Loan Type</th>
												<th>Action</th>
											  </tr>
											</thead>
											<tbody>
											    @foreach($query5 as $q5)
												<tr>
													<th>{{$q5->LoanAppId}}</th>
													<th>{{$q5->AppDate}}</th>
													<th>{{$q5->MemberId}}</th>
													<th>{{$q5->AccountNo}}</th>
													<th>{{$q5->AccountName}}</th>
													<th>{{$q5->LoanType}}</th>
													<th>{{$q5->LoanAppAmt}}</th>
													<th>{{$q5->Purpose}}</th>
													<th>{{$q5->loantype}}</th>
													<th><a href="{{route('admin.Approve', Crypt::encrypt($q5->LoanAppId))}}" class="btn btn-info" > Check To Approve</a></th>
												<tr>
												@endforeach
											</tbody>
										</table>
										@endif
									</div>
								</div>

								<div class="ibox-content" id="approved" style="display: none">
									<h1>Approved Loan Applications</h1>
									<div class="table-responsive">
										@if(!empty($query6))
										<table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
											<thead>
											<tr>
												<th>App No</th>
												<th>Loan No</th>
												<th>Membership No</th>
												<th>Member</th>
												<th>Loan Amount</th>
												<th>Amount To Disburs</th>
												<th>Disburs No</th>
												<th>Loan Purpose</th>
												<th>Loan Type</th>
												<th>Action</th>
                                                {{-- <th>App No</th>
												<th>Date</th>
												<th>Membership No</th>
												<th>Target No</th>
												<th>Member</th>
												<th>Loan Scheme</th>
												<th>Amount</th>
												<th>Loan Purpose</th>
												<th>Loan Type</th>
												<th>Action</th> --}}
											</tr>
											</thead>
											<tbody>
											    @foreach($query6 as $q6)
												<tr>
													<th>{{$q6->LoanAppId}}</th>
													<th>{{$q6->AppDate}}</th>
													<th>{{$q6->MemberId}}</th>
													<th></th>
													<th>{{$q6->AccountName}}</th>
													<th>{{$q6->LoanType}}</th>
													<th>{{$q6->LoanAppAmt}}</th>
													<th>{{$q6->Purpose}}</th>
													<th>{{$q6->loantype}}</th>
													<th><a href="{{route('admin.disbursement', Crypt::encrypt($q6->LoanAppId))}}" class="btn btn-info" > View Loan Disbursment</a></th>
												<tr>
												@endforeach
											</tbody>
										</table>
										{{$query6 ->links()}}
										@endif
									</div>
								</div>

                                {{-- <div class="ibox-content" id="disbursed" style="display: none">
									<h1>Disbursed Loan Applications</h1>
									<div class="table-responsive">
										@if(!empty($query8))
										<table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
											<thead>
											  <tr>
												<th>App No</th>
												<th>Date</th>
												<th>Membership No</th>
                                                <th>A/C No</th>
												<th>Member</th>
												<th>Loan Scheme</th>
												<th>Amount</th>
												<th>Loan Purpose</th>
												<th>Loan Type</th>
											  </tr>
											</thead>
											<tbody>
											    @foreach($query8 as $q8)
												<tr>
													<th>{{$q8->LoanAppId}}</th>
													<th>{{$q8->AppDate}}</th>
													<th>{{$q8->MemberId}}</th>
													<th>{{$q8->AccountNo}}</th>
													<th>{{$q8->AccountName}}</th>
													<th>{{$q8->LoanType}}</th>
													<th>{{$q8->LoanAppAmt}}</th>
													<th>{{$q8->Purpose}}</th>
													<th>{{$q8->loantype}}</th>
												<tr>
												@endforeach
											</tbody>
										</table>
										@endif
									</div>
								</div> --}}
								<div class="ibox-content" id="cancelled" style="display: none">
									<h1>Cancelled Loan Applications</h1>
									<div class="table-responsive">
										@if(!empty($query7))
										<table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
											<thead>
											<tr>
												<th>App No</th>
												<th>Date</th>
												<th>Membership No</th>
												<th>Target No</th>
												<th>Member</th>
												<th>Loan Scheme</th>
												<th>Amount</th>
												<th>Loan Purpose</th>
												<th>Loan Type</th>
											</tr>
											</thead>
											<tbody>
											    @foreach($query7 as $q5)
												<tr>
													<th>{{$q5->LoanAppId}}</th>
													<th>{{$q5->AppDate}}</th>
													<th>{{$q5->MemberId}}</th>
													<th></th>
													<th>{{$q5->AccountName}}</th>
													<th>{{$q5->LoanType}}</th>
													<th>{{$q5->LoanAppAmt}}</th>
													<th>{{$q5->Purpose}}</th>
													<th>{{$q5->loantype}}</th>
												<tr>
												@endforeach
											</tbody>
										</table>
										{{$query7 ->links()}}
										@endif
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
		    </div>
		</div>
	</div>
</div>


@endsection
<script type="text/javascript">
	function toggleTables()
	{
		// var isCustomize = document.getElementById('customize_1').checked;
		var isStandard = document.getElementById('standard_1').checked;
		var isApproved = document.getElementById('standard_2').checked;
		var isCancelled = document.getElementById('standard_3').checked;
        // var isDisbursed = document.getElementById('standard_4').checked;
		// var customize = document.getElementById('customize');
		var standard = document.getElementById('standard');
		var approved = document.getElementById('approved');
		var cancelled = document.getElementById('cancelled');
        // var disbursed = document.getElementById('disbursed');
		// customize.style.display = isCustomize  ? 'table' : 'none';
		standard.style.display = isStandard  ? 'table' : 'none';
		approved.style.display = isApproved  ? 'table' : 'none';
		cancelled.style.display = isCancelled  ? 'table' : 'none';
        // disbursed.style.display = isDisbursed ? 'table' : 'none';

	}
	</script>
