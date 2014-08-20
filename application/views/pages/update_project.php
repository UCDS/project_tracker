	<?php 
	if(isset($project) && count($project)>0){ 
	?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<style>
	.prev_expenses{
		cursor:pointer;
		color:blue;
	}
	.ui-datepicker{ z-index: 9990999 !important;}
</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$(".date").Zebra_DatePicker();
	$(".prev_expenses").click(function(){
		$(".expenses").slideToggle();
	});
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
  $("#status").on('change',function(){
		var status_type_id=$(this).val();
		$("#stage option").hide().prop('disabled',true);
		$("#stage>option:eq(0)").prop('selected',true).show().prop('disabled',true);
		$("#stage ."+status_type_id+"").show().prop('disabled',false);
	});
	$('#formtabs a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	});
	$("#division").change(function(){
			$("#facility option").show();
			if($(this).data('facilityoptions') == undefined){
			/*Taking an array of all options-2 and kind of embedding it on the select1*/
			$(this).data('facilityoptions',$('#facility option').clone());
			}	
		var id = $(this).val();
		var facilityoptions = $(this).data('facilityoptions').filter('[name=' + id + ']');
		$('#facility').html(facilityoptions);
		$('#facility').prepend('<option value="" selected="selected" >--Select--</option>');
		});

});
</script>
	<div class="row">
		<div class="col-md-10">

			<?php if(isset($msg)){ ?>
			<div class="alert alert-info"><?php echo $msg;?></div>
			<?php } ?>
			<ul class="nav nav-tabs" id="formtabs">
			  <li class="active"><a href="#project" data-toggle="tab">Project</a></li>
			  <li><a href="#projectstatus" data-toggle="tab">Status</a></li>
			  <li><a href="#bills" data-toggle="tab">Pending Bills</a></li>
			  <li><a href="#expenses" data-toggle="tab">Expenses</a></li>
			  <li><a href="#targets" data-toggle="tab">Targets</a></li>
			  <li><a href="#image" data-toggle="tab">Image</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			<div class="tab-pane fade in active" id="project">
			<?php
			foreach($project as $p){
			?>
			<table class="table table-bordered table-striped">
			<thead>
			
			<th colspan="2" class='text-center'><?php echo $p->project_name; ?></th>
			</thead>
			<tbody>
			<tr>
				<td>
					<?php echo form_open('projects/update',array('id'=>'update_project_form','role'=>'form')); ?>
					Project ID
				</td>
				<td><?php echo $p->project_id; ?>
				</td>
			</tr>
			<tr>
				<td>Project Name</td>
				<td><input type="text" class="form-control" placeholder="Project Name" value="<?php echo $p->project_name; ?>" id="project_name" name="project_name" required /></td>
			</tr>
			<tr>
				<td>Work Type</td>
				<td>
					<label for="medical" class="control-label"><input type="radio" value="M" id="medical" name="work_type" <?php if($p->work_type_id=="M") echo " checked ";?> />Medical</label>
					<label for="non-medical" class="control-label"><input type="radio" value="N" id="non-medical" name="work_type" <?php if($p->work_type_id=="N") echo " checked ";?> />Non Medical</label>
				</td>
			</tr>
			<tr>
				<td>Division</td>
				<td>
					<select name="division" id="division" class="form-control">
					<option value="" disabled>--SELECT--</option>
					<?php foreach($divisions as $division){
						echo "<option value='$division->division_id'";
						if($division->division_id==$p->division_id) echo " selected ";
						echo ">$division->division</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Facility</td>
				<td>
					<select name="facility" id="facility" class="form-control" >
					<option value="" disabled>--SELECT--</option>
					<?php foreach($facilities as $facility){
						echo "<option value='$facility->facility_id' name='$facility->division_id'";
						if($facility->facility_id==$p->facility_id) echo " selected "; if($facility->division_id!=$p->division_id) echo " hidden "; 
						echo ">$facility->facility_name</option>";
					}
					?>
					</select>
				<td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" class="form-control" placeholder="Project Address" id="project_address" value="<?php echo $p->project_address; ?>" name="project_address" /></td>
			</tr>
			<tr>
				<td>Ref to Admin Sanction</td>
				<td><input type="text" class="form-control" placeholder="Ref. to Admin Sanction" id="ref_admin" value="<?php echo $p->admin_sanction_id;?>" name="ref_admin" /></td>
			</tr>
			<tr>
				<td>Admin Sanction Amount</td>
				<td><input type="text" class="form-control" placeholder="Admin sanction amount" id="admin_amount" value="<?php echo $p->admin_sanction_amount; ?>" name="admin_amount" /></td>
			</tr>
			<tr>
				<td>Ref to Tech Sanction</td>
				<td><input type="text" class="form-control" placeholder="Ref. to Tech Sanction" id="ref_tech" value="<?php echo $p->tech_sanction_id;?>" name="ref_tech" /></td>
			</tr>
			<tr>
				<td>Tech Sanction Amount</td>
				<td><input type="text" class="form-control" placeholder="Tech sanction amount" id="tech_amount" value="<?php echo $p->tech_sanction_amount; ?>" name="tech_amount" /></td>
			</tr>
			<tr>
				<td>Agreement Date</td>
				<td><input type="text" class="form-control date" placeholder="Agreement Date" id="agreement_date" value="<?php echo date("d-M-y",strtotime($p->agreement_date)); ?>" name="agreement_date" /></td>
			</tr>
			<tr>
				<td>Agreement Number</td>
				<td><input type="text" class="form-control" placeholder="Agreement Number" value="<?php echo $p->agreement_id; ?>" id="agreement_number" name="agreement_number" /></td>
			</tr>
			<tr>
				<td>Agreement Amount</td>
				<td><input type="text" class="form-control" placeholder="Agreement Amount Rs" id="agreement_amount" value="<?php echo $p->agreement_amount; ?>" name="agreement_amount" /></td>
			</tr>
			<tr>
				<td>Completion date as per agreement</td>
				<td><input type="text" class="form-control date" placeholder="as per Agreement" id="agreement_completion_date" value="<?php echo date("d-M-y",strtotime($p->agreement_completion_date)); ?>" name="agreement_completion_date" /></td>
			</tr>
			<tr>
				<td>Grant</td>
				<td>		
					<select name="grant" id="grant" class="select-box selectized" required>
					<option value="">--SELECT--</option>
					<?php foreach($grants as $grant){
						echo "<option value='$grant->phase_id' ";
						if($grant->phase_id==$p->grant_phase_id) echo " selected ";
						echo ">$grant->phase_name</option>";
					}
					?>
					</select>	
				</td>
			</tr>
			<tr>
				<td>User Department</td>
				<td>		
					<select name="user_department" id="user_department" class="select-box selectized" required >
					<option value="">--SELECT--</option>
					<?php foreach($user_departments as $user_department){
						echo "<option value='$user_department->user_department_id' ";
						if($user_department->user_department_id==$p->user_department_id) echo " selected ";
						echo ">$user_department->user_department</option>";
					}
					?>
					</select>	
				</td>
			</tr>
			<tr>
				<td>Agency</td>
				<td>
					<select name="agency" id="agency" class="select-box selectized" required>
					<option value="">--SELECT--</option>
					<?php foreach($agencies as $agency){
						echo "<option value='$agency->agency_id'";
						if($agency->agency_id==$p->agency_id) echo " selected ";
						echo ">$agency->agency_name</option>";
					}
					?>
					</select>	
				</td>
			</tr>
			<tr>
				<td>Previous Expenses</td>
				<td>Cumilative : <?php echo number_format($p->expenses);?> - <span class="prev_expenses">Click here to view all.</span>
				<div class="panel panel-default expenses" hidden>
					<div class="panel-heading">
						Expenses for this project
					</div>
					<div class="panel-body">
					<table class="table">
						<thead>
						<th>#</th><th>Date</th><th>Amount</th>
						</thead>
						<tbody>
							<?php
							$i=1;
							foreach($expenses as $expense){ ?>
							<tr>
								<td><?php echo $i++;?></td>
								<td><input type="text" value="<?php echo $expense->expense_id;?>" class="form-control sr-only" name="expense_id[]" />
								<input type="text" value="<?php echo date("d-M-y",strtotime($expense->expense_date)); ?>" class="form-control date" form="update_project_form" name="prev_expense_date[]" size="4" /></td>
								<td><input type="number" min="0" value="<?php echo $expense->expense_amount; ?>" class="form-control" name="prev_expense_amount[]" size="4" /></td>
							</tr>
							<?php } ?>
						</tbody>								
					</table>
					</div>
				</div>
				</td>
			</tr>
			<tr>
			<td colspan="2" align="center">
				<input type='hidden' value="<?php echo $p->project_id; ?>" name="selected_project" />
				<input class='btn btn-lg btn-primary' type="submit" name="update_project" form="update_project_form" value="Update Project" /></form>
			</td>
			</tr>
		</tbody>
		</table>
		</div>
		
		
		<div class="tab-pane fade" id="projectstatus">		
			<table class="table table-bordered table-striped">
			<tr>
				<td>Current Status</td>
				<td>
					<?php echo form_open('projects/update',array('id'=>'update_status_form','role'=>'form')); ?>
					<select name="status" id="status" class="form-control">
					<option value="" class="default" selected disabled >--SELECT--</option>
					<?php foreach($status_types as $status){
						echo "<option value='$status->status_type_id'";
						if($status->status_type_id==$p->status_type_id) echo " selected ";
						echo ">$status->status_type</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Stage of Work</td>
				<td>
					<select name="stage" id="stage" class="form-control">
					<option value="" class="default" selected disabled >--SELECT--</option>
					<?php foreach($stages as $stage){
						echo "<option value='$stage->stage_id'";
						if($stage->stage_id==$p->stage_id) echo " selected "; 
						if($stage->status_type_id!=$p->status_type_id) echo " hidden ";
						echo " class='$stage->status_type_id'>$stage->stage</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Remarks</td>
				<td><input type="text" class="form-control" placeholder="Status Remarks" id="status_remarks" value="<?php echo $p->remarks_1; ?>" name="status_remarks" /></td>
			</tr>
			<tr>
				<td>Probable completion date</td>
				<td>
					<input type="text" class="form-control date" placeholder="Probable Date of Completion" id="probable_date_of_completion" form="update_status_form" value="<?php if($p->probable_date_of_completion!=0) echo date("d-M-y",strtotime($p->probable_date_of_completion)); ?>" name="probable_date_of_completion" required />
				</td>
			</tr>
			<tr>
			<td colspan="2" align="center">
					<input type='hidden' value="<?php echo $p->project_id; ?>" name="selected_project" />
					<input class='btn btn-lg btn-primary' type="submit" name="update_status" value="Update Physical Status" />
				</form>
			</td>
			</tr>
		</table>
		</div>
		<div class="tab-pane fade" id="expenses">		
		<table class="table table-bordered table-striped">
			<tr>
				<td>					
				<?php echo form_open('projects/update',array('id'=>'update_expenditure_form','role'=>'form')); ?>
				Add Expenditure
				</td>
				<td class='text-center'>
				<div class='col-md-12'>
				<input type="number" placeholder="Expenditure" class="form-control" name='expenditure' min="0" required />
				<input type="text" placeholder="Date" class="form-control date" name='expense_date' form="update_expenditure_form" id="from_date" required/>
				</div>
			</td>
			</tr>
			<tr>
			<td colspan="2" align="center">				
				<input type='hidden' value="<?php echo $p->project_id; ?>" name="selected_project" />
				<input class='btn btn-lg btn-primary' type="submit" name="update_expenses" value="Update Expenditure" />
				</form>
			</td>
			</tr>
		</table>
		</div>
		
		<div class="tab-pane fade" id="bills">						
		
		<h4>Details of Bills Pending for more than a month:</h4>

		<table class="table table-bordered table-striped">
		<?php if(count($bills)>0){ ?>
			<tr>
			<td colspan=10">
				<?php echo form_open('projects/update',array('id'=>'delete_bill_form','role'=>'form')); ?>
				<table class="table table-bordered table-striped">
					<thead>
						<th>#</th>
						<th>Bill Sent To</th>
						<th>Submission Date</th>
						<th>Voucher No.</th>
						<th>Gross Amount</th>
					</thead>
					<?php $i=1;foreach($bills as $bill){ ?>
						<tr>
							<td><?php echo $i++; ?>
								<input class="sr-only" type="text" value="<?php echo $bill->bill_id;?>" name="bill_id" hidden readonly /></td>
							<td><?php echo $bill->payer;?></td>
							<td><?php echo $bill->bill_date;?></td>
							<td><?php echo $bill->voucher_number;?></td>
							<td><?php echo $bill->bill_amount;?></td>
							<td><input type='hidden' value="<?php echo $p->project_id; ?>" name="selected_project" />
							<input type="submit" value="X" class="btn btn-danger btn-sm" name="delete_bill" /></td>
						</tr>
					<?php } ?>
				</table>
				</form>	
			</td>
			</tr>
			<?php } ?>
			<tr>
				<td>					
				<?php echo form_open('projects/update',array('id'=>'update_bill_form','role'=>'form')); ?>
				Add Pending Bill
				</td>
				<td class='text-center'>
				<div class='col-md-12'>
				<select name="payer" class="form-control" required>
					<option value="" selected disabled>Bill Sent To</option>
					<option value="HO">Head Office</option>
					<option value="PAO">PAO</option>
					<option value="EE">EE</option>
				<input type="text" placeholder="Date of Submission" class="form-control date" name='bill_date' form="update_bill_form" id="bill_date" required/>
				<input type="number" placeholder="Gross Amount" class="form-control" name='bill_amount' min="0" required />
				<input type="number" placeholder="Voucher No." class="form-control" name='voucher_number' min="0" required />
				</div>
				</td>
			</tr>
			<tr>
			<td colspan="2" align="center">				
				<input type='hidden' value="<?php echo $p->project_id; ?>" name="selected_project" />
				<input class='btn btn-lg btn-primary' type="submit" name="update_bills" value="Update Bill" />
				</form>
			</td>
			</tr>
		</table>
		</div>
		
		  <div class="tab-pane fade" id="targets">
			<small>Please enter all amounts in Lakhs.</small>
			<?php echo form_open('projects/update',array('id'=>'update_targets_form','role'=>'form')); ?>
			<table class="table table-bordered table-striped">
				<?php
					$existing=array();
					$existing['month']=array();
					$existing['year']=array();
					$existing['target_amount']=array();
					foreach($targets as $target){
						$existing['month'][]=$target->month;
						$existing['year'][]=$target->year;
						$existing['target_amount'][]=$target->target_amount;
					}
					$year_start=date("Y-m-d",strtotime("April 1"));
					$year_current=date("Y-m-d");
					if($year_current>=$year_start){ $year=date("Y",strtotime($year_start)); }
					else $year=date("Y",strtotime("April 1 Last year"));
					for($i=0;$i<12;$i++){
						$j=($i+3)%12+1;
						?>
						<tr>
							<td>
								
								<input type="text" value="<?php echo $j;?>" name="projection_month[]" class="sr-only" hidden />
								<input type="text" value="<?php echo $year;?>" name="projection_year[]" class="sr-only" hidden />
								<?php echo date('F', mktime(0, 0, 0, $j, 10));?> <?php echo $year; 
								if($j==12){
									$year++;
								}
							?>
							</td>
							<td>
								<input type="text" placeholder="Lakhs of Rupees" name="estimate_amount[]" value="<?php if(count($existing['target_amount'])>0){ echo $existing['target_amount'][$i]/100000;}?>" class="form-control" />
							</td>
						</tr>
						<?php		
						}
						?>
					<tr>
					<td colspan="2" align="center">
						<input type='hidden' value="<?php echo $p->project_id; ?>" name="selected_project" />
						<input type="submit" class="btn btn-lg btn-primary" value="Update Targets" name="update_targets" />
						</form>
					</td>
					</tr>
					
			</table>
		  </div>
		  <div class="tab-pane fade" id="image">
		  <table class="table table-bordered">
			<tr>
			<td>		
				<?php echo form_open_multipart('projects/update',array('id'=>'update_image_form','role'=>'form')); ?>			
			
				<div id="myCarousel" class="carousel slide">
				<ol class="carousel-indicators">
				<?php $image_count=0; foreach($images as $image){ ?>
				<li data-target="#myCarousel" data-slide-to="<?php echo $image_count;?>" <?php if($image_count==0) echo 'class="active"'; $image_count++;?> ></li>
				<?php } ?>
				</ol>
				<!-- Carousel items -->
				<div class="carousel-inner">
				<?php $image_count=1; foreach($images as $image){ ?>
				<div class="<?php if($image_count==1) echo "active"; $image_count++;?> item">
					<img src="<?php echo base_url();?>assets/images/project_images/<?php echo $image->image_name;?>" class="col-md-12"  alt="No Image found" />
					<div class="row">
					<div class="carousel-caption">
						<h4><?php echo $image->title;?></h4>
						<input type="hidden" class="sr-only" name="remove_image_name" value="<?php echo $image->image_name;?>" />
						<button class="btn btn-lg btn-danger" type="submit" name="remove_image" value="<?php echo $image->image_id;?>" >Remove</button>
					</div>
					</div>
				</div>
				<?php } ?>
				</div>
				<!-- Carousel nav -->
				<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
				<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</div>
			</td>
			</tr>
			<tr>
			<td>
			<div class="col-md-4 col-md-offset-2">
				<input type="text" placeholder="Tell something about this photo." name="image_title" style="width:120%" maxlength="100" class="form-control" />
				<input type='hidden' value="<?php echo $p->project_id; ?>" name="selected_project" />
				<input type="file" class="btn btn-default" name="project_image"  size="20" />
				Max size : 1000Kb<br /> Max width : 1024px<br /> Max Height : 768px
			</div>
			<div class="col-md-3 col-md-offset-1">
			<input class='btn btn-lg btn-primary btn-block' type="submit" name="update_image" form="update_image_form" value="Update Image" />	
			</div>
			</form>
			</td>
			</tr>
		  </table>
		 </div>
		</div>
			<?php
			}
			?>
		</div>
	</div>
	<?php } 
	else { ?>
	
	<div class="row">
	<div class="col-md-6">
	<h3>Projects<?php if($this->input->post('division_id') && count($projects)>0) echo " in ".$projects[0]->division;?>. <small>Click on any one to view and update</small></h3>
	</div>
 	<?php echo form_open('projects/update',array('id'=>'select_filters','role'=>'form','class'=>'form-custom'));?>
	<div class="col-md-6">
	<div class="form-group">
	<select name="division_id" id="division" style="width:150px"  class="form-control">
		<option value="">Division</option>
		<?php
		foreach($divisions as $d){
		
			echo "<option value='$d->division_id'>$d->division</option>";
		}
		?>
	</select>
	</div>
	<div class="form-group">
	<select name="grant" id="grant" style="width:150px"  class="form-control">
		<option value="">Grant</option>
		<?php
		for ($e = 0; $e < count($grant); $e++)
		{
		  for ($ee = $e+1; $ee < count($grant); $ee++)
		  {
			if ($grant[$ee]->grant_phase_id==$grant[$e]->grant_phase_id)
			{
			array_splice($grant,$ee,1);
			$ee--;
			}
		  }
		}
		foreach($grant as $g){
		
			echo "<option value='$g->grant_phase_id'>$g->phase_name</option>";
		}
		?>
	</select>	
	</div>
	<div class="form-group">
	<input type="text" name="project_id" size="3" placeholder="ID" class="form-control" />
	</div>
	<input type="submit" value="Go" class="btn btn-primary btn-sm" name="search_projects" />
	</form>
	</div>
	<?php if(isset($project) && count($project)==0 || count($projects)==0) { 
		echo "<div class='col-md-10'><div class='alert alert-danger'>No projects found.</div></div>";
	}
	else {
	?>
	<table class="table table-hover table-striped table-bordered tablesorter" id="table-1">
	<thead><th>S.No</th><th>Project ID</th><th>Project Name</th><th>Facility</th><th>Grant</th><th>Status</th></thead>
	<tbody>
	<?php
	$i=1;
	foreach($projects as $project){
	?>
	<tr onclick="$('#select_project_form_<?php echo $project->project_id;?>').submit();">
		<td>
			<?php echo form_open('projects/update',array('id'=>'select_project_form_'.$project->project_id,'role'=>'form')); ?>
			<?php echo $i++; ?>
		</td>
		<td><?php echo $project->project_id; ?>
		<input type='hidden' value="<?php echo $project->project_id; ?>" name="project_id" />
		</td>
		<td><?php echo $project->project_name; ?></td>
		<td><?php echo $project->facility_name; ?></td>
		<td><?php echo $project->phase_name; ?></td>
		<td><?php echo $project->status_type; ?>
			</form>
		</td>
	</tr>
	<?php
	}
	?>
	</tbody>
	</table>
	<?php } ?>
	</div>
	<?php 
	}
	?>