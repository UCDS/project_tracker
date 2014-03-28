<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#agreement_date").Zebra_DatePicker({
		direction:false
	});
	$("#probable_date_of_completion,#agreement_completion_date").Zebra_DatePicker({
		direction:1
	});
});
</script>
		<div class="col-md-8 col-md-offset-2">
				<center>	<h3><u>ADD DIVISION</u></h3></center><br>
	<?php echo form_open('masters/add/division',array('role'=>'form')); ?>

		<div class="form-group">
		<label for="division_name" class="col-md-4">Division Name<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Division Name" id="division_name" name="division_name" />
		</div>
	</div>
	<div class="form-group">
		<label for="district" class="col-md-4" >Districts</label>
		<div  class="col-md-8">
		<select name="district" id="district" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($district as $d){
			echo "<option value='$d->district_id'>$d->district_name</option>";
		}
		?>
		</select>
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