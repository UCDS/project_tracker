	<?php 
		switch($report_type){
			case "divisions" : $heading="Projects in ".$projects[0]->division; break;
			case "districts" : $heading = "Projects "; break;
			case "grants" : $heading = $projects[0]->phase_name." Works "; break;
			case "facility_types" : $heading = $projects[0]->facility_type; break;
			case "agencies" : $heading = "Projects by ".$projects[0]->agency_name; break;
			case "user_departments" : $heading = "Projects in ".$projects[0]->user_department; break;
			default : $heading=""; break;
		}
		$admin_sanction=0;$tech_sanction=0;$expenditure_previous_year=0;$expenditure_previous=0;$target_previous=0;$expenditure_current=0;$target_current=0;$expenditure_cumilative=0;$targets_total=0;$agreement_amount=0;$balance=0;
	?>
	<div class="row">
	<div class="col-md-10">
	<div class="col-md-7">
	<h3><?php echo $heading;?> <?php if($this->input->post('district_id')) echo " in ".$projects[0]->district_name;?> <small>Click on any one to view </small></h3>
	<small>All amounts are shown in Lakhs of rupees</small>
	</div>
	<div class="col-md-5">
 	<?php echo form_open('reports/'.$report_type,array('id'=>'select_month','role'=>'form','class'=>'form-custom'));?>
	<?php 
		if($report_type=="grants"){ ?>
		<input type='hidden' value="<?php echo $projects[0]->grant_phase_id; ?>" name="grant" />
	<?php }
		else if($report_type == "divisions"){ ?>
			<input type='hidden' value="<?php echo $projects[0]->division_id; ?>" name="division_id" />
		<?php } 	
		else if($report_type == "districts"){ ?>
			<input type='hidden' value="<?php echo $projects[0]->district_id; ?>" name="district_id" />
		<?php } 	
		else if($report_type == "user_departments"){ ?>
			<input type='hidden' value="<?php echo $projects[0]->user_department_id; ?>" name="user_department" />
		<?php } 	
		else if($report_type == "facility_types"){ ?>
			<input type='hidden' value="<?php echo $projects[0]->facility_type_id; ?>" name="facility_type" />
		<?php } 	
		else if($report_type == "agencies"){ ?>
			<input type='hidden' value="<?php echo $projects[0]->agency_id; ?>" name="agency" />
		<?php } 	?>
	<select class="form-control" style="width:100px" name="month" id="month">
	<option selected disabled>Month</option>
	<?php 
	for($i=1;$i<=12;$i++){
		echo "<option value='".date("m", mktime(0, 0, 0, $i+1, 0, 0, 0))."'>".date("M", mktime(0, 0, 0, $i+1, 0, 0, 0))."</option>";
	}
	?>
	</select>
	<select class="form-control" style="width:100px"  name="year" id="year">
	<option selected disabled>Year</option>
	<?php 
	$year=date("Y");
	for($i=2009;$i<=$year+1;$i++){
		echo "<option value='$i'>$i</option>";
	}
	?>
	</select>
	<?php if(isset($district) && count($district)>0){ ?>
	<select name="district_id" id="district" style="width:150px"  class="form-control">
		<option value="">District</option>
		<?php
		for ($e = 0; $e < count($district); $e++)
		{
		  for ($ee = $e+1; $ee < count($district); $ee++)
		  {
			if ($district[$ee]->district_id==$district[$e]->district_id)
			{
			array_splice($district,$ee,1);
			$ee--;
			}
		  }
		}
		foreach($district as $d){
		
			echo "<option value='$d->district_id'>$d->district_name</option>";
		}
		?>
	</select>	
	<?php } ?>
	<button class="btn btn-sm pull-right" type="submit" name="select_month">Go</button>

	</form>
	</div>
	<table class="table table-hover table-bordered tablesorter" id="table-1">
	<thead>
	<th>S.No</th>
	<th>Project ID</th>
	<th>Project Name</th>
	<th>Facility Name</th>
	<th>Scheme</th>
	<th>AS</th>
	<th>TS</th>
	<th>Agt</th>
	<th>Cum. Exp. prev. years</th>
	<th>Exp. DY upto <?php if($this->input->post('month')&& $this->input->post('year')) { ?>
	<small><?php echo date("M", mktime(0, 0, 0, $this->input->post('month'),  0, 0)).", ".$this->input->post('year');?>
	<?php } else { echo date("M, Y",strtotime("last month"));} ?>
	</small></th>
	<th>Target DY upto <?php if($this->input->post('month')&& $this->input->post('year')) { ?>
	<small><?php echo date("M", mktime(0, 0, 0, $this->input->post('month'),  0, 0)).", ".$this->input->post('year');?>
	<?php } else { echo date("M, Y",strtotime("last month"));} ?>
	</small></th>
	<th>%Ach During year</th>
	<th>Exp. DM <?php if($this->input->post('month')&& $this->input->post('year')) { ?>
	<small><?php echo date("M", mktime(0, 0, 0, $this->input->post('month')+1,  0, 0)).", ".$this->input->post('year');?></small>
	<?php } else{ echo date("M, Y"); } ?></th>
	<th>Target DM <?php if($this->input->post('month')&& $this->input->post('year')) { ?>
	<small><?php echo date("M", mktime(0, 0, 0, $this->input->post('month')+1,  0, 0)).", ".$this->input->post('year');?></small>
	<?php } else{ echo date("M, Y"); } ?></th>
	<th>Cum. Exp.</th>
	<th>Total Target for the year</th>
	<th>Exp % over TS</th>
	<th>Balance</th>
	<th>Status</th>
	<th>Stage <hr />Remarks</th>
	<th>Work Type</th>
	</thead>
	<tbody>

	<?php
	$i=1;
	foreach($projects as $project){
	if($project->status_type_id==3){
		$color="background-color:#D6FFDB;";
	}
	else if($project->status_type_id==2){
		$color="background-color:#FFECD6;";
	}
	else if($project->status_type_id==1){
		$color="background-color:#FAB4B4;";
	}
	
	?>
	
	<tr style="<?php echo $color; ?>" onclick="$('#select_project_form_<?php echo $project->project_id;?>').submit();">
		<td>
			<?php echo form_open('reports/projects',array('id'=>'select_project_form_'.$project->project_id,'role'=>'form')); ?>
			<?php echo $i++; ?>
		</td>
		<td><?php echo $project->project_id; ?></td>
		<td><?php echo $project->project_name; ?>
		<input type='hidden' value="<?php echo $project->project_id; ?>" form="select_project_form_<?php echo $project->project_id;?>" name="project_id" />
		</form>
		</td>
		<td><?php echo $project->facility_name; ?></td>
		<td><?php echo $project->phase_name; ?></td>
		<td class="text-right"><?php echo number_format($project->admin_sanction_amount/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->tech_sanction_amount/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->agreement_amount/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expense_upto_last_year/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expense_upto_last_month/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->target_upto_last_month/100000,2); ?></td>
		<td class="text-right"><?php echo number_format(($project->expense_upto_last_month/$project->target_upto_last_month)*100,1); ?>%</td>
		<td class="text-right"><?php echo number_format($project->expense_current_month/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->target_current_month/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expenses/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->targets/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expenses/$project->tech_sanction_amount*100);echo "%" ?></td>
		<td class="text-right"><?php echo number_format(($project->tech_sanction_amount-$project->expenses)/100000,2); ?></td>
		<td><?php echo $project->status_type; ?></td>
		<td style="min-width:200px;"><?php echo $project->stage;?> <hr /><?php echo $project->remarks_1; ?></td>
		<td><?php if($project->work_type_id=='M') echo "Medical";
			else if($project->work_type_id=='N') echo "Non-Medical"; 
			?>
		</td>
	</tr>
	<?php
		$admin_sanction+=$project->admin_sanction_amount;
		$tech_sanction+=$project->tech_sanction_amount;
		$agreement_amount+=$project->agreement_amount;
		$expenditure_previous_year+=$project->expense_upto_last_year;
		$expenditure_previous+=$project->expense_upto_last_month;
		$target_previous+=$project->target_upto_last_month;
		$expenditure_current+=$project->expense_current_month;
		$target_current+=$project->target_current_month;
		$expenditure_cumilative+=$project->expenses;
		$targets_total+=$project->targets;
	}
	?>
	</tbody>
	<tr>
		<th colspan="5">Total</th>
		<th class="text-right"><?php echo number_format($admin_sanction/100000,2);?></th>
		<th class="text-right"><?php echo number_format($tech_sanction/100000,2);?></th>
		<th class="text-right"><?php echo number_format($agreement_amount/100000,2);?></th>
		<th class="text-right"><?php echo number_format($expenditure_previous_year/100000,2);?></th>
		<th class="text-right"><?php echo number_format($expenditure_previous/100000,2);?></th>
		<th class="text-right"><?php echo number_format($target_previous/100000,2);?></th>
		<th class="text-right"><?php echo number_format(($expenditure_previous/$target_previous)*100,1);?>%</th>
		<th class="text-right"><?php echo number_format($expenditure_current/100000,2);?></th>
		<th class="text-right"><?php echo number_format($target_current/100000,2);?></th>
		<th class="text-right"><?php echo number_format($expenditure_cumilative/100000,2);?></th>
		<th class="text-right"><?php echo number_format($targets_total/100000,2);?></th>
		<th class="text-right"><?php echo number_format(($expenditure_cumilative/$tech_sanction)*100);echo "%"; ?></th>
		<th class="text-right"><?php echo number_format(($admin_sanction-$expenditure_cumilative)/100000,2); ?></th>
	</tr>
	</table>
	</div>
	</div>