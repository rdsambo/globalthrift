@extends('admin.layout.master')
@section('content')
{{-- <style>
    div.header {
    display: block;
    text-align: center;
    position: running(header);
    width: 100%;
    padding-top: 50px;
    font-size: 16px
}
table.body{
    margin-left: 50px;
    width: 50%;
    padding-top: 50px;
    font-size: 12px;

}
table.center {
  margin-left: auto;
  margin-right: auto;
}

</style> --}}

<div class="form-group">
    <div class="row">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox-title">
                <h3>GLobal Thrift Management</h3><br/>
                <button type="button" class="btn btn-primary" style="margin-left:10%"><a href="{{ route('admin.pdfview',['download'=>'pdf','Id'=>$acctrpt->first()->AccountId]) }}">Download PDF</a></button>
            </div>
            <div class="ibox-content" style="margin-left:5px">
                <div class="row">
                    <div class="header">


                        <h3 style="margin-left:20%">Name: {{$acctrpt->first()->AccountName}}</h3>
                    </div>
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{Session::get('error')}}
                            </div>
                        @endif
                        @if(isset($acctrpt))
                        <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important;width: 40%;margin-left:20%" >
                            <thead>
                                <th>Slno</th>
                                {{-- <th>Account Id</th> --}}
                                <th>Account No</th>
                                <th>Date of Collection</th>
                                <th> Amount </th>
                            </thead>
                            <tbody>
                                @php
                                $totamt=0;
                                @endphp
                                @if(isset($acctrpt->first()->ddcollection))
                                    @foreach($acctrpt->first()->ddcollection as $rpt)
                                        <tr>
                                            <td>{{$rpt->SlNo}}</td>
                                            {{-- <td>{{$acctrpt->first()->AccountId}}</td> --}}
                                            <td>{{$acctrpt->first()->AccountNo}}</td>
                                            <td>{{date("d-m-Y",strtotime($rpt->ColDate))}}</td>
                                            <td>{{$rpt->DAmt}}</td>
                                        </tr>
                                        @php
                                        $totamt+=$rpt->DAmt;
                                        @endphp
                                    @endforeach
                                @endif
                                @if(isset($acctrpt->first()->rdcollection))
                                    @foreach($acctrpt->first()->rdcollection as $rpt)
                                        <tr>
                                            <td>{{$rpt->slno}}</td>
                                            {{-- <td>{{$acctrpt->first()->AccountId}}</td> --}}
                                            <td>{{$acctrpt->first()->AccountNo}}</td>
                                            <td>{{date("d-m-Y",strtotime($rpt->coldate))}}</td>
                                            <td>{{$rpt->DAmt}}</td>
                                        </tr>
                                        @php
                                        $totamt+=$rpt->DAmt;
                                        @endphp
                                    @endforeach
                                @endif

                            {{--  {{$acctrpt->links() }} --}}
                                <tr>
                                    <td colspan="4" style="text-align: right"> Total :{{$totamt}}</td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
