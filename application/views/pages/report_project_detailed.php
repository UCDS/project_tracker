	<div class="row">
			
			<table class="table table-bordered table-striped">
			<?php
			foreach($project as $p){
			?>
			<thead><th colspan="2" class='text-center'><?php echo $p->project_name; ?></th></thead>
			<tbody>

			<tr><td colspan="2">			
			<img src="<?php echo base_url();?>assets/images/project_images/project_<?php echo $p->project_id;?>_image.jpg" class="thumbnail col-md-6 col-md-offset-3"  alt="No Image found" />
			</td>
			</tr>
			<tr>
				<td>Project ID</td>
				<td><?php echo $p->project_id; ?>
				</td>
			</tr>
			<tr>
				<td>Project Name</td>
				<td><?php echo $p->project_name; ?></td>
			</tr>
			<tr>
				<td>Facility</td>
				<td><?php echo $p->facility_name; ?></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><?php echo $p->project_address; ?></td>
			</tr>
			<tr>
				<td>District</td>
				<td><?php echo $p->district_name; ?></td>
			</tr>
			<tr>
				<td>Division</td>
				<td><?php echo $p->division; ?></td>
			</tr>
			<tr>
				<td>Grant</td>
				<td><?php echo $p->phase_name; ?></td>
			</tr>
			<tr>
				<td>Agency</td>
				<td><?php echo $p->agency_name; ?></td>
			</tr>
			<tr>
				<td>Ref. to Admin Sacntion</td>
				<td><?php echo $p->admin_sanction_id; ?></td>
			</tr>
			<tr>
				<td>Admin Sanction Amount</td>
				<td><?php echo number_format($p->admin_sanction_amount); ?></td>
			</tr>
			<tr>
				<td>Ref. to Tech Sanction</td>
				<td><?php echo $p->tech_sanction_id; ?></td>
			</tr>
			<tr>
				<td>Tech Sanction Amount</td>
				<td><?php echo number_format($p->tech_sanction_amount); ?></td>
			</tr>
			<tr>
				<td>Agreement Amount</td>
				<td><?php echo number_format($p->agreement_amount); ?></td>
			</tr>
			<tr>
				<td>Agreement Number</td>
				<td><?php echo $p->agreement_id; ?></td>
			</tr>
			<tr>
				<td>Agreement Date</td>
				<td><?php echo date("d-M-y",strtotime($p->agreement_date)); ?></td>
			</tr>
			<tr>
				<td>Completion date as per agreement</td>
				<td><?php echo date("d-M-y",strtotime($p->agreement_completion_date)); ?></td>
			</tr>
			<tr>
				<td>Probable completion date</td>
				<td><?php echo date("d-M-y",strtotime($p->probable_date_of_completion)); ?></td>
			</tr>
			<tr>
				<td>Current Status</td>
				<td><?php echo $p->status_type; ?></td>
			</tr>
			<tr>
				<td>Remarks</td>
				<td><?php echo $p->remarks_1; ?></td>
			</tr>
			<tr>
				<td>Expenditure Amount</td>
				<td><?php echo number_format($p->expenses); ?></td>
			</tr>
			<?php if($p->status_type=='Work Completed'){ ?>
			<tr>
				<td>Completed on</td>
				<td><?php echo  date("d-M-y",strtotime($p->probable_date_of_completion)); ?></td>
			</tr>
			
			<?php } ?>
			</tbody>
			<?php
			}
			?>
			</table>
			</form>		
	</div>