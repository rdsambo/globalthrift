
<div class="ibox-content">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important">
            <caption> <h4>LO Name : {{$name->EOName}}<h4></caption>

            <thead>
                <tr>
                    <th>SL</th>
                    <th></th>
                    <th>ID</th>
                    <th></th>
                    <th>Member No</th>
                    <th></th>
                    <th>Joining</th>
                    <th></th>
                    <th>Name</th>
                    <th></th>
                    <th>Gender</th>
                    <th></th>
                    <th>Age</th>
                </tr>
            </thead>
            @if($memrecs)
            @php
                $cnt=1;
            @endphp
        @foreach ($memrecs as $mem )
        <tr class="gradeX {{$mem->deleted_at ? " text-danger" : ""}}">
                <td>{{$cnt}}</td>
                <td></td>
                <td>{{$mem->MemberId}}</td>
                <td></td>
                <td>{{$mem->MemberNo}}</td>
                <td></td>
                <td>{{date('d-m-Y',strtotime($mem->AdmissionDate))}}</td>
                <td></td>
                <td>{{$mem->MemberName}}</td>
                <td></td>
                <td>{{$mem->Gender}}</td>
                <td></td>
                <td>{{$mem->MemAge}}</td>
                {{-- <td>
                    @if(!$mem->deleted_at)
                    <a href="{{route('admin.member.delete',['id'=>$mem->ID,'memid'=>$mem->MemberId])}}"> <i class="fa fa-trash"></i></a></td>
                    @endif --}}

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
