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
           <h4>Update Detalis</h4>
                <div class="ibox-content">
                     <form method='post' action='../coll_upd/{{$temp_deposite->id}}'>
                      @csrf
                      <div class="row col-md-13">     
                           <div class="form-group col-md-2">
                               <label>Deosit Amount </label>
                           </div>
                           <div class="form-group col-md-2">
                           :{{$temp_deposite ->deposite_amount}}
                           </div>
                      </div> 
                      <div class="row col-md-13">     
                           <div class="form-group col-md-2">
                               <label>Name </label>
                           </div>
                           <div class="form-group col-md-2">
                           :{{$temp_deposite ->member_name}}
                           </div>
                      </div>
                      <div class="row col-md-13">     
                           <div class="form-group col-md-2">
                               <label>A/C No  </label>
                           </div>
                           <div class="form-group col-md-2">
                           :{{$temp_deposite ->account_no}}
                           </div>
                      </div>  
                      <div class="row col-md-13">     
                           <div class="form-group col-md-2">
                               <label>Member Id  </label>
                           </div>
                           <div class="form-group col-md-2">
                           :{{$temp_deposite ->member_id}}
                           </div>
                      </div> 
                      <div class="row col-md-13">     
                           <div class="form-group col-md-2">
                               <label>Amount To Be Collected </label>
                           </div>
                               <div class="form-group col-md-2">
                               <input type="text" required Value="{{$temp_deposite ->amount_collected}}" Name="new_amount">
                               </div>
                      </div>
                      <div class="row col-md-13">     
                           <div class="form-group col-md-2">
                               <label>Date  </label>
                           </div>
                           <div class="form-group col-md-2">
                           :{{$temp_deposite ->collected_date}}
                           </div>
                      </div> 
                      <div class="ibox-content">
                          <div class="row col-md-12">
                               <div class="form-group col-md-2" style="margin-left:100px">
                                  <button type="submit" class="btn btn-primary" >Submit</button>
                          </div>
                      </div>
                      </form>      
    </div>
</div>
@endsection
@section('scripts')
<!--script>
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
           $(".checkboxes").each(function (){
              $(this).prop("checked", true);
              });
           }else{
              $(".checkboxes").each(function (){
                   $(this).prop("checked", false);
              });
           }
    });
</script>
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
function checkboxChecked (obj) {


  var val = $(obj).val();
  if ($(obj).is(":checked")) {
      ++count
    ids[val] = val;
  } else {
      --count
    delete ids[val];
  }

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
@endsection


