@extends('users.layout.master')
@section('content')
<form method="POST" action="{{route('user.member.addmem')}}">
        @csrf
        <div id="layoutSidenav_content">
            <h5>Member <span class="badge badge-secondary">New</span></h5>
            <div class="row p-2">
                <div class="form-inline ">
                    <div class="form-group mr-2">
                        <input type="text" name="fname" class="form-control" placeholder="First name">
                    </div>
                    <div class="form-group mr-2">
                        <input type="text" name="lname" class="form-control" placeholder="Last name">
                    </div>
                    <div class="form-group mr-2">
                        <input type="text" name="nomineename" class="form-control" placeholder="Nominee">
                    </div>
                     <div class="form-group mr-2">
                            <input type="text" name="dob" class="form-control" placeholder="Date of Birth">
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="form-inline ">
                    <div class="form-group mr-3">

                        <div class="form-group"> <!-- Date input -->
                            <input class="form-control" id="doj" name="doj" placeholder="Date of Joining" />
                        </div>
                    </div>
                    <div class="form-group mr-3">
                        <input type="text" name="doj" class="form-control" placeholder="Date of Joining">
                    </div>
                </div>
            </div>
        </div>
</form>

    <script>
    $('#dob').Zebra_DatePicker();
</script>

@endsection


