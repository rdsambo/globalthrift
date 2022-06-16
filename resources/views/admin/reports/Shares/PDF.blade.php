
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Share Holders List</h5>
                        </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th></th>
                                        <th>Member ID</th>
                                        <th></th>
                                        <th>Member Name</th>
                                        <th></th>
                                        <th>No Of Shares</th>
                                        <th></th>
                                        <th>Price</th>
                                        <th></th>
                                        <th>Date of Purchase </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count=0
                                    @endphp
                                    @foreach($data as $list)
                                    <tr>
                                        @php
                                        $count++
                                        @endphp
                                        <td>{{$count}}</td>
                                        <td></td>
                                        <td>{{$list->MemberId}}</td>
                                        <td></td>
                                        <td>{{$list->MemberName}}</td>
                                        <td></td>
                                        <td>{{$list->shares}}</td>
                                        <td></td>
                                        <td>{{$list->shareamount}}</td>
                                        <td></td>
                                        <td>{{$list->created_at}}</td>
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
