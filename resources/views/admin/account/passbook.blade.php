@extends('admin.layout.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')
<style>
    .center {
  margin-left: auto;
  margin-right: auto;
}
</style>
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                        <form name="frm2" method="get" action="" enctype="multipart/form-data">
                            <div class="ibox-title">
                                <h5>Account Passbook</h5>
                                <div class="ibox-content">
                                    <div class="row col-md-13">
                                        <div class="form-group col-md-2">
                                            <label>A/C Holder Name</label>
                                        </div>
                                        <div class="form-group col-md-3" >
                                            {{-- <datalist id="A/C_Name">
                                                @foreach($acctdata as $dda)
                                                <option value="{{$dda->AccountNo}} {{$dda->AccountName}}"> </option>
                                                @endforeach
                                            </datalist>
                                            <input type="text" list="A/C_Name" class="form-control" name="accountid" id="accountid" value="{{ isset($_GET['accountid']) ? $_GET['accountid'] : '' }}">
                                             --}}
                                             <select class="js-example-basic-single" name="accountid" id="accountid" required style="width:100%;">
                                                <option>------select------</option>
                                                @foreach($acctdata as $dda)
                                                     <option value="{{$dda->AccountId}}"{{Request()->get('accountid') == $dda->AccountId ? 'selected' : '' }}>{{$dda->AccountName}}({{$dda->AccountNo}})({{$dda->AccountId}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    <div class="row col-md-12">
                                        <div class="form-group col-md-2">
                                            <label>Transactions From </label>
                                        </div>
                                        <div class="form-group col-md-3" style="margin-left:5px" >
                                            <input type="date" name="datefrom" class="form-control" value="{{ isset($_GET['datefrom']) ? $_GET['datefrom'] : '' }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label >Transaction Till</label>
                                        </div>
                                        <div class="form-group col-md-3" >
                                            <input type="date" name="dateto" class="form-control" value="{{ isset($_GET['dateto']) ? $_GET['dateto'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="row col-md-12">
                                        <div class="form-group col-md-2" style="margin-left:50%">
                                            <button type="submit" name="btncoll" id="btncoll" class="btn btn-primary" >Generate</button>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                @if($transactions && request("accountid"))
                                <div class="ibox-content">
                                <div class="form-group col-md-20">
                                    <table><tr>
                                    {{-- <td>Name:</td><td>{{$account_data->AccountName}}</td><td></td> --}}
                                    </tr></table>
                                    @php
                                    $cnt=1;
                                    @endphp
                                    <h3 style="text-align:center">{{$account_data->AccountName ?? ""}}</h3>
                                    <table class="table table-border center" style="width:60%;">
                                        <tbody>
                                            <thead>
                                                <th>Slno.</th>
                                                <th>Transaction</th>
                                                <th>Description</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <th>Balance</th>
                                            </thead>
                                    @if($datefrom==Null )
                                            @for ($i = $start; $i <= $count; $i++)
                                            <tr>
                                                <td>{{$cnt}} </td>
                                                <td>{{$transactions[$i]->date}}</td>
                                                @if($transactions[$i]->PTYPE == "DEPOSIT")
                                                   <td> DEPOSIT </td>
                                                @else
                                                   <td> WITHDRAWAL </td>
                                                @endif
                                                @if($transactions[$i]->PTYPE == "DEPOSIT")
                                                    <td>0</td>
                                                    <td>{{$transactions[$i]->amount}}</td>
                                                @else
                                                    <td>{{$transactions[$i]->amount}}</td>
                                                    <td>0</td>
                                                @endif
                                                <td>{{$transactions[$i]->cumulative_sum}}</td>
                                            </tr>
                                            @php
                                                $cnt++;
                                            @endphp
                                            @endfor
                                    <!-- for date filteration -->
                                    @else
                                            @for ($i = 0; $i <= $count; $i++)
                                            @if($transactions[$i]->date>=$datefrom && $transactions[$i]->date<=$dateto)
                                            <tr>
                                                <td>{{$cnt}} </td>
                                                <td>{{$transactions[$i]->date}}</td>
                                                @if($transactions[$i]->PTYPE == "DEPOSIT")
                                                   <td> DEPOSIT </td>
                                                @else
                                                   <td> WITHDRAWAL </td>
                                                @endif
                                                @if($transactions[$i]->PTYPE == "DEPOSIT")
                                                    <td>0</td>
                                                    <td>{{$transactions[$i]->amount}}</td>
                                                @else

                                                    <td>{{$transactions[$i]->amount}}</td>
                                                    <td>0</td>
                                                @endif
                                                <td>{{$transactions[$i]->cumulative_sum}}</td>
                                            </tr>
                                            @php
                                                $cnt++;
                                            @endphp
                                            @endif
                                            @endfor
                                    @endif
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                            <div class="ibox-title">
                            </div>
                         </div>
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

$(document).ready(function() {
   // $('#memberid').change(function(){
        $('.js-example-basic-single').select2();
  //});
});
</script>
@endsection



