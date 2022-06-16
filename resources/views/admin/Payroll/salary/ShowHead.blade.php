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
            <label>{{$empname->Title}}&nbsp;&nbsp;{{$empname->EmpFirstName}}&nbsp;&nbsp;{{$empname->EmpMiddleName}}&nbsp;&nbsp;{{$empname->EmpLastName}}</label>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                    @isset($details)
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Salary Head</th>
                                            <th>Head Code</th>
                                            <th>Income</th>
                                            <th>Deduction</th>
                                            <th>total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total=0;
                                            $totalde=0
                                        @endphp
                                        <tr>
                                            <td>1</td>
                                            <td>Basic</td>
                                            <td>Basic</td>
                                            <td>{{$empname->BasicPay}}</td>
                                            <td></td>
                                            @php
                                                $total=$total+$empname->BasicPay
                                            @endphp
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>dearness Allowance</td>
                                            <td>DA</td>
                                            <td>{{$empname->DA}}</td>
                                            <td></td>
                                            @php
                                                $total=$total+$empname->DA
                                            @endphp
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Travelling Alowance</td>
                                            <td>TA</td>
                                            <td>{{$empname->TA}}</td>
                                            <td></td>
                                            @php
                                                $total=$total+$empname->TA
                                            @endphp
                                            <td></td>
                                        </tr>
                                        @php
                                        $count=3;
                                        @endphp
                                        @foreach($details as $dtl)
                                        @php
                                        $count++
                                        @endphp
                                            <tr>
                                                <td>{{$count}}</td>
                                                <td>{{$dtl->SalaryHeadCode}}</td>
                                                <td>{{$dtl->SalaryHeadID}}</td>
                                                @if($dtl->Income==1)
                                                  <td>{{$dtl->Amount}}</td>
                                                  <td> </td>
                                                  @php
                                                      $total=$total+$dtl->Amount
                                                  @endphp
                                                @else
                                                   <td> </td>
                                                   <td>{{$dtl->Amount}}</td>
                                                   @php
                                                   $totalde=$totalde+$dtl->Amount
                                                   @endphp
                                                @endif
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                           <th colspan="3" style="text-align:right;">Total&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                           <th>{{$total}}</th>
                                           <th>{{$totalde}}</th>
                                           <th>{{$total-$totalde}}</th>
                                        </tr>
                                    </tbody>
                                    @endisset
                                </table>

                            </div>
                        </form>
                        <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection


