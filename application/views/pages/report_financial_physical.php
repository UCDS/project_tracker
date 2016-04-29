  <div class="row">
	<div class="col-md-12 ">
		<div class="col-md-7">
		<h3>Financial & Physical Status of Civil Works<small>Click on any one to view </small></h3>
		
		<small>All amounts displayed in crores of rupees.</small>
		</div>
		<div class="col-md-5 pull-right">
			<?php if(count($states)>1){ ?>
			<?php echo form_open("reports/summary/$type",array('class'=>'form-custom')); ?>
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
		<div class="col-md-7">
			<?php if($this->input->post('medical')=="M" || !isset($type_selected)) $work_type = "M"; else $work_type = "N"; ?>
			<?php echo form_open('reports/physical_financial/userdept_district',array('id'=>'work_type_form')); ?>
			<label for="medical"><input type="checkbox" id="medical" value="M" form="work_type_form" name="medical" onclick="$('#work_type_form').submit();"  <?php if($this->input->post('medical')=="M" || !isset($type_selected)) echo "checked"; ?>/> Medical</label>
			<label for="nonmedical"><input type="checkbox" id="nonmedical" form="work_type_form" value="N" name="nonmedical" onclick="$('#work_type_form').submit();" <?php if($this->input->post('nonmedical')=="N") echo "checked"; ?> /> Non Medical</label>
			</form>
		</div>
		<div class="col-md-5 pull-right">
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
		<th data-priority="critical" data-name="name"><?php echo $name;?></th>
		<th>User Department</th>
		
		<th style="width:100px">Total Work Load as on 01-Apr-2014</th>
		<th>Exp. DY</th>
		<th>Pending Bills</th>
		<th>Total Work Done</th>
		<th>Total Works</th>
		<th>Completed</th>
		<th>In Progress</th>
		<th>Not Started</th>
		</tr>
	</thead>
	<tbody>

	<?php
	$total_projects=0;
	$not_started=0;
	$work_in_progress=0;
	$work_completed=0;
	$work_load=0;
	$expenses_current=0;
	$pending_bills=0;
	$districts=array();
	$uds=array();
	$i=1;
	foreach($summary as $row){
		if(!in_array($row->user_department_id,$user_departments)) {
			${"name_".$row->user_department_id}=$row->user_department;
			${"total_projects_".$row->user_department_id}=0;
			${"not_started_".$row->user_department_id}=0;
			${"work_in_progress_".$row->user_department_id}=0;
			${"work_completed_".$row->user_department_id}=0;
			${"work_load_".$row->user_department_id}=0;
			${"expenses_current_".$row->user_department_id}=0;
			${"pending_bills_".$row->user_department_id}=0;
			$uds[]=$row->user_department_id;
		}
	?>

	<?php
		if((count($districts)>0 && !in_array($row->district_id,$districts))){
			$district_id = $districts[count($districts)-1];
			echo "<script>console.log('".$district_id."');</script>";
				?>
		
				<tr onclick="$('#select_form_<?php echo $i;?>').submit();">
					<th colspan="3">Sub Total
						<?php echo form_open("reports/physical_financial/$type",array('id'=>'select_form_'.$i,'role'=>'form')); ?>
					<?php if($this->input->post('state')) { ?>
					<input type='hidden' value="<?php echo $this->input->post('state'); ?>" name="state" />
					<?php } ?>
					<input type='hidden' value="<?php if($district_id!=NULL) echo $district_id; else echo "'0'" ?>" name="<?php echo $id;?>" />
					<input type='hidden' value="<?php  echo $work_type;?>" name="<?php echo "work_type";?>" />
					</th>
					<th class="text-right"><?php echo number_format($work_load_sub/10000000,2);?></th>
					<th class="text-right"><?php echo number_format($expenses_current_sub/10000000,2);?></th>
					<th class="text-right"><?php echo number_format($pending_bills_sub/10000000,2);?></th>
					<th class="text-right"><?php echo number_format(($pending_bills_sub+$expenses_current_sub)/10000000,2);?></th>
					<th class="text-right"><?php echo $total_projects_sub;?></th>
					<th class="text-right"><?php echo $work_completed_sub;?></th>
					<th class="text-right"><?php echo $work_in_progress_sub;?></th>
					<th class="text-right"><?php echo $not_started_sub;?></th>
						</form>
					</th>
				</tr>
		<?php $i++;
		} 		
		?>
	<tr onclick="$('#select_form_<?php echo $i;?>').submit();">
		<td>
			<?php echo form_open("reports/physical_financial/$type",array('id'=>'select_form_'.$i,'role'=>'form')); ?>
			<?php echo $i++; ?>
		</td>
		<td><?php echo $row->$col_name; ?>
		<?php if($this->input->post('state')) { ?>
		<input type='hidden' value="<?php echo $this->input->post('state'); ?>" name="state" />
		<?php } ?>
		<input type='hidden' value="<?php  echo $work_type;?>" name="<?php echo "work_type";?>" />
		<input type='hidden' value="<?php if($row->$id!=NULL) echo $row->$id; else echo "'0'" ?>" name="<?php echo $id;?>" />
		</td>
		<td><?php echo $row->user_department; ?>
		<input type='hidden' value="<?php if($row->user_department_id!=NULL) echo $row->user_department_id; else echo "'0'" ?>" name="<?php echo "user_department_id";?>" />
		</td>
		<td class="text-right"><?php echo number_format(($row->tech_sanction_amount-$row->expenses_last_year)/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($row->expenses_current_year+$row->expense_current_month)/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format($row->bills_pending/10000000,2); ?></td>
		<td class="text-right"><?php echo number_format(($row->bills_pending+$row->expenses_current_year+$row->expense_current_month)/10000000,2); ?></td>
		<td class="text-right"><?php echo $row->total_projects; ?></td>
		<td class="text-right"><?php echo $row->work_completed; ?></td>
		<td class="text-right"><?php echo $row->work_in_progress; ?></td>
		<td class="text-right"><?php echo $row->not_started; ?>
			</form>
		</td>
	</tr>
	<?php
	if( $i==(count($summary) + count($districts))){ 
				$district_id = $districts[count($districts)-1];
			echo "<script>console.log('".$district_id."');</script>";
				?>
		
				<tr onclick="$('#select_form_<?php echo $i;?>').submit();">
					<th colspan="3">Sub Total
						<?php echo form_open("reports/physical_financial/$type",array('id'=>'select_form_'.$i,'role'=>'form')); ?>
					<?php if($this->input->post('state')) { ?>
					<input type='hidden' value="<?php echo $this->input->post('state'); ?>" name="state" />
					<?php } ?>
					<input type='hidden' value="<?php if($district_id!=NULL) echo $district_id; else echo "'0'" ?>" name="<?php echo $id;?>" />
					<input type='hidden' value="<?php  echo $work_type;?>" name="<?php echo "work_type";?>" />
					</th>
					<th class="text-right"><?php echo number_format($work_load_sub/10000000,2);?></th>
					<th class="text-right"><?php echo number_format($expenses_current_sub/10000000,2);?></th>
					<th class="text-right"><?php echo number_format($pending_bills_sub/10000000,2);?></th>
					<th class="text-right"><?php echo number_format(($pending_bills_sub+$expenses_current_sub)/10000000,2);?></th>
					<th class="text-right"><?php echo $total_projects_sub;?></th>
					<th class="text-right"><?php echo $work_completed_sub;?></th>
					<th class="text-right"><?php echo $work_in_progress_sub;?></th>
					<th class="text-right"><?php echo $not_started_sub;?></th>
						</form>
					</th>
				</tr>
		<?php $i++;
		} 	
	
		if(!in_array($row->district_id,$districts)) {
			$total_projects_sub=0;
			$not_started_sub=0;
			$work_in_progress_sub=0;
			$work_completed_sub=0;
			$work_load_sub=0;
			$expenses_current_sub=0;
			$pending_bills_sub=0;
			$districts[]=$row->district_id;		
		}
	$total_projects+=$row->total_projects;
	$not_started+=$row->not_started;
	$work_in_progress+=$row->work_in_progress;
	$work_completed+=$row->work_completed;
	$work_load+=($row->tech_sanction_amount-$row->expenses_last_year);
	$expenses_current+=($row->expenses_current_year+$row->expense_current_month);
	$pending_bills+=$row->bills_pending;
	$total_projects_sub+=$row->total_projects;
	$not_started_sub+=$row->not_started;
	$work_in_progress_sub+=$row->work_in_progress;
	$work_completed_sub+=$row->work_completed;
	$work_load_sub+=($row->tech_sanction_amount-$row->expenses_last_year);
	$expenses_current_sub+=($row->expenses_current_year+$row->expense_current_month);
	$pending_bills_sub+=$row->bills_pending;
	$user_departments[]=$row->user_department_id;
	${"total_projects_".$row->user_department_id}+=$row->total_projects;
	${"not_started_".$row->user_department_id}+=$row->not_started;
	${"work_in_progress_".$row->user_department_id}+=$row->work_in_progress;
	${"work_completed_".$row->user_department_id}+=$row->work_completed;
	${"work_load_".$row->user_department_id}+=($row->tech_sanction_amount-$row->expenses_last_year);
	${"expenses_current_".$row->user_department_id}+=($row->expenses_current_year+$row->expense_current_month);
	${"pending_bills_".$row->user_department_id}+=$row->bills_pending;
	}
	?>
	</tbody>
	<?php foreach($uds as $ud){ ?>
	
		<?php if(count($states)>1){ ?>
				<?php if($this->input->post('state')){
							if($this->input->post('state')=="TS") echo "Telangana";
							else if($this->input->post('state')=="AP") echo "Andhra Pradesh";
						}
					else echo "Andhra Pradesh and Telangana";
				?>
		<?php }
		else{
			$state=$states[0]->state;
		}?>
		
	<tr onclick="$('#select_form_<?php echo $i;?>').submit();">
		<th><?php echo $i;?></th>
		<th>
			<?php echo $state; ?>
			<?php echo form_open("reports/physical_financial/$type",array('id'=>'select_form_'.$i,'role'=>'form')); ?>
		<?php if($this->input->post('state')) {		?>
		<input type='hidden' value="<?php echo $this->input->post('state'); ?>" name="state" />
		<?php } ?>
		<input type='hidden' value="<?php if($ud!=NULL) echo $ud; else echo "'0'" ?>" name="user_department_id" />
		<input type='hidden' value="<?php  echo $work_type;?>" name="<?php echo "work_type";?>" />
		</th>
		<th>
			<?php echo ${"name_".$ud}; ?>
		</th>
		<th class="text-right"><?php echo number_format((${"work_load_".$ud})/10000000,2); ?></th>
		<th class="text-right"><?php echo number_format((${"expenses_current_".$ud})/10000000,2); ?></th>
		<th class="text-right"><?php echo number_format(${"pending_bills_".$ud}/10000000,2); ?></th>
		<th class="text-right"><?php echo number_format((${"pending_bills_".$ud}+${"expenses_current_".$ud})/10000000,2); ?></th>
		<th class="text-right"><?php echo ${"total_projects_".$ud}; ?></th>
		<th class="text-right"><?php echo ${"work_completed_".$ud}; ?></th>
		<th class="text-right"><?php echo ${"work_in_progress_".$ud}; ?></th>
		<th class="text-right"><?php echo ${"not_started_".$ud}; ?>
			</form>
		</th>
	</tr>
	<?php $i++;
	} ?>
	<tr onclick="$('#select_form_all').submit();">
		<th colspan="3">	
			<?php echo form_open("reports/summary/$type",array('id'=>'select_form_all','role'=>'form')); ?>
				<input type='hidden' value="0" form="select_form_all" name="<?php echo $id;?>" />
			</form>
			Total
		</th>
		<th class="text-right"><?php echo number_format($work_load/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($expenses_current/10000000,2);?></th>
		<th class="text-right"><?php echo number_format($pending_bills/10000000,2);?></th>
		<th class="text-right"><?php echo number_format(($pending_bills+$expenses_current)/10000000,2);?></th>
		<th class="text-right"><?php echo $total_projects;?></th>
		<th class="text-right"><?php echo $work_completed;?></th>
		<th class="text-right"><?php echo $work_in_progress;?></th>
		<th class="text-right"><?php echo $not_started;?></th>
	</tr>
	</table>
	</div>
	</div>
