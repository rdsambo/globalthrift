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
                            <li class=""><a data-toggle="tab" href="#tab-2">Personal Details</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3" id="changef">Address Details</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-4" id="changes">Other Details</a></li>
                         </ul>
                         <div class="solid-line"></div>
                    </div>
                    <form method="post" action={{route('admin.Empedit')}} enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content">
                                <div id="tab-2" class="tab-pane active">
                                    {{-- Personal Details --}}
                                    <legend></legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-1 col-form-label">Status</label>
                                                <div class="col-sm-2">
                                                    @if($values->activestatus==1)
                                                    <label style="color:green">Employee</label>
                                                    {{-- <label style="color:red">Ex. Employee</label> --}}
                                                    @else
                                                    <label style="color:red">Ex. Employee</label>
                                                    @endif
                                                </div>
                                                <label class="col-sm-2 col-form-label">Change Status</label>
                                                <div class="col-sm-3">
                                                    <input type="radio" id="html" name="status" value="1">
                                                    <label style="color:green">Activate</label>
                                                    <input type="radio" id="html" name="status" value="0">
                                                    <label style="color:red">Deactivate</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <legend></legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Name of Employee</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="title"value="{{$values->Title}}" required>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="first_Name"value="{{$values->EmpFirstName}}" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="middle_name"  value="{{$values->EmpMiddleName}}">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="last_Name" value="{{$values->EmpLastName}}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">designation&nbsp;&nbsp;({{$values->Designation}})</label>
                                                <div class="col-sm-3">
                                                    <select class="form-control" name="designation" required>
                                                        <option value="{{$values->DesignationID}}">--select---</option>
                                                        @foreach($designation as $de)
                                                        <option value="{{$de->DesignarionID}}">{{$de->Designation}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Department&nbsp;&nbsp;({{$values->Department}})</label>
                                                <div class="col-md-3">
                                                    <select class="form-control" name="department" required>
                                                        <option value="{{$values->DepartmentID}}" >--select---</option>
                                                        @foreach($department as $de)
                                                        <option value="{{$de->DepartmentID}}">{{$de->Department}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Employee Code</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" name="Employee_Code" required  value="{{$values->Employee_Code}}" >
                                                </div>
                                                <label class="col-sm-2 col-form-label">Grade&nbsp;&nbsp;({{$values->Grade}})</label>
                                                <div class="col-sm-3">
                                                    <select name="grade" class="form-control">
                                                        <option value="{{$values->Grade}}">Select</option>
                                                        <option value="I">I</option>
                                                        <option value="II">II</option>
                                                        <option value="III">III</option>
                                                        <option value="IV">IV</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Date of Joining</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="DOJ" required value="{{$values->DOJoining}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Date of Birth</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="DOB" id="dob" required  value="{{$values->DOB}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Date of Retirement</label>
                                                <div class="col-sm-3">
                                                    <input readonly type="text" class="form-control" name="DOR" id="dor" value="{{$values->DORetirement}}" required>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Email Id</label>
                                                <div class="col-sm-3">
                                                    <input type="text" type="text" class="form-control" name="Email" required value="{{$values->Email}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Section&nbsp;&nbsp;({{$values->Section}})</label>
                                                <div class="col-sm-3">
                                                    <select class="form-control" name="section" required>
                                                        <option value="{{$values->SectionID}}">--select---</option>
                                                            @foreach($section as $de)
                                                            <option value="{{$de->SectionID}}">{{$de->Section}}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Qualification</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="qualification" required value="{{$values->qualification}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Mobile number</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" name="Pnumber" required value="{{$values->Phone1}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Alternate number</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" name="Alt" required value="{{$values->Phone1}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Pan Card No</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" Name="PNo" required value="{{$values->PanNo}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">ESIC</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" Name="esic" required value="{{$values->ESIC}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Adhar</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" Name="AdharNo" value="{{$values->AdharNo}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-primary">Save</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-primary" id="one">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Information --}}
                                <div id="tab-3" class="tab-pane">
                                    <legend>Present Address</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Present Address</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="preadd" name="preadd" required value="{{$values->PresentAdd1}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Post Office</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="PO" name="PO" required value="{{$values->PrePO}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Police Station</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="PS" name="PS" required value="{{$values->PrePS}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">District</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="Dis" name="Dis" required value="{{$values->PreDIS}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">State</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="State" name="State" required value="{{$values->PreSTAT}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label"> Pin Code</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="zip" name="zip" required value="{{$values->PrePin}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <legend>Permanent Address</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Permanent Address</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="preadd1" name="preadd1"required value="{{$values->PermanantAaa}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Post Office</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="PO1" name="PO1" required value="{{$values->PerPO}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Police Station</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="PS1" name="PS1"required value="{{$values->PerPS}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">District</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="Dis1" name="Dis1" required value="{{$values->PerDIS}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">State</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="State1" name="State1" required value="{{$values->PerSTAT}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label"> Pin Code</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="zip1" name="zip1" required value="{{$values->PerPin}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-primary">Save</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-primary" id="two">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Documents --}}
                                <div id="tab-4" class="tab-pane">
                                    <legend>Bank Details:</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Bank Name</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" Name="BName" required value="{{$values->BankName}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">IFSC</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="IFSC" required value="{{$values->IFSC}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">A/C No</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" Name="AcNo" required value="{{$values->BankAc_No}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Branch Name</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="Branch" required value="{{$values->BranchName}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <legend>Salary Details:</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Basic Pay</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" Name="Bpay" required value="{{$values->BasicPay}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">TA</label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" name="TA" required value="{{$values->TA}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">DA</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" Name="DA" required value="{{$values->DA}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Change signature</label>
                                                <div class="col-sm-3">
                                                    <p><input type="file"  accept="image/*" name="signature" id="file"  onchange="loadFile(event)" style="display: none;" required></p>
                                                    <p><button><label for="file" style="cursor: pointer;" >choose file</label></button></p>
                                                    <p><img src="{{$values->signature}}"id="output" width="200" /></p>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Change Photo</label>
                                                <div class="col-md-3">
                                                    <p><input type="file"  accept="image/*" name="image" id="file2"  onchange="loadFile2(event)" style="display: none;" required></p>
                                                    <p><button><label for="file2" style="cursor: pointer;" >choose file</label></button></p>
                                                    <p><img src="{{$values->photo}}"id="output2" width="200" /></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <button id="submit" type="submit" name="Submit" class="btn btn-primary">Submit</button><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
       $("#one").click(function(){
        $("#changef").click();
       })
    })
    $(document).ready(function() {
       $("#two").click(function(){
        $("#changes").click();
       })
    })
var loadFile = function(event) {
	var signature = document.getElementById('output');
	signature.src = URL.createObjectURL(event.target.files[0]);
};
var loadFile2 = function(event) {
    var image = document.getElementById('output2');
    image.src = URL.createObjectURL(event.target.files[0]);
};
</script>
@endsection

