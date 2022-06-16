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
                            <h5>Filter For General Ledger <small> </small></h5>
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
                                                <a href="{{route('admin.accounts.generalledger')}}"
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
                            <h5>General Ledger</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTables-example"
                                        style="font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Voucher No</th>
                                                <th>Account Head / Narration</th>
                                                <th>Dr</th>
                                                <th>Cr</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th colspan=3 style="text-align:center">Opening B/F</th>
                                                <th>{{$ob_til}}</th>
                                            </tr>
                                            @forelse ($generalled as $led )
                                            <tr>
                                                <th>{{ date("d-m-Y", strtotime($led->VoucherDt ) )}}</th>
                                                <th>{{$led->VoucherNo}}</th>
                                                <th>{{$led->Narration}}</th>
                                                @if ($led->DrCr=='D')
                                                    <th>{{$led->Amt}}</th>
                                                    <th>0</th>
                                                    @php
                                                       $ob_til+= $led->Amt;
                                                    @endphp
                                                @else
                                                    <th>0</th>
                                                    <th>{{$led->Amt}}</th>
                                                    @php
                                                       $ob_til-= $led->Amt;
                                                    @endphp
                                                @endif
                                            </tr>
                                            @empty
                                            <tr>
                                                <th colspan=5 style="text-align:center">
                                                    No Records found
                                                </th>
                                            </tr>
                                            @endforelse
                                            <tr>
                                                <th colspan=3 style="text-align:center">Closing B/F</th>
                                                <th>{{$ob_til}}</th>
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
