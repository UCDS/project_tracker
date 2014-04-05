	<div class="col-md-8 col-md-offset-2">
	<strong><?php if(isset($msg)) echo $msg;?></strong>	
	<center>	<h3><u>Add Facility</u></h3></center><br>
	<?php echo form_open('masters/add/facility_type',array('role'=>'form')); ?>

	<div class="form-group">
		<label for="facility_name" class="col-md-4">Facility Type</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Facility Type" id="facility_type" name="facility_type" />
		</div>
	</div>
   	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
	</div>
	</form>
	</div>