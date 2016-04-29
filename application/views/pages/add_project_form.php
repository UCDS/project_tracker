<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.chained.min.js"></script>
<script type="text/javascript">
$(function(){
	$("#agreement_date").Zebra_DatePicker({
		direction:false
	});
	$("#probable_date_of_completion,#agreement_completion_date").Zebra_DatePicker();
	$("#facility").chained("#division");
	$("#staff").chained("#division");
});
</script>
	
  <center> 		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
 <h3><u>ADD PROJECT</u></h3></center><br>
 <?php echo form_open('projects/create',array('role'=>'form')); ?>
	<div class="form-group">
		<label for="project_name" class="col-md-4">Project Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Project Name" id="project_name" name="project_name" required />
		</div>
	</div>
	<div class="form-group">
		<label for="work_type" class="col-md-4" >Work Type</label>
		<div  class="col-md-8">
		<select name="work_type" id="work_type" class="form-control" >
		<option value="">--SELECT--</option>
		<?php foreach($work_type as $w){
			echo "<option value='$w->work_type_id'>$w->work_type</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form-group">
		<label for="sanction_type" class="col-md-4" >Santion Type</label>
		<div  class="col-md-8">
		<select name="sanction_type" id="sanction_type" class="form-control" >
		<option value="">--SELECT--</option>
		<?php foreach($sanction_type as $s){
			echo "<option value='$s->sanction_type_id'>$s->sanction_type</option>";
		}
		?>
		</select>		
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
		<select name="division" id="division" class="form-control" required >
		<option value="">--SELECT--</option>
		<?php foreach($divisions as $division){
			echo "<option value='$division->division_id'>$division->division</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form-group">
		<label for="staff" class="col-md-4" >Recording Officer</label>
		<div  class="col-md-8">
		<select name="staff" id="staff" class="form-control" >
		<option value="">--SELECT--</option>
		<?php foreach($staff as $s){
			echo "<option value='$s->staff_id' class='$s->division_id'>$s->designation - $s->staff_name</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form-group">
		<label for="facility" class="col-md-4" >Facility</label>
		<div  class="col-md-8">
		<select name="facility" id="facility" class="form-control" required>
		<option value="">--SELECT--</option>
		<?php foreach($facilities as $facility){
			echo "<option value='$facility->facility_id' class='$facility->division_id'>$facility->facility_name</option>";
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
		<select name="grant" id="grant" class="select-box selectized" required >
		<option value="">--SELECT--</option>
		<?php foreach($grants as $grant){
			echo "<option value='$grant->phase_id'>$grant->phase_name</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form_group">
		<label for="user_department" class="col-md-4">User Department</label>
		<div  class="col-md-8">
		<select name="user_department" id="user_department" class="select-box selectized">
		<option value="">--SELECT--</option>
		<?php foreach($user_departments as $user_department){
			echo "<option value='$user_department->user_department_id'>$user_department->user_department</option>";
		}
		?>
		</select>		
		</div>
	</div>
	<div class="form_group">
		<label for="agency" class="col-md-4">Agency</label>
		<div  class="col-md-8">
		<select name="agency" id="agency" class="select-box selectized" >
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
