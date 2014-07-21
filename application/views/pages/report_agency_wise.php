	<div class="row">
	<div class="col-md-12 ">
	<div class="col-md-7 ">
	<h3>Agency wise summary report <small>Click on any one to view </small></h3>
	</div>
	<div class="col-md-5 pull-right">
		<?php echo form_open('reports/agencies',array('class'=>'form-custom')); ?>
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
			<th colspan="11" style="text-align:center">
				<?php if($this->input->post('state')){
							if($this->input->post('state')=="TS") echo "Telangana";
							else if($this->input->post('state')=="AP") echo "Andhra Pradesh";
						}
					else echo "Andhra Pradesh and Telangana";
				?>
			</th>
		</tr>
		<th>S.No</th>
		<th>Agency</th>
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
	$medical=0;
	$non_medical=0;
	$work_in_progress=0;
	$work_completed=0;
	$expenses=0;
	$expenses_prev=0;
	$expenses_current=0;
	$targets_current=0;
	$i=1;
	foreach($agencies as $agency){
	?>
	<?php echo form_open('reports/agencies',array('id'=>'select_agency_form_'.$agency->agency_id,'role'=>'form')); ?>
	
	<tr onclick="$('#select_agency_form_<?php echo $agency->agency_id;?>').submit();">
		<td><?php echo $i; ?></td>
		<td><?php echo $agency->agency_name; ?>
		<input type='hidden' value="<?php echo $agency->agency_id; ?>" name="agency" />
		</td>
		<td class="text-right"><?php echo number_format($agency->admin_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($agency->tech_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($agency->agreement_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($agency->expenses_last_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($agency->expenses_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($agency->targets_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($agency->admin_sanction_amount-($agency->expenses_current_year+$agency->expenses_last_year))/10000000,2); ?></td>
		<td class="text-right"><?php echo $agency->total_projects; ?></td>
		<td class="text-right"><?php echo $agency->not_started; ?></td>
		<td class="text-right"><?php echo $agency->work_in_progress; ?></td>
		<td class="text-right"><?php echo $agency->work_completed; ?></td>
		<td class="text-right"><?php echo $agency->medical; ?></td>
		<td class="text-right"><?php echo $agency->non_medical; ?></td>
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
	$medical+=$agency->medical;
	$non_medical+=$agency->non_medical;
	$expenses_prev+=$agency->expenses_last_year;
	$expenses_current+=$agency->expenses_current_year;
	$targets_current+=$agency->targets_current_year;
	$expenses+=$agency->expenses_last_year+$agency->expenses_current_year;
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