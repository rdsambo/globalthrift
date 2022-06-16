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
                            <h5>Filter For Ledger Summery Report <small> </small></h5>
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
                                                <a href="{{route('admin.accounts.ledgersummery')}}"
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
                            <h5>General Ledger Summery Report</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTables-example"
                                        style="font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Date</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $flag=0;
                                            $flag1=0;
                                            $subtotal=0;
                                            $total=0;
                                            function rowspan($array,$val){
                                                    $spn=0;
                                                    foreach($array as $arr){
                                                         if($arr->Desc==$val){
                                                            $spn++;
                                                         }
                                                    }
                                                    return $spn;
                                                }
                                        @endphp
                                        <tbody>
                                            @foreach ($ledsumm1 as $key=>$led )
                                                <tr>
                                                    @if($flag==$key)
                                                    @php
                                                        $spn=rowspan($ledsumm1,$led->Desc);
                                                        $flag+=$spn;
                                                    @endphp
                                                        <th rowspan={{$spn}}>{{$led->Desc}}</th>
                                                    @endif
                                                    <th>{{$led->VoucherDt}}</th>
                                                    <th>{{$led->totalcr}}</th>
                                                    <th>{{$led->totaldr}}</th>
                                                    <th></th>
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
