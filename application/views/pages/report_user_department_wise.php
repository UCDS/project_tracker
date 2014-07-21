	<div class="row">
	<div class="col-md-12 ">
	<div class="col-md-7">
	<h3>User Department wise summary report <small>Click on any one to view </small></h3>
	</div>
	<div class="col-md-5 pull-right">
		<?php echo form_open('reports/user_departments',array('class'=>'form-custom')); ?>
		Select State
		<select name="state" class="form-control">
			<option value="">All</option>
			<option value="AP">Andhra Pradesh</option>
			<option value="TS">Telangana</option>
		</select>
		<input type="submit" class="btn btn-primary" name="state_submit" value="Submit" />
		</form>
	</div>
	
	<table class="table table-hover table-striped table-bordered tablesorter" id="table-1">
	<thead>
		<tr>
			<th colspan="15" style="text-align:center">
				<?php if($this->input->post('state')){
							if($this->input->post('state')=="TS") echo "Telangana";
							else if($this->input->post('state')=="AP") echo "Andhra Pradesh";
						}
					else echo "Andhra Pradesh and Telangana";
				?>
			</th>
		</tr>
		<th>S.No</th>
		<th>User Department</th>
		<th>AS</th>
		<th>TS</th>
		<th>Agt</th>
		<th>Cum. Exp prev.</th>
		<th>Cum. Exp current</th>
		<th>Cum. Targets current</th>
		<th>Balance</th>
		<th>Total Works</th>
		<th>Not Started</th>
		<th>In Progress</th>
		<th>Completed</th>
		<th>Medical</th>
		<th>Non Medical</th>
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
	$medical=0;
	$non_medical=0;
	$expenses=0;
	$expenses_prev=0;
	$expenses_current=0;
	$targets_current=0;
	$i=1;
	foreach($user_departments as $user_department){
	?>
	<?php echo form_open('reports/user_departments',array('id'=>'select_user_department_form_'.$user_department->user_department_id,'role'=>'form')); ?>
	
	<tr onclick="$('#select_user_department_form_<?php echo $user_department->user_department_id;?>').submit();">
		<td><?php echo $i; ?></td>
		<td><?php echo $user_department->user_department; ?>
		<input type='hidden' value="<?php echo $user_department->user_department_id; ?>" name="user_department" />
		</td>
		<td class="text-right"><?php echo number_format($user_department->admin_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($user_department->tech_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($user_department->agreement_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($user_department->expenses_last_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($user_department->expenses_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($user_department->targets_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($user_department->admin_sanction_amount-($user_department->expenses_current_year+$user_department->expenses_last_year))/10000000,2); ?></td>
		<td class="text-right"><?php echo $user_department->total_projects; ?></td>
		<td class="text-right"><?php echo $user_department->not_started; ?></td>
		<td class="text-right"><?php echo $user_department->work_in_progress; ?></td>
		<td class="text-right"><?php echo $user_department->work_completed; ?></td>
		<td class="text-right"><?php echo $user_department->medical; ?></td>
		<td class="text-right"><?php echo $user_department->non_medical; ?></td>
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
	$medical+=$user_department->medical;
	$non_medical+=$user_department->non_medical;
	$expenses_prev+=$user_department->expenses_last_year;
	$expenses_current+=$user_department->expenses_current_year;
	$targets_current+=$user_department->targets_current_year;
	$expenses+=$user_department->expenses_last_year+$user_department->expenses_current_year;
	}
	?>
	</tbody>
	<tr>
		<th colspan="2">Total</th>
		<th class="text-right"><?php echo number_format($admin_sanction_amount/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($tech_sanction_amount/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($agreement_amount/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($expenses_prev/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($expenses_current/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($targets_current/10000000,2);?></th>
		<th class="text-right"><?php echo number_format(($admin_sanction_amount-$expenses)/10000000,2);?></th>
		<th class="text-right"><?php echo $total_projects;?></th>
		<th class="text-right"><?php echo $not_started;?></th>
		<th class="text-right"><?php echo $work_in_progress;?></th>
		<th class="text-right"><?php echo $work_completed;?></th>
		<th class="text-right"><?php echo $medical;?></th>
		<th class="text-right"><?php echo $non_medical;?></th>
	</tr>
	</table>
	</div>
	</div>