	<div class="row">
	<div class="col-md-12 ">
	<h3>District wise summary report <small>Click on any one to view </small></h3>
	
	<table class="table table-hover table-bordered">
	<thead>
		<th>S.No</th>
		<th>District Name</th>
		<th>Admin Sanction Amt. (in Crores)</th>
		<th>Agreement Amt. (in Crores)</th>
		<th>Total Works</th>
		<th>Not Started</th>
		<th>In Progress</th>
		<th>Completed</th>
		<th>Medical</th>
		<th>Non Medical</th>
		<th>Expenditure (in Crores)</th>
	</thead>
	<tbody>

	<?php
	$estimate_amount=0;
	$agreement_amount=0;
	$total_projects=0;
	$not_started=0;
	$work_in_progress=0;
	$work_completed=0;
	$medical=0;
	$non_medical=0;
	$expenses=0;
	$i=1;
	foreach($districts as $district){
	?>
	<?php echo form_open('reports/districts',array('id'=>'select_district_form_'.$district->district_id,'role'=>'form')); ?>
	<tr onclick="$('#select_district_form_<?php echo $district->district_id;?>').submit();">
		<td><?php echo $i++; ?></td>
		<td><?php echo $district->district_name; ?>
		<input type='hidden' value="<?php echo $district->district_id; ?>" name="district_id" />
		</td>
		<td class="text-right"><?php echo number_format($district->estimate_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($district->agreement_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo $district->total_projects; ?></td>
		<td class="text-right"><?php echo $district->not_started; ?></td>
		<td class="text-right"><?php echo $district->work_in_progress; ?></td>
		<td class="text-right"><?php echo $district->work_completed; ?></td>
		<td class="text-right"><?php echo $district->medical; ?></td>
		<td class="text-right"><?php echo $district->non_medical; ?></td>
		<td class="text-right"><?php echo number_format($district->expenses/10000000,2); ?></td>
	</tr>
	</form>
	<?php
	$estimate_amount+=$district->estimate_amount;
	$agreement_amount+=$district->agreement_amount;
	$total_projects+=$district->total_projects;
	$not_started+=$district->not_started;
	$work_in_progress+=$district->work_in_progress;
	$work_completed+=$district->work_completed;
	$medical+=$district->medical;
	$non_medical+=$district->non_medical;
	$expenses+=$district->expenses;
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
		<th class="text-right"><?php echo $medical;?></th>
		<th class="text-right"><?php echo $non_medical;?></th>
		<th class="text-right"><?php echo number_format($expenses/10000000,2);?></th>
	</tbody>
	</table>
	</div>
	</div>