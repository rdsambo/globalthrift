@extends('admin.layout.master')
@section('content')
<div class="form-group">
   <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
         <div class="col-lg-12">
            <div class="ibox float-e-margins">
               <div class="ibox-title">
                  <h5>New Member</h5>
               </div>
               @if(Session::has('success'))
					<div class="alert alert-success">
                        <span style="font-size: medium">{{Session::get('success')}}</span>
                    </div>
				@endif
               <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tabs-container">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#tab-1">Members</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-2">Address</a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-3">Occupation</a></li>
                                    </ul>
                                    <form class="form-group" method='post' action="{{route("admin.member.save")}}" enctype="multipart/form-data">
                                        @csrf
                                            @include('admin.member.form')
                                            <br>
                                        <div class="row col-md-12">
                                            <button type="submit" class="btn btn-success" style="float-right"> <i class="fa fa-arrow-circle-right fa-lg"></i>Save</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<script>
$(document).ready(function(){

   $("#txtothersoccupation").hide();
    $('#chksame').change(function(){
        if(this.checked){
           $("#txtpermahouseno").val($("#txtpresenthouseno").val());
           $("#txtpermaroadname").val($("#txtroadname").val());
           $("#txtpermalocality").val($("#txtlocality").val());
           $("#txtpermacity").val($("#txtcity").val());
           $("#txtpermapincode").val($("#txtpincode").val());
           $("#txtpermadistrict").val($("#txtdistrict").val());
           $("#txtpermastate").val($("#textstate").val());
           $("#txtpermacountry").val($("#textcountry").val());

        }else{
           $("#txtpermahouseno").val('');
           $("#txtpermaroadname").val('');
           $("#txtpermalocality").val('');
        //    $("#txtpermacity").val('');
           $("#txtpermapincode").val('');
        //    $("#txtpermadistrict").val('');
        //    $("#txtpermastate").val('');
        //    $("#txtpermacountry").val('');

        }

    });

    $('#occupation').change(function(){
         if($("#occupation").val()==3){
            $("#txtothersoccupation").show();
         }else{
            $("#txtothersoccupation").val('');
            $("#txtothersoccupation").hide();
         }
    });

});
</script>
<script type="text/javascript">
(function($) {
           // $('.sub').attr('disabled',true);
            $("#memphoto").change(function(){
                 readURL(this, 'memphoto_image');
            });

            $("#pancard").change(function(){
                 readURL(this, 'pancard_image');
            });

            function readURL(input, preview_id) {
                if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                  $('#'+preview_id).parents(".form-group").show();
                  $('#'+preview_id).attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
              }
            }
            clearInput = function(Obj){
                var $this = $(Obj);
                var $this_parent = $this.parent(".form-group").hide();
                $this_parent.siblings(".form-group").find("input[type='file']").val("");
            }

        }
        )( jQuery );


</script>
{{-- <link rel="stylesheet" type="text/css" href="{{asset("assets/zebra_datepicker.css")}}"/> --}}
<script>
    $(document).ready(function(){
       $('#dob').Zebra_DatePicker();

    });


</script>
<script>
$(document).ready(function() {
    $('#lomem').change(function() {
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var lo=$('#lomem').val();

        $.ajax({
            'url' : '{{route('getcenter')}}',
            'type' : 'GET',
            'data'  : {'id':lo},
            'dataType' : 'json',
            'success' : function(response) {
                //console.log(response.data.GroupName);
                $('#centername').val(response.data.GroupName);
                $('#groupno').val(response.data.GroupCode);
            },
            'error' : function(data) {
                //console.log(data);
                $('#centername').html(data);
            }
        });
    });
});

</script>
<script>
   $("#nos").on('change', function() {
       var share = $("#nos").val();
       var amount = parseInt(share * 100);
       $("#shareamount").html(amount);

   });


</script>

@endsection

