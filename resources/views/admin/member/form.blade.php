<div class="tab-content">
    <div id="tab-1" class="tab-pane active">
        <div class="panel-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <hr>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">LO</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="lomem" id="lomem">
                                @foreach ($eomember as $lomem)
                                    <option value="{{ $lomem->EOId }}" @isset($employee)
                                        {{ $employee->EOId == $lomem->EOId ? 'selected' : '' }} @endisset>
                                        {{ $lomem->EOName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Center</label>
                        <div class="col-md-3"><input type="text" class="form-control" name="centername" id="centername"placeholder="Center"></div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Group no</label>
                        <div class="col-md-3"><input type="text" class="form-control" name="groupno" id="groupno"
                                placeholder="membersrno" value="@isset($employee) {{ $employee->GroupCode ?? '' }}
                                @endisset" required ></div>
                        <label class="col-sm-2 col-form-label">Member Type</label>
                        <div class="col-sm-3">
                            <select class="form-control " name="memtype" id="memtype">
                                <option value="0" @isset($employee) {{ $employee->GroupName == 0 ? 'selected' : '' }}
                                    @endisset>Select</option>
                                <option value="DD Collection" @isset($employee)
                                    {{ $employee->GroupName == 'DD COLLECTION' ? 'selected' : '' }} @endisset>DD
                                    Collection
                                </option>
                                <option value="MD Collection" @isset($employee)
                                    {{ $employee->GroupName == 'MD COLLECTION' ? 'selected' : '' }} @endisset>MD
                                    Collection </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Target No</label>
                        <div class="col-md-3"><input readonly class="form-control" name="targetno" id="targetno" value="NA"
                                value="@isset($editprofile) {{ $editprofile->TargetNo ?? '' }}
                            @endisset" required></div>
                        <label class="col-sm-2 col-form-label">No of Share</label>
                        <div class="col-sm-3"><input type="text" class="form-control" name="nos" id="nos"></div>
                    </div>
                </div>
            </div>
            {{-- <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Amount</label>
                        <div class="col-md-3"> <label class="form-group" name="shareamount" id="shareamount"></label>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Admission Fee</label>
                        <div class="col-sm-3"><input type="text" class="form-control" name="admfee" id="admfee"
                        value="{{$feedetails[0]->amount}}" placeholder="Member serial no" required>
                        </div>
                        <label class="col-sm-2 col-form-label">Saleble Fee</label>
                        <div class="col-sm-3"><input type="text" class="form-control" name="admfee" id="admfee"
                        value="{{$feedetails[1]->amount}}" placeholder="Member serial no" required>
                        </div>
                        <div class="col-md-3"><input type="hidden" class="form-control" name="memberid" id="memberid"
                                placeholder="member id" value="@if(isset($editprofile)){{$editprofile->MemberId}}@else{{$memid->memberid}}@endif" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Member SrNo</label>
                        <div class="col-sm-3"><input type="text" class="form-control" name="membersrno" id="membersrno"
                                value="@isset($editprofile) {{ $editprofile->MemSrNo ?? '' }}@endisset"
                                placeholder="Member serial no" required>
                        </div>
                        <label class="col-sm-2 col-form-label">Membership No</label>
                        <div class="col-sm-3"><input type="text" class="form-control" name="membership_no" id="membership_no"
                                value="@isset($editprofile) {{ $editprofile->MemSrNo ?? '' }}@endisset"
                                placeholder="Membership No" required>
                        </div>
                       <input type="hidden" class="form-control" name="memberid" id="memberid" placeholder="member id" value="@if(isset($editprofile)){{$editprofile->MemberId}}@else{{$memid->memberid}}@endif" required>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Name [in BLOCK letters] </label>
                        <div class="col-md-3"><input type="text" class="form-control" name="txtfname" id="txtfname"
                                placeholder="Firstname" value="@isset($editprofile) {{ $first_name ?? '' }}@endisset"
                                required></div>
                        <div class="col-md-3"><input type="text" class="form-control" name="txtlname" id="txtlname"
                                placeholder="Lastname" value="@isset($editprofile) {{ $last_name ?? '' }}@endisset"
                                required></div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label"> S/o, W/o, D/o </label>
                        <div class="col-md-3"><input type="text" class="form-control" name="gname" id="gname"
                                placeholder="Guardian's name" required></div>
                        <label class="col-sm-2 col-form-label">Age</label>
                        <div class="col-sm-3"><input type="text" class="form-control" name="age" id="age" value="@isset($editprofile) {{ $editprofile->MemAge ?? '' }}
                           @endisset" placeholder="Age" required></div>
                    </div>
                </div>

            </div>
            <div class="form-group row">

                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label"> Date Of Birth </label>
                        <div class="col-md-3"><input type="text" class="form-control" name="dob" id="dob"
                                placeholder="DOB"></div>
                        <label class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-3"> <select class="form-control m-b" name="gender" id="memtype">
                                <option value="0">Select</option>
                                <option value="M">Male </option>
                                <option value="F">Female </option>

                            </select></div>
                    </div>
                </div>

            </div>
            <div class="form-group row">

                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label"> Marital Status </label>
                        <div class="col-md-3">
                            <select class="form-control" name="mstatus" id="mstatus">

                                <option value="0" @isset($editprofile) {{ $editprofile->Caste == 0 ? 'selected' : '' }}
                                    @endisset>Select</option>
                                <option value="1" @isset($editprofile) {{ $editprofile->Caste == 1 ? 'selected' : '' }}
                                    @endisset>Married</option>
                                <option value="2" @isset($editprofile) {{ $editprofile->Caste == 2 ? 'selected' : '' }}
                                    @endisset>Unmarried</option>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Religion </label>
                        <div class="col-md-3">
                            <select class="form-control" name="mreligion" id="mreligion">
                                <option value="0" @isset($editprofile) {{ $editprofile->Rlgn == 0 ? 'selected' : '' }}
                                    @endisset>Select</option>
                                <option value="1" @isset($editprofile) {{ $editprofile->Rlgn == 1 ? 'selected' : '' }}
                                    @endisset>Hindu</option>
                                <option value="2" @isset($editprofile) {{ $editprofile->Rlgn == 2 ? 'selected' : '' }}
                                    @endisset>Muslim</option>
                                <option value="3" @isset($editprofile) {{ $editprofile->Rlgn == 3 ? 'selected' : '' }}
                                    @endisset>Christian</option>
                                <option value="4" @isset($editprofile) {{ $editprofile->Rlgn == 4 ? 'selected' : '' }}
                                    @endisset>Sikh</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Caste </label>
                        <div class="col-md-3">
                            <select class="form-control" name="mstatus" id="mstatus">
                                <option value="0" @isset($editprofile) {{ $editprofile->Caste == 0 ? 'selected' : '' }}
                                    @endisset>Select</option>
                                <option value="1" @isset($editprofile) {{ $editprofile->Caste == 1 ? 'selected' : '' }}
                                    @endisset>General</option>
                                <option value="2" @isset($editprofile) {{ $editprofile->Caste == 2 ? 'selected' : '' }}
                                    @endisset>SC</option>
                                <option value="3" @isset($editprofile) {{ $editprofile->Caste == 3 ? 'selected' : '' }}
                                    @endisset>ST</option>
                                <option value="4" @isset($editprofile) {{ $editprofile->Caste == 4 ? 'selected' : '' }}
                                    @endisset>OBC</option>
                                <option value="5" @isset($editprofile) {{ $editprofile->Caste == 5 ? 'selected' : '' }}
                                    @endisset>OTHERS</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group row">

                <div class="col-sm-12">
                    <div class="row">

                        <label class="col-sm-2 col-form-label">Name of Introducer </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="introducer_name" id="introducer_name"
                                placeholder="Introducer Name">
                        </div>
                        <label class="col-sm-2 col-form-label">Introducer's membership no </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="introducer_membership_no"
                                id="introducer_membership_no" placeholder="Introducer's Membership No">
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group row">

                <div class="col-sm-12">
                    <div class="row">

                        <label class="col-sm-2 col-form-label">Introducer's Account No </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="introducers_account_no"
                                id="introducers_account_no" placeholder="Introducer's Account No">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div id="tab-2" class="tab-pane">
        <div class="panel-body">
            <div class="ibox-title">
                <h5>Present/Correspondence Address:</h5>
            </div>
            <div class="form-group row">

                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">House No </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="txtpresenthouseno" id="txtpresenthouseno"
                                placeholder="HNO" value="@isset($editprofile) {{ $editprofile->ResAdd1 ?? '' }}
                                @endisset" required>
                        </div>
                        <label class="col-sm-2 col-form-label">Road Name </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="txtroadname" id="txtroadname"
                                placeholder="Road Name" value="@isset($editprofile) {{ $editprofile->ResAdd2 ?? '' }}
                                @endisset" required>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group row">

                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Locality </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="txtlocality" id="txtlocality"
                                placeholder="Locality" required>
                        </div>
                        <label class="col-sm-2 col-form-label">City </label>
                        <div class="col-md-3">
                            <input readonly class="form-control" name="txtcity" id="txtcity" value="Kamrup(M)"
                                required>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Pincode </label>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="txtpincode" id="txtpincode"
                                placeholder="Pincode" required>
                        </div>
                        <label class="col-sm-2 col-form-label">District </label>
                        <div class="col-md-3">
                            <input readonly class="form-control" name="txtdistrict" id="txtdistrict"
                                value="Kamrup(M)" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">State </label>
                        <div class="col-md-3">
                            <input readonly class="form-control" name="textstate" id="textstate"
                                value="Assam" required>
                        </div>
                        <label class="col-sm-2 col-form-label">Country </label>
                        <div class="col-md-3">
                            <input readonly class="form-control" name="textcountry" id="textcountry"
                                value="India" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row col-md-12">
                <input type="checkbox" name="chksame" id="chksame" class="form-group col-md-1">Same as present
            </div>
            <div class="box-content"></div>
            <div class="ibox-title pt-3">
                <h5>Permanent Address</h5>
            </div>
            <div class="form-group row">

                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">House No </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="txtpermahouseno" id="txtpermahouseno"
                                placeholder="HNO" required>
                        </div>
                        <label class="col-sm-2 col-form-label">Road Name </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="txtpermaroadname" id="txtpermaroadname"
                                placeholder="Road Name" required>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group row">

                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Locality </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name=" txtpermalocality" id="txtpermalocality"
                                placeholder="Locality" required>
                        </div>
                        <label class="col-sm-2 col-form-label">City</label>
                        <div class="col-md-3">
                            <input readonly class="form-control" name="txtpermacity" id="txtpermacity"
                                value="Kamrup(M)" required>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Pincode </label>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="txtpermapincode" id="txtpermapincode"
                                placeholder="Pincode" required>
                        </div>
                        <label class="col-sm-2 col-form-label">District</label>
                        <div class="col-md-3">
                            <input readonly class="form-control" name="txtpermadistrict" id="txtpermadistrict"
                            value="Kamrup(M)">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">State </label>
                        <div class="col-md-3">
                            <input readonly class="form-control" name="txtpermastate" id="txtpermastate"
                                value="Assam" required>
                        </div>
                        <label class="col-sm-2 col-form-label">Country </label>
                        <div class="col-md-3">
                            <input readonly class="form-control" name="txtpermacountry" id="txtpermacountry"
                                value="India" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-content"></div>
            <div class="ibox-title pt-4">
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nationality </label>
                <div class="col-sm-3">
                    <select class="form-control m-b" name="nationality" id="nationality">
                        <option value="0" @isset($editprofile) {{ $editprofile->nationality == 0 ? 'selected' : '' }}
                            @endisset>Select</option>
                        <option value="1" @isset($editprofile) {{ $editprofile->nationality == 1 ? 'selected' : '' }}
                            @endisset>Indian</option>
                        <option value="2" @isset($editprofile) {{ $editprofile->nationality == 2 ? 'selected' : '' }}
                            @endisset>Others</option>
                    </select>
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
                <div class="ibox-title pt-4">
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Occupation </label>
                            <div class="col-md-3">
                                <select class="form-control" name="occupation" id="occupation">
                                    <option value="0" @isset($editprofile)
                                        {{ $editprofile->OccupationId == 0 ? 'selected' : '' }} @endisset>Select
                                    </option>
                                    <option value="1" @isset($editprofile)
                                        {{ $editprofile->OccupationId == 1 ? 'selected' : '' }} @endisset>Self Employed
                                    </option>
                                    <option value="2" @isset($editprofile)
                                        {{ $editprofile->OccupationId == 2 ? 'selected' : '' }} @endisset>Employee
                                    </option>
                                    <option value="3" @isset($editprofile)
                                        {{ $editprofile->OccupationId == 3 ? 'selected' : '' }} @endisset>Others
                                    </option>
                                </select>
                            </div>
                            <label class="col-sm-2 col-form-label">Qualification</label>
                            <div class="col-md-3">
                                <select class="form-control " name="mqualification" id="mqualification">
                                    <option value="0" @isset($editprofile)
                                        {{ $editprofile->OccupationId == 0 ? 'selected' : '' }} @endisset>Select
                                    </option>
                                    <option value="1" @isset($editprofile)
                                        {{ $editprofile->OccupationId == 1 ? 'selected' : '' }} @endisset>Under graduate
                                    </option>
                                    <option value="2" @isset($editprofile)
                                        {{ $editprofile->OccupationId == 2 ? 'selected' : '' }} @endisset>Graduate
                                    </option>
                                    <option value="3" @isset($editprofile)
                                        {{ $editprofile->OccupationId == 3 ? 'selected' : '' }} @endisset>Post Graduate
                                    </option>
                                    <option value="4" @isset($editprofile)
                                        {{ $editprofile->OccupationId == 4 ? 'selected' : '' }} @endisset>Illiterate
                                    </option>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Annual Income</label>
                            <div class="col-md-3">
                                <select class="form-control " name="occupation" id="occupation">
                                    <option value="0">Select </option>
                                    <option value="1">Upto 50000 </option>
                                    <option value="2">50000 - 100000</option>
                                    <option value="3">1 - 2 lakhs</option>
                                    <option value="4">2 - 5 lakhs</option>
                                    <option value="5">Above 5 Lakhs</option>
                                </select>
                            </div>
                            <label class="col-sm-2 col-form-label">Asset Owned</label>
                            <div class="col-md-3">
                                <select class="form-control " name="mstatus" id="mstatus">
                                    <option value="0">Select </option>
                                    <option value="1">House </option>
                                    <option value="2">Land</option>
                                    <option value="3">Car</option>
                                    <option value="4">Two Wheeler</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Bank Name</label>
                            <div class="col-md-3">
                                <input type="text" name="bank" value="@isset($editprofile) {{ $editprofile->BankName ?? '' }}
                                @endisset" class="form-control">
                            </div>
                            <label class="col-sm-2 col-form-label">Branch</label>
                            <div class="col-md-3">
                                <input type="text" name="branch" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Account No</label>
                            <div class="col-md-3">
                                <input type="text" name="bankaccountno" value="@isset($editprofile) {{ $editprofile->acno ?? '' }}
                                @endisset" class="form-control">
                            </div>
                            <label class="col-sm-2 col-form-label">Type Of Account/s</label>
                            <div class="col-md-3">
                                <input type="text" name="bankaccountno" value="@isset($editprofile) {{ $editprofile->acno ?? '' }}
                                @endisset" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Spouse</label>
                            <div class="col-md-3">
                                <input type="text" name="spouse" value="@isset($editprofile) {{ $editprofile->Spouce ?? '' }}
                                @endisset" class="form-control">
                            </div>
                            <label class="col-sm-2 col-form-label">Spouse Age</label>
                            <div class="col-md-3">
                                <input type="text" name="spage" value="@isset($editprofile) {{ $editprofile->SpouceAge ?? '' }}
                                @endisset" class="form-control">
                            </div>

                        </div>

                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-sm-12">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Nominee</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="nominee" id="nominee" value="@isset($editprofile) {{ $editprofile->NomName ?? '' }}
                                @endisset" placeholder="Nominee Name" required>
                            </div>

                            <label class="col-sm-2 col-form-label">Relation</label>
                            <div class="col-md-3">
                                <select class="form-control m-b" name="nomrelation" id="nomrelation">
                                    <option value="0" @isset($editprofile)
                                        {{ $editprofile->NomRelationId == 0 ? 'selected' : '' }} @endisset>Select
                                    </option>
                                    <option value="1" @isset($editprofile)
                                        {{ $editprofile->NomRelationId == 1 ? 'selected' : '' }} @endisset>Father
                                    </option>
                                    <option value="2" @isset($editprofile)
                                        {{ $editprofile->NomRelationId == 2 ? 'selected' : '' }} @endisset>Mother
                                    </option>
                                    <option value="3" @isset($editprofile)
                                        {{ $editprofile->NomRelationId == 3 ? 'selected' : '' }} @endisset>Wife
                                    </option>
                                    <option value="4" @isset($editprofile)
                                        {{ $editprofile->NomRelationId == 4 ? 'selected' : '' }} @endisset>Husband
                                    </option>
                                    <option value="5" @isset($editprofile)
                                        {{ $editprofile->NomRelationId == 5 ? 'selected' : '' }} @endisset>Son
                                    </option>
                                    <option value="6" @isset($editprofile)
                                        {{ $editprofile->NomRelationId == 6 ? 'selected' : '' }} @endisset>Daughter
                                    </option>
                                    <option value="7" @isset($editprofile)
                                        {{ $editprofile->NomRelationId == 7 ? 'selected' : '' }} @endisset>Brother
                                    </option>
                                </select>

                            </div>
                        </div>
                    </div>

                </div>


                <div class="form-group row">

                    <div class="col-sm-12">
                        {{-- <div class="row">
                            @if ($submit == 'Add')
                                <label class="col-sm-3 col-form-label">Photograph</label>
                                <div class="col-md-3">
                                    <input type="file" class="form-group" name="memphoto" id="memphoto">
                                </div>
                            @endif
                            <label class="col-sm-3 col-form-label">Signature</label>
                            <div class="col-md-3">
                                <input type="file" class="form-group" name="signature" id="signature">
                            </div>

                        </div>
                        <div class="row">

                            <label class="col-sm-3 col-form-label">Adhaar Card</label>
                            <div class="col-md-3">
                                <input type="file" class="form-group" name="adhaar" id="adhaar">
                            </div>

                            <label class="col-sm-3 col-form-label">Voter Card</label>
                            <div class="col-md-3">
                                <input type="file" class="form-group" name="votercard" id="votercard">
                            </div>

                        </div>
                        <div class="row">

                            <label class="col-sm-3 col-form-label">Passport</label>
                            <div class="col-md-3">
                                <input type="file" class="form-group" name="passport" id="passport">
                            </div>

                            <label class="col-sm-3 col-form-label">Ration Card</label>
                            <div class="col-md-3">
                                <input type="file" class="form-group" name="ration" id="ration">
                            </div>

                        </div>
                        <div class="row">

                            <label class="col-sm-3 col-form-label">Pan Card</label>
                            <div class="col-md-3">
                                <input type="file" class="form-group" name="pancard" id="pancard">
                            </div>

                            <label class="col-sm-3 col-form-label">Driving License</label>
                            <div class="col-md-3">
                                <input type="file" class="form-group" name="driving" id="driving">
                            </div>

                        </div> --}}

                    </div>

                </div>


                <br>
                <div class="row">
                    <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Profile Photo</h5>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" class="img-responsive" value="@isset($memberdocument){{$memberdocument->photo??''}}@endisset"
                                    @if($submit=="Update") src="{{$memberdocument->photo?? asset('dist/images/SD-default-image.png')}}" @else src="{{ asset('dist/images/SD-default-image.png') }}" @endif ">
                                    <label>Upload Photo [Optional] </label>
                                    <input type="file" name="memberphoto" id="memberphoto" class="border-left-right">
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Upload Signature</h5>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" class="img-responsive" value="@isset($memberdocument){{$memberdocument->signature??''}}@endisset"
                                    @if($submit=="Update") src="{{$memberdocument->signature?? asset('dist/images/SD-default-image.png')}}" @else src="{{ asset('dist/images/SD-default-image.png') }}" @endif >
                                    <label>Upload Photo [Optional] </label>
                                    <input type="file" name="signature" id="signature" class="border-left-right">
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Upload Adhaar Card</h5>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" class="img-responsive" value="@isset($memberdocument){{$memberdocument->adhaar??''}}@endisset"
                                    @if($submit=="Update") src="{{$memberdocument->adhaar?? asset('dist/images/SD-default-image.png')}}" @else src="{{ asset('dist/images/SD-default-image.png') }}" @endif >
                                    <label>Upload Photo [Optional] </label>
                                    <input type="file" name="adhaar" id="adhaar" class="border-left-right">
                                </div>

                            </div><br>
                            <label class="col-sm-9 col-form-label">Adhaar Card No</label>
                            <input type="text" class="form-control" name="adhaar_card_no" id="adhaar_card_no" value="@isset($editprofile) {{ $editprofile->adhaar_card_no ?? '' }}
                            @endisset"
                            placeholder="Adhaar Card No">
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Upload Driving Card</h5>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" class="img-responsive" value="@isset($memberdocument){{$memberdocument->drivinglic??''}}@endisset"
                                    @if($submit=="Update") src="{{$memberdocument->drivinglic?? asset('dist/images/SD-default-image.png')}}" @else src="{{ asset('dist/images/SD-default-image.png') }}" @endif >
                                    <label>Upload Photo [Optional] </label>
                                    <input type="file" name="driving" id="driving" class="border-left-right">
                                </div>

                            </div>
                            <br>
                            <label class="col-sm-9 col-form-label">Driving Licence No</label>
                            <input type="text" class="form-control" name="driving_licence_no" id="driving_licence_no" value="@isset($editprofile) {{ $editprofile->driving_licence_no ?? '' }}
                            @endisset"
                            placeholder="Driving Licence No">

                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Upload Pancard</h5>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" class="img-responsive" value="@isset($memberdocument){{$memberdocument->pancard??''}}@endisset"
                                    @if($submit=="Update") src="{{$memberdocument->pancard?? asset('dist/images/SD-default-image.png')}}" @else src="{{ asset('dist/images/SD-default-image.png') }}" @endif >
                                    <label>Upload Photo [Optional] </label>
                                    <input type="file" name="pancard" id="pancard" class="border-left-right">
                                </div>

                            </div>
                            <br>
                            <label class="col-sm-9 col-form-label">Pancard No</label>
                            <input type="text" class="form-control" name="pancard_no" id="pancard_no" value="@isset($editprofile) {{ $editprofile->pancard_no ?? '' }}
                            @endisset"
                            placeholder="Pancard No">
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Upload Ration Card</h5>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" class="img-responsive" value="@isset($memberdocument){{$memberdocument->ration??''}}@endisset"
                                    @if($submit=="Update") src="{{$memberdocument->ration?? asset('dist/images/SD-default-image.png')}}" @else src="{{ asset('dist/images/SD-default-image.png') }}" @endif ">
                                    <label>Upload Photo [Optional] </label>
                                    <input type="file" name="ration" id="ration" class="border-left-right">
                                </div>

                            </div>
                            <br>
                            <label class="col-sm-9 col-form-label">Ration No</label>
                            <input type="text" class="form-control" name="ration_card_no" id="ration_card_no" value="@isset($editprofile) {{ $editprofile->ration_card_no ?? '' }}
                            @endisset"
                            placeholder="Ration Card No">
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Passport Photo</h5>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" class="img-responsive" value="@isset($memberdocument){{$memberdocument->passport??''}}@endisset"
                                       @if($submit=="Update") src="{{$memberdocument->passport ?? asset('dist/images/SD-default-image.png')}}" @else src="{{ asset('dist/images/SD-default-image.png') }}" @endif >
                                    <label>Upload Photo [Optional] </label>
                                    <input type="file" name="passport" id="passport" class="border-left-right">
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Voter Card Photo</h5>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" class="img-responsive" value="@isset($memberdocument){{$memberdocument->voter??''}}@endisset"
                                    @if($submit=="Update") src="{{$memberdocument->voter?? asset('dist/images/SD-default-image.png')}}" @else src="{{ asset('dist/images/SD-default-image.png') }}" @endif>
                                    <label>Upload Photo [Optional] </label>
                                    <input type="file" name="votercard" id="votercard" class="border-left-right">
                                </div>

                            </div>
                            <br>
                            <label class="col-sm-9 col-form-label">Voter Card No</label>
                            <input type="text" class="form-control" name="voter_card_no" id="voter_card_no" value="@isset($editprofile) {{ $editprofile->voter_card_no ?? '' }}
                            @endisset"
                            placeholder="Voter Card No">
                        </div>

                    </div>
                    {{-- <div class="row col-md-12">
                        <button type="submit" class="btn btn-success" style="float-right"> <i class="fa fa-arrow-circle-right fa-lg"></i>Save</button>
                     </div> --}}
                </div>




            </div>
        </div>
    </div>
</div>
