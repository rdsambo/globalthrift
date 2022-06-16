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
                                                <a href="{{route('admin.accounts.balancesheetdtl')}}"
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
                            <h5>Balance Sheet Detail</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTables-example"
                                        style="font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th>A/C Type</th>
                                                <th>A/C Group</th>
                                                <th>AC Sub Group</th>
                                                <th>Ledger</th>
                                                {{-- <th>Desc Id</th> --}}
                                                <th>Amount</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $flag1=0;
                                                $flag2=0;
                                                $flag3=0;
                                                $total=0;
                                                function rowspan($lvl){
                                                    $spn=0;
                                                    foreach($lvl as $level2){
                                                        foreach($level2->acsubgroup as $level3){
                                                                $spn+=count($level3->acledger);
                                                        }
                                                    }
                                                    return $spn;
                                                }

                                                function rowspan2($lvl){
                                                    $spn=0;
                                                    foreach($lvl as $level3){
                                                        $spn+=count($level3->acledger);
                                                    }
                                                    return $spn;
                                                }
                                            @endphp
                                            @foreach($achead as $key1=>$level1)
                                                @foreach($level1->acgroup as $key2=>$level2)
                                                    @foreach($level2->acsubgroup as $key3=>$level3)
                                                        @foreach ($level3->acledger as $key4=>$level4)
                                                            <tr>

                                                                {{-- level1 --}}
                                                                @if($flag1==$key1)
                                                                    @php
                                                                        $flag1++;
                                                                        $spn=rowspan($level1->acgroup);
                                                                    @endphp
                                                                    <th rowspan={{$spn}}>{{$level1->achead}}</th>
                                                                @endif



                                                                {{-- level2 --}}
                                                                @if ($key3==0 && $key4==0)
                                                                    @php
                                                                        $spn=rowspan2($level2->acsubgroup);
                                                                    @endphp
                                                                    <th rowspan={{$spn}}>{{$level2->ACGroup}}</th>
                                                                @endif



                                                                {{-- level3 --}}
                                                                @php
                                                                    $span3= count($level3->acledger)
                                                                @endphp
                                                                @if ($key4==0)
                                                                <th rowspan={{$span3}}>{{$level3->SubGrp}}</th>
                                                                @endif



                                                                {{-- level4 --}}
                                                                <th>{{$level4->Desc}}</th>


                                                                {{-- level 5 try to do in controller--}}
                                                                 @php
                                                                    // $amt=0;
                                                                    // foreach ($level4->acledgerbalsheet as $data) {
                                                                    //     if($data->DrCr=='C'){
                                                                    //         $amt+=$data->Amt;
                                                                    //     }else{
                                                                    //         $amt-=$data->Amt;
                                                                    //     }
                                                                    // }
                                                                    // $total+=$amt;
                                                                @endphp
                                                                {{-- <th>{{$amt}}</th> --}}

                                                                @php
                                                                    $amt=DB::table('atcbdt')->where('DescId',$level4->DescId)
                                                                    ->whereBetween(DB::raw("str_to_date(VoucherDt, '%Y-%m-%d')"), [$fromdate, $todate])
                                                                    ->selectRaw("sum(CASE WHEN DrCr='D' THEN Amt ELSE 0 END) as totaldr,
                                                                                 sum(CASE WHEN DrCr='C' THEN Amt ELSE 0 END) as totalcr")->get();
                                                                @endphp
                                                                <th>{{$amt[0]->totalcr-$amt[0]->totaldr}}</th>


                                                                {{-- level 6 --}}
                                                                @php
                                                                     $flag2++;
                                                                     $total+=$amt[0]->totalcr-$amt[0]->totaldr;
                                                                @endphp
                                                                @if ($flag2==$span3)
                                                                    <th>Total : {{$total}}</th>
                                                                    @php
                                                                        $total=0;
                                                                        $flag2=0;
                                                                    @endphp
                                                                @endif

                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
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
