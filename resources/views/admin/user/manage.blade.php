@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>User Profile</h5>
                        <div class="ibox float-e-margins">
                        <div class="ibox-title" style="width: 800px">
                            <h5>User List</h5>
                            <div class="text-right">
                                <button type="button" class="btn btn-primary"><a href="{{route('admin.member.add')}}">Add User</a></button>
                            </div>
                        </div>
                            <div class="ibox-content" style="width: 700px">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Contact No</th>
                                                <th>Role</th>
                                                <th colspan="3">Action</th>
                                            </tr>
                                        </thead>

                                            <tbody>
                                        @if($userrecs)
                                                @php
                                                $cnt=1;
                                                @endphp
                                            @foreach ($userrecs as $mem )
                                            <tr class="gradeX {{$mem->deleted_at ? " text-danger" : ""}}">
                                                    <td>{{$cnt}}</td>
                                                    <td>{{$mem->userid}}</td>
                                                    <td>{{$mem->username}}</td>
                                                    <td>{{$mem->contactno}}</td>
                                                    <td>{{$mem->role}}</td>

                                                    <td>
                                                        @if(!$mem->deleted_at)
                                                        <a href="{{route('admin.member.delete',['id'=>$mem->ID,'memid'=>$mem->MemberId])}}" rel="tooltip" data-placement="top" title="Delete User"> <i class="fa fa-trash"></i></a></td>
                                                        @endif
                                                    <td>
                                                        @if(!$mem->deleted_at)
                                                        <a href="{{route('admin.member.edit',['id'=>$mem->ID,'memid'=>$mem->MemberId])}}" rel="tooltip" data-placement="top" title="Modify User"> <i class="fa fa-edit"></i></a></td>
                                                        @endif
                                                    <td>
                                                        @if(!$mem->deleted_at)
                                                        <a href="{{route('admin.member.view',['id'=>$mem->ID,'memid'=>$mem->MemberId])}}" rel="tooltip" data-placement="top" title="View User"> <i class="fa fa-add"></i></a></td>
                                                        @endif
                                                </tr>
                                                @php
                                                $cnt++;
                                                @endphp
                                            @endforeach
                                        @else
                                                <tr>
                                                    <td colspan="5">No records Found</td>
                                                </tr>
                                        @endif
                                            </tbody>
                                    </table>
                                    {{-- {{ $userrecs->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
