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
                                     <input type="date" class="form-control" name="s_month" value="{{Request()->get('s_month')}}">
                                     {{-- <select name="s_month" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($month as $m)
                                            <option value="{{$m->Month}}" {{Request()->get('s_month') == $m->Month ? 'selected' : '' }}>{{$m->M_name}}</option>
                                        @endforeach
                                    </select> --}}
                                 </div>
                                 <label class="col-md-2 text-right">Select Ending Month</label>
                                 <div class="col-md-3">
                                    <input type="date" class="form-control" name="e_month" value="{{Request()->get('e_month')}}">
                                     {{-- <select name="e_month" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($month as $m)
                                            <option value="{{$m->Month}}" {{Request()->get('e_month') == $m->Month ? 'selected' : '' }}>{{$m->M_name}}</option>
                                        @endforeach
                                    </select> --}}
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
                    <h5>Loan Reports  from <strong>{{Request()->get('s_month')}}</strong> To <strong>{{Request()->get('e_month')}}</strong>  <small> </small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>LO Name</th>
                                        <th>No of Active Loan</th>
                                        <th>Principal Amt.</th>
                                        <th>Interest Amt.</th>
                                        <th>Principal Recovered</th>
                                        <th>Interest Recovered</th>
                                        <th>Total</th>
                                        <th>Total Recovered</th>
                                        <th>View </th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($testing as $key=>$val)
                                        <tr>
                                            <th>{{$key+1}}</th>
                                            <th>{{$val->EOName}}</th>
                                            <th></th>
                                            <th>{{$val->total_loan}}</th>
                                            <th>{{$val->total_int}}</th>
                                            <th>{{$val->coll_prin}}</th>
                                            <th>{{$val->coll_int}}</th>
                                            <th>{{$val->total_loan+$val->total_int}}</th>
                                            <th>{{$val->coll_prin+$val->coll_int}}</th>
                                            <th></th>
                                        </tr>
                                        @endforeach --}}
                                        @php
                                            $t1=0;
                                            $t2=0;
                                            $t3=0;
                                            $t4=0;
                                        @endphp
                                        @foreach($list as $key=>$val)
                                        <tr>
                                            {{-- {{dd($val['name'])}} --}}
                                            <td>{{$key+1}}</td>
                                            <td>{{$val['name']}}</td>
                                            <td>{{$val['number']}}</td>
                                            <td>{{$val['totpri']}}</td>
                                            @php
                                                $t1=$t1+$val['totpri'];
                                            @endphp
                                            <td>{{$val['totint']}}</td>
                                            @php
                                                $t2=$t2+$val['totint'];
                                            @endphp
                                            <td>{{$val['pri_coll']}}</td>
                                            @php
                                                $t3=$t3+$val['pri_coll'];
                                            @endphp
                                            <td>{{$val['int_coll']}}</td>
                                            @php
                                                $t4=$t4+$val['int_coll'];
                                                $id=$val['loid'];
                                            @endphp
                                            <td>{{$val['totpri']+$val['totint']}}</td>
                                            <td>{{$val['pri_coll']+$val['int_coll']}}</td>
                                            <td><a href="{{route('admin.viewperlo',[$id])}}" class="btn btn-primary">View</a></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="3">Total:</th>
                                            <th>{{$t1}}</th>
                                            <th>{{$t2}}</th>
                                            <th>{{$t3}}</th>
                                            <th>{{$t4}}</th>
                                            <th>{{$t1+$t2}}</th>
                                            <th>{{$t3+$t4}}</th>
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
