<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#agreement_date").Zebra_DatePicker({
		direction:false
	});
	$("#probable_date_of_completion,#agreement_completion_date").Zebra_DatePicker();
	$("#division").change(function(){
			$("#facility option").show();
			if($(this).data('facilityoptions') == undefined){
			/*Taking an array of all options-2 and kind of embedding it on the select1*/
			$(this).data('facilityoptions',$('#facility option').clone());
			}	
		var id = $(this).val();
		var facilityoptions = $(this).data('facilityoptions').filter('[name=' + id + ']');
		$('#facility').html(facilityoptions);
		$('#facility').prepend('<option value="" selected="selected" >--Select--</option>');
		});
});
</script>
	
		<div class="col-md-8 col-md-offset-2">
  <center> 		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
 <h3><u>ADD PROJECT</u></h3></center><br>
 <?php echo form_open('projects/create',array('role'=>'form')); ?>
	<div class="form-group">
		<label for="project_name" class="col-md-4">Project Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Project Name" id="project_name" name="project_name" />
		</div>
	</div>
	<div class="form_group">
		<div  class="col-md-12" style="padding-left:0">
		<label class="col-md-6">Work Type</label>
		<label class="radio-inline" for="wt_medical">
		<input type="radio" name="work_type" id="wt_medical" value="M" />Medical 
		</label>
		<label for="wt_non_medical" class="radio-inline"> 
		<input type="radio" id="wt_non_medical" name="work_type" value="N" /> 
		Non Medical
		</label>
		</div>
	</div>
	<div class="form-group">
		<label for="project_address" class="col-md-4">Project Address</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Project Address" id="project_address" name="project_address" />
		</div>
	</div>
	<div class="form-group">
		<label for="division" class="col-md-4" >Division</label>
		<div  class="col-md-8">
		<select name="division" id="division" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($divisions as $division){
			echo "<option value='$division->division_id'>$division->division</option>";
		}
		?>
		</select>		
	</div>
	</div>
	<div class="form-group">
		<label for="facility" class="col-md-4" >Facility</label>
		<div  class="col-md-8">
		<select name="facility" id="facility" class="form-control" >
		<option value="">--SELECT--</option>
		<?php foreach($facilities as $facility){
			echo "<option value='$facility->facility_id' name='$facility->division_id' hidden>$facility->facility_name</option>";
		}
		?>
		</select>		
	</div>
	</div>	
	<div class="form_group">
		<label for="estimate_amount" class="col-md-4">Ref. to Admin Sanction</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Ref. to Admin Sanction" id="ref_admin" name="ref_admin" />
		</div>
	</div>
	<div class="form_group">
		<label for="estimate_amount" class="col-md-4">Admin Sanction Amt</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Admin sanction amount" id="admin_amount" name="admin_amount" />
		</div>
	</div>
	<div class="form_group">
		<label for="estimate_amount" class="col-md-4">Ref. to Technical Sanction</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Ref. to Technical Sanction" id="ref_tech" name="ref_tech" />
		</div>
	</div>
	<div class="form_group">
		<label for="estimate_amount" class="col-md-4">Technical Sanction Amount</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Technical Sanction Amount" id="tech_amount" name="tech_amount" />
		</div>
	</div>
	<div class="form_group">
		<label for="agreement_amount" class="col-md-4">Agreement Amount</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agreement Amount Rs" id="agreement_amount" name="agreement_amount" />
		</div>
	</div>
	<div class="form_group">
		<label for="agreement_number" class="col-md-4">Agreement Number</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agreement Number" id="agreement_number" name="agreement_number" />
		</div>
	</div>
	<div class="form_group">
		<label for="agreement_date" class="col-md-4">Agreement Date</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agreement Date" id="agreement_date" name="agreement_date" />
		</div>
	</div>
	<div class="form_group">
		<label for="agreement_completion_date" class="col-md-4">Completion Date</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="as per Agreement" id="agreement_completion_date" name="agreement_completion_date" />
		</div>
	</div>
	<div class="form_group">
		<label for="grant" class="col-md-4">Grant</label>
		<div  class="col-md-8">
		<select name="grant" id="grant" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($grants as $grant){
			echo "<option value='$grant->phase_id'>$grant->phase_name</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form_group">
		<label for="agency" class="col-md-4">Agency</label>
		<div  class="col-md-8">
		<select name="agency" id="agency" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($agencies as $agency){
			echo "<option value='$agency->agency_id'>$agency->agency_name</option>";
		}
		?>
		</select>
		</div>
	</div>
	<div class="form_group">
		<label for="probable_date_of_completion" class="col-md-4">Probable Date of Completion</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Probable Date of Completion" id="probable_date_of_completion" name="probable_date_of_completion" />
		</div>
	</div>
	</div> 
   	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
	</div>
