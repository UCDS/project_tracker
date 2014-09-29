	<div class="row">
	<div class="col-md-12 ">
	<div class="col-md-7">
	<h3>District wise summary report <small>Click on any one to view </small></h3>
	<small>All amounts displayed in crores of rupees.</small>
	</div>
	<div class="col-md-5 pull-right">
		<?php echo form_open('reports/districts',array('class'=>'form-custom')); ?>
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
			<th colspan="13" style="text-align:center">
				<?php if($this->input->post('state')){
							if($this->input->post('state')=="TS") echo "Telangana";
							else if($this->input->post('state')=="AP") echo "Andhra Pradesh";
						}
					else echo "Andhra Pradesh and Telangana";
				?>
			</th>
		</tr>
		<th>S.No</th>
		<th>District Name</th>
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
	foreach($districts as $district){
	?>
	<tr onclick="$('#select_district_form_<?php echo $district->district_id;?>').submit();">
		<td>
			<?php echo form_open('reports/districts',array('id'=>'select_district_form_'.$district->district_id,'role'=>'form')); ?>
			<?php echo $i++; ?>
		</td>
		<td><?php echo $district->district_name; ?>
		<?php if($this->input->post('state')) { ?>
		<input type='hidden' value="<?php echo $this->input->post('state'); ?>" name="state" />
		<?php } ?>
		<input type='hidden' value="<?php if($district->district_id!=NULL) echo $district->district_id; else echo "0" ?>" name="district_id" />
		</td>
		<td class="text-right"><?php echo number_format($district->admin_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($district->tech_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($district->agreement_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($district->expenses_last_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($district->expenses_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($district->targets_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($district->expenses_current_year/$district->targets_current_year)*100,2); ?>%</td>
		<td class="text-right"><?php echo number_format(($district->expenses_current_year+$district->expenses_last_year)/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($district->admin_sanction_amount-($district->expenses_current_year+$district->expenses_last_year))/10000000,2); ?></td>
		<td class="text-right"><?php echo $district->total_projects; ?></td>
		<td class="text-right"><?php echo $district->not_started; ?></td>
		<td class="text-right"><?php echo $district->work_in_progress; ?></td>
		<td class="text-right"><?php echo $district->work_completed; ?></td>
		<td class="text-right"><?php echo $district->medical; ?></td>
		<td class="text-right"><?php echo $district->non_medical; ?>
			</form>
		</td>
	</tr>
	<?php
	$admin_sanction_amount+=$district->admin_sanction_amount;
	$tech_sanction_amount+=$district->tech_sanction_amount;
	$agreement_amount+=$district->agreement_amount;
	$total_projects+=$district->total_projects;
	$not_started+=$district->not_started;
	$work_in_progress+=$district->work_in_progress;
	$work_completed+=$district->work_completed;
	$medical+=$district->medical;
	$non_medical+=$district->non_medical;
	$expenses_prev+=$district->expenses_last_year;
	$expenses_current+=$district->expenses_current_year;
	$targets_current+=$district->targets_current_year;
	$expenses+=$district->expenses_last_year+$district->expenses_current_year;
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