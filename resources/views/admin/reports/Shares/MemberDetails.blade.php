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
                                        <label class="col-md-1"><h3>Search </h3></label>
                                        <div class="col-md-3">
                                            <select name="option" class="form-control">
                                                <option value="MemberId">Member Id</option>
                                                <option value="MemberNo">Member No</option>
                                                <option value="MemberName">Member Name</option>
                                              </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="Member_id" class="form-control" placeholder="Enter Member Id">
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
                                        <th>Member Id</th>
                                        <th>Member No</th>
                                        <th>Member Name</th>
                                        <th>Gender</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count=0
                                    @endphp
                                    @foreach($member as$bar)
                                        <tr>
                                            <td>{{$count}}</td>
                                            <td>{{$bar->MemberId}}</td>
                                            <td>{{$bar->MemberNo}}</td>
                                            <td>{{$bar->MemberName}}</td>
                                            <td>{{$bar->Gender}}</td>
                                            <td><a href="{{route('admin.Details.View_Member_details',[$bar->MemberId])}}"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{ $member->appends(request()->all()) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection


