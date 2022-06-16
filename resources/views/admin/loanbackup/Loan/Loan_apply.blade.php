@extends('admin.layout.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Apply For Loan    <small> </small></h5>
					</div>
					<div class="ibox-content">

							<form method="POST" class="form-horizontal"  name="updateForm" id="updateForm" action={{route('admin.subapplyloan',[$id])}}>
								@csrf
								   <div class="form-group">
									   <div class="row">
										    <label class="col-md-2">Application No</label>
											<div class="col-md-3">
												<input readonly class="form-control" name="app_no" value="{{$app_id}}">
											</div>
												<label class="col-md-3 text-right">Date</label>
												<div class="col-md-3">
													<input type="date" class="form-control" id="data_1" name="DOV" required>
												</div>

									   </div>
								    </div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-2">Loan Officer</label>
												<div class="col-md-3">
													<select id="sel_officer" name="sel_officer" class="form-control" required>
														<option value="">Select </option>
														@foreach($loanofficer as $lo)
														<option value="{{$lo->EOId}}">{{$lo->EOName}}</option>
														@endforeach
													</select>
												</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-2">Center</label>
												 <div class="col-md-3">
													 <select id="sel_center_name" name="sel_center_name" class="form-control" required>
														<option value="0">- Select -</option>
													 </select>
												 </div>
												 <label class="col-md-3 text-right"> Group</label>

												  <div class="col-md-3">
													  <select id="sel_grp_name" name="sel_grp_name" class="form-control">
														  <option value="0">- Select -</option>
													  </select>
												  </div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-2">*Membership No.</label>
												<div class="col-md-3">
													<input readonly class="form-control" name="mem_no" value="{{$MemId}}" required>
												</div>
											<label class="col-md-3 text-right">Member Name</label>
												<div class="col-md-3">
													<input readonly class="form-control" name="mem_name" value="{{$name}}">
												</div>

										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-2">A/C NO</label>
												<div class="col-md-3">
													<input readonly class="form-control" name="Ac_No" value="{{$AcNo}}">
												</div>
										</div>
									</div>
									{{-- <div class="form-group">
										<div class="row">
											<label class="col-md-2">*Guarantor Name</label>
												<div class="col-md-3">
													<select class="form-control" name="guarantor_no" id="memberid" required>
														 <option > -- Select guarantor no --</option>
														 @foreach($gaurenter as $ge)
														 <option value="{{$ge->MemberId}}">{{$ge->AccountName}}</option>
														 @endforeach
													</select>
												</div>
										</div> --}}
                                        {{-- <div class="form-group">
                                              <div class="row">
                                                   <label class="col-md-2">*Guarantor Name</label>
                                                   <div class="col-md-3">
                                                       <datalist id="A/C_Name">
                                                            @foreach($gaurenter as $ge)
												             <option class="form-control" value="{{$ge->MemberId}}">{{$ge->AccountName}}</option>
											                @endforeach
                                                        </datalist>
                                                        <input type="text" list="A/C_Name" class="form-control" name="guarantor_no">
                                                    </div>
                                                </div>
									     </div> --}}
                                          <div class="form-group">
                                              <div class="row">
                                                   <label class="col-md-2">*Guarantor Name</label>
                                                   <div class="col-md-3">
                                                       <select class="js-example-basic-single" name="guarantor_no" id="memberid" required>
                                                            <option>------select------</option>
                                                            @foreach($gaurenter as $ge)
                                                            <option value="{{$ge->MemberId}}">{{$ge->AccountName}}</option>
                                                            @endforeach
                                                       </select>
                                                    </div>
                                                </div>
									     </div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-2">Loan Number</label>
												<div class="col-md-3">
													@foreach($J1 as $j)
													<input readonly class="form-control" name="loan_no" value="{{$j->sl}}">
													@endforeach
												</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-2">*Loan Scheme</label>
												<div class="col-md-3">
													<select class="form-control" name="loan_scheme" nrequired >
														 <option>-- Select Loan Scheme --</option>
														 @foreach($loanscheme as $los)
														 <option value="{{$los->loantypeid}}">{{$los->LoanType}}</option>
														 @endforeach
													</select>
												</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-2">*Purpose of Loan</label>
												<div class="col-md-3">
													<select class="form-control" name="loan_purpose" required>
														<option>-- Select purpose of loan --</option>
														@foreach($purpose as $pos)
														 <option value="{{$pos->LPurposeId}}" >{{$pos->Purpose}}</option>
														 @endforeach
													</select>
												</div>
											<label class="col-md-3 text-right">*Loan Type</label>
												<div class="col-md-3">
													<input type="radio" name="loan_type" value="Flat" required> Flat Rate
													<input type="radio" name="loan_type" value="Reducing" required> Reducing Rate
												</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-2">*Applied Loan Amount</label>
												<div class="col-md-3">
													<input type="number" class="form-control" name="app_loan_amt" required >
												</div>
											<label class="col-md-3 text-right">*Business Type</label>
												<div class="col-md-3">
													<select class="form-control" name="business_type" required>
														<option>-- Select Business Type --</option>
														@foreach($Business as $bus)
														 <option value="{{$bus->BusinessTypeId}}">{{$bus->BusinessType}}</option>
														 @endforeach
													</select>
												</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-2">*Multiple Disbursement</label>
												<div class="col-md-3">
													<input type="radio" name="md" id="md" value="Y" required onclick="yesfun()"> Yes
													<input type="radio" name="md" id="md" value="N" required onclick="nofun()"> No
												</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-2">*Breakup of Disburse Amount</label>
												<div class="col-md-9">
													<div class="row">
														<label class="col-md-4">AMT</label>

													</div>
													{{--add field--}}
													<div class="form-group" id="attachment"  >
													    <div class="land-owner-parent ">
															<div id="land_owner">
																<div class="row">
																	<div class="col-md-4">
																		<input type="text" class="form-control" placeholder="" name="dis_amt[]">
																	</div>
																		<button type="button"   class="btn btn-danger" onclick="removeLandOwner(this)" id="deleteid">
																			<i class="material-icons"> delete </i>
																		</button>
																</div>
															</div>
														</div>
													</div>
													<div class="row m-b-8" style="padding-top:-1px ">
														<div class="text-left  col-md-offset-4">
															<button type="button"  class="btn btn-primary" onclick="addMoreLandOwner()"  id="addid">
																<i class="material-icons">add</i>
															</button>
														</div>
													</div>


													{{-- endadd field--}}
												</div>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
										 <div class="form-group">
											<div class="col-sm-12 text-center">
														<button id="submit" type="submit" name="Submit" class="btn btn-primary" style="padding-left: 5%; padding-right: 5%;">Save</button><br>
											</div>
									</div>
							</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- <script>
$(document).ready(function(){
	$('#memberid').change(function(){
		$val=$('#memberid').val();
		console.log($val);
		$.ajax({
			url:"{{route('admin.get_MName')}}",
			type:'get',
			dataType:'json',
			data:{id:$(this).val()},
			success:function(resp){
				console.log(resp);
				if(resp.success == true){
					$.each(resp.GauName,function(k,v){
						$('#guarantor_name').val(v);
					})
				}
			},
			error:function(resp){
				console.log(resp);
			}
		})
	});
	});
</script> --}}

<script>
$(document).ready(function() {
   // $('#memberid').change(function(){
        $('.js-example-basic-single').select2();
  //});
});
</script>
<script>
	$(document).ready(function(){
		$("#sel_officer").change(function(){
			var eoid = $(this).val();
			alert(eoid);
			$.ajax({
				url: "{{route('admin.get_center')}}",
				type: 'get',
				dataType: 'json',
				data: {id:$(this).val()},
				success:function(response){
					//var len = response.length;
					//console.log(len);
					$("#sel_center_name").empty();
					$("#sel_center_name").append("<option value=''>Select</option>");
					$.each( response.CenterName,function(k,v){
						$("#sel_center_name").append("<option value="+v.Eoid+">"+v.Market+"</option>");
					})
				},
				error:function(response){
				console.log(response);
			}
			});


			;
			$.ajax({
				url: "{{route('admin.getgroup')}}",
				type: 'get',
				dataType: 'json',
				data: {id:$(this).val()},
				success:function(response){
					$("#sel_grp_name").empty();
					$("#sel_grp_name").append("<option value=''>Select</option>");
					$.each( response.group,function(k,v){

						$("#sel_grp_name").append("<option value="+v.GroupId+">"+v.GroupName+"-("+v.GroupCode+")</option>");
					})
					//$sql = "SELECT GroupId,GroupName,GroupCode FROM groupmst WHERE EOId=".$eo;
					// for( var i = 0; i<len; i++){
					// 	var grpid = response[i]['grpID'];
					// 	var grpname = response[i]['grpName'];
					// 	var grpcode = response[i]['grpCode'];
					// 	$("#sel_grp_name").append("<option value='"+grpid+"'>"+grpname+"-("+grpcode+")</option>");
					// }
				},
				error:function(response){
				console.log(response);
			}
			});

		});

	});
</script>
<script>
    var remove_landowner_button = '<button type="button" class="btn btn-danger" onclick="removeLandOwner(this)">' +
        '<i class="material-icons"> delete_sweep </i>' +
        '</button>';

	yesfun=function (){
		$('#deleteid').show("medium");
		$('#addid').show("medium");
	}
	nofun=function (){
		$('#deleteid').hide("medium");
		$('#addid').hide("medium");
		$(".land-owner-parent").not(":first").hide("slow", function(){
			$(this).remove();
		})
	}
    addMoreLandOwner = function () {

        var count=0;
        ++count;

        var clone_data = $(".land-owner-parent:last").clone();
        $(clone_data).find("input, select, textarea").val("");

        $(clone_data).find(".remove_button").html(remove_landowner_button);
        $(clone_data).hide();
        var clone_data = $(".land-owner-parent:last").after(clone_data);
        $(".land-owner-parent:last").show("slow");
        $('select').selectpicker();

    }
    removeLandOwner = function (obj) {
        console.log("remove button click");
        if ($(".land-owner-parent").length == 1) {
			alert("Atleast one File required.");
			return false;
        }
        $(obj).parents(".land-owner-parent").hide("slow", function () {
            $(this).remove();
        });
    }

</script>

@endsection
