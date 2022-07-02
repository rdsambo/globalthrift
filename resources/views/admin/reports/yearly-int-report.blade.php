@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <form>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-4"><h3>Search Interest Provided by Date </h3></label>
                                        <div class="col-md-3">
                                            <input class="form-control" type="text" name="search_date" id="search_date" value="{{Request()->get('search_date')}}">
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-filter"></i>Search </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Voucher No</th>
                                        <th>Narration</th>
                                        <th>Date</th>
                                        <th>Interest Amout</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($dailyInt as $key=>$int )
                                        <tr>
                                            <th>{{++$key}}</th>
                                            <th>{{$int->VoucherNo}}</th>
                                            <th>{{$int->Narration}}</th>
                                            <th>{{date('Y-m-d',strtotime($int->VoucherDt))}}</th>
                                            <th>{{$int->Amt}}</th>
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
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('#search_date').Zebra_DatePicker();
    })
</script>
@endsection


