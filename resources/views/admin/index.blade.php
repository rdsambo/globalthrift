@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
					@if(Session::has('success'))
					<div class="alert alert-success">
                        <span style="font-size: medium">{{Session::get('success')}}</span>
                    </div>
				    @endif
					{{-- <div class="ibox-title">
						<h5>Dashboard<small> </small></h5>
					</div> --}}
					<div class="ibox-content">
                        <legend><h4>Yearly Interest:</h4></legend>
                        <form method="post" action="{{route('admin.provideyearlyint')}}">
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="hidden" name="submit" value="1">
                                            <input type="submit" class="btn btn-primary" value="Provide Yearly Interest">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important" >
                                    <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>Account No</th>
                                            <th>Account Name</th>
                                            <th>Member Id</th>
                                            <th>A/C Bal</th>
                                            <th>Opening Date</th>
                                            <th>Yearly Interest Amt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($YearlyInt as $key=>$Int)
                                           <tr>
                                               <th>{{++$key}}</th>
                                               <th>{{$Int->AccountNo}}</th>
                                               <th>{{$Int->AccountName}}</th>
                                               <th>{{$Int->MemberId}}</th>
                                               <th>{{$Int->AcBal}}</th>
                                               <th>{{date('d-m-Y', strtotime($Int->AdmissionDate))}}</th>
                                               <th>{{$Int->yearlyint}}</th>
                                           </tr>
                                        @empty
                                        <tr>
                                            <th colspan='9' style="text-align:center">No Record Found</th>
                                        </tr>
                                        @endforelse
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



