	<?php 
	if(isset($project) && count($project)>0){ 
	?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<style>
	.prev_expenses{
		cursor:pointer;
		color:blue;
	}
</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$(".date").Zebra_DatePicker();
	$(".prev_expenses").click(function(){
		$(".expenses").slideToggle();
	});
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
  $("#status").on('change',function(){
		var status_type_id=$(this).val();
		$("#stage option").hide().prop('disabled',true);
		$("#stage>option:eq(0)").prop('selected',true).show().prop('disabled',true);
		$("#stage ."+status_type_id+"").show().prop('disabled',false);
	});
});
</script>	<div class="row">
		<div class="col-md-10">
			<?php if(isset($msg)){ ?>
			<h3><?php echo $msg;?></h3>
			<?php } ?>
			<?php echo form_open_multipart('projects/update',array('id'=>'update_form','role'=>'form')); ?>
			<?php
			foreach($project as $p){
			?>
			<table class="table table-bordered table-striped">
			<thead>
			
			<th colspan="2" class='text-center'><?php echo $p->project_name; ?></th>
			</thead>
			<tbody>
			<tr><td colspan="2">			
			<img src="<?php echo base_url();?>assets/images/project_images/project_<?php echo $p->project_id;?>_image.jpg" class="thumbnail col-md-6 col-md-offset-3"  alt="No Image found" />
			
			<input type='hidden' value="<?php echo $p->project_id; ?>" name="selected_project" />
			<input type="file" class="btn btn-primary" name="project_image" size="20" />
			</td>
			</tr>
			<tr>
				<td>Project ID</td>
				<td><?php echo $p->project_id; ?>
				</td>
			</tr>
			<tr>
				<td>Project Name</td>
				<td><input type="text" class="form-control" placeholder="Project Name" value="<?php echo $p->project_name; ?>" id="project_name" name="project_name" /></td>
			</tr>
			<tr>
				<td>Work Type</td>
				<td>
					<label for="medical" class="control-label"><input type="radio" value="M" id="medical" name="work_type" <?php if($p->work_type_id=="M") echo " checked ";?> />Medical</label>
					<label for="non-medical" class="control-label"><input type="radio" value="N" id="non-medical" name="work_type" <?php if($p->work_type_id=="N") echo " checked ";?> />Non Medical</label>
				</td>
			</tr>
			<tr>
				<td>Division</td>
				<td>
					<select name="division" id="division" class="form-control">
					<option value="">--SELECT--</option>
					<?php foreach($divisions as $division){
						echo "<option value='$division->division_id'";
						if($division->division_id==$p->division_id) echo " selected ";
						echo ">$division->division</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Facility</td>
				<td>
					<select name="facility" id="facility" class="form-control" >
					<option value="">--SELECT--</option>
					<?php foreach($facilities as $facility){
						echo "<option value='$facility->facility_id' name='$facility->division_id'";
						if($facility->facility_id==$p->facility_id) echo " selected ";
						echo ">$facility->facility_name</option>";
					}
					?>
					</select>
				<td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" class="form-control" placeholder="Project Address" id="project_address" value="<?php echo $p->project_address; ?>" name="project_address" /></td>
			</tr>
			<tr>
				<td>Ref to Admin Sanction</td>
				<td><input type="text" class="form-control" placeholder="Ref. to Admin Sanction" id="ref_admin" value="<?php echo $p->admin_sanction_id;?>" name="ref_admin" /></td>
			</tr>
			<tr>
				<td>Admin Sanction Amount</td>
				<td><input type="text" class="form-control" placeholder="Admin sanction amount" id="admin_amount" value="<?php echo $p->admin_sanction_amount; ?>" name="admin_amount" /></td>
			</tr>
			<tr>
				<td>Ref to Tech Sanction</td>
				<td><input type="text" class="form-control" placeholder="Ref. to Tech Sanction" id="ref_tech" value="<?php echo $p->tech_sanction_id;?>" name="ref_tech" /></td>
			</tr>
			<tr>
				<td>Tech Sanction Amount</td>
				<td><input type="text" class="form-control" placeholder="Tech sanction amount" id="tech_amount" value="<?php echo $p->tech_sanction_amount; ?>" name="tech_amount" /></td>
			</tr>
			<tr>
				<td>Agreement Date</td>
				<td><input type="text" class="form-control date" placeholder="Agreement Date" id="agreement_date" value="<?php echo date("d-M-y",strtotime($p->agreement_date)); ?>" name="agreement_date" /></td>
			</tr>
			<tr>
				<td>Agreement Number</td>
				<td><input type="text" class="form-control" placeholder="Agreement Number" value="<?php echo $p->agreement_id; ?>" id="agreement_number" name="agreement_number" /></td>
			</tr>
			<tr>
				<td>Agreement Amount</td>
				<td><input type="text" class="form-control" placeholder="Agreement Amount Rs" id="agreement_amount" value="<?php echo $p->agreement_amount; ?>" name="agreement_amount" /></td>
			</tr>
			<tr>
				<td>Completion date as per agreement</td>
				<td><input type="text" class="form-control date" placeholder="as per Agreement" id="agreement_completion_date" value="<?php echo date("d-M-y",strtotime($p->agreement_completion_date)); ?>" name="agreement_completion_date" /></td>
			</tr>
			<tr>
				<td>Grant</td>
				<td>		
					<select name="grant" id="grant" class="form-control">
					<option value="">--SELECT--</option>
					<?php foreach($grants as $grant){
						echo "<option value='$grant->phase_id' ";
						if($grant->phase_id==$p->grant_phase_id) echo " selected ";
						echo ">$grant->phase_name</option>";
					}
					?>
					</select>	
				</td>
			</tr>
			<tr>
				<td>User Department</td>
				<td>		
					<select name="user_department" id="user_department" class="form-control">
					<option value="">--SELECT--</option>
					<?php foreach($user_departments as $user_department){
						echo "<option value='$user_department->user_department_id' ";
						if($user_department->user_department_id==$p->user_department_id) echo " selected ";
						echo ">$user_department->user_department</option>";
					}
					?>
					</select>	
				</td>
			</tr>
			<tr>
				<td>Agency</td>
				<td>
					<select name="agency" id="agency" class="form-control">
					<option value="">--SELECT--</option>
					<?php foreach($agencies as $agency){
						echo "<option value='$agency->agency_id'";
						if($agency->agency_id==$p->agency_id) echo " selected ";
						echo ">$agency->agency_name</option>";
					}
					?>
					</select>	
				</td>
			</tr>
			<tr>
				<td>Previous Expenses</td>
				<td>Cumilative : <?php echo number_format($p->expenses);?> - <span class="prev_expenses">Click here to view all.</span>
				<div class="panel panel-default expenses" hidden>
					<div class="panel-heading">
						Expenses for this project
					</div>
					<div class="panel-body">
					<table class="table">
						<thead>
						<th>#</th><th>Date</th><th>Amount</th>
						</thead>
						<tbody>
							<?php
							$i=1;
							foreach($expenses as $expense){ ?>
							<tr>
								<td><?php echo $i++;?></td>
								<td><input type="text" value="<?php echo $expense->expense_id;?>" class="form-control sr-only" name="expense_id[]" />
								<input type="text" value="<?php echo date("d-M-y",strtotime($expense->expense_date)); ?>" class="form-control date" form="update_form" name="prev_expense_date[]" size="4" /></td>
								<td><input type="text" value="<?php echo $expense->expense_amount; ?>" class="form-control" name="prev_expense_amount[]" size="4" /></td>
							</tr>
							<?php } ?>
						</tbody>								
					</table>
					</div>
				</div>
				</td>
			</tr>
			<tr>
			<th><input class='btn btn-lg btn-default btn-block col-md-3' type="submit" name="update_project" form="update_form" value="Update Project" /></th>
			</tr>
		</tbody>
		</table>
		<table class="table table-bordered">
			<tr>
				<td>Current Status</td>
				<td>
					<select name="status" id="status" class="form-control">
					<option value="" class="default" selected disabled >--SELECT--</option>
					<?php foreach($status_types as $status){
						echo "<option value='$status->status_type_id'";
						if($status->status_type_id==$p->status_type_id) echo " selected ";
						echo ">$status->status_type</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Stage of Work</td>
				<td>
					<select name="stage" id="stage" class="form-control">
					<option value="" class="default" selected disabled >--SELECT--</option>
					<?php foreach($stages as $stage){
						echo "<option value='$stage->stage_id'";
						if($stage->stage_id==$p->stage_id) echo " selected "; 
						if($stage->status_type_id!=$p->status_type_id) echo " hidden ";
						echo " class='$stage->status_type_id'>$stage->stage</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Remarks</td>
				<td><input type="text" class="form-control" placeholder="Status Remarks" id="status_remarks" value="<?php echo $p->remarks_1; ?>" name="status_remarks" /></td>
			</tr>
			<tr>
				<td>Probable completion date</td>
				<td><input type="text" class="form-control date" placeholder="Probable Date of Completion" id="probable_date_of_completion" form="update_form" value="<?php echo date("d-M-y",strtotime($p->probable_date_of_completion)); ?>" name="probable_date_of_completion" /></td>
			</tr>
			<tr>
			<th><input class='btn btn-lg btn-default btn-block' type="submit" name="update_status" value="Update Physical Status" /></th>
			</tr>
		</table>
		<table class="table table-bordered">
			<tr>
				<td>Add Expenditure</td>
				<td class='text-center'>
				<div class='col-md-12'>
				<input type="text" placeholder="Expenditure" class="form-control" name='expenditure' />
				<input type="text" placeholder="Date" class="form-control date" name='expense_date' id="from_date" />
				</div>
			</td>
			</tr>
			<tr>
			<th><input class='btn btn-lg btn-default btn-block' type="submit" name="update_expenses" value="Update Expenditure" /></th>
			</tr>
		</table>
			<?php
			}
			?>
			</form>		
		</div>
	</div>
	<?php } 
	else { ?>
	
	<div class="row">
	<div class="col-md-6">
	<h3>Projects<?php if($this->input->post('district_id') && count($projects)>0) echo " in ".$projects[0]->district_name;?>. <small>Click on any one to view and update</small></h3>
	</div>
 	<?php echo form_open('projects/update',array('id'=>'select_filters','role'=>'form','class'=>'form-custom'));?>
	<div class="col-md-6">
	<div class="form-group">
	<select name="district_id" id="district" style="width:150px"  class="form-control">
		<option value="">District</option>
		<?php
		for ($e = 0; $e < count($district); $e++)
		{
		  for ($ee = $e+1; $ee < count($district); $ee++)
		  {
			if ($district[$ee]->district_id==$district[$e]->district_id)
			{
			array_splice($district,$ee,1);
			$ee--;
			}
		  }
		}
		foreach($district as $d){
		
			echo "<option value='$d->district_id'>$d->district_name</option>";
		}
		?>
	</select>
	</div>
	<div class="form-group">
	<select name="grant" id="grant" style="width:150px"  class="form-control">
		<option value="">Grant</option>
		<?php
		for ($e = 0; $e < count($grant); $e++)
		{
		  for ($ee = $e+1; $ee < count($grant); $ee++)
		  {
			if ($grant[$ee]->grant_phase_id==$grant[$e]->grant_phase_id)
			{
			array_splice($grant,$ee,1);
			$ee--;
			}
		  }
		}
		foreach($grant as $g){
		
			echo "<option value='$g->grant_phase_id'>$g->phase_name</option>";
		}
		?>
	</select>	
	</div>
	<div class="form-group">
	<input type="text" name="project_id" size="3" placeholder="ID" class="form-control" />
	</div>
	<input type="submit" value="Go" class="btn btn-primary btn-sm" name="search_projects" />
	</form>
	</div>
	<?php if(isset($project) && count($project)==0 || count($projects)==0) { 
		echo "<div class='col-md-10'><div class='alert alert-danger'>No projects found.</div></div>";
	}
	else {
	?>
	<table class="table table-hover table-bordered">
	<thead><th>S.No</th><th>Project ID</th><th>Project Name</th><th>Facility</th><th>Grant</th><th>Status</th></thead>
	<tbody>

	<?php
	$i=1;
	foreach($projects as $project){
	?>
	<?php echo form_open('projects/update',array('id'=>'select_project_form_'.$project->project_id,'role'=>'form')); ?>
	<tr onclick="$('#select_project_form_<?php echo $project->project_id;?>').submit();">
		<td><?php echo $i++; ?>
		<td><?php echo $project->project_id; ?>
		<input type='hidden' value="<?php echo $project->project_id; ?>" name="project_id" />
		</td>
		<td><?php echo $project->project_name; ?></td>
		<td><?php echo $project->facility_name; ?></td>
		<td><?php echo $project->phase_name; ?></td>
		<td><?php echo $project->status_type; ?></td>
	</tr>
	</form>
	<?php
	}
	?>
	</tbody>
	</table>
	<?php } ?>
	</div>
	<?php 
	}
	?>