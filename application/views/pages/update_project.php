	<?php if(isset($project)){ ?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#from_date,#to_date").Zebra_DatePicker({
		direction:false
	});
	$("#probable_date").Zebra_DatePicker();
});
</script>	<div class="row">
		<div class="col-md-10">
			<?php if(isset($msg)){ ?>
			<h3><?php echo $msg;?></h3>
			<?php } ?>
			<table class="table table-bordered table-striped">
			<?php
			foreach($project as $p){
			?>
			<thead>
			
			<th colspan="2" class='text-center'><?php echo $p->project_name; ?></th>
			</thead>
			<tbody>
			<tr><td colspan="2">			
			<img src="<?php echo base_url();?>assets/images/project_images/project_<?php echo $p->project_id;?>_image.jpg" class="thumbnail col-md-6 col-md-offset-3"  alt="No Image found" />
			</td>
			</tr>
			<tr>
				<td>Project ID</td>
				<td><?php echo $p->project_id; ?>
				</td>
			</tr>
			<tr>
				<td>Project Name</td>
				<td><?php echo $p->project_name; ?></td>
			</tr>
			<tr>
				<td>Facility</td>
				<td><?php echo $p->facility_name; ?></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><?php echo $p->project_address; ?></td>
			</tr>
			<tr>
				<td>District</td>
				<td><?php echo $p->district_name; ?></td>
			</tr>
			<tr>
				<td>Agreement Date</td>
				<td><?php echo date("d-M-y",strtotime($p->agreement_date)); ?></td>
			</tr>
			<tr>
				<td>Agreement Number</td>
				<td><?php echo $p->agreement_id; ?></td>
			</tr>
			<tr>
				<td>Agreement Amount (in Lakhs of Rs.)</td>
				<td><?php echo number_format($p->agreement_amount); ?></td>
			</tr>
			<tr>
				<td>Completion date as per agreement</td>
				<td><?php echo date("d-M-y",strtotime($p->agreement_completion_date)); ?></td>
			</tr>
			<tr>
				<td>Admin Sanction Amount (in Lakhs of Rs.)</td>
				<td><?php echo number_format($p->admin_sanction_amount); ?></td>
			</tr>
			<tr>
				<td>Probable completion date</td>
				<td><?php echo date("d-M-y",strtotime($p->probable_date_of_completion)); ?></td>
			</tr>
			<tr>
				<td>Current Status</td>
				<td><?php echo $p->status_type; ?></td>
			</tr>
			<tr>
				<td>Update</td>
				<td class='text-center'>
				<div class='col-md-12'>
				<?php echo form_open_multipart('projects/update',array('id'=>'update_form','role'=>'form')); ?>
				<span class="pull-left">Upload Image : </span> <input type='hidden' value="<?php echo $p->project_id; ?>" name="selected_project" />

				<input type="file" name="project_image" size="20" />

				<br /><br />
				<input type="text" placeholder="Expenditure in Lakhs" class="form-control" name='expenditure' />
				<input type="text" placeholder="Date" class="form-control" name='expense_date' id="from_date" />
				<select class='form-control' name='status'>
				<option value=''>Change Status</option>
				<option value='1'>Not Started</option>
				<option value='2'>Work in Progress</option>
				<option value='3'>Work completed</option>
				<input type="text" placeholder="Status Remarks" class="form-control" name='status_remarks' />
				<input type="text" placeholder="Probable Date" class="form-control" name='probable_date' id="probable_date" />
				</select>
				<input class='btn btn-sm btn-primary btn-block' type="submit" name="update" value="Update" />
				</div>
			</td>
			</tr>
			</tbody>
			<?php
			}
			?>
			</table>
			</form>		
		</div>
	</div>
	<?php } else { ?>
	
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<h3>List of Projects. <small>Click on any one to view and update</small></h3>
	
	<table class="table table-hover table-bordered">
	<thead><th>S.No</th><th>Project ID</th><th>Project Name</th><th>Facility</th><th>District</th><th>Status</th></thead>
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
		<td><?php echo $project->district_name; ?></td>
		<td><?php echo $project->status_type; ?></td>
	</tr>
	</form>
	<?php
	}
	?>
	</tbody>
	</table>
	</div>
	</div>
	<?php } ?>