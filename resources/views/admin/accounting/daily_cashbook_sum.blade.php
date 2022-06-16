@extends('admin.layout.master')
@section('content')
    <div class="form-group">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <span style="font-size: medium">{{ Session::get('success') }}</span>
                            </div>
                        @endif
                        <div class="ibox-title">
                            <h5>Filter For Cash Book Detail <small> </small></h5>
                        </div>
                        <div class="ibox-content">
                            <form>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-2 text-right">Select Starting Date</label>
                                            <div class="col-md-3">
                                                <input type="date" class="form-control" name="s_month"
                                                    value="{{ Request()->get('s_month') }}">
                                            </div>
                                            <label class="col-md-2 text-right">Select Ending Date</label>
                                            <div class="col-md-3">
                                                <input type="date" class="form-control" name="e_month"
                                                    value="{{ Request()->get('e_month') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-left:50%">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-sm btn-primary"><i
                                                        class="glyphicon glyphicon-search"></i>&nbsp;Search </button>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="{{ route('admin.accounts.cashbookperdate') }}"
                                                    class="btn btn-sm btn-primary">Reset</a>
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
                                    <table class="table table-striped table-bordered table-hover dataTables-example"
                                        style="font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Account Head</th>
                                                <th>Dr.</th>
                                                <th>Cr.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $flag   = 0;
                                                $op_bal = 0;
                                                $date   ='';
                                                $daytotCr=0;
                                                $daytotDr=0;
                                                $sl=0;
                                            @endphp
                                            @foreach ($summary as $key => $sum)
                                                @php
                                                $sl++;
                                                    if($key==0){
                                                        $date=date("d-m-Y", strtotime($sum->VoucherDt ) );
                                                        $daytotDr+= $ob_til;
                                                    }
                                                    if($date== date("d-m-Y", strtotime($sum->VoucherDt ))){
                                                        $flag=0;
                                                    }else{
                                                        $flag=1;
                                                        $date=date("d-m-Y", strtotime($sum->VoucherDt ) );
                                                    }

                                                @endphp
                                                @if($flag==1)
                                                    <tr>
                                                        <th colspan=3 style="text-align:right">Day total :</th>
                                                        <th> {{$daytotDr}}</th>
                                                        <th> {{$daytotCr}}</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan=3 style="text-align:right">Closing Balance :</th>
                                                        <th>{{$daytotDr-$daytotCr}}</th>
                                                        <th></th>
                                                    </tr>
                                                    <tr><td colspan=5></td></tr>

                                                    <tr>
                                                        <th colspan=3 style="text-align:center">Opening B/F</th>
                                                        <th>{{$daytotDr-$daytotCr}}</th>
                                                    </tr>
                                                        @php
                                                            $daytotDr-=$daytotCr;
                                                            $flag=0;
                                                            $daytotCr=0;
                                                            $sl=0;
                                                        @endphp
                                                @endif
                                                @if($key==0)
                                                    <tr>
                                                        <th colspan=3 style="text-align:center">Opening B/F</th>
                                                        <th>{{$ob_til}}</th>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td>{{ $sl }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($sum->VoucherDt ) )}}</td>
                                                    {{-- <td>{{ $sum->SubGrp}}//{{$sum->DescId}}</td> --}}
                                                    <td>{{ $sum->Desc}}//{{$sum->DescId}}</td>
                                                    <td>{{ $sum->totalcr }}</td>
                                                    <td>{{ $sum->totaldr }}</td>
                                                </tr>
                                                @php
                                                    $daytotDr += $sum->totalcr;
                                                    $daytotCr += $sum->totaldr;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <th colspan=3 style="text-align:right">Day total :</th>
                                                <th> {{$daytotDr}}</th>
                                                <th> {{$daytotCr}}</th>
                                            </tr>
                                            <tr>
                                                <th colspan=3 style="text-align:right">Closing Balance :</th>
                                                <th>{{$daytotDr-$daytotCr}}</th>
                                                <th></th>
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
