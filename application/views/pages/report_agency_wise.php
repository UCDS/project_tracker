	<div class="row">
	<div class="col-md-12 ">
	<h3>Agency wise summary report <small>Click on any one to view </small></h3>
	
	<table class="table table-hover table-bordered">
	<thead>
		<th>S.No</th>
		<th>Agency</th>
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
	foreach($agencies as $agency){
	?>
	<?php echo form_open('reports/agencies',array('id'=>'select_agency_form_'.$agency->agency_id,'role'=>'form')); ?>
	
	<tr onclick="$('#select_agency_form_<?php echo $agency->agency_id;?>').submit();">
		<td><?php echo $i; ?></td>
		<td><?php echo $agency->agency_name; ?>
		<input type='hidden' value="<?php echo $agency->agency_id; ?>" name="agency" />
		</td>
		<td class='text-right'><?php echo number_format($agency->admin_sanction_amount/10000000,2); ?></td>
		<td class='text-right'><?php echo number_format($agency->agreement_amount/10000000,2); ?></td>
		<td class='text-right'><?php echo $agency->total_projects; ?></td>
		<td class='text-right'><?php echo $agency->not_started; ?></td>
		<td class='text-right'><?php echo $agency->work_in_progress; ?></td>
		<td class='text-right'><?php echo $agency->work_completed; ?></td>
		<td class='text-right'><?php echo number_format($agency->expenses/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($agency->tech_sanction_amount-$agency->expenses)/10000000,2); ?></td>
	</tr>
	</form>
	<?php
	$admin_sanction_amount+=$agency->admin_sanction_amount;
	$tech_sanction_amount+=$agency->tech_sanction_amount;
	$agreement_amount+=$agency->agreement_amount;
	$total_projects+=$agency->total_projects;
	$not_started+=$agency->not_started;
	$work_in_progress+=$agency->work_in_progress;
	$work_completed+=$agency->work_completed;
	$expenses+=$agency->expenses;
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