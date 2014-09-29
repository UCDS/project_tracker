	<div class="row">
	<div class="col-md-12 ">
	<div class="col-md-7">
	<h3>Division wise summary report <small>Click on any one to view </small></h3>
	<small>All amounts displayed in crores of rupees.</small>
	</div>
	<div class="col-md-5 pull-right">
		<?php echo form_open('reports/divisions',array('class'=>'form-custom')); ?>
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
		<th>Division Name</th>
		<th>AS</th>
		<th>TS</th>
		<th>Agt</th>
		<th>Cum. Exp prev. years</th>
		<th>Exp during year</th>
		<th>Targets during year</th>
		<th>%Ach during year</th>
		<th>Cum. Exp</th>
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
	foreach($districts as $division){
	?>
	<tr onclick="$('#select_division_form_<?php echo $division->division_id;?>').submit();">
		<td>	
			<?php echo form_open('reports/divisions',array('id'=>'select_division_form_'.$division->division_id,'role'=>'form')); ?>
			<?php echo $i++; ?>
		</td>
		<td><?php echo $division->division; ?>
		<?php if($this->input->post('state')) { ?>
		<input type='hidden' value="<?php echo $this->input->post('state'); ?>" name="state" />
		<?php } ?>
		<input type='hidden' value="<?php if($division->division_id!=NULL) echo $division->division_id; else echo "0" ?>" name="division_id" />
		</td>
		<td class="text-right"><?php echo number_format($division->admin_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($division->tech_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($division->agreement_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($division->expenses_last_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($division->expenses_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($division->targets_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($division->expenses_current_year/$division->targets_current_year)*100,2); ?>%</td>
		<td class="text-right"><?php echo number_format(($division->expenses_current_year+$division->expenses_last_year)/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($division->admin_sanction_amount-($division->expenses_current_year+$division->expenses_last_year))/10000000,2); ?></td>
		<td class="text-right"><?php echo $division->total_projects; ?></td>
		<td class="text-right"><?php echo $division->not_started; ?></td>
		<td class="text-right"><?php echo $division->work_in_progress; ?></td>
		<td class="text-right"><?php echo $division->work_completed; ?></td>
		<td class="text-right"><?php echo $division->medical; ?></td>
		<td class="text-right"><?php echo $division->non_medical; ?>
	</form></td>
	</tr>
	<?php
	$admin_sanction_amount+=$division->admin_sanction_amount;
	$tech_sanction_amount+=$division->tech_sanction_amount;
	$agreement_amount+=$division->agreement_amount;
	$total_projects+=$division->total_projects;
	$not_started+=$division->not_started;
	$work_in_progress+=$division->work_in_progress;
	$work_completed+=$division->work_completed;
	$medical+=$division->medical;
	$non_medical+=$division->non_medical;
	$expenses_prev+=$division->expenses_last_year;
	$expenses_current+=$division->expenses_current_year;
	$targets_current+=$division->targets_current_year;
	$expenses+=$division->expenses_last_year+$division->expenses_current_year;
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
		<th class="text-right"><?php echo number_format(($expenses_current/$targets_current)*100,2);?></th>
		<th class="text-right"><?php echo number_format($expenses/10000000,2);?></th>
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