	<div class="row">
	<div class="col-md-12 ">
	<h3>User Department wise summary report <small>Click on any one to view </small></h3>
	
	<table class="table table-hover table-bordered">
	<thead>
		<th>S.No</th>
		<th>User Department</th>
		<th>Admin Sanction(Crores)</th>
		<th>Agreement(Crores)</th>
		<th>Total Works</th>
		<th>Not Started</th>
		<th>In Progress</th>
		<th>Completed</th>
		<th>Expenditure (Crores)</th>
		<th>Balance (Crores)</th>
	</thead>
	<tbody>

	<?php
	$admin_sanction_amount=0;
	$tech_sanction_amount=0;
	$agreement_amount=0;
	$total_projects=0;
	$not_started=0;
	$work_in_progress=0;
	$work_completed=0;
	$expenses=0;
	$i=1;
	foreach($user_departments as $user_department){
	?>
	<?php echo form_open('reports/user_departments',array('id'=>'select_user_department_form_'.$user_department->user_department_id,'role'=>'form')); ?>
	
	<tr onclick="$('#select_user_department_form_<?php echo $user_department->user_department_id;?>').submit();">
		<td><?php echo $i; ?></td>
		<td><?php echo $user_department->user_department; ?>
		<input type='hidden' value="<?php echo $user_department->user_department_id; ?>" name="user_department" />
		</td>
		<td class='text-right'><?php echo number_format($user_department->admin_sanction_amount/10000000,2); ?></td>
		<td class='text-right'><?php echo number_format($user_department->agreement_amount/10000000,2); ?></td>
		<td class='text-right'><?php echo $user_department->total_projects; ?></td>
		<td class='text-right'><?php echo $user_department->not_started; ?></td>
		<td class='text-right'><?php echo $user_department->work_in_progress; ?></td>
		<td class='text-right'><?php echo $user_department->work_completed; ?></td>
		<td class='text-right'><?php echo number_format($user_department->expenses/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($user_department->tech_sanction_amount-$user_department->expenses)/10000000,2); ?></td>
	</tr>
	</form>
	<?php
	$admin_sanction_amount+=$user_department->admin_sanction_amount;
	$tech_sanction_amount+=$user_department->tech_sanction_amount;
	$agreement_amount+=$user_department->agreement_amount;
	$total_projects+=$user_department->total_projects;
	$not_started+=$user_department->not_started;
	$work_in_progress+=$user_department->work_in_progress;
	$work_completed+=$user_department->work_completed;
	$expenses+=$user_department->expenses;
	$i++;
	}
	?>
	<tr>
		<th colspan="2">Total</th>
		<th class='text-right'><?php echo number_format($admin_sanction_amount/10000000,2);?></th>
		<th class='text-right'><?php echo number_format($agreement_amount/10000000,2);?></th>
		<th class='text-right'><?php echo $total_projects;?></th>
		<th class='text-right'><?php echo $not_started;?></th>
		<th class='text-right'><?php echo $work_in_progress;?></th>
		<th class='text-right'><?php echo $work_completed;?></th>
		<th class='text-right'><?php echo number_format($expenses/10000000,2);?></th>
		<th class='text-right'><?php echo number_format(($tech_sanction_amount-$expenses)/10000000,2);?></th>
	</tbody>
	</table>
	</div>
	</div>