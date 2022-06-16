@extends('admin.layout.master')
@section('content')
<style>
fieldset {
  background-color: #eeeeee;
}

legend {
   font-size: small;
  background-color: gray;
  color: white;
  padding: 5px 10px;
}

.txtbox {
    width: 50px;
    margin-left: 50px;
}
.pl-x{
   padding-left: 10px;
}

</style>
<div class="form-group">
   <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
         <div class="col-lg-12">
            <div class="ibox float-e-margins">
               <div class="wrapper wrapper-content animated fadeIn">
                  <div class="row">
                     <div class="col-lg-12 m-b-md">
                        <div class="tabs-container">
                           <ul class="nav nav-tabs">
                              {{-- <li class="active"><a data-toggle="tab" href="#tab-1">List</a></li> --}}
                              <li class=""><a data-toggle="tab" href="#tab-2">Details</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-3">Member Assets</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-3">Picture</a></li>
                           </ul>
                           <form class="form-group" method='post' action="{{route("admin.member.save")}}" enctype="multipart/form-data">
                              @csrf
                              <div class="tab-content">
                                 {{-- <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                         @if($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <div class="alert alert-danger">{{ $error }}</div>
                                                @endforeach
                                         @endif


                                    </div>
                                    <div class="row col-md-12">
                                       <button type="submit" class="btn btn-success" style="float-right"> <i class="fa fa-arrow-circle-right fa-lg"></i>Save</button>
                                    </div>
                                 </div> --}}
                                 <div id="tab-2" class="tab-pane active">
                                    <div class="panel-body">
                                          <div class="row">
                                             <div class="col-md-12">
                                                <div class="form-group col-sm-3">
                                                      <label class="form-group">Membership No </label>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                      <input type="text" class="form-group" name="memberid" id="memberid" value="{{$memdetails->MemberId}}" >
                                                </div>
                                                <div class="form-group col-sm-3 ">
                                                      <label class="form-group">Member No </label>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                      <input type="text" class="form-group" name="membersrno" id="membersrno" value="{{$memdetails->MemSrNo}}">
                                                </div>
                                             </div>
                                          </div>
                                       {{--  <div class="box-content"></div> --}}
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="form-group col-sm-3 ">
                                                <label class="form-group">LO</label>
                                             </div>
                                             <div class="form-group col-sm-3">
                                                <input type="text" class="form-group" name="loname" id="loname" value="{{\App\Helpers\Helper::geteodetails($memdetails->GroupId)->EOName}}">
                                             </div>
                                             <div class="form-group col-sm-3 ">
                                                <label class="form-group">Center</label>
                                             </div>
                                             <div class="form-group col-sm-3">
                                                <input type="text" class="form-group" name="name" id="name" value="">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                             <div class="col-md-12">
                                                <div class="form-group col-sm-3">
                                                   <label class="form-group"> Group No </label>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                <input type="text" class="form-group" name="groupno" id="groupno" value={{\App\Helpers\Helper::getgroupno($memdetails->GroupId)->GroupCode}}>
                                                </div>
                                                <div class="form-group col-sm-3 ">
                                                   <label class="form-group"> Group Name </label>
                                                </div>
                                                <div class="form-group col-md-3 ">
                                                      <label class="form-group">{{\App\Helpers\Helper::getgroupno($memdetails->GroupId)->GroupName}}</label>
                                                </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="form-group col-md-3 ">
                                                <label class="form-group"> Old Member? </label>
                                             </div>
                                             <div class="form-group col-md-3">
                                                   <label class="form-group">{{$memdetails->MemberType}}</label>
                                             </div>
                                             <div class="form-group col-md-3">
                                                <label class="form-group"> Admission Fee </label>
                                             </div>
                                             <div class="form-group col-md-3">
                                                <label class="form-group"> {{$memdetails->Adminfee}} </label>
                                             </div>
                                          </div>
                                       </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                      <label class="form-group"> Member ID </label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                      <label class="form-group"> {{$memdetails->MemberId}} </label>
                                                </div>

                                                <div class="form-group col-md-3">
                                                      <label class="form-group"> Target No </label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                      <label class="form-group">{{ $memdetails->TargetNo}} </label>
                                                </div>
                                             </div>
                                        </div>
                                        <div class="row">
                                             <div class="form-group col-md-3">
                                                <label class="form-group"> Adm. Date </label>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-group">{{date('d-m-Y',strtotime($memdetails->MemberId))}} </label>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label class="form-group"> Other Misc.Fees</label>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label class="form-group">{{ $memdetails->SalebleFee}}</label>
                                            </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-12">
                                             <fieldset>
                                                <legend>Personal Information:</legend>
                                                   <div class="form-group col-md-3">
                                                      <label class="form-group">Full Name</label>
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                      <input class="" type="text" name="name" id="name" value="{{$memdetails->MemberName}}">
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                      <label class="form-group"> Age </label>
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                      <label>{{$years = \Carbon\Carbon::parse($memdetails->MemberDOB)->age}}</label>
                                                   </div>

                                                   <div class="form-group col-md-3">
                                                      <label>Alias</label>
                                                   </div>
                                             </fieldset>
                                          </div>
                                       </div>
                                       <div class="row">
                                             <div class="col-md-12">
                                             <div class="form-group col-md-3">
                                                <label class="form-group"> Date of Birth </label>
                                             </div>
                                             <div class="form-group col-md-3">
                                                <input type="text" class="form-group" name="dob" id="dob" value="{{date('d-m-Y',strtotime($memdetails->MemberDOB))}}" >
                                             </div>
                                             <div class="form-group col-md-3">
                                                <label class="form-group">Retired Date</label>
                                             </div>
                                             <div class="form-group col-md-3">
                                                <label class="form-group">{{date('d-m-Y',strtotime($memdetails->RetdDate))}}</label>
                                             </div>
                                       </div>
                                       </div>

                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="form-group col-md-3">
                                                <label class="form-group">Gender</label>
                                             </div>
                                             <div class="col-md-3">
                                                <input type="text" class="form-group" name="txtgender" id="txtgender" value="{{$memdetails->Gender}}" >
                                             </div>
                                             <div class="form-group col-md-3">
                                                <label class="form-group"> Caste</label>
                                             </div>
                                             <div class="col-md-3">
                                             <input type="text" class="form-group" name="txtcity" id="txtcity" value="{{\App\Helpers\Helper::getcaste($memdetails->Caste)}}" >
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                            <div class=" col-md-12">
                                                <div class="form-group col-md-3">
                                                    <label class="form-group">Religion</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                <input type="text" class="form-group" name="txtreligion" id="txtreligion" value="{{\App\Helpers\Helper::getreligion($memdetails->Rlgn)}}" >
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-group"> Qualification</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input type="text" class="form-group" name="txtqualification" id="txtqualification" value="{{\App\Helpers\Helper::getqualification($memdetails->QualificationId ?? 0)}}">
                                                </div>
                                            </div>
                                       </div>
                                       <div class="box-content"></div>
                                       <div class="ibox-title pt-3"><h5>Present Address</h5></div>
                                       <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <label class="form-group">Address</label>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <input type="text" class="form-group" name="txtpresentadd" id="txtpresentadd" value="{{$memdetails->ResAdd1}}{{$memdetails->ResAdd2}}" style="width:550px;" >
                                                </div>
                                            </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <label class="form-group">Village :</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input type="text" class="form-group" name="txtvillage" id="txtvillage" value="{{\App\Helpers\Helper::getvillage($memdetails->VillageId ?? 0)}}" >
                                                </div>
                                                <div class="form-group col-md-3">
                                                        <label class="form-group"> GP</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input type="text" class="form-group" name="txtgp" id="txtgp" Value="" >
                                                </div>
                                            </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <label class="form-group"> Block / Mun.</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input type="text" class="form-group" name="txtblock" id="txtblock" value="Guwahati" >
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-group"> District</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input type="text" class="form-group" name="txtblock" id="txtblock" value="Kamrup" >
                                                </div>

                                           </div>
                                       </div>

                                       <div class="row">
                                           <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <label class="form-group"> State</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input type="text" class="form-group" name="txtstate" id="txtstate" value="Assam" >
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-group"> Country</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input type="text" class="form-group" name="txtcountry" id="txtcountry" value="India" >
                                                </div>

                                           </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-12">
                                             <fieldset>
                                                <legend>Spouse & Guarantor:</legend>
                                                   <div class="form-group col-md-3">
                                                      <label class="form-group">Spouse</label>
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                      <input class="" type="text" name="name" id="name" value="{{$memdetails->Spouce}}">
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                      <label class="form-group"> Alive </label>
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                      <label>{{$memdetails->SpouseAlive}}</label>
                                                   </div>
                                             </fieldset>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group col-md-3">
                                                    <label class="form-group">Age</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input class="" type="text" name="name" id="name" value="{{$memdetails->SpouceAge}}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-group">D.O.B</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input class="" type="text" name="name" id="name" value="{{date('d-m-Y',strtotime($memdetails->SpouceDOB))}}">
                                                </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group col-md-3">
                                                    <label class="form-group">Guarantor</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input type="text" name="name" id="name" value="{{$memdetails->Guarantor}}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-group">Gender</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input class="" type="text" name="name" id="name" value="{{$memdetails->GSex}}">
                                                </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group col-md-3">
                                                    <label class="form-group">Age</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input type="text" name="name" id="name" value="{{$memdetails->GAge}}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-group">D.O.B</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input class="" type="text" name="name" id="name" value="{{$memdetails->GDOB}}">
                                                </div>
                                          </div>
                                       </div>
                                          <div>
                                          <!-- Nav tabs -->
                                          <ul class="nav nav-tabs" role="tablist">
                                             <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Economic</a></li>
                                             <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Business</a></li>
                                             <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Bank Account</a></li>

                                          </ul>
                                          <!-- Tab panes -->
                                          <div class="tab-content">
                                             <div role="tabpanel" class="tab-pane active" id="home">
                                                   <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group col-md-3">
                                                                <label class="form-group">Type of House</label>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <input type="text" name="name" id="name" value="{{\App\Helpers\Helper::gethousetype($memdetails->HouseType??0)}}">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-group">House Status</label>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <input class="" type="text" name="name" id="name" value="{{\App\Helpers\Helper::gethousestatus($memdetails->HouseStatus)}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group col-md-3">
                                                                    <label class="form-group">Roof Type</label>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <input type="text" name="name" id="name" value="">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label class="form-group">Wall Type</label>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <input class="" type="text" name="name" id="name" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group col-md-3">
                                                                    <label class="form-group">No of Rooms</label>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <input type="text" name="name" id="name" value="">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label class="form-group">Total Asset Value</label>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <input class="" type="text" name="name" id="name" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group col-md-3">
                                                                    <label class="form-group">Dependant Mem. Adult</label>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <input type="text" name="name" id="name" value="">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label class="form-group">Child</label>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <input class="" type="text" name="name" id="name" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                             </div>
                                             <div role="tabpanel" class="tab-pane" id="profile">adad</div>
                                             <div role="tabpanel" class="tab-pane" id="messages">...</div>
                                             <div role="tabpanel" class="tab-pane" id="settings">...</div>
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
                                             <div class="form-group col-md-3">
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
                                             <div class="form-group col-md-3">
                                                <label class="form-group"> Qualification</label>
                                             </div>
                                             <div class="row col-md-3">
                                                <select class="form-group" name="mstatus" id="mstatus">
                                                   <option value="0">Select </option>
                                                   <option value="1">Under graduate </option>
                                                   <option value="2">Graduate</option>
                                                   <option value="3">Post Graduate</option>
                                                   <option value="4">Illiterate</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="row col-md-12">
                                             <div class="form-group col-md-3">
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
                                             <div class="form-group col-md-3">
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
                                                <div class="form-group col-md-3">
                                                   <label class="form-group">Nominee </label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                   <input type="text" class="form-group" name="nominee" id="nominee" placeholder="Nominee Name">
                                                </div>
                                                <div class="form-group col-md-3">
                                                   <label class="form-group">Relation </label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                   <input type="text" class="form-group" name="nomineerelation" id="nomineerelation" placeholder="Relation ">
                                                </div>
                                          </div>
                                          <div class="row col-md-12">
                                                <div class="form-group col-md-3">
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
                                                <div class="form-group col-md-3">
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
@endsection
