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
						<h5>Filter For Cash Book Detail    <small> </small></h5>
					</div>
					<div class="ibox-content">
                    <form>
                    <div class="row">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 text-right">Select Starting Date</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="s_month" value="{{Request()->get('s_month')}}">
                                </div>
                                <label class="col-md-2 text-right">Select Ending Date</label>
                                <div class="col-md-3">
                                <input type="date" class="form-control" name="e_month" value="{{Request()->get('e_month')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-left:50%">
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{route('admin.accounts.cashbookperdate')}}" class="btn btn-sm btn-primary">Reset</a>
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
                    <h5>Cash Book Detail</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="text-align:center">Date</th>
                                        <th style="text-align:center">Voucher No</th>
                                        <th style="text-align:center" colspan=2>Account Head / Narration </th>
                                        <th style="text-align:center">Dr.</th>
                                        <th style="text-align:center">Cr.</th>
                                    </tr>
                                    </thead>
                                    @php
                                        $drdaytotal=$ob_til;
                                        $crdaytotal=0;
                                        $flag=0;
                                        $tempdate="00-00-0000";
                                        $sl=1;
                                        $closing_bal=0;
                                    @endphp
                                    <tbody>
                                        @forelse($cbperdate as $key=>$cbper)
                                            @php
                                                if($flag==0){
                                                    $tempdate=date("d-m-Y", strtotime($cbper->VoucherDt) );
                                                }
                                            @endphp
                                         {{-- closing balance when date changes --}}
                                            @if($tempdate != date("d-m-Y", strtotime($cbper->VoucherDt) ))
                                                <tr>
                                                    <th colspan="2" style="text-align:right">{{date("d-m-Y", strtotime($tempdate) )}}</th>
                                                    <th colspan="3" style="text-align:right" >Day Total</th>
                                                    <th>{{$drdaytotal}}</th>
                                                    <th>{{$crdaytotal}}</th>
                                                    @php
                                                        $ob_til=$drdaytotal-$crdaytotal;
                                                        $drdaytotal-=$crdaytotal;
                                                        $crdaytotal = 0;
                                                    @endphp
                                                </tr>
                                                <tr>
                                                    <th colspan="2" style="text-align:right">{{date("d-m-Y", strtotime($tempdate) )}}</th>
                                                    <th colspan="3" style="text-align:right">Closing Balance</th>
                                                    <th>{{$ob_til}}</th>
                                                    <th></th>
                                                </tr>
                                                <tr><td colspan=7></td></tr>
                                                @php
                                                    $flag = 3;
                                                    $sl=1;
                                                @endphp
                                            @endif
                                            @php
                                                 $tempdate = date("d-m-Y", strtotime($cbper->VoucherDt) );
                                            @endphp
                                         {{-- ends --}}
                                         {{-- opening balance at the begining of table --}}
                                         @if($flag==0 || $flag==3)
                                         <tr>
                                             <th colspan="2" style="text-align:right">{{date("d-m-Y", strtotime($cbper->VoucherDt) )}}</th>
                                             <th colspan="3" style="text-align:center">Opening Balance</th>
                                             <th>{{$ob_til}}</th>
                                             <th></th>
                                         </tr>
                                         @php
                                             $flag=1;
                                             $tempdate=date("d-m-Y", strtotime($cbper->VoucherDt) );
                                         @endphp
                                        @endif
                                         {{-- ends --}}
                                         {{-- actual table content --}}
                                            <tr>
                                                <td>{{$sl}}</td>
                                                @php
                                                    $sl++;
                                                @endphp
                                                <td>{{date("d-m-Y", strtotime($cbper->VoucherDt) )}}</td>
                                                <td>{{$cbper->VoucherNo}}</td>
                                                <td>{{$cbper->SubGrp}}</td>
                                                <td>{{$cbper->Narration}}</td>
                                                @if ($cbper->DrCr=='D')
                                                    <td>0</td>
                                                    <td>{{$cbper->Amt}}</td>
                                                    @php
                                                        $crdaytotal+=$cbper->Amt;
                                                    @endphp
                                                @else
                                                    <td>{{$cbper->Amt}}</td>
                                                    <td>0</td>
                                                    @php
                                                        $drdaytotal+=$cbper->Amt;
                                                    @endphp
                                                @endif
                                            </tr>
                                         {{-- ends --}}
                                        @empty
                                            <tr>
                                                <th colspan=6 style="text-align:center">No Transactions for this day</th>
                                            </tr>
                                        @endforelse
                                         {{-- this will appere in the End of tyhe table --}}
                                        <tr>
                                            <th colspan="2" style="text-align:right">{{date("d-m-Y", strtotime($todate) )}}</th>
                                            <th colspan="3" style="text-align:right" >Day Total</th>
                                            <th>{{$drdaytotal}}</th>
                                            <th>{{$crdaytotal}}</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="text-align:right">{{date("d-m-Y", strtotime($ob_til) )}}</th>
                                            <th colspan="3" style="text-align:right">Closing Balance</th>
                                            <th>{{$drdaytotal-$crdaytotal}}</th>
                                            <th></th>
                                        </tr>
                                         {{-- ends --}}
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
