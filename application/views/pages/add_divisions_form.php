<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#date").Zebra_DatePicker({
		
	});
	
});
</script>
		<div class="col-md-8 col-md-offset-2">
		<center><strong><?php if(isset($msg)){ echo $msg;}?></strong></center>
				<center>	<h3><u>ADD DIVISION</u></h3></center><br>
	<?php echo validation_errors(); echo form_open('masters/add/divisions',array('role'=>'form')); ?>

		<div class="form-group">
		<label for="division" class="col-md-4">Division Name<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Division Name" id="division" name="division" />
		</div>
	</div>
	<div class="form-group">
		<label for="district_name" class="col-md-4" >Districts<font color='red'>*</font></label>
		<div  class="col-md-8">
		<select name="district_name" id="district_name" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($district as $d){
			echo "<option value='$d->district_id'>$d->district_name</option>";
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
		<input type="text" class="form-control" placeholder="Latitude " id="latitude" name="latitude" />
		</div>
	</div>
<div class="form-group">
		<label for="state" class="col-md-4">State</label>
		<div  class="col-md-8">
		<input readonly type="text" class="form-control" value="Andhra Pradesh"id="state" name="state" />
		</div>
	</div>
   	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
	</div>
</div>