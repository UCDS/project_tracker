
	<?php if(isset($mode)&& $mode=="select"){ ?>
	<center>	<h3><u>Edit Facility</u></h3></center><br>
	<?php echo form_open('masters/edit/facility',array('role'=>'form')); ?>

	<div class="form-group">
		<label for="facility_type" class="col-md-4" >Facility Type</label>
		<div  class="col-md-8">
		<select name="facility_type" id="facility_type" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($facility_types as $facility_type){
			echo "<option value='$facility_type->facility_type_id'";
			if(isset($facility) && $facility[0]->facility_type_id==$facility_type->facility_type_id)
				echo " SELECTED ";
			echo ">$facility_type->facility_type</option>";
		}
		?>
		</select>
		</div>
	</div>	
	<div class="form-group">
		<label for="facility_name" class="col-md-4">Facility Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Facility Name" id="facility_name" name="facility_name" 
		<?php if(isset($facility)){
			echo "value='".$facility[0]->facility_name."' ";
			}
		?>
		/>
		<?php if(isset($facility)){ ?>
		<input type="hidden" value="<?php echo $facility[0]->facility_id;?>" name="facility_id" />
		
		<?php } ?>
		</div>
	</div>
	<div class="form-group">
		<label for="division" class="col-md-4" >Division</label>
		<div  class="col-md-8">
		<select name="division" id="division" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($divisions as $d){
			echo "<option value='$d->division_id'";
			if(isset($facility) && $facility[0]->division_id==$d->division_id)
				echo "selected";
			echo ">$d->division</option>";
		}
		?>
		</select>
		</div>
	</div>	
	<div class="form-group">
	<label for="longitude" class="col-md-4">Longitude</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Longitude" id="longitude" name="longitude" 
		<?php if(isset($facility)){
			echo "value='".$facility[0]->longitude."' ";
			}
		?>
		/>
		</div>
	</div>
	<div class="form-group">
	<label for="latitude" class="col-md-4">Latitude</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Latitude" id="latitude" name="latitude" 
		<?php if(isset($facility)){
			echo "value='".$facility[0]->latitude."' ";
		}
		?>
		/>
		</div>
	</div>

	</div> 
   	<div class="col-md-3 col-md-offset-4">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div>
	</form>
	<?php } ?>
	<h3><?php if(isset($msg)) echo $msg;?></h3>	
	<div class="col-md-12">
	<?php echo form_open('masters/edit/facility',array('role'=>'form','class'=>'form-inline','name'=>'search_facility'));?>
	<h3> Search Facilities </h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr>
		<td>
		<select name="search_facility_type" id="search_facility_type" class="form-control" style="width:180px">
		<option value="" disabled selected>Type</option>
		<?php foreach($facility_types as $facility_type){
			echo "<option value='$facility_type->facility_type_id'>$facility_type->facility_type</option>";
		}
		?>
		</select>
		<select name="search_division" id="search_division" class="form-control" style="width:150px">
		<option value="" disabled selected >Division</option>
		<?php foreach($divisions as $d){
			echo "<option value='$d->division_id'>$d->division</option>";
		}
		?>
		</select>
		<input type="text" class="form-control" placeholder="Facility Name" id="search_facility_name" name="search_facility_name" style="width:200px;" /></td>
		<td><input class="btn btn-lg btn-primary btn-block" name="search" value="Search" type="submit" /></td></tr>
	</tbody>
	</table>
	</form>
	<?php if(isset($mode) && $mode=="search"){ ?>

	<h3 class="col-md-12">List of facilities</h3>
	<div class="col-md-12 "><strong>
	<?php if($this->input->post('search_facility_type')) echo "Facility Type : ".$facility[0]->facility_type; ?>
	<?php if($this->input->post('search_facility_name')) echo "Facility name starting with : ".$this->input->post('search_facility_name'); ?>
	<?php if($this->input->post('search_division')) echo "Division : ".$facility[0]->division; ?>
	</strong>
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
	<th>S.No</th><th>Facility Name </th><th>Facility Type</th><th>Division</th><th>Longitude</th><th>Latitude</th>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($facility as $f){ ?>
	<?php echo form_open('masters/edit/facility',array('id'=>'select_facility_form_'.$f->facility_id,'role'=>'form')); ?>
	<tr onclick="$('#select_facility_form_<?php echo $f->facility_id;?>').submit();" >
		<td><?php echo $i++; ?></td>
		<td><?php echo $f->facility_name; ?>
		<input type="hidden" value="<?php echo $f->facility_id; ?>" name="facility_id" />
		<input type="hidden" value="select" name="select" />
		</td>
		<td><?php echo $f->facility_type; ?></td>
		<td><?php echo $f->division; ?></td>
		<td><?php echo $f->longitude; ?></td>
		<td><?php echo $f->latitude; ?></td>
	</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div>