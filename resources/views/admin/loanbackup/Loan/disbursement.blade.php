@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5> Loan Disbursement(Multiple trans)    <small> </small></h5>
					</div>
					{{-- <div class="ibox-content"> --}}
                        <div class="row">
							<form method="POST" class="form-horizontal"  name="updateForm" id="updateForm" action={{route('admin.disbursapply',['pid'=>$purpose->LPurposeId,'ltid'=>$intst->loantypeid])}}>
								@csrf
								<div class="wrapper wrapper-content animated fadeInRight">
										<div class="ibox float-e-margins">
											<div class="ibox-title text-center"></div>
												<div class="ibox-content">
														<div class="form-group">
															<div class="row">
																{{-- <div class="col-md-4">
																	<div class="col-md-6"><label>Loan No</label></div>
																	<div class="col-md-6"><input readonly name="loan_no" class="form-control" value=""></div>
																</div> --}}
																{{-- <div class="col-md-4 text-center">
																	<label>Selection Type</label><br>
																	<input type="radio" name="rdoST" value="All">&nbsp;<label>All</label>&nbsp;
																	<input type="radio" name="rdoST" value="Selective">&nbsp;<label>Selective</label>
																</div> --}}
																<div class="col-md-4">
																	<div class="col-md-6"><label>Loan Application No.</label></div>
																	<div class="col-md-6"><input readonly name="loan_app_no" class="form-control" value="{{$values->LoanAppId}}"></div>
																</div>
															</div>
														</div>
														<div class="hr-line-solid"></div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-6">
																	<div class="col-md-4"><label>Loan Officer</label></div>
																	<div class="col-md-8">
																		<input readonly name="loan_officer" class="form-control" value="{{$eomst->EOName}}">
																		<!-- <select name="loan_officer" class="form-control">
																			<option value="select">Select</option>
																		</select> -->
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="col-md-4"><label>Repayment Schedule</label></div>
																	<div class="col-md-8">
																		<select name="repayment" class="form-control">
																			<option value="monthly">Monthly</option>
																			<option value="yearly">Yearly</option>
																		</select>
																	</div>
																 </div>
															</div>
														</div>
														<div class="form-group">
															<div class="row">

																<div class="col-md-6">
																	<div class="col-md-4"><label>C.O.</label></div>
																	<div class="col-md-8">
																		<input readonly name="co" class="form-control"value="{{$CenterName->Market}}">
																	</div>
																</div>
																<div class="col-md-6">

																	<div class="col-md-4"><label>Loan Scheme</label></div>
																	<div class="col-md-8"><input readonly name="loan_scheme" class="form-control"
																		value="{{$intst->LoanType}}"></div>
																</div>
															</div>
														</div>

														<div class="form-group">
															<div class="row">
																<div class="col-md-6">

																	<div class="col-md-4"><label>Group</label></div>

																	<div class="col-md-8"><input readonly name="group" class="form-control" value=""></div>
																</div>
																<div class="col-md-6">
																	<div class="col-md-4"><label>Loan Number</label></div>
																	<div class="col-md-8"><input readonly name="loan_no" class="form-control" value="{{$values->AppLoanNo}}"></div>
																</div>
															</div>
														</div>

														<div class="form-group">
															<div class="row">
																<div class="col-md-6">
																	<div class="col-md-4"><label>Membership No.</label></div>
																	<div class="col-md-8"><input readonly name="mem_no" class="form-control" value="{{$values->MemberId}}"></div>
																</div>
																<div class="col-md-6">
																	<div class="col-md-4"><label>Name</label></div>
																	<div class="col-md-8"><input readonly name="name" class="form-control" value="{{$Name->AccountName}}"></div>
																</div>

															</div>
														</div>
                                                        <div class="form-group">
															<div class="row">
																<div class="col-md-6">
																	<div class="col-md-4"><label>Gaurenter Membership No.</label></div>
																	<div class="col-md-8"><input readonly name="mem_no" class="form-control" value="{{$values->GuarantorId}}"></div>
																</div>
																<div class="col-md-6">
																	<div class="col-md-4"><label>Gaurenter Name</label></div>
																	<div class="col-md-8"><input readonly name="name" class="form-control" value="{{$Gauname->AccountName}}"></div>
																</div>
															</div>
														</div>
                                                        <div class="hr-line-solid"></div>
                                                        @foreach($acno as $ac)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="col-md-6"><label>A/C No</label></div>
                                                                    <div class="col-md-6"><input readonly name="Ac_no" id="{{$ac->AccountNo}}" class="form-control" value="{{$ac->AccountNo}}"></div>
                                                                    <div class="col-md-6"><input type="hidden" name="Ac_no" id="{{$ac->AccountId}}" class="form-control" value="{{$ac->AccountId}}"></div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    {{-- <div class="col-md-6"><label>Check Balance</label></div> --}}
                                                                    <div class="col-md-4"><button type="button" class="btn btn-primary" id="func{{$ac->AccountNo}}">check balance</button></div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="col-md-6"><label>Available Balance</label></div>
                                                                    <div class="col-md-6"><input readonly name="available" id="avail{{$ac->AccountNo}}" class="form-control" value=""></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <script>
                                                            $(document).ready(function(){
                                                                $('#func{{$ac->AccountNo}}').click(function(){
                                                                $val=$("#{{$ac->AccountId}}").val();
                                                                //$val={{$ac->AccountId}}
                                                                    //alert($val);
                                                                    $.ajax({
                                                                            url:"{{route('admin.checkbalance')}}",
                                                                            type:'get',
                                                                            dataType:'json',
                                                                            data:{id:$val},
                                                                            success:function(resp){
                                                                                console.log(resp);
                                                                                    if(resp.success == true){
                                                                                        $('#avail{{$ac->AccountNo}}').val(resp.transactions);
                                                                                    }
                                                                            },
                                                                            error:function(resp){
                                                                                console.log(resp);
                                                                                }
                                                                            })
                                                                });
                                                            });
                                                        </script>
                                                         @endforeach
														<div class="hr-line-solid"></div>

														<div class="form-group">
															<div class="row">
																<div class="col-md-3">
																	<div class="col-md-6"><label>Applied Loan Amount</label></div>
																	<div class="col-md-6">
																	<input readonly name="loan_amt" id="loan_amt" class="form-control" value="{{$values->LoanAppAmt}}">
																	</div>
																</div>
                                                                <div class="col-md-3">
																	<div class="col-md-6"><label>Interest Period(Month)</label></div>
																	<div class="col-md-6"><input readonly name="interest_period" id="interest_period" class="form-control" value="{{$intst->Loan_duration}}"></div>
																</div>

																<div class="col-md-3">
																	<div class="col-md-6"><label>Installment No.</label></div>
																	<div class="col-md-6"><input readonly name="installment_no" class="form-control" value="{{$intst->Loan_duration}}"></div>
																</div>


																<div class="col-md-3">

																	<div class="col-md-6"><label>Rate of Interest(%)</label></div>
																	<div class="col-md-6"><input readonly name="rate_of_interest" id="rate_of_interest" class="form-control" value="{{$intst->Loan_interest}}"></div>
																</div>
															</div>
														</div>

														<div class="form-group">
															<div class="row">
                                                                <div class="col-md-3">
																	<div class="col-md-6"><label>Approve Loan Amount</label></div>
																	<div class="col-md-6">
																	<input type="number" name="loan_amt" id="Aloan_amt" class="form-control" value="">
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="col-md-6"><label>Interest Amount</label></div>
																	<div class="col-md-6"><input readonly name="interest_amt" id="interest_amt" class="form-control" value=""></div>
																</div>
																<div class="col-md-3">
																	<div class="col-md-6"><label>Installment Size</label></div>
																	<div class="col-md-6"><input readonly name="MonthlyEMI" id="MonthlyEMI" class="form-control"></div>
																</div>
                                                                <div class="col-md-3">
																	<div class="col-md-6"><label>Loan Cycle</label></div>
																	<div class="col-md-6"><input type="text" name="loan_cycle" class="form-control" value=""></div>
																</div>
															</div>
														</div>

                                                        <div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<div class="col-md-6"><label>1st Disburse Amount</label></div>
																	<div class="col-md-6"><input type="number" id="disburse_amt" name="disburse_amt[]" class="form-control"></div>
																</div>
															</div>
														</div>
                                                        <div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<div class="col-md-6"><label>2nd Disburse Amount</label></div>
																	<div class="col-md-6"><input type="number" id="disburse_amt" name="disburse_amt[]" class="form-control"></div>
																</div>
															</div>
														</div>
                                                        <div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<div class="col-md-6"><label>3rd Disburse Amount</label></div>
																	<div class="col-md-6"><input type="number" id="disburse_amt" name="disburse_amt[]" class="form-control"></div>
																</div>
															</div>
														</div>

														<div class="hr-line-solid"></div>

														<div class="form-group">
															<div class="row">
																<div class="col-md-3">
																	<div class="col-md-3"><label>Loan Date</label></div>
																	<div class="col-md-9">
																	<input type="date" class="form-control" id="data_1" name="data_1" >
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="col-md-3"><label>Start Date</label></div>
																	<div class="col-md-9"><input readonly name="start_date" id="start_date" class="form-control" required></div>
																</div>
																<div class="col-md-2">
																	<div class="col-md-3"><label>Day:</label></div>
																	<div class="col-md-9"><p><div id="paybyDay"></div></p></div>
																</div>
															</div>
														</div>

														<div class="hr-line-solid"></div>

														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<div class="col-md-6"><label>Loan Registation fee</label></div>
																	<div class="col-md-6"><input type="text" name="Reg_fee" class="form-control"></div>
																</div>
																<div class="col-md-4">
																	<div class="col-md-6"><label>Other Fee</label></div>
																	<div class="col-md-6"><input type="text" name="membership_fees" class="form-control"></div>
																</div>
															</div>
														</div>
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-3"><label>Processing Fee</label></div>
                                                                    <div class="col-md-3"><input type="text"  name="Pro_feep" id="Pro_feep" class="form-control" placeholder="Enter %"></div>
                                                                    <div class="col-md-1">%</div>
                                                                    <div class="col-md-3"><input type="text" name="Pro_fee" id="Pro_fee" class="form-control" ></div>
                                                                </div><br>
                                                                {{-- <div class="row">
                                                                    <div class="col-md-3"><label>Document Fee </label></div>
                                                                    <div class="col-md-3"><input type="text" name="doc_feep" id="doc_feep" class="form-control"></div>
                                                                    <div class="col-md-1">%</div>
                                                                    <div class="col-md-3"><input type="text" name="doc_fee" id="doc_fee" class="form-control" ></div>
                                                                </div> --}}
                                                            </div>
                                                        </div>


														<div class="hr-line-solid"></div>

														<div class="form-group">

																<div class="col-md-6">

																		{{-- <div class="row">
																			<div class="col-md-3"><label>Processing Fee</label></div>
																			<div class="col-md-3"><input type="text"  name="Pro_feep" id="Pro_feep" class="form-control"></div>
																			<div class="col-md-1">%</div>
																			<div class="col-md-3"><input type="text" name="Pro_fee" id="Pro_fee" class="form-control" ></div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-3"><label>Document Fee </label></div>
																			<div class="col-md-3"><input type="text" name="doc_feep" id="doc_feep" class="form-control"></div>
																			<div class="col-md-1">%</div>
																			<div class="col-md-3"><input type="text" name="doc_fee" id="doc_fee" class="form-control" ></div>
																		</div> --}}
																	<!-- </div> -->
																</div>

																<div class="col-md-6">
																	<div class="row">
																		<div class="col-md-6"><label>Source of Fund</label></div>
																		<div class="col-md-6">
																			<select name="source_of_fund" class="form-control">
																				<option>Own Source</option>
																			</select>
																		</div>
																	</div>
																	<br>
																	<div class="row">

																		<div class="col-md-6"><label>Purpose of Loan</label></div>
																		<div class="col-md-6">
																			<input type="text" name="purpose_of_loan" class="form-control" value="{{$purpose->Purpose}}">
																		</div>
																	</div>
																	<div class="hr-line-solid"></div>
																	<label><u>Payment Type</u></label>
																	<div class="row">

																		<div class="col-md-4"><input type="radio" name="rdoPT" value="Cash">&nbsp;<label>Cash</label></div>
																		<div class="col-md-4"><input type="radio" name="rdoPT" value="Bank">&nbsp;<label>Bank</label></div>
																		<div class="col-md-4"><input type="radio" name="rdoPT" value="Bank & Cash Both">&nbsp;<label>Bank & Cash Both</label></div>
																	</div>
																	<div class="hr-line-solid"></div>
																		<label><u>Cheque Detail</u></label>
																	<div class="row">

																		<div class="col-md-6"><label>Cheque No</label><input type="text" name="chq_no" class="form-control"></div>
																		<div class="col-md-6"><label>Date</label><input type="date" class="form-control" id="data_2" name="CQDATE" required value=""></div>
																	</div>
                                                                    <div class="hr-line-solid"></div>
																		<label><u>Bank Detail Detail</u></label>
																	<div class="row">
																		<div class="col-md-6">
																			<label>Bank Id&nbsp;&nbsp;</label><input type="text" name="bank_id" class="form-control">
																		</div>
                                                                        <div class="col-md-6">
																			<label>SFId&nbsp;&nbsp;</label><input type="text" name="SFId" class="form-control">
																		</div>
																	</div>
                                                                    {{-- <div class="row">
																		<div class="col-md-6">
																			<label>IFSC&nbsp;&nbsp;</label><input type="text" name="IFSC" class="form-control">
																		</div>
                                                                        <div class="col-md-6">
																			<label>A/C No&nbsp;&nbsp;</label><input type="text" name="AC_NO" class="form-control">
																		</div>
																	</div> --}}
																</div>

														</div>

														<div class="hr-line-solid"></div>
																	<div class="row">
																		<div class="col-md-4"></div>
																		<div class="col-md-2"><input type="radio" name="Approve" value="D">&nbsp;<label>Disburse </label></div>
																		<div class="col-md-2"><input type="radio" name="Approve" value="Y">&nbsp;<label>Cancal</label></div>
				                                                        <div class="col-md-4"></div>
																	</div>

													   <div class="form-group">
															<div class="col-sm-12 text-center">

																<button id="submit" type="submit" name="Submit" class="btn btn-primary" style="padding-left: 5%; padding-right: 5%;">Save</button><br>

															</div>
														</div>
												</div>
										</div>
								</div>
							</form>
						</div>
					</div>
					{{-- loan calculation starts --}}
					{{-- flat --}}
					{{-- @if($values->loantype=='Flat') --}}
					<div class="wrapper wrapper-content animated fadeInRight">
					<div class="row">
						<div class="col-lg-6">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Flat Rate</h5>
                                    @if($values->loantype=='Flat')
                                    &nbsp&nbsp✅
                                @endif
								</div>
								<div class="ibox-content">
									<div class="row">
										<div class="col-sm-12 b-r">
											<form role="form">
												<div class="form-group">
												 <div class="row">
													<div class="col-sm-4">
														<label>Loan Amount</label>
														<input type="text" id="DispPAmt" name="DispPAmt" class="form-control" placeholder="0.00" readonly="true">
													</div>
													<div class="col-sm-4">
														<label>Int. Payable</label>
														<input readonly  id="DispFIntP" name="DispFIntP" placeholder="0.00" class="form-control" >
													</div>
													<div class="col-sm-4">
														<label>Total Payable</label>
														<input readonly  min="0" step="1" id="DispFTotPayable" name="DispFTotPayable" placeholder="0.00" class="form-control" >
													</div>
												</div>
												</div>
											</form>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 b-r">
										<table id="memListTable" class="table table-responsive table-bordered">
											 <thead>
												<tr>
													<th>SL</th>
													<th>EMI</th>
													<th>INT</th>
													<th>PRINCIPAL</th>
													<th>BALANCE</th>
												</tr>
												</thead>
												<tbody id="flatDiv">
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

						</div>
                    {{-- @endif
					@if($values->loantype=='Reducing') --}}
					<div class="col-lg-6">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
                                <h5>Reducing Rate</h5>
                                @if($values->loantype=='Reducing')
                                   &nbsp&nbsp✅
                                @endif
                            </div>
							<div class="ibox-content">
								<div class="row">
								<div class="col-sm-12 b-r">
									<form role="form">
										<div class="form-group">
										 <div class="row">
											<div class="col-sm-4">
												<label>Loan Amount</label>
												<input type="text" id="DispPAmtR" name="DispPAmtR" class="form-control" placeholder="0.00" readonly="true">
											</div>
											<div class="col-sm-4">
												<label>Int. Payable</label>
												<input type="text" id="DispRIntP" name="DispRIntP" placeholder="0.00" class="form-control" readonly="true">
											</div>
											<div class="col-sm-4">
												<label>Total Payable</label>
												<input type="text" min="0" step="1" id="DispRTotPayable" name="DispRTotPayable" placeholder="0.00" class="form-control"  readonly="true">
											</div>
										</div>
										</div>
									</form>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 b-r">
								<table id="memListTable" class="table table-responsive table-bordered">
									 <thead>
										<tr>
											<th>SL</th>
											<th>EMI</th>
											<th>INT</th>
											<th>PRINCIPAL</th>
											<th>BALANCE</th>
										</tr>
										</thead>
										<tbody id="reducingDiv">
										</tbody>
									</table>
								</div>
							</div>
							</div>
						</div>
					</div>
					{{-- @endif --}}
					</div>
				</div>
				</div>
{{-- flat end --}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
    $('#checkbalance').click(function(){
        alert("Atleast one File required.");
        // $.ajax({
        // 	url:"{{route('admin.get_MName')}}",
        // 	type:'get',
        // 	dataType:'json',
        // 	data:{id:$(this).val()},
        // 	success:function(resp){
        // 		console.log(resp);
        // 		if(resp.success == true){
        // 			$.each(resp.GauName,function(k,v){
        // 				$('#guarantor_name').val(v);
        // 			})
        // 		}
        // 	},
        // 	error:function(resp){
        // 		console.log(resp);
        // 	}
        // })
    });
    });
    $(document).ready(function(){
        $('#Pro_feep').change(function(){
            var amt=$('#Aloan_amt').val();
            var newmt=amt*($('#Pro_feep').val()/100)
            $('#Pro_fee').val(newmt);
        })
        $('#doc_feep').change(function(){
            var amt=$('#Aloan_amt').val();
            var newmt=amt*($('#doc_feep').val()/100)
            $('#doc_fee').val(newmt);
        })
    })
</script>
<script>
window.onload = function() {
     $('#Aloan_amt').change(function(){

                var LoanAmt = $('#Aloan_amt').val();
				var LoanInt = $('#rate_of_interest').val();
				var LoanTerm = $('#interest_period').val();
                var IntFlatAmt = (parseFloat(LoanAmt)* (parseFloat(LoanInt)/12) * (parseFloat(LoanTerm)))/100;
				var TotalFlatPayable = parseFloat(LoanAmt)+parseFloat(IntFlatAmt);
				var FlatEMI = (parseFloat(TotalFlatPayable) / parseFloat(LoanTerm)).toFixed(2);
				var FlatEMIInt = (parseFloat(IntFlatAmt) / parseFloat(LoanTerm)).toFixed(2);
				$('#DispPAmt').val(parseFloat(LoanAmt).toFixed(2));
				$('#DispFIntP').val(parseFloat(IntFlatAmt).toFixed(2));
				$('#DispFTotPayable').val(parseFloat(TotalFlatPayable).toFixed(2));
				FlatDisplayTable(LoanAmt,LoanTerm,FlatEMIInt,FlatEMI,TotalFlatPayable);
				ReducingInt(LoanAmt,LoanTerm,LoanInt);
				if('{{$values->loantype}}'=='Flat'){
				$('#interest_amt').val(parseFloat(IntFlatAmt).toFixed(2));
				$('#MonthlyEMI').val(parseFloat(FlatEMI).toFixed(0));
				}
             })
}

function FlatDisplayTable(Floan,Fterm,Fint,FEMI,TotalFlatPayable)
			{
			var total=TotalFlatPayable;
			var Floan = Floan;
			var rws = Fterm;
			var emi = FEMI;
			var Fint = Fint;
			var principalRefund = '';
			var table_body = '';
			var dispTD = '';
			var totP = 0;
			var totI = 0;
              for(var i=0;i<rws;i++){
                table_body+='<tr>';
                for(var j=0;j<5;j++){
					if(j == 0)
						dispTD = (i+1);
					else if(j == 1 && i!=rws-1)
						dispTD = parseFloat(emi);
						// for equivalent
					else if(j == 1 && i==rws-1)
					    dispTD=Math.round(emi)+(parseFloat(total)-(Math.round(emi)*rws));
						//dispTD = emi+(total-(emi*rws));
					else if(j == 2){
						dispTD = Fint;
						totI += parseFloat(dispTD);
						}
					else if(j == 3)	{
						dispTD = parseFloat(emi)-parseFloat(Fint);
						totP += parseFloat(dispTD);
						principalRefund = parseFloat(dispTD);
						}

					else if(j == 4)	{
						dispTD = (parseFloat(Floan)-parseFloat(totP));
						//Floan =	parseFloat(dispTD).toFixed(0);
						}
					// else if(j == 4 && i==rws-1)	{
					// 	temp = (parseFloat(Floan)-parseFloat(totP)).toFixed(2);
					// 	dispTD=0.00.toFixed(2);
					// 	//Floan =	parseFloat(dispTD).toFixed(0);
					// 	}
					if(j!=0){
						table_body +='<td>';
                        table_body +=Math.round(dispTD).toFixed(2);
                        table_body +='</td>';
					}else{
                        table_body +='<td>';
                        table_body +=dispTD;
                        table_body +='</td>';
					}
                }
				table_body+='</tr>';
              }
                table_body+='<tr><td></td><td></td>';
				table_body +='<td><strong>';
                table_body += Math.round(totI).toFixed(2);
                table_body +='</strong></td><td><strong>';
				table_body += Math.round(totP).toFixed(2);
				table_body+='</strong></td></tr>';
                /*table_body+='</table>';*/
               $('#flatDiv').html(table_body);
			}

	function ReducingInt(p,n,r)
		{
		var REMI = Math.abs(parseFloat(PMT(((r/100)/12), n, p))); //output */
		var totalRPayable = parseFloat(REMI)*parseFloat(n);
		$('#DispPAmtR').val(p);
		$('#DispRIntP').val( Math.round(totalRPayable-p).toFixed(2));
		//$('#DispRTotPayable').val(totalRPayable.toFixed(0));
		$('#DispRTotPayable').val( Math.round(totalRPayable).toFixed(2));
		if('{{$values->loantype}}'=='Reducing'){
            $('#interest_amt').val( Math.round(totalRPayable-p).toFixed(2));
			$('#MonthlyEMI').val(Math.abs(parseFloat(PMT(((r/100)/12), n, p))).toFixed(0));
            }
		var ReducingIntPerMonth = 0;
		var ReducingPrincipal = p;
		var table_body = '';
		var dispTD = '';
		var totP = 0;
		var totI = 0;
		var d = false;
		var dd = 1;
		for(var i=0;i<n;i++){
				if((i == n-1 && d == true) || (i<n-1))
				{
					dd=2;
                	table_body+='<tr>';
				}
                for(var j=0;j<5;j++){
					if(j == 0)
						dispTD = (i+1);
					else if(j == 1 && i!=n-1)
						dispTD = parseFloat(REMI);
					else if(j == 1 && i==n-1)
					    dispTD=Math.round(REMI)+(parseFloat(totalRPayable)-(Math.round(REMI)*n));
					else if(j == 2){
						ReducingIntPerMonth = (parseFloat(ReducingPrincipal)*1*(parseFloat(r)/100))/12
						//dispTD = Math.round(ReducingIntPerMonth);
						dispTD = ReducingIntPerMonth;
						totI=totI+dispTD
						}
					else if(j == 3)	{
						dispTD = (parseFloat(REMI)-parseFloat(ReducingIntPerMonth));
							principalRefund = parseFloat(dispTD);
							totP += parseFloat(dispTD);
						}
					else if(j == 4)	{
						dispTD = (parseFloat(ReducingPrincipal)-parseFloat(principalRefund));
						//alert(dispTD);
						ReducingPrincipal = (parseFloat(ReducingPrincipal)-parseFloat(principalRefund));
						}
						if(j!=0){
						table_body +='<td>';
                        table_body +=Math.round(dispTD).toFixed(2);
                        table_body +='</td>';
					}else{
                        table_body +='<td>';
                        table_body +=dispTD;
                        table_body +='</td>';
					}
				}
					table_body+='</tr>';
              }
                table_body+='<tr><td></td><td></td>';
				table_body +='<td><strong>';
                table_body += Math.round(totI).toFixed(2);
                table_body +='</strong></td><td><strong>';
				table_body += Math.round(totP).toFixed(2);
				table_body+='</strong></td></tr>';
                /*table_body+='</table>';*/
               $('#reducingDiv').html(table_body);

		}

	function PMT(i, n, p) {
	 return i * p * Math.pow((1 + i), n) / (1 - Math.pow((1 + i), n));
	}
</script>

<script>
// for date calculation
$(document).ready(function(){
$('#data_1').change(function(){
            // var today = new Date()
            // $('#data_1').val(today);
            // alert(today);
			var data =$('#data_1').val();
			var nd = formatDate(data);
			var sd = getdate(nd,30);
			$('#start_date').val(formatDateddyymmmm(sd));
			$('#paybyDay').html(getPayByDay(sd));
        })
});
        function formatDate(date) {
     		var arr = date.split('-');
			return arr[1]+"/"+arr[0]+"/"+arr[2];
 		}

		function formatDateddyymmmm(date) {
     		var arr = date.split('/');
			return arr[1]+"-"+arr[0]+"-"+arr[2];
 		}

		function getPayByDay(d)
			{
			var pbD = new Date(d);
			var dy = "";
			switch (pbD.getDay())
				{
					case 1:
					dy = "Monday";
					break;

					case 2:
					dy = "Tuesday";
					break;

					case 3:
					dy = "Wednesday";
					break;

					case 4:
					dy = "Thursday";
					break;

					case 5:
					dy = "Friday";
					break;

					case 6:
					dy = "Saturday";
					break;

					case 7:
					dy = "Sunday";
					break;
				}

				return dy;
			}

			function getdate(tt,dys) {

				var date = new Date();
                //alert(date);
				var newdate = new Date(date);
                //alert(newdate);
				var dys = parseInt(dys);
				var l = "C";
				while (l == "C") {
				newdate.setDate(newdate.getDate() + dys);

				var dd = newdate.getDate();
				var mm = newdate.getMonth() + 1;
				var y = newdate.getFullYear();

				if (dd < 27 || dd >=29)
					dd=27;

				if(parseInt(mm)<=9)  mm = '0' + mm;
				if(parseInt(dd)<=9)  dd = '0' + dd;
				//if (mm.length < 2) mm = '0' + mm;
    			//if (dd.length < 2) dd = '0' + dd;

				var someFormattedDate = mm + '/' + dd + '/' + y;
				newdate = new Date(someFormattedDate);

				//alert(newdate);
				//alert(newdate.getDay());
				if(newdate.getDay() == 0)
					{
						l = "C";
						dys = 1;
					}
				else
					{
					l = "B";
					//
					}
				}
				return someFormattedDate;
			}
</script>
@endsection

