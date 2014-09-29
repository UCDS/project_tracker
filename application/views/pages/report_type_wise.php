	<div class="row">
	<div class="col-md-12 ">
	<div class="col-md-7 ">
	<h3>Facility type wise summary report <small>Click on any one to view </small></h3>
	</div>
	<div class="col-md-5 pull-right">
		<?php echo form_open('reports/facility_types',array('class'=>'form-custom')); ?>
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
		<th>Facility Type</th>
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
	foreach($facility_types as $facility_type){
	?>
	
	<tr onclick="$('#select_facility_type_form_<?php echo $facility_type->facility_type_id;?>').submit();">
		<td>
			<?php echo form_open('reports/facility_types',array('id'=>'select_facility_type_form_'.$facility_type->facility_type_id,'role'=>'form')); ?>
			<?php echo $i++; ?>
		</td>
		<td><?php echo $facility_type->facility_type; ?>
		<?php if($this->input->post('state')) { ?>
		<input type='hidden' value="<?php echo $this->input->post('state'); ?>" name="state" />
		<?php } ?>
		<input type='hidden' value="<?php if($facility_type->facility_type_id!=NULL) echo $facility_type->facility_type_id;else echo "0"; ?>" name="facility_type" />
		</td>
		<td class="text-right"><?php echo number_format($facility_type->admin_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($facility_type->tech_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($facility_type->agreement_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($facility_type->expenses_last_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($facility_type->expenses_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($facility_type->targets_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($facility_type->expenses_current_year/$facility_type->targets_current_year)*100,2); ?>%</td>
		<td class="text-right"><?php echo number_format(($facility_type->expenses_current_year+$facility_type->expenses_last_year)/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($facility_type->admin_sanction_amount-($facility_type->expenses_current_year+$facility_type->expenses_last_year))/10000000,2); ?></td>
		<td class="text-right"><?php echo $facility_type->total_projects; ?></td>
		<td class="text-right"><?php echo $facility_type->not_started; ?></td>
		<td class="text-right"><?php echo $facility_type->work_in_progress; ?></td>
		<td class="text-right"><?php echo $facility_type->work_completed; ?></td>
		<td class="text-right"><?php echo $facility_type->medical; ?></td>
		<td class="text-right"><?php echo $facility_type->non_medical; ?>
			</form>
		</td>
	</tr>
	<?php
	$admin_sanction_amount+=$facility_type->admin_sanction_amount;
	$tech_sanction_amount+=$facility_type->tech_sanction_amount;
	$agreement_amount+=$facility_type->agreement_amount;
	$total_projects+=$facility_type->total_projects;
	$not_started+=$facility_type->not_started;
	$work_in_progress+=$facility_type->work_in_progress;
	$work_completed+=$facility_type->work_completed;
	$medical+=$facility_type->medical;
	$non_medical+=$facility_type->non_medical;
	$expenses_prev+=$facility_type->expenses_last_year;
	$expenses_current+=$facility_type->expenses_current_year;
	$targets_current+=$facility_type->targets_current_year;
	$expenses+=$facility_type->expenses_last_year+$facility_type->expenses_current_year;
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