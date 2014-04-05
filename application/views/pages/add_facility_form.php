	<div class="col-md-8 col-md-offset-2">
		<center><strong><?php if(isset($msg)) echo $msg;?></strong>	
	<h3><u>Add Facility</u></h3></center><br>
	<?php echo validation_errors(); echo form_open('masters/add/facility',array('role'=>'form')); ?>

<div class="form-group">
		<label for="facility_name" class="col-md-4">Facility Name<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Facility Name" id="facility_name" name="facility_name" />
		</div>
	</div>
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
		<label for="division" class="col-md-4" >Division</label>
		<div  class="col-md-8">
		<select name="division" id="division" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($divisions as $d){
			echo "<option value='$d->division_id'>$d->division</option>";
		}
		?>
		</select>
		</div>
	</div>	
	<div class="form-group">
	<label for="longitude" class="col-md-4">Longitude</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Longitude" id="longitude" name="longitude" />
		</div>
	</div>
	<div class="form-group">
	<label for="latitude" class="col-md-4">Latitude</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Latitude" id="latitude" name="latitude" />
		</div>
	</div>

	</div> 
   	<div class="col-md-2 col-md-offset-5">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
	</div>
	</form>