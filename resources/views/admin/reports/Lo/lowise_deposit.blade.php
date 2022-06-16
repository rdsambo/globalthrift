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
                                <label class="col-md-2 text-right">Select Starting Month</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="s_month" value="{{$fromdate}}">
                                </div>
                                <label class="col-md-2 text-right">Select Ending Month</label>
                                <div class="col-md-3">
                                <input type="date" class="form-control" name="e_month" value="{{$todate}}">
                                </div>
                            </div>
                        </div>
                        {{-- Request()->get('e_month') --}}
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 text-right">Select Collection Type</label>
                                <div class="col-md-3">
                                    <select name="Collection" class="form-control">
                                        <option value="">Select</option>
                                        <option value="DD" @if($flag==1) selected @endif>DD Collection</option>
                                        <option value="MD" @if($flag==2) selected @endif>MD Collection</option>
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
                                    <a href="{{route('admin.lowiseloan')}}" class="btn btn-sm btn-primary">Reset</a>
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
                    @php
                        $f = date("d-m-Y", strtotime($fromdate) )
                    @endphp
                    <h5>Collection Reports  from <strong>{{$f}}</strong> To <strong>{{date("d-m-Y", strtotime($todate) )}}</strong>  <small> </small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>LO Name</th>
                                        <th>No Of Active Member</th>
                                        <th>No Of Active A/C</th>
                                        <th>Total Collection Amount</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lo as $key=>$loan)
                                        @php
                                            $amount=0;
                                        @endphp
                                        <tr>
                                            <th>{{$key+1}}</th>
                                            <th>{{$loan->EOName}}</th>
                                            <th>{{count($loan->lowisemem)}}</th>
                                            <th>{{count($loan->lowiseac)}}</th>
                                            @if($flag!=2)
                                                @foreach($ddcoll as $col)
                                                    @if($col->EOId==$loan->EOId)
                                                        @php
                                                            $amount+=$col->totalAmt;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if($flag!=1)
                                                @foreach($rdcoll as $col)
                                                    @if($col->EOId==$loan->EOId)
                                                        @php
                                                            $amount+=$col->totalAmt;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                            <th>{{$amount}}</th>
                                        </tr>
                                        @endforeach
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
