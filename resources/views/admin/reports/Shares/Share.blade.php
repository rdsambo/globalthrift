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
                                        <label class="col-md-3"><h3>Search Share Holders By </h3></label>
                                        <div class="col-md-3">
                                            <select name="option" class="form-control">
                                                <option value="MemberId">Member Id</option>
                                                <option value="MemberName">Member Name</option>
                                              </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="Member_id" class="form-control" placeholder="Enter ">
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
                                        <th>Member ID</th>
                                        <th>Member Name</th>
                                        <th>No Of Shares</th>
                                        <th>Price</th>
                                        <th>Date of Purchase </th>
                                        <th>Certificate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count=0
                                    @endphp
                                    @foreach($ShareList as $list)
                                    <tr>
                                        @php
                                        $count++
                                        @endphp
                                        <td>{{$count}}</td>
                                        <td>{{$list->MemberId}}</td>
                                        <td>{{$list->MemberName}}</td>
                                        <td>{{$list->shares}}</td>
                                        <td>{{$list->shareamount}}</td>
                                        <td>{{date('d-m-Y',strtotime($list->created_at))}}</td>
                                        <td><a href="{{route('admin.ShareCertificate',[$list->MemberId])}}"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $ShareList->appends(request()->all()) }}
                            <a class="btn btn-primary" href="?export=excel&Loan_officer={{request("Share")}}" class="btn btn">Export All Share Holders to excel </a></br>
                            <a class="btn btn-primary" href="{{route('admin.exportPDF') }}">Export to PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js" ></script>
<script>
    function generatePDF() {
 var doc = new jsPDF();  //create jsPDF object
  doc.fromHTML(document.getElementById("test"), // page element which you want to print as PDF
  15,
  15,
  {
    'width': 170  //set width
  },
  function(a)
   {
    doc.save("HTML2PDF.pdf"); // save file name as HTML2PDF.pdf
  });
}
</script>
@endsection


