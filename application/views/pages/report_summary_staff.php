  <div class="row">
	<div class="col-md-12 ">
		<div class="col-md-7">
		<h3><?php echo $title;?><small>Click on any one to view </small></h3>
		
		<small>All amounts displayed in crores of rupees.</small>
		</div>
		<div class="col-md-5 pull-right">
			<?php if(count($states)>1){ ?>
			<?php echo form_open("reports/staff",array('class'=>'form-custom')); ?>
			Select State
			<select name="state" class="form-control">
				<option value="">All</option>
				<option value="1">Andhra Pradesh</option>
				<option value="2">Telangana</option>
			</select>
			<input type="submit" class="btn btn-primary" name="state_submit" value="Submit" />
			</form>
			<?php } ?>
		</div>
	<div class="col-md-12">
	<div class="col-md-4 pull-right">
 	<?php echo form_open('reports/staff',array('id'=>'select_month','role'=>'form','class'=>'form-custom'));?>
	<small>Get report as on</small>
	<select class="form-control" style="width:100px" name="month" id="month">
	<option selected disabled>Month</option>
	<?php 
	for($i=1;$i<=12;$i++){
		echo "<option value='".date("m", mktime(0, 0, 0, $i+1, 0, 0))."'";
		if($this->input->post('month') && $this->input->post('month')==$i) echo " selected ";
		else if($i==date("m")) echo " selected ";
		echo ">".date("M", mktime(0, 0, 0, $i+1, 0, 0))."</option>";
	}
	?>
	</select>
	<select class="form-control" style="width:100px"  name="year" id="year">
	<option selected disabled>Year</option>
	<?php 
	$year=date("Y");
	for($i=2009;$i<=$year+1;$i++){
		echo "<option value='$i'";
		if($this->input->post('year') && $this->input->post('year')==$i) echo " selected ";
		else if($i==date("Y")) echo " selected ";
		echo ">$i</option>";
	}
	?>
	</select>
	<button class="btn btn-sm" type="submit" name="select_month">Go</button>
	</form>
	<br>
	<input id="colSelect1" type="checkbox" class="sr-only" hidden />
	<label class="btn btn-default btn-md" for="colSelect1">Select Columns</label>
	<div id="columnSelector" class="columnSelector col-md-4"></div>
	<button type="button" class="btn btn-default btn-md print">
	  <span class="glyphicon glyphicon-print"></span> Print
	</button>
	</div>
	</div>
	<div class="row"></div>
	<h5>
		<?php if(count($states)>1){ ?>
				<?php if($this->input->post('state')){
							if($this->input->post('state')=="TS") echo "Telangana";
							else if($this->input->post('state')=="AP") echo "Andhra Pradesh";
						}
					else echo "Andhra Pradesh and Telangana";
				?>
		<?php } ?>
	</h5>
	<table class="table table-hover table-striped table-bordered tablesorter" id="table-1">
	<thead>
		<tr>
		<th data-priority="critical">S.No</th>
		<th data-priority="critical" data-name="name">Division</th>
		<th data-priority="critical" data-name="name">Staff</th>
		<th>AS</th>
		<th>TS</th>
		<th>Agt</th>
		<th>Cum. Exp. prev. years</th>
		<th>Cum. Exp. Last FY</th>
		<th>Balace Work as on 1st April</th>
		<th>Exp. DY upto last month</small></th>
		<th>Target DY upto last month</small></th>
		<th>%Ach During year</th>
		<th>Exp. DM <?php if($this->input->post('month')&& $this->input->post('year')) { ?>
		<small><?php echo date("M", mktime(0, 0, 0, $this->input->post('month')+1,  0, 0)).", ".$this->input->post('year');?></small>
		<?php } else{ echo date("M, Y"); } ?></th>
		<th>Target DM <?php if($this->input->post('month')&& $this->input->post('year')) { ?>
		<small><?php echo date("M", mktime(0, 0, 0, $this->input->post('month')+1,  0, 0)).", ".$this->input->post('year');?></small>
		<?php } else{ echo date("M, Y"); } ?></th>
		<th>Cum. Exp</th>
		<th>Pending Bills</th>
		<th>Total Target for the year</th>
		<th>Exp % over TS</th>
		<th>Balance</th>
		<th>Total Works</th>
		<th>Not Started</th>
		<th>In Progress</th>
		<th>Completed</th>
		<th>Medical</th>
		<th>Non Medical</th>
		</tr>
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
	$expenses_prev_year=0;
	$expenses_current=0;
	$expenses_current_month=0;
	$targets_current=0;
	$targets_current_month=0;
	$targets_total=0;
	$pending_bills=0;
	$divisions=array();
	$i=1;
	foreach($summary as $row){
		if(!!$row->reporting_officer_id) ${'reporting_officer_'.$row->reporting_officer_id}=0;
	}
	echo $reporting_officer_60;
	foreach($summary as $row){
	if(!in_array($row->division_id ,$divisions)){
		if(count($divisions)>0){?>

			<tr onclick="$('#select_form_<?php echo $division_id;?>').submit();">
				<td></td>
				<th>
				<?php echo form_open("reports/staff",array('id'=>'select_form_'.$division_id,'role'=>'form')); ?>
				<?php echo $division." Total"; ?>
				<?php if($this->input->post('state')) { ?>
				<input type='hidden' class="sr-only" value="<?php echo $this->input->post('state'); ?>" name="state" />
				<?php } ?>
				<?php if($this->input->post('year')) { ?>
				<input type='hidden' class="sr-only" value="<?php echo $this->input->post('year'); ?>" name="year" />
				<?php } ?>
				<?php if($this->input->post('month')) { ?>
				<input type='hidden' class="sr-only" value="<?php echo $this->input->post('month'); ?>" name="month" />
				<?php } ?>
				<input type='hidden' value="<?php if($division_id!=NULL) echo $division_id; else echo "'0'" ?>" name="division_id" />
				</th>
				<td></td>
				<th class="text-right"><?php echo number_format($admin_sanction_amount_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($tech_sanction_amount_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($agreement_amount_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($expenses_prev_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($expenses_prev_year_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format(($tech_sanction_amount_sub-$expenses_prev_sub)/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($expenses_current_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($targets_current_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format(($expenses_current_sub/$targets_current_sub)*100,2);?>%</th>
				<th class="text-right"><?php echo number_format($expenses_current_month_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($targets_current_month_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($expenses_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($pending_bills_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($targets_total_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format(($expenses_sub/$tech_sanction_amount_sub)*100,2);?>%</th>
				<th class="text-right"><?php echo number_format(($admin_sanction_amount_sub-$expenses_sub)/10000000,2);?></th>
				<th class="text-right"><?php echo $total_projects_sub;?></th>
				<th class="text-right"><?php echo $not_started_sub;?></th>
				<th class="text-right"><?php echo $work_in_progress_sub;?></th>
				<th class="text-right"><?php echo $work_completed_sub;?></th>
				<th class="text-right"><?php echo $medical_sub;?></th>
				<th class="text-right"><?php echo $non_medical_sub;?></form></th>
			</tr>
		<?php
		}
		$admin_sanction_amount_sub=0;
		$tech_sanction_amount_sub=0;
		$agreement_amount_sub=0;
		$total_projects_sub=0;
		$not_started_sub=0;
		$work_in_progress_sub=0;
		$work_completed_sub=0;
		$medical_sub=0;
		$non_medical_sub=0;
		$expenses_sub=0;
		$expenses_prev_sub=0;
		$expenses_prev_year_sub=0;
		$expenses_current_sub=0;
		$expenses_current_month_sub=0;
		$targets_current_sub=0;
		$targets_current_month_sub=0;
		$targets_total_sub=0;
		$pending_bills_sub=0;
		$division_id = $row->division_id;
		$division=$row->division;
		$divisions[]=$row->division_id;
	}
	?>
	<tr onclick="$('#select_form_<?php echo $row->$id;?>').submit();">
		<td>
			<?php echo form_open("reports/staff",array('id'=>'select_form_'.$row->$id,'role'=>'form')); ?>
			<?php echo $i++; ?>
		</td>
		<td><?php echo $row->division; ?>
		<?php if($this->input->post('state')) { ?>
		<input type='hidden' class="sr-only" value="<?php echo $this->input->post('state'); ?>" name="state" />
		<?php } ?>
		<?php if($this->input->post('year')) { ?>
		<input type='hidden' class="sr-only" value="<?php echo $this->input->post('year'); ?>" name="year" />
		<?php } ?>
		<?php if($this->input->post('month')) { ?>
		<input type='hidden' class="sr-only" value="<?php echo $this->input->post('month'); ?>" name="month" />
		<?php } ?>
		<input type='hidden' value="<?php if($row->$id!=NULL) echo $row->$id; else echo "'0'" ?>" name="<?php echo $id;?>" />
		<input type='hidden' value="<?php if($row->division_id!=NULL) echo $row->division_id; else echo "'0'" ?>" name="division_id" />
		</td>
		<td><?php echo $row->staff_name."<br /><small>".$row->designation."</small>";?></td>
		<td class="text-right"><?php echo number_format($row->admin_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($row->tech_sanction_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($row->agreement_amount/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($row->expenses_last_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($row->expenses_previous_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($row->tech_sanction_amount-$row->expenses_last_year)/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($row->expenses_current_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($row->targets_current_year/10000000,2); ?></td>
		<td class="text-right"><?php if($row->targets_current_year>0) echo number_format(($row->expenses_current_year/$row->targets_current_year)*100,2); else echo 0;?>%</td>
		<td class="text-right"><?php echo number_format($row->expense_current_month/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($row->target_current_month/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($row->expenses_current_year+$row->expenses_last_year)/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($row->bills_pending/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($row->targets_total_year/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($row->expenses_current_year+$row->expenses_last_year)/$row->tech_sanction_amount*100);echo "%" ?></td>
		<td class="text-right"><?php echo number_format(($row->admin_sanction_amount-($row->expenses_current_year+$row->expenses_last_year))/10000000,2); ?></td>
		<td class="text-right"><?php echo $row->total_projects; ?></td>
		<td class="text-right"><?php echo $row->not_started; ?></td>
		<td class="text-right"><?php echo $row->work_in_progress; ?></td>
		<td class="text-right"><?php echo $row->work_completed; ?></td>
		<td class="text-right"><?php echo $row->medical; ?></td>
		<td class="text-right"><?php echo $row->non_medical; ?>
			</form>
		</td>
	</tr>
	<?php
	$admin_sanction_amount+=$row->admin_sanction_amount;
	$tech_sanction_amount+=$row->tech_sanction_amount;
	$agreement_amount+=$row->agreement_amount;
	$total_projects+=$row->total_projects;
	$not_started+=$row->not_started;
	$work_in_progress+=$row->work_in_progress;
	$work_completed+=$row->work_completed;
	$medical+=$row->medical;
	$non_medical+=$row->non_medical;
	$expenses_prev+=$row->expenses_last_year;
	$expenses_prev_year+=$row->expenses_previous_year;
	$expenses_current+=$row->expenses_current_year;
	$expenses_current_month+=$row->expense_current_month;
	$targets_current+=$row->targets_current_year;
	$targets_current_month+=$row->target_current_month;
	$expenses+=$row->expenses_last_year+$row->expenses_current_year;
	$targets_total+=$row->targets_total_year;
	$pending_bills+=$row->bills_pending;
	$admin_sanction_amount_sub+=$row->admin_sanction_amount;
	$tech_sanction_amount_sub+=$row->tech_sanction_amount;
	$agreement_amount_sub+=$row->agreement_amount;
	$total_projects_sub+=$row->total_projects;
	$not_started_sub+=$row->not_started;
	$work_in_progress_sub+=$row->work_in_progress;
	$work_completed_sub+=$row->work_completed;
	$medical_sub+=$row->medical;
	$non_medical_sub+=$row->non_medical;
	$expenses_prev_sub+=$row->expenses_last_year;
	$expenses_prev_year_sub+=$row->expenses_previous_year;
	$expenses_current_sub+=$row->expenses_current_year;
	$expenses_current_month_sub+=$row->expense_current_month;
	$targets_current_sub+=$row->targets_current_year;
	$targets_current_month_sub+=$row->target_current_month;
	$expenses_sub+=$row->expenses_last_year+$row->expenses_current_year;
	$targets_total_sub+=$row->targets_total_year;
	$pending_bills_sub+=$row->bills_pending;
	echo "<script>console.log('".count($summary)."');</script>";
	if($i==(count($summary)+1)){ ?>

			<tr onclick="$('#select_form_<?php echo $division_id;?>').submit();">
				<td></td>
				<th>
					<?php echo form_open("reports/staff",array('id'=>'select_form_'.$division_id,'role'=>'form')); ?>
				<?php echo $division." Total"; ?>
				<?php if($this->input->post('state')) { ?>
				<input type='hidden' class="sr-only" value="<?php echo $this->input->post('state'); ?>" name="state" />
				<?php } ?>
				<?php if($this->input->post('year')) { ?>
				<input type='hidden' class="sr-only" value="<?php echo $this->input->post('year'); ?>" name="year" />
				<?php } ?>
				<?php if($this->input->post('month')) { ?>
				<input type='hidden' class="sr-only" value="<?php echo $this->input->post('month'); ?>" name="month" />
				<?php } ?>
				<input type='hidden' value="<?php if($division_id!=NULL) echo $division_id; else echo "'0'" ?>" name="division_id" />
				</th>
				<td></td>
				<th class="text-right"><?php echo number_format($admin_sanction_amount_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($tech_sanction_amount_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($agreement_amount_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($expenses_prev_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($expenses_prev_year_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format(($tech_sanction_amount_sub-$expenses_prev_sub)/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($expenses_current_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($targets_current_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format(($expenses_current_sub/$targets_current_sub)*100,2);?>%</th>
				<th class="text-right"><?php echo number_format($expenses_current_month_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($targets_current_month_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($expenses_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($pending_bills_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format($targets_total_sub/10000000,2);?></th>
				<th class="text-right"><?php echo number_format(($expenses_sub/$tech_sanction_amount_sub)*100,2);?>%</th>
				<th class="text-right"><?php echo number_format(($admin_sanction_amount_sub-$expenses_sub)/10000000,2);?></th>
				<th class="text-right"><?php echo $total_projects_sub;?></th>
				<th class="text-right"><?php echo $not_started_sub;?></th>
				<th class="text-right"><?php echo $work_in_progress_sub;?></th>
				<th class="text-right"><?php echo $work_completed_sub;?></th>
				<th class="text-right"><?php echo $medical_sub;?></th>
				<th class="text-right"><?php echo $non_medical_sub;?></form></th>
			</tr>		
	<?php 
		}
	}
	?>
	</tbody>
	<tr onclick="$('#select_form_all').submit();">
		<th>	
			<?php echo form_open("reports/staff",array('id'=>'select_form_all','role'=>'form')); ?>
				<input type='hidden' value="0" form="select_form_all" name="<?php echo $id;?>" />
			</form>
			Total
		</th>
		<th></th>
		<th></th>
		<th class="text-right"><?php echo number_format($admin_sanction_amount/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($tech_sanction_amount/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($agreement_amount/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($expenses_prev/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($expenses_prev_year/10000000,2);?></th>
		<th class="text-right"><?php echo number_format(($tech_sanction_amount-$expenses_prev)/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($expenses_current/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($targets_current/10000000,2);?></th>
		<th class="text-right"><?php echo number_format(($expenses_current/$targets_current)*100,2);?>%</th>
		<th class="text-right"><?php echo number_format($expenses_current_month/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($targets_current_month/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($expenses/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($pending_bills/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($targets_total/10000000,2);?></th>
		<th class="text-right"><?php echo number_format(($expenses/$tech_sanction_amount)*100,2);?>%</th>
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
