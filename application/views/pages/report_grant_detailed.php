	<?php 
		$admin_sanction=0;$tech_sanction=0;$expenditure_previous=0;$expenditure_current=0;$expenditure_cumilative=0;$targets_total=0;$agreement_amount=0;$balance=0;
	?>
	<div class="row">
	<div class="col-md-12">
 	<?php echo form_open('reports/grants',array('id'=>'select_month','role'=>'form'));?>
	<button class="btn btn-lg pull-right" type="submit" name="select_month">></button>
		<input type='hidden' value="<?php echo $projects[0]->grant_phase_id; ?>" name="grant" />
	<select class="form-control pull-right" style="width:100px"  name="year" id="year">
	<option selected disabled>Year</option>
	<?php 
	$year=date("Y");
	for($i=2009;$i<=$year+1;$i++){
		echo "<option value='$i'>$i</option>";
	}
	?>
	</select>
	<select class="form-control pull-right" style="width:100px" name="month" id="month">
	<option selected disabled>Month</option>
	<?php 
	for($i=1;$i<=12;$i++){
		echo "<option value='".date("m", mktime(0, 0, 0, $i+1, 0, 0, 0))."'>".date("M", mktime(0, 0, 0, $i+1, 0, 0, 0))."</option>";
	}
	?>
	</select>

	<select name="district_id" id="district" style="width:150px"  class="form-control pull-right">
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
	</form>
	<h3><?php echo $projects[0]->phase_name;?> <?php if($this->input->post('district_id')) echo " in ".$projects[0]->district_name;?> <small> Click on any one to view </small></h3>
		<small>All amounts are shown in Lakhs of rupees</small>
	<table id="header-fixed"  class="table table-hover table-bordered"></table>
	<table class="table table-hover table-bordered" id="table-1">
	<thead>
	<th>S.No</th>
	<th>Project ID</th>
	<th>Project Name</th>
	<th>Facility</th>
	<th>AS</th>
	<th>TS</th>
	<th>Agt</th>
	<th>Exp. upto <?php if($this->input->post('month')&& $this->input->post('year')) { ?>
	<small><?php echo date("M", mktime(0, 0, 0, $this->input->post('month'),  0, 0)).", ".$this->input->post('year');?>
	<?php } else { echo date("M, Y",strtotime("last month"));} ?>
	</small></th>
	
	
	<th>Exp. during <?php if($this->input->post('month')&& $this->input->post('year')) { ?>
	<small><?php echo date("M", mktime(0, 0, 0, $this->input->post('month')+1,  0, 0)).", ".$this->input->post('year');?></small>
	<?php } else{ echo date("M, Y"); } ?></th>
	<th>Cum. Exp.</th>
	<th>Target</th>
	<th>Exp %</th>
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
	<?php echo form_open('reports/projects',array('id'=>'select_project_form_'.$project->project_id,'role'=>'form')); ?>
	
	<tr style="<?php echo $color; ?>" onclick="$('#select_project_form_<?php echo $project->project_id;?>').submit();">
		<td><?php echo $i++; ?></td>
		<td><?php echo $project->project_id; ?></td>
		<td><?php echo $project->project_name; ?>
		<input type='hidden' value="<?php echo $project->project_id; ?>" name="project_id" />
		</form>
		</td>
		<td><?php echo $project->facility_name; ?></td>
		<td class="text-right"><?php echo number_format($project->admin_sanction_amount/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->tech_sanction_amount/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->agreement_amount/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expense_upto_last_month/100000,2); ?> <hr /> <?php echo number_format($project->target_upto_last_month/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expense_current_month/100000,2); ?> <hr /> <?php echo number_format($project->target_current_month/100000,2); ?></td>
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
		$expenditure_previous+=$project->expense_upto_last_month;
		$expenditure_current+=$project->expense_current_month;
		$expenditure_cumilative+=$project->expenses;
		$targets_total+=$project->targets;
	}
	?>
	<tr>
		<th colspan="4">Total</th>
		<th class="text-right"><?php echo number_format($admin_sanction/100000,2);?></th>
		<th class="text-right"><?php echo number_format($tech_sanction/100000,2);?></th>
		<th class="text-right"><?php echo number_format($agreement_amount/100000,2);?></th>
		<th class="text-right"><?php echo number_format($expenditure_previous/100000,2);?></th>
		<th class="text-right"><?php echo number_format($expenditure_current/100000,2);?></th>
		<th class="text-right"><?php echo number_format($expenditure_cumilative/100000,2);?></th>
		<th class="text-right"><?php echo number_format($targets_total/100000,2);?></th>
		<th class="text-right"><?php echo number_format(($expenditure_cumilative/$tech_sanction)*100);echo "%"; ?></th>
		<th class="text-right"><?php echo number_format(($admin_sanction-$expenditure_cumilative)/100000,2); ?></th>
	</tr>
	</tbody>
	</table>
	</div>
	</div>