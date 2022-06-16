@extends('admin.layout.master')
@section('content')
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
<div class="form-group">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5> Collect Emi    <small> </small></h5>
            </div>
            <form action="{{route('admin.loan_coll_emi')}}" method="post">
                @csrf
            <div class="ibox-content">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="col-md-4"><label>App. No.</label></div>
                            <div class="col-md-8"><input readonly name="loan_app_no" class="form-control" value="{{$keyLoan->LoanAppId}}"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-4"><label>Loan Id.</label></div>
                            <div class="col-md-8"><input readonly name="loan_Id" class="form-control" value="{{$keyLoan->LoanId}}"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-4"><label>Loan No.</label></div>
                            <div class="col-md-8"><input readonly name="loan_no" class="form-control" value="{{$keyLoan->LoanNo}}"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-4"><label>Member Id</label></div>
                            <div class="col-md-8"><input readonly name="memberid" class="form-control" value="{{$keyLoan->MemberId}}"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Loan Officer</label></div>
                            <div class="col-md-8">
                                <input readonly name="loan_officer" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Center</label></div>
                            <div class="col-md-8">
                                <input readonly name="center" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Loan Scheme</label></div>
                            <div class="col-md-8"><input readonly name="loan_scheme" class="form-control" value="{{$keyLoan->LoanType}}"></div>
                            <div class="col-md-8"><input type="hidden" name="loan_type" class="form-control" value="{{$keyLoan->LoanTypeId}}"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Loan Purpose</label></div>
                            <div class="col-md-8">
                                <input readonly name="purpose" class="form-control"value="{{$keyLoan->Purpose}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Int. Rate(%)</label></div>
                            <div class="col-md-8"><input readonly name="int_rt" class="form-control" value="{{$keyLoan->Loan_interest}}"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Loan Date</label></div>
                            <div class="col-md-8"><input readonly name="date" class="form-control" value="{{$keyLoan->LoanDt}}"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Loan Amount</label></div>
                            <div class="col-md-8"><input readonly name="loan_amt" id="loan_amt" class="form-control" value="{{$keyLoan->LOSAmt}}"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Interest Amount</label></div>
                            <div class="col-md-8">
                                <input readonly name="int_amt" class="form-control" value="{{$keyLoan->IOSAmt}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Principal Recovered</label></div>
                            <div class="col-md-8"><input readonly name="p_out" id="p_out" class="form-control" value="{{$recovered->tot_PrinCollAmt}}"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Interest Recovered</label></div>
                            <div class="col-md-8"><input readonly name="int_out" class="form-control" value="{{$recovered->tot_IntCollAmt}}"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Total Recovered</label></div>
                            <div class="col-md-8"><input readonly name="int_out" class="form-control" value="{{$recovered->total}}"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-8 b-r">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-6"><label>Installment No. : {{$instno_v1}}</label></div>
                                    <input type="hidden" name="ins_no" class="form-control" value="{{$instno_v1}}">
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-success" id="myBtn" role="button" data-bs-toggle="modal" >view records</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6"><label>Payable Amount :</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-6"><label>Due Amount :</label></div>
                                    <div class="col-md-6"><label>Paid Amount :</label></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-6"><label>Principal Amount</label></div>
                                    <div class="col-md-6"><input readonly name="p_prin" class="form-control" value="{{$loanemi[$instno-1]->PrinceAmt}}"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-6"><input readonly name="d_prin" id="d_prin" class="form-control" value="{{$records[$len]->PrincDue ?? '0'}}" oninput="calculate()" required></div>
                                    <div class="col-md-6"><input type="number" name="c_prin" id="c_prin" class="form-control" value="{{$loanemi[$instno-1]->PrinceAmt}}" oninput="calculate()" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-6"><label>Interest Amount</label></div>
                                    <div class="col-md-6"><input readonly name="p_intst" class="form-control" value="{{$loanemi[$instno-1]->InstAmt}}" ></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-6"><input readonly name="d_intst" id="d_intst" class="form-control" value="{{$records[$len]->InstDue ?? '0'}}" oninput="calculate()" required></div>
                                    <div class="col-md-6"><input type="number" name="c_intst" id="c_intst" class="form-control" value="{{$loanemi[$instno-1]->InstAmt}}" oninput="calculate()" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-6"><label>Penalty Amount</label></div>
                                    <div class="col-md-6"><input readonly name="p_penalty" class="form-control" value="0"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-6"><input readonly name="d_penalty" id="d_penalty" class="form-control" value="0" oninput="calculate()" required></div>
                                    <div class="col-md-6"><input type="number" name="c_penalty" id="c_penalty" class="form-control" value="0" oninput="calculate()" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-6"><label>Total Amount</label></div>
                                    <div class="col-md-6"><input readonly name="p_total" class="form-control" value="{{$loanemi[$instno-1]->InstAmt+$loanemi[$instno-1]->PrinceAmt}}"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-6"><input readonly name="d_total" id="d_total" class="form-control" value="{{$records[$len]->TotalDue ?? '0'}}" required></div>
                                    <div class="col-md-6"><input type="number" name="c_total" id="c_total" class="form-control" value="{{$loanemi[$instno-1]->InstAmt+$loanemi[$instno-1]->PrinceAmt}}" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-4"><label>Date</label></div>
                                    <div class="col-md-8"><input type="date" name="date" class="form-control" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="col-md-3"><label>Collection Mode</label></div>
                                    <div class="col-md-1"><input type="radio" id="col_mode" name="col_mode" value="C" onclick="MyFun()" required></div>
                                    <div class="col-md-2"><label>Cash</label></div>
                                    <div class="col-md-1"><input type="radio" id="col_mode" name="col_mode" value="B" onclick="MyFunII()" required></div>
                                    <div class="col-md-2"><label>Bank</label></div>
                                    <div class="col-md-1"><input type="radio" id="col_mode" name="col_mode" value="T" onclick="MyFunIII()" required></div>
                                    <div class="col-md-2"><label>Transfer</label></div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="hidden_el0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-5"><label>A/C Type </label></div>
                                    <div class="col-md-1"><input type="radio" id="col_from" name="ac_type" value="dd" ></div>
                                    <div class="col-md-2"><label>DD</label></div>
                                    <div class="col-md-1"><input type="radio" id="col_from" name="ac_type" value="md" ></div>
                                    <div class="col-md-2"><label>MD</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-4"><label>A/C No</label></div>
                                    <div class="col-md-8"><input readonly name="ac_no" id="ac_no" class="form-control" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="hidden_el0_1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-4"><label>A/C Id</label></div>
                                    <div class="col-md-8"><input readonly name="ac_id_v1" id="ac_id_v1" class="form-control" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="hidden_el">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-4"><label>Bank Name</label></div>
                                    <div class="col-md-8"><input type="text" name="bank_name" id="bank_name" class="form-control" required></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-4"><label>Cheque No</label></div>
                                    <div class="col-md-8"><input type="number" name="cheque_no" id="cheque_no" class="form-control" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="hidden_el_v_1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-4"><label>Cheque date</label></div>
                                    <div class="col-md-8"><input type="date" name="checque_date" id="checque_date" class="form-control" required></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-4"><label>Amount</label></div>
                                    <div class="col-md-8"><input type="number" name="Amount" id="Amount0" class="form-control" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="hidden_el2">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-4"><label>Amount</label></div>
                                    <div class="col-md-8"><input type="number" name="Amountcash" id="Amount" class="form-control" required></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-4"><label>Date</label></div>
                                    <div class="col-md-8"><input type="date" name="cash_date" id="cash_date" class="form-control" required></div>
                                </div>
                            </div>
                        </div>
                       <div id="xyz"></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6"><input type="Submit" class="btn btn-primary" value="Save"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="col-sm-4 ">
                {{-- </div>
                <div class="row"> --}}
                            <legend><h5>Premature Closing</h5> </legend>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6"><label>Close this Loan :</label></div>
                                        <div class="col-md-6">
                                            <input type="button" class="btn btn-danger" id="PremaClosing" value="Close" onclick="return confirm('Are you sure you want to Close This Loan');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <form action="{{route('admin.changeacno')}}" method="post">
                            @csrf
                            <legend><h5>Change A/C No</h5></legend>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6"><label>A/C No :</label></div>
                                        <div class="col-md-6">
                                            <input readonly class="form-control" value="{{$keyLoan->ac_no}}" id="ac_No0">
                                            <input type="hidden" class="form-control" value="{{$keyLoan->ac_id}}" id="ac_id0">
                                            <input type="hidden" class="form-control" value="{{$keyLoan->LoanAppId}}" name="app_no">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6"><label>Select A/C</label></div>
                                        <div class="col-md-6">
                                            <select class="form-control" id="ac_id" name="ac_id">
                                                @foreach($acno as $ac)
                                                    <option value="{{$ac->AccountId}} && {{$ac->AccountNo}}">{{$ac->AccountNo}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6"><label>A/C Bal :</label></div>
                                        <div class="col-md-6">
                                            <input readonly class="form-control" id="ac_bal"name="ac_bal" value="{{$acbal}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
                                            <input type="Submit" class="btn btn-warning" value="Change">
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
          <h4 class="modal-title">Previous Collection Report of App. No({{$keyLoan->LoanAppId}}), Loan Id({{$keyLoan->LoanId}}).</h4>
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
                        <th>Balance Int.</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $key=>$rec)
                    <tr>
                        <th>{{$key+1}}</th>
                        <th>{{$rec->RecDate}}</th>
                        <th>{{$rec->PrinCollAmt}}</th>
                        <th>{{$rec->IntCollAmt}}</th>
                        <th>{{$rec->BalanceAmt}}</th>
                        <th>Calculate</th>

                    </tr>
                    @empty
                    <tr>
                        <th colspan="6" style="text-align: center">No Record Found</th>
                    </tr>
                    @endforelse
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
<script>
    $('#myBtn').click(function(){
        $('#myModal').modal('show');
    })
    function calculate(){
        var prin=$('#c_prin').val();
        var int =$('#c_intst').val();
        var pen =$('#c_penalty').val();
        var tot =(+prin)+(+int)+(+pen);
        $('#c_total').val(tot);
    }
    $( document ).ready(function() {
      hideall();
    });
    function hideall(){
        $('#hidden_el0_1').prop('hidden', true);
        $('#hidden_el').prop('hidden', true);
        $('#hidden_el0').prop('hidden', true);
        $('#hidden_el2').prop('hidden', true);
        $('#bank_name').prop("hidden", true);
        $('#cheque_no').prop("hidden", true);
        $('#hidden_el_v_1').prop("hidden", true);
        $('#ac_no').val(), $('#ac_id_v1').val();
    }
    function MyFun(){
        hideall();
        $('#ac_id_v1').prop('required',false);
        $('#ac_no').prop('required',false);
        $('#Amount0').prop('required',false);
        $('#checque_date').prop('required',false);
        $('#bank_name').prop('required',false);
        $('#cheque_no').prop('required',false);
        $('#hidden_el2').prop('hidden', false);
    }
    function MyFunII(){
        hideall();
        $('#ac_id_v1').prop('required',false);
        $('#cash_date').prop('required',false);
        $('#Amount').prop('required',false);
        $('#ac_no').prop('required',false);
        $('#hidden_el').prop('hidden', false);
        $('#hidden_el_v_1').prop("hidden", false);
    }
    function MyFunIII(){
        hideall();
        $('#Amount').prop('required',false);
        $('#checque_date').prop('required',false);
        $('#bank_name').prop('required',false);
        $('#cheque_no').prop('required',false);
        $('#cash_date').prop('required',false);
        $('#Amount0').prop('required',false);
        $('#bank_name').prop("required", false);
        $('#cheque_no').prop("required", false);
        $('#hidden_el0').prop('hidden', false);
        $('#hidden_el0_1').prop('hidden', false);
        var ac_no=$('#ac_No0').val(); var ac_id = $('#ac_id0').val();
        $('#ac_no').val(ac_no), $('#ac_id_v1').val(ac_id);
    }

    $('#PremaClosing').click(function(){
        var val_out = $('#p_out').val();
        var val_total = $('#loan_amt').val();
        var now = val_total - val_out;
        var interest = $('#c_intst').val();
        var total = (+interest) + (+now) ;
        $('#c_prin').val(now);
        $('#c_total').val(total);
    })

</script>
@endsection

