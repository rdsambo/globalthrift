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
            <h5> Filter<small> </small></h5>
        </div>
        <div class="ibox-content">
        <div class="row">
            <form method="POST" class="form-horizontal"  name="updateForm" id="updateForm" action={{route('admin.approveapply')}}>
                @csrf
                <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="ibox float-e-margins">
                            {{-- <div class="ibox-title text-center"></div> --}}
                                {{-- <div class="ibox-content"> --}}
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-md-4"><label>Collection date from</label></div>
                                                    <div class="col-md-8">
                                                        <input type="date" id="collection_from_date" value="{{ isset($_GET['collection_from_date']) ? $_GET['collection_from_date'] : '' }}"name="collection_from_date" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-4"><label>Collection Date to</label></div>
                                                    <div class="col-md-8">
                                                        <input type="date" id="collection_to_date" value="{{ isset($_GET['collection_to_date']) ? $_GET['collection_to_date'] : ''}}" name="collection_to_date" class="form-control">
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="col-md-4"><label>Collection type</label></div>
                                                    <div class="col-md-8">
                                                        <select class="form-control" name="collection_type">
                                                            <option value="DD" {{ request('collection_type')=='DD'?'selected'  : ''}}>Daily collection</option>
                                                            <option value="MD" {{ request('collection_type')=='MD'?'selected'  : ''}}>monthly collection</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="col-md-4"><label>Collected by</label></div>
                                                    <div class="col-md-8">
                                                        <select class="form-control" name="lo_id">
                                                           <option value=""> Select      </option>
                                                               @foreach ($lo as $key=>$record )
                                                                <option value="{{$record->id}}" {{ request('lo_id')== $record->id ?'selected'  : ''}}>{{$record->username}}</option>
                                                               @endforeach
                                                        </select>
                                                   </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-md-4"><label>Deposite Amount</label></div>
                                                    <div class="col-md-8">
                                                        <input type="number" id="deposite_amount" value="{{ isset($_GET['deposite_amount']) ? $_GET['deposite_amount'] : ''}}" name="deposite_amount" class="form-control" placeholder="Enter deposite amount">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <div class="col-sm-12 text-center">

                                                <button type="submit" class="btn btn-primary">Search</button>
                                                <a href="{{route('admin.collection.index')}}" class="btn btn-danger">Reset</a><br>

                                            </div>
                                        </div>
                                {{-- </div> --}}
                        </div>
                </div>
            </form>
        </div>
    {{-- </div> --}}
                        <!--filter-->
                    {{-- <div class="form-group"> --}}
                    {{-- <div class="wrapper wrapper-content animated fadeInRight"> --}}
                        {{-- <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    @if(Session::has('success'))
                                        <div class="alert alert-success"><span style="font-size: medium">{{Session::get('success')}}</span></div>
                                    @endif
                                    <div class="ibox-content">
                                        <caption><h3>Filter</h3> </caption>
                                        <div class="table-responsive">
                                            <form class="navbar-form navbar-left" role="search" method="GET" action="">
                                                <div class="row">
                                                    <label class="col-md-3 filter">Collection date from</label>
                                                    <div class="col-md-3 filter">
                                                        <input type="date" id="collection_from_date" value="{{ isset($_GET['collection_from_date']) ? $_GET['collection_from_date'] : '' }}"name="collection_from_date" class="form-control">
                                                    </div>
                                                    <label class="col-md-3 filter" style="padding-left:40px ">Collection Date to</label>
                                                    <div class="col-md-3 filter">
                                                        <input type="date" id="collection_to_date" value="{{ isset($_GET['collection_to_date']) ? $_GET['collection_to_date'] : ''}}" name="collection_to_date" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <label class="col-md-3 filter">Collection type</label>
                                                        <div class="col-md-3 filter">
                                                            <select class="form-control" name="collection_type">
                                                                <option value="DD" {{ request('collection_type')=='DD'?'selected'  : ''}}>Daily collection</option>
                                                                <option value="MD" {{ request('collection_type')=='MD'?'selected'  : ''}}>monthly collection</option>

                                                            </select>
                                                        </div>
                                                        <label class="col-md-3 filter" style="padding-left:40px ">Collected by</label>
                                                        <div class="col-md-3 filter">
                                                            <select class="form-control" name="lo_id">
                                                                <option value=""> Select      </option>
                                                                @foreach ($lo as $key=>$record )
                                                                    <option value="{{$record->id}}" {{ request('lo_id')== $record->id ?'selected'  : ''}}>{{$record->username}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                </div>
                                                <div class="row">
                                                    <label class="col-md-3 filter">Deposite Amount</label>
                                                    <div class="col-md-3 filter">
                                                        <input type="number" id="deposite_amount" value="{{ isset($_GET['deposite_amount']) ? $_GET['deposite_amount'] : ''}}" name="deposite_amount" class="form-control" placeholder="Enter deposite amount">
                                                    </div>


                                            </div>


                                                <div class="row " style="text-align: center;padding-top:30px">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                    <a href="{{route('admin.collection.index')}}" class="btn btn-danger">Reset</a>
                                                </div>

                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- </div> --}}
                        <!--end filter-->
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                        {{-- <div class="ibox-title">


                            <div class="row col-md-12">

                            </div>
                        </div> --}}
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important" >
                                <caption><h3>Collection List</h3> </caption>
                                <thead>
                                    <tr>
                                        <th><input class="form-check-input" id="checkall" name="applicable_for_all" type="checkbox" ></th>
                                        <th>SL</th>
                                        <th>Account No</th>
                                        <th>Amount to be collected</th>
                                        <th>Collection type</th>
                                        <th>Amount collected</th>
                                        <th>Member name</th>
                                        <th>Collected by</th>
                                        <th>Collected date</th>
                                        <th style="text-align:center">Status</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                        <form action="{{route('admin.collection.store')}}" method="POST">
                            @csrf
                                    <tbody>

                                        @if($temp_deposite)
                                            @foreach ($temp_deposite as $key=>$data )
                                                <tr>
                                                    <td>
                                                    @if($data->transfer_status==1)
                                                        <input value="{{$data->id}}"class="form-check-input checkboxes" id="applicable-for-all" name="id[]" type="checkbox" onchange="checkboxChecked(this)" disabled>
                                                    @else
                                                         <input value="{{$data->id}}"class="form-check-input checkboxes" id="applicable-for-all" name="id[]" type="checkbox" onchange="checkboxChecked(this)">
                                                    @endif
                                                    </td>
                                                    <td>{{$key+$temp_deposite->firstItem()}}</td>
                                                    <td>{{$data->account_no}}</td>
                                                    <td>{{$data->amount_collected}}</td>
                                                    <td>{{$data->collection_type}}</td>
                                                    <td>{{$data->deposite_amount}}</td>
                                                    <td>{{$data->member_name}}</td>
                                                    <td>{{$data->user->username}}</td>
                                                    <td>{{$data->collected_date}}</td>
                                                    @if($data->transfer_status==1)
                                                    <td><span class="badge badge-success">Transfered</span></td>
                                                    @else
                                                    <td><span class="badge badge-warning">Pending</span></td>
                                                    @endif
                                                    <td>
                                                        @if($data->transfer_status!=1)
                                                            <a   onclick="myFunction()" > <i class="fa fa-trash"></i></a>&nbsp;&nbsp;
                                                        @endif
                                                        @if($data->transfer_status!=1)
                                                            <a  href="coll_edt/{{$data->id}}"><i class="fa fa-edit"></i></a>
                                                        @endif
                                                        <script>
                                                             function myFunction() {
                                                                    var txt;
                                                                    var r = confirm("Please Confirm");
                                                                        if (r == true) {
                                                                            window.location.href="coll_del/{{$data->id}}";
                                                                        } else {
                                                                            txt = "You pressed can!";
                                                                            }
                                                                        document.getElementById("demo").innerHTML = txt;
                                                                    }
                                                        </script>
                                                </tr>
                                            @endforeach
                                        @else
                                                <tr>
                                                    <td colspan="5">No records Found</td>
                                                </tr>
                                        @endif

                                    </tbody>


                            </table>
                            @if ($temp_deposite)
                                {{ $temp_deposite->appends(request()->all()) }}
                            @endif
                            <div class="row col-md-6 ">
                                <div class="container">
                                    <caption><h2><b>#Total transfer amount:</b></h2> </caption><caption><b><h2 id="total_transfer"></h2></b></caption>
                                    <caption><h2><b>#Total Member :</b></h2> </caption><b><caption><h2 id="total_member"></h2></b></caption>

                                </div>
                              </div>
                            {{-- <div class="row col-md-6" >
                                <caption><h2><b>#Total transfer amount:</b></h2> </caption><caption><h2 id="total_transfer"></h2></caption>
                                <caption><h2><b>#Total Member :</b></h2> </caption><caption><h2 id="total_member"></h2></caption>

                            </div> --}}
                            <div class="row col-md-6">
                                <button class="btn btn-primary" type="submit" style="float: right"> Submit</button>
                            </div>

                        </form>
                        <div class="row">
                              {{ $temp_deposite->appends(request()->all())->links() }}
                        </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
// $("#checkall").click(function (){
//     var value =@json($temp_deposite);
//     var ids=[];
//     $.each(value.data,function(k,v){
//         id.push(v.id);
//     })





// });
var count=0;
var value =@json($temp_deposite);

var ids=[];
function checkboxChecked(obj) {
  var val = $(obj).val();
  if ($(obj).is(":checked")) {
    //   ++count
    ids[val] = val;
  } else{
    //   --count
      delete ids[val];
  }
count = $(".checkboxes:checked").length;
  calculateAmount();
  $('#total_member').text(count);

}
calculateAmount = function(){

	var deposite_amount=0;
    var value =@json($temp_deposite);

  $.each(value.data, function(index, item){

  	if(ids[item.id] !== undefined){

    	deposite_amount += parseFloat(item.deposite_amount);
    }
  })

  $('#total_transfer').html(`₹`+deposite_amount);
}

</script>
<script>
$(document).ready(function () {
   $(".checkbox").change(function() {
       if($(this).is(":checked")){
           var t=1;
           $.ajax({
                'url'   : '{{route('admin.getdd-data')}}',
                'type'  : 'get',
                'data'  :  {t:1,t1:5},
                success: function(data){
                   if(data.success==true){
                        var html="";
                   }
                    console.log(data);
                }
           });
       }
   })
});
</script>
<script>
    $("#checkall").click(function (){
        if ($("#checkall").is(':checked')){
           $(".checkboxes").not("[disabled]").each(function (){
              $(this).prop("checked", true);
              checkboxChecked(this)
              });
           }else{
              $(".checkboxes").not("[disabled]").each(function (){
                   $(this).prop("checked", false);
                   checkboxChecked(this)
              });
           }
           calculateAmount();
    });
</script>


@endsection


