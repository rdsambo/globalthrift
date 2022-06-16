@extends('admin.layout.master')
<style>

    .filter{
    padding-right: 44px;
    padding-left: 44px;
    padding-top: 44px;
    }
</style>
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox-title">
           <h5>New LO Assign</h5>
                <div class="ibox-content">

                 <form method="POST" action="{{route('admin.uploadNew')}}">
                    @csrf

                       <div class="row col-md-13">
                           <div class="form-group col-md-2">
                               <label>Select lo</label>
                           </div>
                           <div class="form-group col-md-3">
                                <select class="form-control" name="user_id">
                                                    <option value="##">Select lo</option>
                                                    @foreach($account_data as $dda)
                                                        <option value="{{$dda->EOId}}">{{$dda->EOName}}</option>
                                                    @endforeach
                                </select>
                            @error('user_id')
                             {{ $message }}
                             @enderror
                            </div>
                        </div>

                        <div class="row col-md-13">
                           <div class="form-group col-md-2">
                               <label>User Name</label>
                           </div>
                           <div class="form-group col-md-3">
                               <input type="text" name="username" class="form-control" placeholder="Name">
                                  @error('username')
                                  {{ $message }}
                                  @enderror
                           </div>
                        </div>
                        <div class="row col-md-13">
                           <div class="form-group col-md-2">
                               <label>Password</label>
                           </div>
                           <div class="form-group col-md-3">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                   @error('password')
                                   {{ $message }}
                                   @enderror
                           </div>
                        </div>

                        <div class="row col-md-13">
                            <div class="form-group col-md-2">
                               <label>Confirm Password</label>
                            </div>
                            <div class="form-group col-md-3">
                                 <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                   @error('password_confirmation')
                                   {{ $message }}
                                   @enderror
                            </div>
                        </div>

                            <div class="ibox-content">
                               <div class="row col-md-12">
                                  <div class="form-group col-md-2" style="margin-left:100px">
                                     <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                               </div>
                            </div>
                     </form>
                     <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 b-r">
							<table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 11px !important">
                                 <thead>
									<tr>
										<th>Loan officer Name</th>
										<th>User Name</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
                                        @foreach($UsersList as $list)
                                        <tr>
                                            <th>{{$list->EOName}}</th>
                                            <th>{{$list->username}}</th>
                                            <th><a onclick="myFunction()"> <i class="fa fa-trash"></th>
                                                <script>
                                                    function myFunction() {
                                                           var txt;
                                                           var r = confirm("Please Confirm");
                                                               if (r == true) {
                                                                   window.location.href="Data_del/{{$list->userid}}";
                                                               } else {
                                                                   txt = "You pressed can!";
                                                                   }
                                                               document.getElementById("demo").innerHTML = txt;
                                                           }
                                               </script>
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
@endsection


