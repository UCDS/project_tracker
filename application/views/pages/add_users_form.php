<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#date").Zebra_DatePicker({
	
	});
	
});
</script>
		<div class="col-md-8 col-md-offset-2">
				<center>	
					<strong><?php if(isset($msg)){ echo $msg;}?></strong>
					<h3><u><b>ADD USER</b></u></h3></center><br>
	<?php echo validation_errors();echo form_open('masters/add/users',array('role'=>'form')); ?>
  <div class="form-group">
  <label for="user_type" class="col-md-4" >User Type<font color='red'>*</font></label>
  <div  class="col-md-8">
  <select name="user_type" id="user_type" class="form-control">
  <option value="">--SELECT--</option>
  <option value="Superinendant Engineer" <?php echo set_select('user_type', 'superinendant'); ?> >Superinendant Engineer</option>
  <option value="Executive Engineer" <?php echo set_select('user_type', 'executive'); ?> >Executive Engineer</option>
  <option value="Deputy Executive Engineer" <?php echo set_select('user_type', 'deputy'); ?> >Deputy Executive Engineer</option>
  <option value="Assistant Executive Engineer" <?php echo set_select('user_type', 'assistant'); ?> >Assistant Executive Engineer </option>
  </select></div></div>
	    <div class="form-group">
		<label for="username" class="col-md-4">User Name<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="User Name" id="username" name="username" />
		</div>
	    </div>
	<div class="form-group">
    <label for="password" class="col-md-4">Password<font color='red'>*</font></label>
	<div  class="col-md-8">
	<input type="password" class="form-control" placeholder="Password" id="password" name="password" />
	</div>
	</div>
	    <div class="form-group">
		<label for="first_name" class="col-md-4">First Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name" />
		</div>
	    </div>
	<div class="form-group">
		<label for="last_name" class="col-md-4">Last Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Last Name" id="last_name" name="last_name" />
		</div>
	</div>
	<div class="form_group">
		<div   class="col-md-12" style="padding-left:0">
		<label for="gender" class="col-md-6">Gender</label>
		
		<label class="radio-inline" for="male">
		<input type="radio" name="gender" id="male" value="M" />Male 
		</label>
		<label for="female" class="radio-inline"> 
		<input type="radio" id="female" name="gender" value="F" /> 	Female
	
		</label>
		</div>
        </div>
	
		<div class="form_group">
		<label for="date" class="col-md-4">Date of Birth</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Date of Birth" id="date" name="dob" />
		</div>
	</div>

	<div class="form-group">
		<label for="phone_no" class="col-md-4">Phone Number</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Phone Number" id="phone_no" name="phone_no" />
		</div>
	</div>
	<div class="form-group">
		<label for="email_id" class="col-md-4">Email Id</label>
		<div  class="col-md-8">
		<input type="email" class="form-control" placeholder="Email Id" id="email_id" name="email_id" />
		</div>
	</div>
	<div class="form-group">
		<label for="address" class="col-md-4">Address</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Address" id="address" name="address" />
		</div>
	</div>
		<div class="form-group">
		<label for="country" class="col-md-4">Country</label>
		<div  class="col-md-8">
		<input type="text" readonly class="form-control" value="India" id="country" name="country" />
		</div>
	</div>
	
	<div class="form-group">
		<label for="state" class="col-md-4">State</label>
		<div  class="col-md-8">
		<input type="text" readonly class="form-control" value="Andhra Pradesh" id="state" name="state" />
		</div>
	</div>
		<div class="form-group">
		<label for="city" class="col-md-4">City</label>
		<div  class="col-md-8">
		<input type="text"  class="form-control" placeholder="City" id="city" name="city" />
		</div>
	</div>
	
		
	<div class="form-group">
		<label for="pincode" class="col-md-4">Pincode</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Pincode" id="pincode" name="pincode" />
		</div>
	</div>

	</div>	
   	<div class="col-md-2 col-md-offset-5">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
	</div>
