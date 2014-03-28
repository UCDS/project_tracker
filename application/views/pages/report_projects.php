	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<h3>Projects <small>Click on any one to view </small></h3>
	
	<table class="table table-hover table-bordered">
	<thead><th>Project Name</th><th>Facility</th><th>District</th><th>Status</th><th>Work Type</th></thead>
	<tbody>

	<?php
	$i=1;
	foreach($projects as $project){
	?>
	<?php echo form_open('reports/projects',array('id'=>'select_project_form_'.$project->project_id,'role'=>'form')); ?>

	<tr onclick="$('#select_project_form_<?php echo $project->project_id;?>').submit();">
		<td><?php echo $i++; ?>
		<td><?php echo $project->project_name; ?>
		<input type='hidden' value="<?php echo $project->project_id; ?>" name="project_id" />
		</td>
		<td><?php echo $project->facility_name; ?></td>
		<td><?php echo $project->district_name; ?></td>
		<td><?php echo $project->project_status; ?></td>
		<td><?php if($project->work_type_id=='M') echo "Medical";
			else echo "Non-Medical"; 
			?></td>
	</tr>
	</form>
	<?php
	}
	?>
	</tbody>
	</table>
	</div>
	</div>