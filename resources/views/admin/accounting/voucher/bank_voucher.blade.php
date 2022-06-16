@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5> Bank Voucher -    <small> </small></h5>
            </div>
            @if(Session::has('success'))
				<div class="alert alert-success"><span style="font-size: medium">{{Session::get('success')}}</span></div>
			@endif
            @if(Session::has('error'))
                <div class="alert alert-danger"><span style="font-size: medium">{{Session::get('error')}}</span></div>
            @endif
            <form action="{{route('admin.accounts.vouchersave')}}" method="post">
                @csrf
            <div class="ibox-content">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Balance</label></div>
                            <div class="col-md-8">
                                <input readonly name="balance" class="form-control" value="{{$balance}}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Voucher No</label></div>
                            <div class="col-md-8">
                                <input readonly name="voucher_no" class="form-control" value="{{$voucher_no['VoucherNo']}}" required>
                                <input type='hidden' name="HeadId" class="form-control" value="{{$voucher_no['HeadId']}}" required>
                                <input type='hidden' name="lslno" class="form-control" value="{{$voucher_no['lslno']->nextslno}}" required>
                                <input type='hidden' name="Ttype" class="form-control" value="C" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Voucher Date</label></div>
                            <div class="col-md-8">
                                <input type="date" name="voucher_date" class="form-control" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Bank Name</label></div>
                            <div class="col-md-8">
                                <select name="descid" id="bank_name" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($bankname->acledger as $bname )
                                        <option value="{{$bname->DescId}}">{{$bname->Desc}}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name"> --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Cheque No</label></div>
                            <div class="col-md-8">
                                <input type="text" name="cheque_no" class="form-control" placeholder="Enter cheque No" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-4"><label>Cheque Date</label></div>
                            <div class="col-md-8">
                                <input type="date" name="cheque_date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="col-md-6"><label>Payment</label></div>
                            <div class="col-md-2">
                                <input type="radio" name="mode" value="Payment">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="col-md-6"><label>Receipt</label></div>
                            <div class="col-md-2">
                                <input type="radio" name="mode" value="Receipt">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6">( [D] for payment, [C] for receipt )</div>
                        </div>
                    </div>
                </div> --}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-10">
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
                                <thead>
                                   <tr>
                                       {{-- <th width=4%>SL</th> --}}
                                       <th width=10%>Dr. / Cr.</th>
                                       <th width=15%>Particulars</th>
                                       <th width=45%>Narration</th>
                                       <th width=20%>Amount</th>
                                       <th width=10%>Balance</th>
                                   </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        {{-- <th>1</th> --}}
                                        <td><select class="form-control" name="d_c" required><option value="C">Cr.</option><option value="D">Dr.</option></select></td>
                                        <td><input type="text" class="form-control" name="particulars" required></td>
                                        <td><input type="text" class="form-control" name="narration" required></td>
                                        <td><input type="text" class="form-control" name="amount" required></td>
                                        <td><input type="text" class="form-control" name="balance" required></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
	</div>
</div>
@endsection
@section('scripts')

@endsection

