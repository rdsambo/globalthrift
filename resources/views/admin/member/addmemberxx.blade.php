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
                     <div class="col-lg-6 m-b-md">
                        <div class="tabs-container">
                           <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#tab-1">Members</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-2">Address</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-3">Occupation</a></li>
                              {{-- <li class=""><a data-toggle="tab" href="#tab-4">Share</a></li> --}}
                           </ul>
                           <form class="form-group" method='post' action="{{route("admin.member.save")}}" enctype="multipart/form-data">
                              @csrf
                                    <div class="tab-content">
                                       <div id="tab-1" class="tab-pane active">
                                          <div class="panel-body">
                                             @if($errors->any())
                                                      @foreach ($errors->all() as $error)
                                                         <div class="alert alert-danger">{{ $error }}</div>
                                                      @endforeach
                                             @endif
                                             <div class="row">
                                                <div class="form-group col-md-12">
                                                      <div class="col-md-3">
                                                         <label class="form-group">LO </label>

                                                      </div>
                                                      <div class="col-md-3">
                                                         <select class="form-group" name="lomem" id="lomem">
                                                            @foreach($eomember as $lomem)
                                                                  <option value="{{$lomem->EOId}}">{{$lomem->EOName}}</option>
                                                            @endforeach
                                                         </select>
                                                      </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="form-group col-md-12">
                                                      <div class="form-group col-md-3">
                                                         <label class="form-group">Center </label>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                         <input type="text" class="form-group" name="centername" id="centername" placeholder="Center" >
                                                      </div>
                                                      <div class="form-group col-md-2 ">
                                                         <label class="form-group">Group no</label>
                                                      </div>
                                                      <div class="row col-md-3">
                                                         <input type="text" class="form-group" name="groupno" id="groupno" placeholder="membersrno" required>
                                                      </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="form-group col-md-12">
                                                      <div class="form-group col-md-3">
                                                         <label class="form-group">Member Type </label>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                         <select name="memtype" id="memtype" class="form-group">
                                                            <option value="0">Select One</option>
                                                            <option value="DD Collection">DD Collection</option>
                                                            <option value="MD Collection">MD Collection</option>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-md-2">
                                                         <label class="form-group">Target No </label>
                                                      </div>
                                                      <div class="form-group col-md-2">
                                                        <input type="text" class="form-group" name="targetno" id="targetno">
                                                      </div>

                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="box-content"></div>
                                                    <div class="form-group col-md-3">
                                                        <label class="form-group">No of Share</label>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <input type="number" class="form-group" name="nos" id="nos" >
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <button type="button" class="btn" id="cal"><i class="fa fa-calculator"></i>Calc</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                   <div class="form-group col-md-3">
                                                        <label class="form-group">Amount</label>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                         <label class="form-group" name="shareamount" id="shareamount"></label>
                                                    </div>
                                                </div>

                                             </div>
                                             <div class="row">
                                                <div class="form-group col-md-12">
                                                      <div class="form-group col-md-3">
                                                         <label class="form-group">Member ID </label>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                         <input type="text" class="form-group" name="memberid" id="memberid" placeholder="memberid" required>
                                                      </div>
                                                      <div class="form-group col-md-2 ">
                                                         <label class="form-group">Member SrNo </label>
                                                      </div>
                                                      <div class="row col-md-3">
                                                         <input type="text" class="form-group" name="membersrno" id="membersrno" placeholder="membersrno" required>
                                                      </div>
                                                </div>
                                             </div>

                                             <div class="row">
                                                <div class="form-group col-md-12">
                                                      <div class="form-group col-md-3">
                                                         <label class="form-group">Name [in BLOCK letters] </label>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                         <input type="text" class="form-group" name="txtfname" id="txtfname" placeholder="Firstname" required>
                                                      </div>

                                                      <div class="col-md-3">
                                                         <input type="text" class="form-group" name="txtlname" id="txtlname" placeholder="Lastname" required>
                                                      </div>
                                                </div>
                                             </div>
                                             <div class="row col-md-12">
                                                <div class="form-group col-md-3 ">
                                                   <label class="form-group"> S/o, W/o, D/o </label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                   <input type="text" class="form-group" name="gname" id="gname" placeholder="Guardian's name" required>
                                                </div>
                                                <div class="form-group col-md-2 ">
                                                   <label class="form-group"> Age </label>
                                                </div>
                                                <div class="form-group col-md-1 ">
                                                   <input type="text" class="form-group" name="age" id="age" placeholder="Age" >
                                                </div>
                                             </div>
                                             <div class="row col-md-12">
                                                <div class="form-group col-md-3 ">
                                                   <label class="form-group"> Date Of Birth </label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                      <input type="text" class="form-group" name="dob" id="dob" placeholder="DOB" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> Gender </label>
                                                </div>
                                                <div class="form-group col-md-2">
                                                   <select class="form-group" name="gender" id="gender">
                                                      <option value="0">Select </option>
                                                      <option value="M">Male </option>
                                                      <option value="F">Female </option>
                                                   </select>
                                                </div>
                                             </div>

                                             <div class="row col-md-12">
                                                <div class="form-group col-md-3">
                                                   <label class="form-group"> Marital Status </label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                   <select class="form-group" name="mstatus" id="mstatus">
                                                      <option value="0">Select </option>
                                                      <option value="1">Married </option>
                                                      <option value="2">Unmarried</option>
                                                   </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> Nationality </label>
                                                </div>
                                                <div class="form-group col-md-2">
                                                   <input type="text" class="form-group" name="nationality" id="nationality" placeholder="Nationality" >
                                                </div>
                                             </div>
                                             <div class="row col-md-12">
                                                <div class="form-group col-md-3">
                                                   <label class="form-group"> Religion </label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <select class="form-group" name="mreligion" id="mreligion">
                                                      <option value="0">Select </option>
                                                      <option value="1">Hindu </option>
                                                      <option value="2">Muslim</option>
                                                      <option value="3">Christian</option>
                                                      <option value="4">Sikh</option>

                                                   </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> Caste </label>
                                                </div>
                                                <div class="form-group col-md-2">
                                                   <select class="form-group" name="mstatus" id="mstatus">
                                                      <option value="0">Select </option>
                                                      <option value="1">General </option>
                                                      <option value="2">SC</option>
                                                      <option value="3">ST</option>
                                                      <option value="4">OBC</option>
                                                      <option value="5">MOBC</option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row col-md-12">
                                             <button type="submit" class="btn btn-success" style="float-right"> <i class="fa fa-arrow-circle-right fa-lg"></i>Save</button>
                                          </div>
                                       </div>
                                       <div id="tab-2" class="tab-pane">
                                          <div class="panel-body">
                                             <div class="ibox-title"><h5>Present Address</h5></div>
                                             <div class="row col-md-12">
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> House No</label>
                                                </div>
                                                <div class="row col-md-3">
                                                   <input type="text" class="form-group" name="txtpresenthouseno" id="txtpresenthouseno" placeholder="HNO" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> Road Name</label>
                                                </div>
                                                <div class="row col-md-3">
                                                   <input type="text" class="form-group" name="txtroadname" id="txtroadname" placeholder="Road Name" >
                                                </div>
                                             </div>
                                             <div class="row col-md-12">
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> Locality</label>
                                                </div>
                                                <div class="row col-md-3">
                                                   <input type="text" class="form-group" name="txtlocality" id="txtlocality" placeholder="Locality" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> City</label>
                                                </div>
                                                <div class="row col-md-3">
                                                   <input type="text" class="form-group" name="txtcity" id="txtcity" placeholder="City" >
                                                </div>
                                             </div>
                                             <div class="row col-md-12">
                                                <div class="form-group col-md-2">
                                                   <label class="form-group">Pincode</label>
                                                </div>
                                                <div class="row col-md-3">
                                                   <input type="text" class="form-group" name="txtpincode" id="txtpincode" placeholder="Pincode" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> District</label>
                                                </div>
                                                <div class="row col-md-3">
                                                   <input type="text" class="form-group" name="txtdistrict" id="txtdistrict" placeholder="District" >
                                                </div>
                                             </div>
                                             <div class="row col-md-12">
                                                <input type="checkbox" name="chksame" id="chksame" class="form-group col-md-1">Same as present
                                             </div>
                                             <div class="box-content"></div>
                                             <div class="ibox-title pt-3"><h5>Permanent Address</h5></div>
                                             <div class="row col-md-12">
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> House No</label>
                                                </div>
                                                <div class="row col-md-3">
                                                   <input type="text" class="form-group" name="txtpermahouseno" id="txtpermahouseno" placeholder="HNO" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> Road Name</label>
                                                </div>
                                                <div class="row col-md-3">
                                                   <input type="text" class="form-group" name="txtpermaroadname" id="txtpermaroadname" placeholder="Road Name" >
                                                </div>
                                             </div>
                                             <div class="row col-md-12">
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> Locality</label>
                                                </div>
                                                <div class="row col-md-3">
                                                   <input type="text" class="form-group" name="txtpermalocality" id="txtpermalocality" placeholder="Locality" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> City</label>
                                                </div>
                                                <div class="row col-md-3">
                                                   <input type="text" class="form-group" name="txtpermacity" id="txtpermacity" placeholder="City" >
                                                </div>
                                             </div>
                                             <div class="row col-md-12">
                                                <div class="form-group col-md-2">
                                                   <label class="form-group">Pincode</label>
                                                </div>
                                                <div class="row col-md-3">
                                                   <input type="text" class="form-group" name="txtpermapincode" id="txtpermapincode" placeholder="Pincode" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                   <label class="form-group"> District</label>
                                                </div>
                                                <div class="row col-md-3">
                                                   <input type="text" class="form-group" name="txtpermadistrict" id="txtpermadistrict" placeholder="District" >
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div id="tab-3" class="tab-pane">
                                          <div class="panel-body">
                                             <div class="row col-md-12">
                                                <div class="form-group col-md-5 ">
                                                   <label class="form-group">Occupation & Other Details</label>
                                                </div>
                                                <div class="box-content"></div>
                                                <div class="row col-md-12">
                                                   <div class="form-group col-md-2">
                                                      <label class="form-group">Occupation</label>
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                      <select class="form-group" name="occupation" id="occupation">
                                                         <option value="0">Select </option>
                                                         <option value="1">Self Employed </option>
                                                         <option value="2">Employee</option>
                                                         <option value="3">Others</option>
                                                      </select>
                                                      <input type="text" class="form-group" name="txtothersoccupation" id="txtothersoccupation" placeholder="others" >
                                                   </div>
                                                   <div class="form-group col-md-2">
                                                      <label class="form-group"> Qualification</label>
                                                   </div>
                                                   <div class="row col-md-3">
                                                      <select class="form-group" name="mqualification" id="mqualification">
                                                         <option value="0">Select </option>
                                                         <option value="1">Under graduate </option>
                                                         <option value="2">Graduate</option>
                                                         <option value="3">Post Graduate</option>
                                                         <option value="4">Illiterate</option>
                                                      </select>
                                                   </div>
                                                </div>
                                                <div class="row col-md-12">
                                                   <div class="form-group col-md-2">
                                                      <label class="form-group">Annual Inc</label>
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                      <select class="form-group" name="occupation" id="occupation">
                                                         <option value="0">Select </option>
                                                         <option value="1">Upto 50000 </option>
                                                         <option value="2">50000 - 100000</option>
                                                         <option value="3">1 - 2 lakhs</option>
                                                         <option value="4">2 - 5 lakhs</option>
                                                      </select>

                                                   </div>
                                                   <div class="form-group col-md-2">
                                                      <label class="form-group">Asset Owned</label>
                                                   </div>
                                                   <div class="row col-md-3">
                                                      <select class="form-group" name="mstatus" id="mstatus">
                                                         <option value="0">Select </option>
                                                         <option value="1">House </option>
                                                         <option value="2">Land</option>
                                                         <option value="3">Car</option>
                                                         <option value="4">Two Wheeler</option>
                                                      </select>
                                                   </div>
                                                </div>
                                                <div class="row col-md-12">
                                                      <div class="form-group col-md-2">
                                                         <label class="form-group">Nominee </label>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                         <input type="text" class="form-group" name="nominee" id="nominee" placeholder="Nominee Name">
                                                      </div>
                                                      <div class="form-group col-md-2">
                                                         <label class="form-group">Relation </label>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                         <select class="form-group" name="nomrelation" id="nomrelation">
                                                         <option value="0">Select </option>
                                                         <option value="1">Father </option>
                                                         <option value="2">Mother</option>
                                                         <option value="3">Wife</option>
                                                         <option value="4">Husband </option>
                                                         <option value="5">Son </option>
                                                         <option value="6">Daughter </option>
                                                         <option value="7">Brother </option>
                                                      </select>
                                                      </div>
                                                </div>
                                                <div class="row col-md-12">
                                                    <div class="form-group col-md-2">
                                                        <label class="form-group">Photograph </label>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <input type="file" class="form-group" name="memphoto" id="memphoto" >
                                                    </div>
                                                    <div class="form-group"  style="display: none;">
                                                        <img src="" id="memphoto_image" height="70px" width="80px" >
                                                        <button type="button" onclick="clearInput(this)" class="btn btn-danger btn-xs">Clear</button>
                                                    </div>
                                                </div>
                                                <div class="row col-md-12">
                                                      <div class="form-group col-md-2">
                                                         <label class="form-group">Pan Card </label>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                         <input type="file" class="form-group" name="pancard" id="pancard" >
                                                      </div>
                                                         <div class="form-group"  style="display: none;">
                                                            <img src="" id="pancard_image" height="70px" width="80px" >
                                                            <button type="button" onclick="clearInput(this)" class="btn btn-danger btn-xs">Clear</button>
                                                         </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
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

