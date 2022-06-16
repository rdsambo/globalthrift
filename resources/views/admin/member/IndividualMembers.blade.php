@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                           <h3>Member Details -</h3>
                        </div>
                <div class="ibox-content">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class=""><a data-toggle="tab" href="#tab-2">Member Details</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3">Personal Information</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-4">Documents</a></li>
                         </ul>
                         <div class="solid-line"></div>
                    </div>

                        <div class="tab-content">
                                <div id="tab-2" class="tab-pane active">
                                    {{-- Member Details --}}
                                    <legend></legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Name of Member</label>
                                                <div class="col-sm-3">
                                                    {{-- {{$member->MemberName}} --}}
                                                    <input readonly class="form-control" placeholder="{{$member->MemberName}} ">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Member Id</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" id='memId' placeholder="{{$member->MemberId}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Member No</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->MemberNo}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Admission Date</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="{{$member->AdmissionDate}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">LO Name</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->EOName}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Group Name</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="{{$member->GroupName}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Group No</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->GroupId}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Group Name</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="Center">
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <legend>nominee:</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Nominee name</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->NomName}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Age</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="{{$member->NomAge}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">sex</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->NomSex}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Date Of Birth</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="{{$member->NomDOB}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Relation With Member</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->relation}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Information --}}
                                <legend></legend>
                                <div id="tab-3" class="tab-pane">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Full Name</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->MemberName}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Age</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="{{$member->MemAge}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">date of Birth</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->MemberDOB}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Retired Date</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="Center">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Gender</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->Gender}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Caste</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="{{$member->Caste}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Occupation</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->occupation}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Qualification</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="{{$member->Qualification}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <legend>Spouse & Guarantor:</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Sopuse Name</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->Spouce}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Alive</label>
                                                <div class="col-md-3">{{$member->SpouseAlive}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Spouse Age</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->SpouceAge}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Spouse Dob</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="{{$member->SpouceDOB}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">gauranter Name</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->Guarantor}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">gauranter Age</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="{{$member->GAge}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <legend>Present Address:</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-8">
                                                    <input readonly class="form-control" placeholder="{{$member->PerAdd1}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Village</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->villagename}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Pin</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="{{$member->Pin}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Block/Mun.</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->VillageId}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">District</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="{{$member->District}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">State</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" placeholder="{{$member->State}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Country</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" placeholder="{{$member->country}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Documents --}}
                                {{-- <div id="tab-4" class="tab-pane">
                                    <div class="col-sm-6">
                                        <div class="ibox-content">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-4 col-form-label">Photo</label>
                                                        <div class="col-sm-6">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button name="radio" class="btn btn-primary" type="radio" id="standard_1" onClick="openPhoto('{{$document->photo}}')" value="radio"/>view
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-4 col-form-label">Signature</label>
                                                        <div class="col-sm-6">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button name="radio" class="btn btn-primary" type="radio" id="standard_2" onClick="openPhoto('{{$document->signature}}')" value="radio"/>view
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-4 col-form-label">Adhaar Card No</label>
                                                        <div class="col-sm-6">
                                                            <input readonly class="form-control" placeholder="{{$member->adhaar_card_no}}">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button name="radio" class="btn btn-primary" type="radio" id="standard_3" onClick="openPhoto('{{$document->adhaar}}')" value="radio"/>view
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-4 col-form-label">	Driving Licence No</label>
                                                        <div class="col-sm-6">
                                                            <input readonly class="form-control" placeholder="{{$member->driving_licence_no}}">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button name="radio" class="btn btn-primary" type="radio" id="standard_4" onClick="openPhoto('{{$document->drivinglic}}')" value="radio"/>view
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-4 col-form-label">Pancard No</label>
                                                        <div class="col-sm-6">
                                                            <input readonly class="form-control" placeholder="{{$member->pancard_no}}">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button name="radio" class="btn btn-primary" type="radio" id="standard_5" onClick="openPhoto('{{$document->pancard}}')" value="radio"/>view
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-4 col-form-label">Ration Card No</label>
                                                        <div class="col-sm-6">
                                                            <input readonly class="form-control" placeholder="{{$member->ration_card_no}}">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button name="radio" class="btn btn-primary" type="radio" id="standard_6" onClick="openPhoto('{{$document->ration}}')" value="radio"/>view
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-4 col-form-label">	Voter Card No</label>
                                                        <div class="col-sm-6">
                                                            <input readonly class="form-control" placeholder="{{$member->voter_card_no}}">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button name="radio" class="btn btn-primary" type="radio" id="standard_7" onClick="openPhoto('{{$document->voter}}')" value="radio"/>view
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="ibox-content">
                                            <div class="form-group col-md-4" >
                                                <img id="photo" src="" alt="no image found" width="460" height="345">
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
function openPhoto(y) {
   $('#photo').attr('src',y);
}
</script>
@endsection


