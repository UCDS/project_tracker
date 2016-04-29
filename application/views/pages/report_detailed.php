	<?php 
		switch($type){
			case "divisions" : $heading="Projects in ".$projects[0]->division; break;
			case "districts" : $heading = "Projects "; break;
			case "schemes" : $heading = $projects[0]->phase_name." Works "; break;
			case "facility_types" : $heading = $projects[0]->facility_type; break;
			case "facilities" : $heading = $projects[0]->facility_name; break;
			case "agencies" : $heading = "Projects by ".$projects[0]->agency_name; break;
			case "staff" : $heading = "Projects in ".$projects[0]->division." assigned to ".$projects[0]->staff_name; break;
			case "user_departments" : $heading = "Projects in ".$projects[0]->user_department; break;
			default : $heading=""; break;
		}
		$admin_sanction=0;$tech_sanction=0;$expenditure_previous_year=0;$expenditure_previous=0;$target_previous=0;$expenditure_current=0;$target_current=0;$expenditure_cumilative=0;$targets_total=0;$agreement_amount=0;$balance=0;
		$pending_bills=0;
	?>
	<?php if(count($projects)==0){ echo "No Projects to display. You might not have access to view this report."; } else { ?> 
	<div class="row">
	<div class="col-md-12">
	<div class="col-md-4">
	<h3><?php if($this->input->post("$id")) {
		echo $heading;
		if($this->input->post('district_id')) echo " in ".$projects[0]->district_name;
	}
	else echo "All Projects";
	?> 
	<small>Click on any one to view </small></h3>
	<small>All amounts are shown in Lakhs of rupees</small>
	</div>
	<div class="col-md-8">
	<div class="panel panel-default">
	<div class="panel-body">
 	<?php echo form_open('reports/summary/'.$type,array('id'=>'select_month','role'=>'form','class'=>'form-custom'));?>
		<input type='hidden' value="<?php if($this->input->post("$id"))echo $projects[0]->$id; else echo 0; ?>" name="<?php echo $id;?>" />

	
	<select class="form-control" style="width:100px" name="month" id="month">
	<option selected disabled>Month</option>
	<?php 
	$m=0;
	for($i=1;$i<=12;$i++){
		echo "<option value='".date("m", mktime(0, 0, 0, $i+1, 0, 0))."'";
		if($this->input->post('month') && $this->input->post('month')==$i) { echo " selected "; $m=1;}
		else if($m==0 && $i==date("m") ) echo " selected ";
		echo ">".date("M", mktime(0, 0, 0, $i+1, 0, 0))."</option>";
	}
	?>
	</select>
	<select class="form-control" style="width:100px"  name="year" id="year">
	<option selected disabled>Year</option>
	<?php 
	$year=date("Y");
	$y=0;
	for($i=2009;$i<=$year+1;$i++){
		echo "<option value='$i'";
		if($this->input->post('year') && $this->input->post('year')==$i){ echo " selected "; $y=1; }
		else if($y==0 && $i==date("Y")) echo " selected ";
		echo ">$i</option>";
	}
	?>
	</select>
	<?php 
	$district=array();
	foreach($projects as $p){
		$district[]=array(
			'district_id'=>$p->district_id,
			'district_name'=>$p->district_name
		);
	}
	$district=array_map("unserialize", array_unique(array_map("serialize", $district)));;
	if(isset($district) && count($district)>0){ ?>
	<select name="district_id" id="district" style="width:150px"  class="form-control">
		<option value="">District</option>
		<?php
		foreach($district as $d){
			echo "<option value='$d[district_id]'>$d[district_name]</option>";
		}
		?>
	</select>	
	<?php } ?>
	<select name="agreement_filter" style="width:200px"  class="form-control">
		<option value="" selected>All Projects</option>
		<option value="in" <?php if($this->input->post('agreement_filter')=='in') echo " selected ";?> >Projects in Time</option>
		<option value="out" <?php if($this->input->post('agreement_filter')=="out") echo " selected "; ?> >Projects beyond Agreement Date</option>
	</select>
	<select name="status_filter" style="width:200px"  class="form-control">
		<option value="" selected>Status</option>
		<option value="1" <?php if($this->input->post('status_filter')=='1') echo " selected ";?> >Not Started</option>
		<option value="2" <?php if($this->input->post('status_filter')=='2') echo " selected ";?> >In Progress</option>
		<option value="3" <?php if($this->input->post('status_filter')=="3") echo " selected "; ?> >Completed</option>
	</select>
	<button class="btn btn-sm pull-right" type="submit" name="select_month">Go</button>

	</form>
	</div>
	</div>
	</div>

	<div class="col-md-12">
	
		<div class="col-md-5 pull-right">
		<input id="colSelect1" type="checkbox" class="sr-only" hidden />
		<label class="btn btn-default btn-md" for="colSelect1">Select Columns</label>
		<div id="columnSelector" class="columnSelector col-md-4"></div>
		<button type="button" class="btn btn-default btn-md print">
		  <span class="glyphicon glyphicon-print"></span> Print
		</button>
		</div>
	</div>

	<div class="pull-right">
		<span style="width:10px;background:#FAB4B4;margin:5px;">&nbsp&nbsp&nbsp&nbsp </span> Works Not Started <br />
		<span style="width:10px;background:#FFECD6;margin:5px;">&nbsp&nbsp&nbsp&nbsp </span> Works in Progress <br />
		<span style="width:10px;background:#D6FFDB;margin:5px;">&nbsp&nbsp&nbsp&nbsp </span> Works Completed
	</div>
	<div class="row"></div>
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
	<th>Agt. Date</th>
	<th>Comp. Date as per Agt.</th>
	<th>Extended Date</th>
	<th>Days Left for Agt. Comp. Date</th>
	<th>Probable/Actual Date of Comp.</th>
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
	<th>Pending Bills</th>
	<th>Total Target for the year</th>
	<th>Exp % over TS</th>
	<th>Balance</th>
	<th>Overall Status</th>
	<th>Physical Stage</th>
	<th>Final Bill</th>
	<th>Final Bill Date</th>
	<th>HO Pendency</th>
	<th>Remarks</th>
	<th>Work Type</th>
	<th>Sanction Type</th>
	<th>Images</th>
	<th>Division</th>
	<th>User Department</th>
	<th>Recording Officer</th>
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
		<td class="text-right"><?php if($project->agreement_date!=0) echo date("d-M-Y",strtotime($project->agreement_date));?></td>
		<td class="text-right"><?php if($project->agreement_completion_date!=0) echo date("d-M-Y",strtotime($project->agreement_completion_date));?></td>
		<td class="text-right"><?php if(!!$project->completion_date) echo date("d-M-Y",strtotime($project->completion_date));?></td>
		<td class="text-right">
			<?php 
				if($project->status_type_id<3) {
					if($project->completion_date!=0) echo (strtotime($project->completion_date)-strtotime(date("Y-m-d")))/60/60/24;
					else if($project->agreement_completion_date!=0) echo (strtotime($project->agreement_completion_date)-strtotime(date("Y-m-d")))/60/60/24;
				}
			?>
		</td>
		<td class="text-right"><?php if($project->probable_date_of_completion!=0) echo date("d-M-Y",strtotime($project->probable_date_of_completion));?></td>
		<td class="text-right"><?php echo number_format($project->expense_upto_last_year/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expense_upto_last_month/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->target_upto_last_month/100000,2); ?></td>
		<td class="text-right"><?php echo number_format(($project->expense_upto_last_month/$project->target_upto_last_month)*100,1); ?>%</td>
		<td class="text-right"><?php echo number_format($project->expense_current_month/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->target_current_month/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expenses/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->pending_bills/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->targets/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expenses/$project->tech_sanction_amount*100);echo "%" ?></td>
		<td class="text-right"><?php echo number_format(($project->tech_sanction_amount-$project->expenses)/100000,2); ?></td>
		<td><?php echo $project->status_type; ?></td>
		<td><?php echo $project->stage;?></td>
		<td><?php if(!!$project->final_bill) echo "Paid"; else echo "Not Paid";?></td>
		<td><?php if(!!$project->final_bill && $project->final_bill_date!='0') echo $project->final_bill_date;?></td>
		<td>
			<?php 
				foreach($pendencies as $pendency) {
					if($pendency->project_id == $project->project_id) { 
						echo $pendency->pendency_type."<br />";
					}
				}
			?>
		</td>
		<td><?php echo $project->remarks_1; ?></td>
		<td><?php echo $project->work_type;?></td>
		<td><?php echo $project->sanction_type;?></td>
		<td class="text-right"><?php echo $project->image_count; ?></td>
		<td><?php echo $project->division; ?></td>
		<td><?php echo $project->user_department; ?></td>
		<td class="text-right"><?php echo $project->designation; ?> - <?php echo $project->staff_name;?></td>
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
		$pending_bills+=$project->pending_bills;
	}
	?>
	</tbody>
	<tr>
		<th>Total</th>
		<th class="text-right"></th>
		<th class="text-right"></th>
		<th class="text-right"></th>
		<th class="text-right"></th>
		<th class="text-right"><?php echo number_format($admin_sanction/100000,2);?></th>
		<th class="text-right"><?php echo number_format($tech_sanction/100000,2);?></th>
		<th class="text-right"><?php echo number_format($agreement_amount/100000,2);?></th>
		<th class="text-right"></th>
		<th class="text-right"></th>
		<th class="text-right"></th>
		<th class="text-right"></th>
		<th class="text-right"></th>
		<th class="text-right"><?php echo number_format($expenditure_previous_year/100000,2);?></th>
		<th class="text-right"><?php echo number_format($expenditure_previous/100000,2);?></th>
		<th class="text-right"><?php echo number_format($target_previous/100000,2);?></th>
		<th class="text-right"><?php echo number_format(($expenditure_previous/$target_previous)*100,1);?>%</th>
		<th class="text-right"><?php echo number_format($expenditure_current/100000,2);?></th>
		<th class="text-right"><?php echo number_format($target_current/100000,2);?></th>
		<th class="text-right"><?php echo number_format($expenditure_cumilative/100000,2);?></th>
		<th class="text-right"><?php echo number_format($pending_bills/100000,2);?></th>
		<th class="text-right"><?php echo number_format($targets_total/100000,2);?></th>
		<th class="text-right"><?php echo number_format(($expenditure_cumilative/$tech_sanction)*100);echo "%"; ?></th>
		<th class="text-right"><?php echo number_format(($admin_sanction-$expenditure_cumilative)/100000,2); ?></th>
		<th></th>
	</tr>
	</table>
	</div>
	</div>
	<?php } ?>
