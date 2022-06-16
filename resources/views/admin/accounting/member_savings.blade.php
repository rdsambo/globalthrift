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
                            <h5>Filter For Member Savings Report <small> </small></h5>
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
                                                <a href="{{route('admin.accounts.membersavings')}}"
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
                            <h5>Member Savings Report</h5>
                        </div>
                        <div class="ibox-content">
                            <h5>Daily Deposit A/C</h5>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTables-example"
                                        style="font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Acc No</th>
                                                <th>Name</th>
                                                {{-- <th>Address</th> --}}
                                                <th>Opening BAlance</th>
                                                <th>Amount Collected</th>
                                                <th>Amount Repaid</th>
                                                <th>Closing BAlance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($savings_rep as $key=>$data)
                                            <tr>
                                                <th>{{$key+1}}</th>
                                                <th>{{$data->AccountNo}}</th>
                                                <th>{{$data->AccountName}}</th>
                                                <th>0</th>
                                                <th>{{$data->collected}}</th>
                                                <th>{{$data->returned}}</th>
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
