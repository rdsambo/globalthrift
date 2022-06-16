<html>
<head>
<style>
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

</style>
</head>
<body>
<div class="form-group">
    <div class="row">
        <div class="header">
            <h3>Name: {{$acctrpt->first()->AccountName}}</h3>
        </div>
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            @endif
            @if(isset($acctrpt))
            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important;width:40%;margin-left:40%" >
                <thead>
                    <th>Slno</th>
                    <th>Account Id</th>
                    {{-- <th>Account No</th> --}}
                    <th>Date of Collection</th>
                    <th> Amount </th>
                </thead></br>
                <tbody style="margin-top:20%">
                    @php
                    $totamt=0;
                    @endphp
                    @foreach ($acctrpt->first()->ddcollection as $rpt)
                    <tr>
                        <td>{{$rpt->SlNo}}</td>
                        <td>{{$acctrpt->first()->AccountId}}</td>
                        {{-- <td>{{$acctrpt->first()->AccountNo}}</td> --}}
                        <td>{{date("d-m-Y",strtotime($rpt->ColDate))}}</td>
                        <td>{{$rpt->DAmt}}</td>
                    </tr>
                    @php
                    $totamt+=$rpt->DAmt;
                    @endphp
                    @endforeach
                {{--  {{$acctrpt->links() }} --}}
                    <tr>
                        <td colspan="4" style="text-align: right"> Total :{{$totamt}}</td>
                    </tr>
                </tbody>
            </table>
            @endif
    </div>
</div>
</body>
</html>
