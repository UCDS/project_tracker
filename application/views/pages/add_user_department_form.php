	<div class="col-md-8 col-md-offset-2">
		<h3><?php if(isset($msg)) echo $msg;?></h3>	
		<center><h3><u>ADD USER DEPARTMENT</u></h3></center><br>
		<?php echo form_open('masters/add/user_department',array('role'=>'form')); ?>
			<div class="form-group">
			<label for="user_department" class="col-md-4">User Department</label>
			<div  class="col-md-8">
			<input type="text" class="form-control" placeholder="User Department" id="user_department" name="user_department" />
			</div>
		</div>
		<div class="col-md-3 col-md-offset-4">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
		</div>
	</div>