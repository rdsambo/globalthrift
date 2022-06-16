@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">


                        <div class="ibox-title">
                            <h5>Load Details    <small> &nbsp   Simple login form example</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>

                        <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 b-r">
                                 <form role="form">
                                     <div class="form-group">
                                         <div class="row">
                                             <div class="col-sm-6">
                                                  <label>Loan Amount</label> <input type="number" min="0" step="1" id="txtLAmt" name="txtLAmt" oninput="(validity.valid)||(value='0');" placeholder="Loan Amount" class="form-control">
                                             </div>
                                             <div class="col-sm-3">
                                                  <label>Interest</label> <input readonly type="number" min="0" step=".1" id="txtLInt" name="txtLInt" placeholder="Loan Amount" class="form-control">
                                             </div>
                                             <div class="col-sm-3">
                                                  <label>Term</label> <input readonly type="number" min="0" step="1" id="txtLTerm" name="txtLTerm" placeholder="Loan Term" class="form-control" >
                                             </div>
                                             </div>
                                             </div>
                                             <div class="form-group"><label>Loan Product</label>
                                                <select class="form-control m-b" name="LstProd" id="LstProd"  required>
                                                    <option value="0">Select Product</option>
                                                    @foreach($product_data as $dda)
                                                    <option value="{{$dda->ProductId}}">{{$dda->Product}}</option>
                                                @endforeach
                                                </select>
                                             </div>
                                             <div class="form-group"><label>Loan Type</label>
                                                   <select class="form-control m-b" name="LstLoanType" id="LstLoanType" required >
                                                       <option value="0">Select Loan Type</option>
                                                    </select>
                                             </div>
                                  </form>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-center">
                                    <a href="#"><i class="fa fa-sign-in big-icon"></i></a>
                                </p>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Flat Rate</h5>
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
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title"><h5>Reducing Rate</h5></div>
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
            </div>



    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
$('#LstProd').change(function(){
    $('#LstLoanType').html('');
    $.ajax({
        url:"{{route('admin.loan_type')}}",
        type:'get',
        dataType:'json',
        data:{id:$(this).val()},
        success:function(resp){
            console.log(resp);
            if(resp.success == true){
                var html = "<option val=''>Select Loan type</option>";
                $.each(resp.loan_type,function(k,v){
                    html += "<option value='"+v.loantypeid+"'>"+v.LoanType+"</option>";
                })
                $('#LstLoanType').html(html);
            }
        },
        error:function(resp){
            console.log(resp);
        }
    })
})
});


$(document).ready(function(){
$('#LstLoanType').change(function(){
    $.ajax({
        url:"{{route('admin.loan_calculate')}}",
        type:"get",
        datatype:"json",
        data:{id:$(this).val()},
        success:function(resp){
            console.log(resp);
            if(resp.success == true){
                $('#txtLInt').val(resp.loan_calculate[0].Loan_interest);
				$('#txtLTerm').val(resp.loan_calculate[0].Loan_duration);
                var LoanAmt = $('#txtLAmt').val();
				var LoanInt = $('#txtLInt').val();
				var LoanTerm = $('#txtLTerm').val();
                var IntFlatAmt = (parseFloat(LoanAmt)* (parseFloat(LoanInt)/12) * (parseFloat(LoanTerm)))/100;
				var TotalFlatPayable = parseFloat(LoanAmt)+parseFloat(IntFlatAmt);
				var FlatEMI = (parseFloat(TotalFlatPayable) / parseFloat(LoanTerm)).toFixed(2);
				var FlatEMIInt = (parseFloat(IntFlatAmt) / parseFloat(LoanTerm)).toFixed(2);
				$('#DispPAmt').val(parseFloat(LoanAmt).toFixed(2));
				$('#DispFIntP').val(parseFloat(IntFlatAmt).toFixed(2));
				$('#DispFTotPayable').val(parseFloat(TotalFlatPayable).toFixed(2));
				FlatDisplayTable(LoanAmt,LoanTerm,FlatEMIInt,FlatEMI,TotalFlatPayable);
				ReducingInt(LoanAmt,LoanTerm,LoanInt);

            }

        },
        error:function(resp){
            console.log(resp);
        }
    })

})
});


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
@endsection
