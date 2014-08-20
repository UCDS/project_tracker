<style>
	b{
		font-size:12px;
	}
	.row alternate{
		margin:10px 0px;
	}
	.alternate:nth-child(even){
		background:#eee;
	}
	.alternate{
		border-bottom:1px solid #ccc;
	}
</style>
<script>
	$(function(){
	
		$('#formtabs a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		});
	});
</script>
	<div class="row">
			
			<ul class="nav nav-tabs" id="formtabs">
			  <li class="active"><a href="#project" data-toggle="tab">Project</a></li>
			  <li><a href="#expenses" data-toggle="tab">Expenses</a></li>
			  <li><a href="#expense_targets" data-toggle="tab">Expenses & Targets</a></li>
			</ul>

			<?php
			foreach($project as $p){
			?>		
			<div class="tab-content">
			<div class="tab-pane fade in active" id="project">	
			<div class="row">
				<?php 
				if(count($images)>0){
				?>
				<div id="myCarousel" class="carousel slide">
				<ol class="carousel-indicators">
				<?php $image_count=0;
				foreach($images as $image){ ?>
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
					</div>
					</div>
				</div>
				<?php } ?>
				</div>
				<!-- Carousel nav -->
				<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
				<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</div>
				<?php }  else { ?>
					<div class="alert alert-info">
						No Images found
					</div>
				<?php } ?>
				
			</div>
			<div class="row" style="border:1px solid #ccc;border-radius:0.2em;">
				<div class="col-md-6">
					<div class="row alternate">
					<div class="col-md-5">
						<b>Project ID:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->project_id;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Project Name:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->project_name;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Facility:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->facility_name;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Address:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->project_address;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>District:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->district_name;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Division:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->division;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>User Department:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->user_department;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Scheme:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->phase_name;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Agency:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->agency_name;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Current Status:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->status_type;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Stage of Work:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->stage;?><br />
						<?php echo $p->remarks_1;?>
					</div>
					</div>
				</div>
				<div class="col-md-6" style="border-left:4px solid #ccc">
					<div class="row alternate">
					<div class="col-md-5">
						<b>Ref. to Admin Sanction </b>
					</div>
					<div class="col-md-7">
						<?php echo $p->admin_sanction_id;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Admin Sanction Amount</b>
					</div>
					<div class="col-md-7">
						<?php echo number_format($p->admin_sanction_amount/100000,2);?> Lakhs
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Ref. To Tech Sanction:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->tech_sanction_id;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Tech Sanction Amount:</b>
					</div>
					<div class="col-md-7">
						<?php echo number_format($p->tech_sanction_amount/100000,2);?> Lakhs
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Agreement Amount:</b>
					</div>
					<div class="col-md-7">
						<?php echo number_format($p->agreement_amount/100000,2);?> Lakhs
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Agreement Number:</b>
					</div>
					<div class="col-md-7">
						<?php echo $p->agreement_id;?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Agreement Date:</b>
					</div>
					<div class="col-md-7">
						<?php echo date("d-M-Y",strtotime($p->agreement_date));?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Completion Date as per Agreement:</b>
					</div>
					<div class="col-md-7">
						<?php echo date("d-M-Y",strtotime($p->agreement_completion_date));?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Probable Completion Date:</b>
					</div>
					<div class="col-md-7">
						<?php echo date("d-M-Y",strtotime($p->probable_date_of_completion));?>
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Cumilative Expenditure:</b>
					</div>
					<div class="col-md-7">
						<?php echo number_format($p->expenses/100000,2);?> Lakhs
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Expenditure Current Year:</b>
					</div>
					<div class="col-md-7">
						<?php echo number_format(($p->expenses - $p->expense_upto_last_year)/100000,2);?> Lakhs
					</div>
					</div>
					<div class="row alternate">
					<div class="col-md-5">
						<b>Total Target for the Current Year:</b>
					</div>
					<div class="col-md-7">
						<?php echo number_format($p->targets/100000,2);?> Lakhs
					</div>
					</div>
				</div>
		</div>
		</div>
			<?php
			}
			$expense_total=0;
			$target_total=0;
			?>
			<div class="tab-pane fade in" id="expense_targets">
			<span>All amounts are in Lakhs of rupees</span>
			<table class="table table-bordered table-striped">
			<th>Month, Year</th>
			<th>Expenditure</th>
			<th>Expenditure Total</th>
			<th>Target</th>
			<th>Target Total</th>
			<?php
			foreach($expense_targets as $e){
			$expense_total+=$e->expense_amount;
			$target_total+=$e->target_amount;
			?>
			<tr>
				<td><?php echo date("M, Y",strtotime($e->projection_month));?>
				<td><?php echo number_format($e->expense_amount/100000,2);?></td>
				<td><?php echo number_format($expense_total/100000,2);?></td>
				<td><?php echo number_format($e->target_amount/100000,2);?></td>
				<td><?php echo number_format($target_total/100000,2);?></td>
			</tr>
			<?php } ?>
			<tr>
				<th colspan="2">Total</th>
				<th><?php echo number_format($expense_total/100000,2);?></th>
				<th></th>
				<th><?php echo number_format($target_total/100000,2);?></th>
			</tr>
			</table>
			</div>
			
			<div class="tab-pane fade in" id="expenses">
			<span>All amounts are in Lakhs of rupees</span>
			<table class="table table-bordered table-striped">
			<th>#</th>
			<th>Date</th>
			<th>Expenditure</th>
			<?php
			$i=1;
			foreach($expenses as $e){
			$expense_total+=$e->expense_amount;
			?>
			<tr>
				<td><?php echo $i++;?>
				<td><?php echo date("d-M-Y",strtotime($e->expense_date));?>
				<td><?php echo number_format($e->expense_amount/100000,2);?></td>
			</tr>
			<?php } ?>
			<tr>
				<th colspan="2">Total</th>
				<th><?php echo number_format($expense_total/100000,2);?></th>
			</tr>
			</table>
			</div>
			</div>
	</div>