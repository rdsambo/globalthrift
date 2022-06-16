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
                            <h5>Filter For Profit & Loss <small> </small></h5>
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
                                                <a href="{{route('admin.accounts.profitnloss')}}"
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
                            <h5>Profit & Loss</h5>
                        </div>
                        <div class="ibox-content">
                            <h5>Income</h5>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTables-example"
                                        style="font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Amount</th>
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
                                                         if($arr->SubGrp==$val){
                                                            $spn++;
                                                         }
                                                    }
                                                    return $spn;
                                                }
                                        @endphp
                                        <tbody>
                                            @foreach($income as $key=>$data)
                                            <tr>
                                                <th>{{$key+1}}</th>

                                                @if($flag==$key)
                                                    @php
                                                        $spn=rowspan($income,$data->SubGrp);
                                                        $flag+=$spn;
                                                    @endphp
                                                        <th rowspan={{$spn}}>{{$data->SubGrp}}</th>
                                                @endif


                                                <th>{{$data->Desc}}</th>
                                                <th>{{$data->totalcr-$data->totaldr}}</th>
                                                    @php
                                                        $total+=$data->totalcr-$data->totaldr;
                                                        $subtotal+=$data->totalcr-$data->totaldr;
                                                    @endphp
                                                @if ($flag==$key+1)
                                                     <th>{{$subtotal}}</th>
                                                     @php
                                                         $subtotal=0;
                                                     @endphp
                                                @endif
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan=4 style="text-align:right">Total:</th>
                                                <th>{{$total}}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <h5>Expanse</h5>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTables-example"
                                        style="font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($expanse as $key=>$data)
                                            <tr>
                                                <th>{{$key+1}}</th>
                                                @if($flag1==$key)
                                                    @php
                                                        $spn=rowspan($expanse,$data->SubGrp);
                                                        $flag1+=$spn;
                                                        $totstatus='Y';
                                                    @endphp
                                                    <th rowspan={{$spn}}>{{$data->SubGrp}}</th>
                                                @endif
                                                <th>{{$data->Desc}}</th>
                                                <th>{{$data->totalcr-$data->totaldr}}</th>
                                                    @php
                                                        $total+=$data->totalcr-$data->totaldr;
                                                        $subtotal+=$data->totalcr-$data->totaldr;
                                                    @endphp
                                                @if ($flag1==$key+1)
                                                     <th>{{$subtotal}}</th>
                                                     @php
                                                         $subtotal=0;
                                                     @endphp
                                                @endif
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan=4 style="text-align:right">Total:</th>
                                                <th>{{$total}}</th>
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
