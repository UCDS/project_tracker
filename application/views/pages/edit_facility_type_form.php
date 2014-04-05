<h3><?php if(isset($msg)) echo $msg;?></h3>	
	<div class="col-md-12">
	<?php echo form_open('masters/edit/facility_type',array('role'=>'form','class'=>'form-inline','name'=>'search_facility_type'));?>
	<h3> Search Facility Type </h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr>
		<td>
		
		<input type="text" class="form-control" placeholder="--ALL--" id="search_facility_type" name="search_facility_type" style="width:200px;" /></td>
		<td><input class="btn btn-lg btn-primary btn-block" name="search" value="Search" type="submit" /></td></tr>
	</tbody>
	</table>
	</form>
	<?php if(isset($mode)&& $mode=="select"){ ?>
	<center>	<h3><u>Edit Facility Type</u></h3></center><br>
	<?php echo form_open('masters/edit/facility_type',array('role'=>'form')); ?>

	<div class="form-group">
		<label for="facility_type" class="col-md-4">Facility Type</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Facility Type" id="facility_type" name="facility_type" 
		<?php if(isset($facility_type)){
			echo "value='".$facility_type[0]->facility_type."' ";
			}
		?>
		/>
		<?php if(isset($facility_type)){ ?>
		<input type="hidden" value="<?php echo $facility_type[0]->facility_type_id;?>" name="facility_type_id" />
		
		<?php } ?>
		</div>
	</div>
	

   	<div class="col-md-3 col-md-offset-4">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div>
	</form>
	<?php } ?>
	
	<?php if(isset($mode) && $mode=="search"){ ?>

	<h3 class="col-md-12">List of facilities</h3>
	<div class="col-md-12 "><strong>
	

<?php if($this->input->post('search_facility_type')) echo "Facility Type starting with : ".$this->input->post('search_facility_type'); ?>
	
	</strong>
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
	<th>S.No</th><th>Facility Type </th>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($facility_type as $f){ ?>
	<?php echo form_open('masters/edit/facility_type',array('id'=>'select_facility_type_form_'.$f->facility_type_id,'role'=>'form')); ?>
	<tr onclick="$('#select_facility_type_form_<?php echo $f->facility_type_id;?>').submit();" >
		<td><?php echo $i++; ?></td>
		<td><?php echo $f->facility_type; ?>
		<input type="hidden" value="<?php echo $f->facility_type_id; ?>" name="facility_type_id" />
		<input type="hidden" value="select" name="select" />
		</td>

	</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div>