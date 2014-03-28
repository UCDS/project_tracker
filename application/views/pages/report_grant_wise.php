	<div class="row">
	<div class="col-md-12 ">
	<h3>Grant wise summary report <small>Click on any one to view </small></h3>
	
	<table class="table table-hover table-bordered">
	<thead>
		<th>S.No</th>
		<th>Grant</th>
		<th>Admin Sanction Amt. (in Crores)</th>
		<th>Agreement Amt. (in Crores)</th>
		<th>Total Works</th>
		<th>Not Started</th>
		<th>In Progress</th>
		<th>Completed</th>
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
	$expenses=0;
	$i=1;
	foreach($grants as $grant){
	?>
	<?php echo form_open('reports/grants',array('id'=>'select_grant_form_'.$grant->grant_id,'role'=>'form')); ?>
	
	<tr onclick="$('#select_grant_form_<?php echo $grant->grant_id;?>').submit();">
		<td><?php echo $i; ?></td>
		<td><?php echo $grant->grant_name; ?>
		<input type='hidden' value="<?php echo $grant->grant_id; ?>" name="grant" />
		</td>
		<td class='text-right'><?php echo number_format($grant->estimate_amount/10000000,2); ?></td>
		<td class='text-right'><?php echo number_format($grant->agreement_amount/10000000,2); ?></td>
		<td class='text-right'><?php echo $grant->total_projects; ?></td>
		<td class='text-right'><?php echo $grant->not_started; ?></td>
		<td class='text-right'><?php echo $grant->work_in_progress; ?></td>
		<td class='text-right'><?php echo $grant->work_completed; ?></td>
		<td class='text-right'><?php echo number_format($grant->expenses/10000000,2); ?></td>
	</tr>
	</form>
	<?php
	$estimate_amount+=$grant->estimate_amount;
	$agreement_amount+=$grant->agreement_amount;
	$total_projects+=$grant->total_projects;
	$not_started+=$grant->not_started;
	$work_in_progress+=$grant->work_in_progress;
	$work_completed+=$grant->work_completed;
	$expenses+=$grant->expenses;
	$i++;
	}
	?>
	<tr>
		<th>Total</th>
		<th class='text-right'><?php echo number_format($estimate_amount/10000000,2);?></th>
		<th class='text-right'><?php echo number_format($agreement_amount/10000000,2);?></th>
		<th class='text-right'><?php echo $total_projects;?></th>
		<th class='text-right'><?php echo $not_started;?></th>
		<th class='text-right'><?php echo $work_in_progress;?></th>
		<th class='text-right'><?php echo $work_completed;?></th>
		<th class='text-right'><?php echo number_format($expenses/10000000,2);?></th>
	</tbody>
	</table>
	</div>
	</div>