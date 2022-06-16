@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                    <form method="post" id ="form-print">
                        <div class="ibox-title">
                           <h3>Member Details </h3>
                        </div>
                <div class="ibox-content">

                        @csrf
                        <div class="tab-content">
                                    {{-- Personal Details --}}
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Name of Employee</label>
                                                <div class="col-sm-2">
                                                    <input readonly class="form-control" name="Title"value="{{$values->Title}}" >
                                                </div>
                                                <div class="col-sm-2">
                                                    <input readonly class="form-control" name="first_Name"value="{{$values->EmpFirstName}}" >
                                                </div>
                                                <div class="col-md-2">
                                                    <input readonly class="form-control" name="middle_name"  value="{{$values->EmpMiddleName}}">
                                                </div>
                                                <div class="col-md-2">
                                                    <input readonly class="form-control" name="last_Name" value="{{$values->EmpLastName}}" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">designation</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" name="designation" value="{{$values->Designation}}" >
                                                </div>
                                                <label class="col-sm-2 col-form-label">Department</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" name="department" value="{{$values->Department}}" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Employee Code</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" name="Employee_Code"   value="{{$values->Employee_Code}}" >
                                                </div>
                                                <label class="col-sm-2 col-form-label">Grade</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" name="grade"   value="{{$values->Grade}}" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Date of Joining</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" name="DOJ"  value="{{$values->DOJoining}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Date of Birth</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" name="DOB" id="dob"   value="{{$values->DOB}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Date of Retirement</label>
                                                <div class="col-sm-3">
                                                    <input readonly readonly class="form-control" name="DOR" id="dor" value="{{$values->DORetirement}}" >
                                                </div>
                                                <label class="col-sm-2 col-form-label">Email Id</label>
                                                <div class="col-sm-3">
                                                    <input readonly readonly class="form-control" name="Email"  value="{{$values->Email}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Section</label>
                                                <div class="col-sm-3">
                                                    <input readonly readonly class="form-control" name="Email"  value="{{$values->Section}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Qualification</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" name="qualification"  value="{{$values->qualification}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Mobile number</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" name="number"  value="{{$values->Phone1}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Alternate number</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" name="Alt"  value="{{$values->Phone1}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Pan Card No</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" Name="PNo"  value="{{$values->PanNo}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">ESIC</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" Name="esic"  value="{{$values->ESIC}}">
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
                                    <legend>Present Address:</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Present Address</label>
                                                <div class="col-sm-8">
                                                    <input readonly class="form-control" id="preadd" name="preadd"  value="{{$values->PresentAdd1}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Post Office</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" id="PO" name="PO"  value="{{$values->PrePO}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Police Station</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" id="PS" name="PS"  value="{{$values->PrePS}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">District</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" id="Dis" name="Dis"  value="{{$values->PreDIS}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">State</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" id="State" name="State"  value="{{$values->PreSTAT}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label"> Pin Code</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" id="zip" name="zip"  value="{{$values->PrePin}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <legend>Permanent Address:</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Permanent Address</label>
                                                <div class="col-sm-8">
                                                    <input readonly class="form-control" id="preadd1" name="preadd1" value="{{$values->PermanantAaa}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Post Office</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" id="PO1" name="PO1"  value="{{$values->PerPO}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Police Station</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" id="PS1" name="PS1" value="{{$values->PerPS}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">District</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" id="Dis1" name="Dis1"  value="{{$values->PerDIS}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">State</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" id="State1" name="State1"  value="{{$values->PerSTAT}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label"> Pin Code</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" id="zip1" name="zip1"  value="{{$values->PerPin}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <legend>Bank Details:</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Bank Name</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" Name="BName"  value="{{$values->BankName}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">IFSC</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" name="IFSC"  value="{{$values->IFSC}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">A/C No</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" Name="AcNo"  value="{{$values->BankAc_No}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Branch Name</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" name="Branch"  value="{{$values->BranchName}}">
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
                                                    <input readonly class="form-control" Name="Bpay"  value="{{$values->BasicPay}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">TA</label>
                                                <div class="col-md-3">
                                                    <input readonly class="form-control" name="TA"  value="{{$values->TA}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">DA</label>
                                                <div class="col-sm-3">
                                                    <input readonly class="form-control" Name="DA"  value="{{$values->DA}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <legend>Image & Signature:</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Image</label>
                                                <div class="col-sm-3">
                                                    <img src="{{$values->signature}}" weidth="200">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Signature</label>
                                                <div class="col-md-3">
                                                    <img src="{{$values->photo}}" weidth="200">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </form>

                </div>
            </div>
            <input type="button" class="btn btn-primary" onclick="GeneratePdf();" value="GeneratePdf">
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src=
"https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.1/html2pdf.bundle.min.js"
        integrity=
"sha512vDKWohFHe2vkVWXHp3tKvIxxXg0pJxeid5eo+UjdjME3DBFBn2F8yWOE0XmiFcFbXxrEOR1JriWEno5Ckpn15A=="
        crossorigin="anonymous">
    </script>
<script>
    // Function to GeneratePdf
    function GeneratePdf() {
        var element = document.getElementById('form-print');
        html2pdf(element);
    }
</script>

<script src=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity=
"sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
    crossorigin="anonymous">
</script>
@endsection

