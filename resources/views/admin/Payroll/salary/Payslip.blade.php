@extends('admin.layout.master')
<style>

    .filter{
    padding-right: 44px;
    padding-left: 44px;
    padding-top: 44px;
    }
</style>
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox-title">
            <form>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3">
                                <caption><h3>Select Month & Year for PaySlip:</h3></caption>
                            </div>
                            <div class="col-sm-2">
                                <select name="month" class="form-control">
                                    @foreach($month as $mn)
                                    <option value="{{$mn->id}}" {{Request()->get('month') == $mn->id ? 'selected' : '' }}>{{$mn->M_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select name="year" class="form-control">
                                    @for($i=2020;$i<=2030;$i++)
                                    <option value="{{$i}}" {{Request()->get('year') == $i ? 'selected' : '' }}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <Button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="ibox-content">
            @isset($Employee)
            <div class="row" >
                <div class="col-sm-8">
                    <div class="ibox float-e-margins">
                        <a href="{{route('admin.printpayslip',[$monthof,$yearof])}}" class="btn btn-primary" style="float:right">Print All</a><br/>
                        @foreach($Employee as $emp)
                        <div id="{{$emp->Employee_Code}}">
                            <legend>{{$emp->Title}}&nbsp;{{$emp->EmpFirstName}}&nbsp;{{$emp->EmpMiddleName}}&nbsp;{{$emp->EmpLastName}}</legend>
                            <label>Payslip of __/{{$monthof}}/{{$yearof}}, Global Thrift and Credit Cooperative Society Ltd.</label>
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important;" >
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Salary Head</th>
                                        <th>Salary Head Code</th>
                                        <th>Income</th>
                                        <th>Deduction</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl=0;
                                        $totin=0;
                                        $totded=0;
                                    @endphp
                                    @foreach($payslipAll as $slip)
                                    @php
                                        $sl++;
                                    @endphp
                                    @if($emp->Employee_Code==$slip->Emp_Code)
                                    <tr>
                                        <td>{{$sl}}</td>
                                        <td>{{$slip->SalaryHeadID}}</td>
                                        <td>{{$slip->SalaryHeadCode}}</td>
                                        @if($slip->Income==1)
                                            <td style="text-align:right">{{$slip->Amount}}</td>
                                            <td> </td>
                                            @php
                                                $totin=$totin+$slip->Amount;
                                            @endphp
                                        @else
                                            <td ></td>
                                            <td style="text-align:right">{{$slip->Amount}}</td>
                                            @php
                                                $totded=$totded+$slip->Amount;
                                            @endphp
                                        @endif
                                        {{-- <td style="text-align:right">{{$tot}}</td> --}}
                                        <td></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    <tr>
                                        <th colspan="3" style="text-align:right">TOTAL:</th>
                                        <th style="text-align:right">{{$totin}}</th>
                                        <th style="text-align:right">{{$totded}}</th>
                                        <th style="text-align:right">{{$totin-$totded}}</th>
                                    </tr>
                                </tbody>
                                {{-- <p style="float:right"><input type="button" onclick="myPrint('{{$emp->Employee_Code}}')" value="print" class="btn btn-primary"></p> --}}


                            </table>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endisset
        </div>
    </div>
</div>
@endsection
@section('scripts')
{{-- <script>
    function myPrint(myfrm) {
        var printdata = document.getElementById(myfrm);
        newwin = window.open("");
        newwin.document.write(printdata.outerHTML);
        newwin.print();
        newwin.close();
    }
</script> --}}
@endsection


