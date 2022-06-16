
@extends('admin.layout.master')
@section('content')

<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
					@if(Session::has('success'))
					<div class="alert alert-success"><span style="font-size: medium">{{Session::get('success')}}</span></div>
				    @endif
					<div class="ibox-title">
						<h5>Account Holders List    <small> </small></h5>
					</div>
					<div class="ibox-content">
                        <div class="row">
								<form method="post" action="{{route('admin.accountfilter')}}">
                                    @csrf
										<div class="row">
											<div class="col-md-12 text-center">
												 <div class="row">
													<div class="col-md-6">
														<select name="SearchBy" class="form-control">
															<option value="AccountNo">Account No</option>
															<option value="AccountName">Account Name</option>
															<option value="MemberId">Membership ID</option>
														</select>
													</div>
													<div class="col-md-3">
														<input type="text" name="valueToSearch" placeholder="Value To Search" class="form-control">
													</div>
													<div class="col-md-3">
														{{-- <input type="submit" name="search" value="Filter"> --}}
                                                        <button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-filter"></i>Search </button>
													</div>
												</div>
											</div>
										</div>
										<div>
										<div class="row" style="margin-top:10px">
											<div class="col-sm-12 b-r">
												<table id="memListTable" class="table table-responsive table-bordered">
												    <thead>
												        <tr>
                                                            <th>SL</th>
													        <th>ID</th>
													        <th>Account No</th>
													        <th>Name</th>
													        <th>Gender</th>
													        <th>Date Opening</th>
													        <th>Member ID</th>
													        <th>Action</th>
													    </tr>
												    </thead>
												    <tbody>
														@foreach($records as $key=>$rc)
														<tr>
															<td>{{$key+$records->firstItem()}}</td>
															<td>{{$rc->AccountId}}</td>
															<td>{{$rc->AccountNo}}</td>
															<td>{{$rc->AccountName}}</td>
															<td>{{$rc->Gender}}</td>
															<td>{{$rc->EntryDate}}</td>
															<td>{{$rc->MemberId}}</td>
	                                                        <td><a href="{{route('admin.applyforloan',[$rc->AccountId,$rc->AccountName,$rc->AccountNo,$rc->MemberId])}}"><span class="badge badge-primary">Apply Loan</span></a></td>
														</tr>
														@endforeach
												    </tbody>
											    </table>
												{{$records->links()}}
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


