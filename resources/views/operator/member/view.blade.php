@extends('users.layout.master')
@extends('users.layout.dashboard')
@section('content')
<body class="sb-nav-fixed">
<div id="layoutSidenav_content">
    <div id="layoutSidenav">
        <main>
            <div class="container-xl11">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>Member</h5>
                                </div>
                                <div class="col-sm-7">
                                    <a href="#" class="btn btn-primary"><i class="material-icons">&#xE147;</i> <span>Add member</span></a>
                                    <a href="#" class="btn btn-primary"><i class="material-icons">&#xE24D;</i> <span>Export to Excel</span></a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Membership Date</th>
                                    <th>No of Share</th>
                                    <th>Share Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><a href="#"><img src="" class="avatar" alt="Avatar"> Michael Holz</a></td>
                                    <td>04/10/2013</td>
                                    <td>Admin</td>
                                    <td><span class="status text-success">&bull;</span> Active</td>
                                    <td>
                                        <a href="#" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                        <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
       </main>
    </div>
</div>
</body>
@endsection

