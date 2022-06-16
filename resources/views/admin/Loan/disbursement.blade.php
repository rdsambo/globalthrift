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
                    @if(Session::has('success'))
					<div class="alert alert-success"><span style="font-size: medium">{{Session::get('success')}}</span></div>
				    @endif
                    @if(Session::has('error'))
					<div class="alert alert-danger"><span style="font-size: medium">{{Session::get('success')}}</span></div>
				    @endif
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
                                                                <div class="col-md-8"><input readonly name="Gmem_no" class="form-control" value="{{$values->GuarantorId}}"></div>
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
                                                                <div class="col-md-6"><input readonly id="{{$ac->AccountNo}}" class="form-control" value="{{$ac->AccountNo}}"></div>
                                                                <div class="col-md-6"><input type="hidden" id="{{$ac->AccountId}}" class="form-control" value="{{$ac->AccountId}}"></div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                {{-- <div class="col-md-6"><label>Check Balance</label></div> --}}
                                                                <div class="col-md-4"><button type="button" class="btn btn-primary" id="func{{$ac->AccountNo}}">check balance</button></div>
                                                            </div>
                                                            @if($ac->AccountId==$values->AccountId)
                                                                <div class="col-md-6"><input type="hidden" name="Ac_no" id="{{$ac->AccountNo}}" class="form-control" value="{{$ac->AccountNo}}"></div>
                                                                <div class="col-md-6"><input type="hidden" name="Ac_id" id="{{$ac->AccountId}}" class="form-control" value="{{$ac->AccountId}}"></div>
                                                            @endif
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
                                                                <input readonly id="loan_amt" class="form-control" value="{{$values->LoanAppAmt}}">
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
                                                                <div class="col-md-6"><label>Approved Loan Amount</label></div>
                                                                <div class="col-md-6">
                                                                <input readonly name="Aloan_amt" id="Aloan_amt" class="form-control" value="{{$values->ApprovedAmt}}">
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

                                                    @php
                                                        $sl=0;
                                                        $status=0;
                                                        $couu_amt=0;
                                                    @endphp
                                                @isset($muldis)
                                                    @foreach($muldis as $key=>$mul)
                                                    @php
                                                        $sl++;
                                                    @endphp
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="col-md-4"><label>{{$sl}}.st Disburse Amount</label></div>
                                                                <div class="col-md-6"><input readonly id="disburse_amt" name="disburse_amt" class="form-control" value="{{$mul->BreakupAmt}}"></div>
                                                                @php
                                                                    $couu_amt=$couu_amt+$mul->BreakupAmt;
                                                                @endphp
                                                                @if($mul->IsDisbursed=='Y')
                                                                    @php
                                                                        $status++;
                                                                    @endphp
                                                                @endif
                                                                @if($mul->IsDisbursed=='N' && $key==$status)
                                                                @php
                                                                    $disbursamt=$mul->BreakupAmt;
                                                                @endphp
                                                                <div class="col-md-2"><input type="button" class="btn btn-primary" value="Disburs Amount" onclick="DetailFun('{{$couu_amt}}')"></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @else
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="col-md-4"><label>Disburse Amount</label></div>
                                                            <div class="col-md-6"><input readonly id="disburse_amt" name="disburse_amt" class="form-control" value="{{$values->ApprovedAmt}}"></div>
                                                            <div class="col-md-2"><input type="button" class="btn btn-primary" value="Disburs Amount" onclick="DetailFun('{{$couu_amt}}')"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endisset
										    </div>
								        </div>
							    </div>
							    <div class="wrapper wrapper-content animated fadeInRight" id="show">
								        <div class="ibox float-e-margins">
                                            {{-- <div class="ibox-title text-center"></div> --}}
                                                <div class="ibox-content">
                                                    <label> Disbursment No : {{$status+1}}</label>
                                                    <div class="hr-line-solid"></div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            @isset($muldis)
                                                            <div class="col-md-3">
                                                                <div class="col-md-3"><label>Disburs Amount</label></div>
                                                                <div class="col-md-9">
                                                                <input readonly class="form-control" value={{$disbursamt}} >
                                                                <input type="hidden" class="form-control" value={{$disbursamt}} name="disburs_amt" id="disburs_amt" >
                                                                <input type="hidden" class="form-control" value={{$status+1}} name="dose" >
                                                                </div>
                                                            </div>
                                                            @endisset
                                                            <div class="col-md-3">
                                                                <div class="col-md-3"><label>Loan Date</label></div>
                                                                <div class="col-md-9">
                                                                <input type="date" class="form-control" id="data_1" name="data_1" required>
                                                                {{-- <input id="datepicker" type="text" class="form-control" data-zdp_readonly_element="false"> --}}
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
                                                    @if($status==0)
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
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="col-md-3"><label>Processing Fee</label></div>
                                                                <div class="col-md-3"><input type="text"  name="Pro_feep" id="Pro_feep" class="form-control" placeholder="Enter %"></div>
                                                                <div class="col-md-1">%</div>
                                                                <div class="col-md-3"><input type="text" name="Pro_fee" id="Pro_fee" class="form-control" ></div>
                                                            </div><br>
                                                        </div>
                                                    </div>
                                                    @endif
                                                        <div class="hr-line-solid"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-6">
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
                                                                        <input readonly name="purpose_of_loan" class="form-control" value="{{$purpose->Purpose}}">
                                                                    </div>
                                                                </div>
                                                                <div class="hr-line-solid"></div>
                                                                <label><u>Payment Type</u></label>
                                                                <div class="row">

                                                                    <div class="col-md-4"><input type="radio" name="rdoPT" value="1" id="cash">&nbsp;<label>Cash</label></div>
                                                                    <div class="col-md-4"><input type="radio" name="rdoPT" value="2" id="checque">&nbsp;<label>Checque</label></div>
                                                                    <div class="col-md-4"><input type="radio" name="rdoPT" value="3" id="CandC">&nbsp;<label>checque & Cash Both</label></div>
                                                                </div>
                                                                <div id="CorC">
                                                                <div class="hr-line-solid"></div>
                                                                    <label><u>Cheque Detail</u></label>
                                                                <div class="row">

                                                                    <div class="col-md-6"><label>Cheque No</label><input type="text" name="chq_no" class="form-control"></div>
                                                                    <div class="col-md-6"><label>Date</label><input type="date" class="form-control" id="data_2" name="checquedt" value=""></div>
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
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="hr-line-solid"></div>
                                                                    <div class="row">
                                                                        <div class="col-md-4"></div>
                                                                        <input type="hidden" id="flatarr" name="flatarr[]" value="">
                                                                        <input type="hidden" id="redarr" name="redarr[]" value="">
                                                                        <input type="hidden" name="loan_type" value="{{$values->loantype}}">
                                                                        <div class="col-md-2"><input type="radio" name="Approve" value="D">&nbsp;<label>Disburse </label></div>
                                                                        <div class="col-md-2"><input type="radio" name="Approve" value="Y" id="cancal">&nbsp;<label>Cancal</label></div>
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

						        </div>
					    </div>
                            </form>
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
                                                    <th>Date</th>
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
                                            <th>Date</th>
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
    function DetailFun(val){
        // alert(val);

        $('#show').show();
        $('#disburs_amt').val(val)
        $('#cancal').prop('checked', false);
    }
    $(document).ready(function(){
        $('#CorC').hide();
        // $('#CorC').prop("disabled","disabled");
        $('#cancal').click(function(){
            $('#show').hide();
        });
        $('#checque').click(function(){
            $('#CorC').show();
        });
        $('#CandC').click(function(){
            $('#CorC').show();
        });
        $('#cash').click(function(){
            $('#CorC').hide();
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
    $('#show').hide();
}

function LoanCalculate(){
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
}

function FlatDisplayTable(Floan,Fterm,Fint,FEMI,TotalFlatPayable){
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
            var date =$('#data_1').val();
            var arr=[];
            // var arr = Array(rws).fill().map(() => Array(6));
                for(var i=0;i<rws;i++){
                    arr.push( [] );
                    table_body+='<tr>';
                    var sd = getdate(date,30);
                    for(var j=0;j<=5;j++){
                        if(j == 0)
                            dispTD = (i+1);
                        else if(j==1){
                            dispTD=formatDateddyymmmm(sd);
                            date=dispTD;
                        }
                        else if(j == 2 && i!=rws-1)
                            dispTD = parseFloat(emi);
                            // for equivalent
                        else if(j == 2 && i==rws-1)
                            dispTD=Math.round(emi)+(parseFloat(total)-(Math.round(emi)*rws));
                            //dispTD = emi+(total-(emi*rws));
                        else if(j == 3){
                            dispTD = Fint;
                            totI += parseFloat(dispTD);
                            }
                        else if(j == 4)	{
                            dispTD = parseFloat(emi)-parseFloat(Fint);
                            totP += parseFloat(dispTD);
                            principalRefund = parseFloat(dispTD);
                            }

                        else if(j == 5)	{
                            dispTD = (parseFloat(Floan)-parseFloat(totP));
                            //Floan =	parseFloat(dispTD).toFixed(0);
                            }
                        // else if(j == 4 && i==rws-1)	{
                        // 	temp = (parseFloat(Floan)-parseFloat(totP)).toFixed(2);
                        // 	dispTD=0.00.toFixed(2);
                        // 	//Floan =	parseFloat(dispTD).toFixed(0);
                        // 	}
                        if(j>1){
                            arr[i].push(Math.round(dispTD).toFixed(2));
                            // alert('ok');
                            table_body +='<td>';
                            table_body +=Math.round(dispTD).toFixed(2);
                            // var val1=Math.round(dispTD).toFixed(2);
                            // table_body += '<input type="hidden" name="record[i][]" value="'+val1+'">';
                            table_body +='</td>';
                        }else{
                            table_body +='<td>';
                            table_body +=dispTD;
                            // var val1=dispTD;
                            table_body +='</td>';
                            // table_body += '<input type="hidden" name="record[i][]" value="'+val1+'">';
                            arr[i].push(dispTD);
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
               console.log(arr);
               $('#flatarr').val(JSON.stringify(arr) );
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
        var date =$('#data_1').val();
        var arr=[];
		for(var i=0;i<n;i++){
            arr.push( [] );
				if((i == n-1 && d == true) || (i<n-1))
				{
					dd=2;
                	table_body+='<tr>';
				}
                var sd = getdate(date,30);
                for(var j=0;j<=5;j++){
					if(j == 0)
						dispTD = (i+1);
                    else if(j==1){
                        dispTD=formatDateddyymmmm(sd);
                        date=dispTD;
                    }
					else if(j == 2 && i!=n-1)
						dispTD = parseFloat(REMI);
					else if(j == 2 && i==n-1)
					    dispTD=Math.round(REMI)+(parseFloat(totalRPayable)-(Math.round(REMI)*n));
					else if(j == 3){
						ReducingIntPerMonth = (parseFloat(ReducingPrincipal)*1*(parseFloat(r)/100))/12
						dispTD = ReducingIntPerMonth;
						totI=totI+dispTD
						}
					else if(j == 4)	{
						dispTD = (parseFloat(REMI)-parseFloat(ReducingIntPerMonth));
							principalRefund = parseFloat(dispTD);
							totP += parseFloat(dispTD);
						}
					else if(j == 5)	{
						dispTD = (parseFloat(ReducingPrincipal)-parseFloat(principalRefund));
						ReducingPrincipal = (parseFloat(ReducingPrincipal)-parseFloat(principalRefund));
						}
						if(j>1){
						table_body +='<td>';
                        table_body +=Math.round(dispTD).toFixed(2);
                        table_body +='</td>';
                        arr[i].push(Math.round(dispTD).toFixed(2));
					}else{
                        table_body +='<td>';
                        table_body +=dispTD;
                        table_body +='</td>';
                        arr[i].push(dispTD);
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
               $('#reducingDiv').html(table_body);
               $('#redarr').val(JSON.stringify(arr) );

		}

	function PMT(i, n, p) {
	 return i * p * Math.pow((1 + i), n) / (1 - Math.pow((1 + i), n));
	}
</script>

<script>
$(document).ready(function(){
$('#data_1').change(function(){
			var data =$('#data_1').val();
			var nd = formatDate(data);
			var sd = getdate(data,30);
			$('#start_date').val(formatDateddyymmmm(sd));
			$('#paybyDay').html(getPayByDay(sd));
            console.log(getPayByDay(sd));
            LoanCalculate();
        })
});

        function formatDate(date) {
     		var arr = date.split('-');
			return arr[1]+"-"+arr[0]+"-"+arr[2];
 		}

		function formatDateddyymmmm(date) {
     		var arr = date.split('-');
			return arr[1]+"-"+arr[0]+"-"+arr[2];
 		}

		function getPayByDay(d)
			{
            var arr = d.split('-');
			var test =arr[1]+"/"+arr[0]+"/"+arr[2];
			pbD = new Date(test);
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
					case 0:
					dy = "Sunday";
					break;
				}
				return dy;
			}

			function getdate(tt,dys) {
                var data = tt;
				var newdate = new Date(data);
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
				var someFormattedDate = dd + '-' + mm + '-' + y;
			    newdate = mm + '/' + dd + '/' + y;
                var newdate = new Date(newdate);
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

