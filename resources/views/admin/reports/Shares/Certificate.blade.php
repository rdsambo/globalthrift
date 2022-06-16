@extends('admin.layout.master')
@section('content')
<style>
    <style>
div.a {
  line-height: normal;
}

div.b {
  line-height: 1.6;
}

div.c {
  line-height: 80%;
}

div.d {
  line-height: 200%;
}
</style>
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <p align="right"><input type="button" onclick="myPrint('myfrm')" value="print" class="btn btn-primary"></p>
                        </div>
                    <div class="ibox-content">
                        <form method="post" action="" id="myfrm">
                            <div style="width:1000px; height:600px; padding:20px;  border: 10px solid #787878">
                                <div style="width:950px; height:550px; padding:20px;  border: 5px solid #787878">
                                    <div class="c" style='margin-top:20px; text-align:center' >
                                        <span style="font-size:50px; font-weight:bold;">Share Certificate</span>
                                    <br><br>
                                    <span style="font-size:15px; font-weight:bold;font-style: italic;" >Global Thrift & Credit Cooperative Society Ltd</span>
                                    <br><br>
                                    </div>
                                    <div style='margin-top:20px;'>
                                    <span style="font-size:15px; font-weight:bold; font-style: italic; text-align:left" >Certificare No&nbsp;&nbsp;:&nbsp;&nbsp; {{$person->MemSrNo}}</span>
                                    <br>
                                    <span style="font-size:15px; font-weight:bold; font-style: italic; margin-right:70%" > Number of Shares&nbsp;&nbsp;:&nbsp;&nbsp;{{$person->shares}}</span>
                                    <br><br>
                                    </div>

                                    <div style='text-align:center;margin-top:20px;'>
                                        <span style="font-size:20px"><i>This is to certify that <b>{{$person->MemberName}}</b></i></span>
                                    <br>
                                    <span style="font-size:20px"><i>of <b>{{$person->ResAdd1}},{{$person->District}},{{$person->State}},{{$person->country}},({{$person->Pin}})</b></i></span>
                                    <br><br>
                                    </div>
                                    <div style='text-align:center'>
                                        <span style="font-size:20px"><i>Was at <b>{{date('d-m-y',strtotime($person->AdmissionDate))}}</b> the registered holder of <b>{{$person->shares}}</b> Ordinary shares of <b>{{$person->shareamount}}</b> paid to the <b>Global Thrift & Credit Cooperative Society Ltd.</b> subject to the Articles of Association of Company.</i></span>
                                    <br>
                                    </div>
                                    <div style='margin-top:30px;'>
                                        <span style="font-size:12px"><b>This certificate is herbly  executed by the company:</b></span>
                                    <br>
                                    <span style="font-size:12px"><i>Director :</i></span>
                                    <br>
                                    <span style="font-size:12px"><i>Secretary :</i></span>
                                    <br>
                                    <span style="font-size:12px"><i>Date of issue :</i></span>
                                    <br>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
     function myPrint(myfrm) {
            var printdata = document.getElementById(myfrm);
            newwin = window.open("");
            newwin.document.write(printdata.outerHTML);
            newwin.print();
            newwin.close();
        }
</script>
@endsection


