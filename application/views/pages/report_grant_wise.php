	<div class="row">
	<div class="col-md-12 ">
	<div class="col-md-7 ">
	<h3>Grant wise summary report <small>Click on any one to view </small></h3>
	<small>All amounts displayed in crores of rupees.</small>	
	</div>
	<div class="col-md-5 pull-right">
		<?php echo form_open('reports/grants',array('class'=>'form-custom')); ?>
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
		<th>Grant</th>
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
	foreach($grants as $grant){
	?>
	<?php echo form_open('reports/grants',array('id'=>'select_grant_form_'.$grant->grant_id,'role'=>'form')); ?>
	
	<tr onclick="$('#select_grant_form_<?php echo $grant->grant_id;?>').submit();">
		<td><?php echo $i; ?></td>
		<td><?php echo $grant->grant_name; ?>
		<input type='hidden' value="<?php echo $grant->grant_id; ?>" name="grant" />
		</td>
		<td class="text-right"><?php echo number_format($grant->admin_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($grant->tech_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($grant->agreement_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($grant->expenses_last_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($grant->expenses_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($grant->targets_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($grant->admin_sanction_amount-($grant->expenses_current_year+$grant->expenses_last_year))/10000000,2); ?></td>
		<td class="text-right"><?php echo $grant->total_projects; ?></td>
		<td class="text-right"><?php echo $grant->not_started; ?></td>
		<td class="text-right"><?php echo $grant->work_in_progress; ?></td>
		<td class="text-right"><?php echo $grant->work_completed; ?></td>
		<td class="text-right"><?php echo $grant->medical; ?></td>
		<td class="text-right"><?php echo $grant->non_medical; ?></td>
	</tr>
	</form>
	<?php
	$admin_sanction_amount+=$grant->admin_sanction_amount;
	$tech_sanction_amount+=$grant->tech_sanction_amount;
	$agreement_amount+=$grant->agreement_amount;
	$total_projects+=$grant->total_projects;
	$not_started+=$grant->not_started;
	$work_in_progress+=$grant->work_in_progress;
	$work_completed+=$grant->work_completed;
	$medical+=$grant->medical;
	$non_medical+=$grant->non_medical;
	$expenses_prev+=$grant->expenses_last_year;
	$expenses_current+=$grant->expenses_current_year;
	$targets_current+=$grant->targets_current_year;
	$expenses+=$grant->expenses_last_year+$grant->expenses_current_year;
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