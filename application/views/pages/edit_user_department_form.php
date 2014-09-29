
	<?php if(isset($mode)&& $mode=="select"){ ?>
	<center>	<h3><u>Edit User Department</u></h3></center><br>
	<?php echo form_open('masters/edit/user_department',array('role'=>'form')); ?>

	<div class="form-group">
		<label for="user_department" class="col-md-4">User Department</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="User Department" id="user_department" name="user_department" 
		<?php if(isset($user_department)){
			echo "value='".$user_department[0]->user_department."' ";
			}
		?>
		/>
		<?php if(isset($user_department)){ ?>
		<input type="hidden" value="<?php echo $user_department[0]->user_department_id;?>" name="user_department_id" />
		
		<?php } ?>
		</div>
	</div>
   	<div class="col-md-3 col-md-offset-4">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div>
	</form>
	<?php } ?>
	<h3><?php if(isset($msg)) echo $msg;?></h3>	
	<div class="col-md-12">
	<?php echo form_open('masters/edit/user_department',array('role'=>'form','class'=>'form-inline','name'=>'search_user_department'));?>
	<h3> Search User Departments </h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr>
		<td>
		<input type="text" class="form-control" placeholder="User Department" id="search_user_department" name="search_user_department" style="width:200px;" /></td>
		<td><input class="btn btn-lg btn-primary btn-block" name="search" value="Search" type="submit" /></td>
	</tr>
	</tbody>
	</table>
	</form>
	<?php if(isset($mode) && $mode=="search"){ ?>

	<h3 class="col-md-12">List of user departments</h3>
	<div class="col-md-12 "><strong>
	<?php if($this->input->post('search_user_department')) echo "User Departments starting with : ".$this->input->post('search_user_department'); ?>
	</strong>
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
		<th>S.No</th>
		<th>User Department</th>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($user_department as $ud){ ?>
		<?php echo form_open('masters/edit/user_department',array('id'=>'select_user_department_form_'.$ud->user_department_id,'role'=>'form'));?>
		<tr onclick="$('#select_user_department_form_<?php echo $ud->user_department_id;?>').submit();" >
			<td><?php echo $i++; ?></td>
			<td><?php echo $ud->user_department; ?>
			<input type="hidden" value="<?php echo $ud->user_department_id; ?>" name="user_department_id" />
			<input type="hidden" value="select" name="select" />
			</td>
		</tr>
		</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div>