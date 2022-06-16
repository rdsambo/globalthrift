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
                        <div class="form-group" style="margin-left:50%">
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{route('admin.viewperlo',[$id])}}" class="btn btn-sm btn-primary">Reset</a>
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
                    <h5>Collection Reports of <strong>{{$loname->EOName}}</strong> from <strong>{{Request()->get('s_month')}}</strong> To <strong>{{Request()->get('e_month')}}</strong>  <small> </small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Member Name</th>
                                        <th>Center</th>
                                        <th>Loan Number</th>
                                        <th>Recovered Principal Amt.</th>
                                        <th>Recovered Interest Amt.</th>
                                        <th>Penalty Amt.</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $t1=0;
                                            $t2=0;
                                            $t3=0;
                                            $t4=0;
                                        @endphp
                                        @foreach($temp as $key=>$t)
                                        <tr>
                                            @php
                                                $t1=$t1+$t->avg_PrinCollAmt->sum('PrinCollAmt');
                                                $t2=$t2+$t->avg_PrinCollAmt->sum('IntCollAmt');
                                                $t3=$t3+$t->avg_PrinCollAmt->sum('PenCollAmt');
                                                $t4=$t4+$t->avg_PrinCollAmt->sum('PrinCollAmt')+$t->avg_PrinCollAmt->sum('IntCollAmt')+$t->avg_PrinCollAmt->sum('PenCollAmt');
                                            @endphp
                                            <td>{{++$key}}</td>
                                            <td>{{$t->MemberName}}</td>
                                            <td>{{$loname->Market}}</td>
                                            <td>{{$t->LoanId}}</td>
                                            <td>{{$t->avg_PrinCollAmt->sum('PrinCollAmt')}}</td>
                                            <td>{{$t->avg_PrinCollAmt->sum('IntCollAmt')}}</td>
                                            <td>{{$t->avg_PrinCollAmt->sum('PenCollAmt')}}</td>
                                            <td>{{$t->avg_PrinCollAmt->sum('PrinCollAmt')+$t->avg_PrinCollAmt->sum('IntCollAmt')+$t->avg_PrinCollAmt->sum('PenCollAmt')}}</td>
                                        </tr>
                                        @endforeach

                                        <tr>
                                            <th colspan="4">Total:</th>
                                            <th>{{$t1}}</th>
                                            <th>{{$t2}}</th>
                                            <th>{{$t3}}</th>
                                            <th>{{$t4}}</th>
                                        </tr>
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
