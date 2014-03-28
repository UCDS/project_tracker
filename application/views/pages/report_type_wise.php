	<div class="row">
	<div class="col-md-12 ">
	<h3>Facility type wise summary report <small>Click on any one to view </small></h3>
	
	<table class="table table-hover table-bordered">
	<thead>
		<th>S.No</th>
		<th>Facility Type</th>
		<th>Admin Sanction Amt. (in Crores)</th>
		<th>Agreement Amt. (in Crores)</th>
		<th>Total Works</th>
		<th>Not Started</th>
		<th>In Progress</th>
		<th>Completed</th>
		<th>Expenditure (in Crores)</th>
		<th>Project Status</th>
	</thead>
	<tbody>

	<?php
	$estimate_amount=0;
	$agreement_amount=0;
	$total_projects=0;
	$not_started=0;
	$work_in_progress=0;
	$work_completed=0;
	$expenses=0;
	$i=1;
	foreach($facility_types as $facility_type){
	?>
	<?php echo form_open('reports/facility_types',array('id'=>'select_facility_type_form_'.$facility_type->facility_type_id,'role'=>'form')); ?>
	
	<tr onclick="$('#select_facility_type_form_<?php echo $facility_type->facility_type_id;?>').submit();">
		<td><?php echo $i++; ?></td>
		<td><?php echo $facility_type->facility_type; ?>
		<input type='hidden' value="<?php echo $facility_type->facility_type_id; ?>" name="facility_type" />
		</td>
		<td class="text-right"><?php echo number_format($facility_type->estimate_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($facility_type->agreement_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo $facility_type->total_projects; ?></td>
		<td class="text-right"><?php echo $facility_type->not_started; ?></td>
		<td class="text-right"><?php echo $facility_type->work_in_progress; ?></td>
		<td class="text-right"><?php echo $facility_type->work_completed; ?></td>
		<td class="text-right"><?php echo number_format($facility_type->expenses/10000000,2); ?></td>
		<td><?php echo $facility_type->project_status; ?></td>
	</tr>
	</form>
	<?php
	$estimate_amount+=$facility_type->estimate_amount;
	$agreement_amount+=$facility_type->agreement_amount;
	$total_projects+=$facility_type->total_projects;
	$not_started+=$facility_type->not_started;
	$work_in_progress+=$facility_type->work_in_progress;
	$work_completed+=$facility_type->work_completed;
	$expenses+=$facility_type->expenses;
	}
	?>
	<tr>
		<th>Total</th>
		<th class="text-right"><?php echo number_format($estimate_amount/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($agreement_amount/10000000,2);?></th>
		<th class="text-right"><?php echo $total_projects;?></th>
		<th class="text-right"><?php echo $not_started;?></th>
		<th class="text-right"><?php echo $work_in_progress;?></th>
		<th class="text-right"><?php echo $work_completed;?></th>
		<th class="text-right"><?php echo number_format($expenses/10000000,2);?></th>
	</tbody>
	</table>
	</div>
	</div>