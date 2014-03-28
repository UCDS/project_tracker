
	<?php if(isset($mode)&& $mode=="select"){ ?>
	<center>	<h3><u>Edit Agency</u></h3></center><br>
	<?php echo form_open('masters/edit/agency',array('role'=>'form')); ?>


		<div class="form-group">
		<label for="agency_name" class="col-md-4">Agency Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agency Name" id="agency_name" name="agency_name" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->agency_name."' ";
			}
		?>
		/>
		<?php if(isset($agency)){ ?>
		<input type="hidden" value="<?php echo $agency[0]->agency_id;?>" name="agency_id" />
		
		<?php } ?>
		</div>
	</div>
	
	

		<div class="form-group">
		<label for="agency_contact_name" class="col-md-4">Agency Contact Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agency Contact Name" id="agency_contact_name" name="agency_contact_name" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->agency_contact_name."' ";
			}
		?>
		/>
</div></div>
		<div class="form-group">
		<label for="agency_contact_designation" class="col-md-4">Agency Designation</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agency Designation" id="agency_contact_designation" name="agency_contact_designation"
		<?php if(isset($agency)){
			echo "value='".$agency[0]->agency_contact_designation."' ";
			}
		?>
		/>
</div></div>
		<div class="form-group">
		<label for="agency_address" class="col-md-4">Agency Address</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agency Address" id="agency_address" name="agency_address" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->agency_address."' ";
			}
		?>
		/>
</div></div>
		<div class="form-group">
		<label for="agency_contact_number" class="col-md-4">Agency Contact No</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agency Contact Number" id="agency_contact_number" name="agency_contact_number" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->agency_contact_number."' ";
			}
		?>
		/>
</div></div>
		<div class="form-group">
		<label for="agency_email_id" class="col-md-4">Agency Email Id</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agency Email Id" id="agency_email_id" name="agency_email_id" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->agency_email_id."' ";
			}
		?>
		/>
</div></div>
		<div class="form-group">
		<label for="account_no" class="col-md-4">Account No</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Account No" id="account_no" name="account_no" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->account_no."' ";
			}
		?>
		/>
		</div></div>

		<div class="form-group">
		<label for="bank_name" class="col-md-4">Bank Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Bank Name" id="bank_name" name="bank_name" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->bank_name."' ";
			}
		?>
		/>
</div></div>


		<div class="form-group">
		<label for="branch" class="col-md-4">Branch</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Branch" id="branch" name="branch" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->branch."' ";
			}
		?>
		/>
</div></div>
		<div class="form-group">
		<label for="pan" class="col-md-4">Pan</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="pan" id="pan" name="pan" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->pan."' ";
			}
		?>
		/>

		</div>

	</div> 
   	<div class="col-md-3 col-md-offset-4">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div>
	</form>	
	<?php } ?>
	<h3><?php if(isset($msg)) echo $msg;?></h3>	
	<div class="col-md-12">
	<?php echo form_open('masters/edit/agency',array('role'=>'form','class'=>'form-inline','name'=>'search_agency'));?>
	<h3> Search Agency </h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr><td><input type="text" class="form-control" placeholder="Agency Name" id="search_agency_name"
				 name="search_agency_name" style="width:200px;" /></td>	
		<td>
		<!--<select name="search_agency_name" id="search_agency_name" class="form-control" style="width:180px">
		<option value="" disabled selected>Agency</option>
		<?php foreach($agency as $agency_name){
			echo "<option value='$agency_name->agency_id'>$agency_name->agency_name</option>";
		}
		?>
		</select>--></td>	
				
		<td><input class="btn btn-lg btn-primary btn-block" name="search" value="Search" type="submit" /></td></tr>
	</tbody>
	</table>
	</form>
	<?php if(isset($mode) && $mode=="search"){ ?>

	<h3 class="col-md-12">List of Agencies</h3>
	<div class="col-md-12 "><strong>
	<?php if($this->input->post('search_agency_id')) echo "Agency id : ".$agency[0]->agency_id; ?>
	<?php if($this->input->post('search_agency_name')) echo "Agency name  : ".$this->input->post('search_agency_name'); ?>
	</strong>
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
	<th>S.No</th><th>Agency Name </th><th>Agency Address</th><th>Agency Contact Name</th><th>Agency Designation</th>
	<th>Agency Contact no</th><th>Agency Email Id</th><th>Account No</th><th>Bank Name</th><th>Branch</th><th>Pan</th>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($agency as $a){ ?>
	<?php echo form_open('masters/edit/agency',array('id'=>'select_agency_form_'.$a->agency_id,'role'=>'form')); ?>
	<tr onclick="$('#select_agency_form_<?php echo $a->agency_id;?>').submit();" >
		<td><?php echo $i++; ?></td>
		<td><?php echo $a->agency_name; ?>
		<input type="hidden" value="<?php echo $a->agency_id; ?>" name="agency_id" />
		<input type="hidden" value="select" name="select" />
		</td>
		<td><?php echo $a->agency_address; ?></td>
		<td><?php echo $a->agency_contact_name; ?></td>
		<td><?php echo $a->agency_contact_designation; ?></td>
		<td><?php echo $a->agency_contact_number; ?></td>
		<td><?php echo $a->agency_email_id; ?></td>
		<td><?php echo $a->account_no; ?></td>
		<td><?php echo $a->bank_name; ?></td>
		<td><?php echo $a->branch; ?></td>
		<td><?php echo $a->pan; ?></td>
	</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div>