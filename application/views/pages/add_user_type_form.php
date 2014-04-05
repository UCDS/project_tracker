	<div class="col-md-8 col-md-offset-2">
		<center><strong><?php if(isset($msg)) echo $msg;?></strong>	
	<h3><u>Add User Type</u></h3></center><br>
	<?php echo form_open('masters/add/user_type',array('role'=>'form')); ?>

	<div class="form-group">
		<label for="user_type" class="col-md-4">User Type</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="User Type" id="user_type" name="user_type" />
		</div>
	</div>
   	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
	</div>
	</form>
	</div>