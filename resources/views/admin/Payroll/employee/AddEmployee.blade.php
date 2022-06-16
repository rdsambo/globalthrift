@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                           <h3>Employee Details -</h3>
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
                        <form method="post" action={{route('admin.EmpAdd')}} enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content">
                                <div id="tab-2" class="tab-pane active">
                                    {{-- Personal Details --}}
                                    <legend></legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Name of Employee</label>
                                                <div class="col-sm-2">
                                                    <select class="form-control"  name="title" required>
                                                        <option value="Mr.">Mr.</option>
                                                        <option value="Mrs.">Mrs.</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="first_Name"placeholder="First Name" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="middle_name"  placeholder="Middle Name">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="last_Name" placeholder="Last Name" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">designation</label>
                                                <div class="col-sm-3">
                                                    <select class="form-control" name="designation" required>
                                                        <option value="">--select---</option>
                                                        @foreach($designation as $de)
                                                        <option value="{{$de->DesignarionID}}">{{$de->Designation}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Department</label>
                                                <div class="col-md-3">
                                                    <select class="form-control" name="department" required>
                                                        <option value="">--select---</option>
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
                                                    <input type="text" class="form-control" name="Employee_Code" required>
                                                    @error('Employee_Code')
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                                <label class="col-sm-2 col-form-label">Grade</label>
                                                <div class="col-sm-3">
                                                    <select name="grade" class="form-control">
                                                        <option>select</option>
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
                                                    <input type="date" class="form-control" name="DOJ" required>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Date of Birth</label>
                                                <div class="col-md-3">
                                                    <input type="date" class="form-control" name="DOB" id="dob" required >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Salary Starting Month</label>
                                                <div class="col-sm-3">
                                                    <select class="form-control" required name="month">
                                                        <option value='1'>January</option>
                                                        <option value='2'>Feb</option>
                                                        <option value='3'>Mar</option>
                                                        <option value='4'>Apr</option>
                                                        <option value='5'>May</option>
                                                        <option value='6'>Jun</option>
                                                        <option value='7'>Jul</option>
                                                        <option value='8'>Aug</option>
                                                        <option value='9'>Sep</option>
                                                        <option value='10'>Oct</option>
                                                        <option value='11'>Nov</option>
                                                        <option value='12'>Dec</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Salary Starting Year</label>
                                                <div class="col-md-3">
                                                    <input type="number" name="year" min="2000" max="2099" step="1" value="2021" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Date of Retirement</label>
                                                <div class="col-sm-3">
                                                    <input readonly type="text" class="form-control" name="DOR" id="dor" required>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Email Id</label>
                                                <div class="col-sm-3">
                                                    <input type="text" type="text" class="form-control" name="Email" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Section</label>
                                                <div class="col-sm-3">
                                                    <select class="form-control" name="section" required>
                                                        <option value="">--select---</option>
                                                            @foreach($section as $de)
                                                            <option value="{{$de->SectionID}}">{{$de->Section}}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Qualification</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="qualification" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Mobile number</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" name="Pnumber" required>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Alternate number</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" name="Alt" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Pan Card No</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" Name="PNo" required>
                                                </div>
                                                <label class="col-sm-2 col-form-label">ESIC</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" Name="esic" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Adhar</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" Name="AdharNo" required>
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
                                                    <input type="text" class="form-control" id="preadd" name="preadd" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Post Office</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="PO" name="PO" required>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Police Station</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="PS" name="PS" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">District</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="Dis" name="Dis" required>
                                                </div>
                                                <label class="col-sm-2 col-form-label">State</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="State" name="State" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label"> Pin Code</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="zip" name="zip" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <legend>Permanent Address</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label"> Same as Peresent</label>
                                                <div class="col-sm-1">
                                                    <input type="checkbox" id="sameas">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Permanent Address</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="preadd1" name="preadd1"required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Post Office</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="PO1" name="PO1" required>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Police Station</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="PS1" name="PS1"required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">District</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="Dis1" name="Dis1" required>
                                                </div>
                                                <label class="col-sm-2 col-form-label">State</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="State1" name="State1" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label"> Pin Code</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="zip1" name="zip1" required>
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
                                                    <input type="text" class="form-control" Name="BName" required>
                                                </div>
                                                <label class="col-sm-2 col-form-label">IFSC</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="IFSC" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">A/C No</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" Name="AcNo" required>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Branch Name</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="Branch" required>
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
                                                    <input type="number" class="form-control" Name="Bpay" required>
                                                </div>
                                                <label class="col-sm-2 col-form-label">DA</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" Name="DA" required>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">TA</label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" name="TA" required>
                                                </div>
                                                {{-- <label class="col-sm-2 col-form-label">Grade Pay</label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" name="Gpay" required>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <legend>Photo & Signature</legend>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Upload signature</label>
                                                <div class="col-sm-3">
                                                    <p><input type="file"  accept="image/*" name="signature" id="file"  onchange="loadFile(event)" style="display: none;" required></p>
                                                    <p><button><label for="file" style="cursor: pointer;" >choose file</label></button></p>
                                                    <p><img id="output" width="200" /></p>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Upload Photo</label>
                                                <div class="col-md-3">
                                                    <p><input type="file"  accept="image/*" name="image" id="file2"  onchange="loadFile2(event)" style="display: none;" required></p>
                                                    <p><button><label for="file2" style="cursor: pointer;" >choose file</label></button></p>
                                                    <p><img id="output2" width="200" /></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
       $("#dob").change(function(){
        var date=$("#dob").val();
        split_date = date.split("-");
        convertedDate = split_date[2]+"/"+split_date[1]+"/"+split_date[0];
        calaculateYears(convertedDate);
       })
    })
</script>
<script>
$( document ).ready(function() {
  $("#sameas").click(function(){
    var get1=$("#preadd").val();
    var get2=$("#PO").val();
    var get3=$("#PS").val();
    var get4=$("#Dis").val();
    var get5=$("#State").val();
    var get6=$("#zip").val();

    $("#preadd1").val(get1);
    $("#PO1").val(get2);
    $("#PS1").val(get3);
    $("#Dis1").val(get4);
    $("#State1").val(get5);
    $("#zip1").val(get6);
 });
});
</script>
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
</script>
<script>
var loadFile = function(event) {
	var signature = document.getElementById('output');
	signature.src = URL.createObjectURL(event.target.files[0]);
};
</script>
<script>
    var loadFile2 = function(event) {
        var image = document.getElementById('output2');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

function calaculateYears(date){
    var str = date;

    if( /^\d{2}\/\d{2}\/\d{4}$/i.test( str ) ) {

        var parts = str.split("/");

        var day = parts[0] && parseInt( parts[0], 10 );
        var month = parts[1] && parseInt( parts[1], 10 );
        var year = parts[2] && parseInt( parts[2], 10 );
        var duration = parseInt( 60, 10);

        if( day <= 31 && day >= 1 && month <= 12 && month >= 1 ) {

            //var lastDay = new Date(y, m + 1, 0);
            var expiryDate = new Date( year, month , 0 );
            expiryDate.setFullYear( expiryDate.getFullYear() + duration );

            var day = ( '0' + expiryDate.getDate() ).slice( -2 );

            var month = ( '0' + ( expiryDate.getMonth() + 1 ) ).slice( -2 );
            var year = expiryDate.getFullYear();
            //var day = new Date(year, month + 1, 0);

            $("#dor").val( year + "-" + month + "-" + day );

        } else {
            console.log('something');
        }
    }
}
</script>

@endsection


