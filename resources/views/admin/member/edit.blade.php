{{-- @extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Members Profile </h5>
                    </div>
                    <form class="form-group" method="get" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="wrapper wrapper-content">
                            <div class="row animated fadeInRight">
                                <div class="col-md-3">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Profile Photo</h5>
                                        </div>
                                        <div>
                                            <div class="ibox-content no-padding border-left-right">
                                                <img alt="image" class="img-responsive" src="{{asset('dist/images/profile_big.jpg')}}">
                                                <label>Upload Photo [Optional] </label>
                                                <input type="file" name="memberphoto" id="memberphoto" class="border-left-right">
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-9">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Bio Data</h5>
                                            <div class="ibox-content">

                                                <div>
                                                    <div class="feed-activity-list">
                                                        <div class="feed-element ">
                                                                <div class="row">
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Name</strong><input type="text" value="{{$editprofile->MemberName}}" class="form-control"/>
                                                                    </div>
                                                                    <div class="media-body col-md-2">
                                                                            <strong>Type</strong><input type="text" value="{{$editprofile->MemberType}}" class="form-control"/>
                                                                    </div>
                                                                    <div class="media-body col-md-2">
                                                                            <strong>Gender</strong><input type="text" value="{{$editprofile->Gender}}" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                                <div class="row pt-3">
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Caste</strong><input type="text" value="{{\App\Helpers\Helper::getcaste($editprofile->Caste)}}" class="form-control"/>
                                                                    </div>
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Religion</strong><input type="text" value="{{\App\Helpers\Helper::getreligion($editprofile->Rlgn)}}" class="form-control"/>
                                                                    </div>
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Qualification</strong>
                                                                        <input type="text" value="{{\App\Helpers\Helper::getqualification($editprofile->QualificationId)}}" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                                <div class="row pt-3">
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Marital Status</strong><input type="text" value="{{\App\Helpers\Helper::getcaste($editprofile->Caste)}}" class="form-control"/>
                                                                    </div>
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Spouse</strong><input type="text" value="{{$editprofile->Spouce}}" class="form-control"/>
                                                                    </div>
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Qualification</strong>
                                                                        <input type="text" value="{{\App\Helpers\Helper::getqualification($editprofile->Qualification)}}" class="form-control"/>
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
                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary"> Update </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
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
               <div class="wrapper wrapper-content animated fadeIn">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="tabs-container">
                           <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#tab-1">Members</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-2">Address</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-3">Occupation</a></li>
                              {{-- <li class=""><a data-toggle="tab" href="#tab-4">Share</a></li> --}}
                           </ul>
                           <form class="form-group" method='post' action="" enctype="multipart/form-data">
                              @csrf
                              
                               
                                   @include('admin.member.form')
                                 <br>
                              <div class="row col-md-12">
                                 <button type="submit" class="btn btn-success" style="float-right"> <i class="fa fa-arrow-circle-right fa-lg"></i>Update</button>
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

        }else{
           $("#txtpermahouseno").val('');
           $("#txtpermaroadname").val('');
           $("#txtpermalocality").val('');
           $("#txtpermacity").val('');
            $("#txtpermapincode").val('');
            $("#txtpermadistrict").val('');

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
    $(document).ready(function(){
        $("#cal").click(function(){
           var share=$("#nos").val();
           var amount = parseInt(share*100);
            $("#shareamount").html(amount);
        });
    });
</script>

@endsection

