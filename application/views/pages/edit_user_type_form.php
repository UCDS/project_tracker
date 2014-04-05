<h3><?php if(isset($msg)) echo $msg;?></h3>	
	<div class="col-md-12">
	<?php echo form_open('masters/edit/user_type',array('role'=>'form','class'=>'form-inline','name'=>'search_user_type'));?>
	<h3> Search User Type </h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr>
		<td>
		
		<input type="text" class="form-control" placeholder="--ALL--" id="search_user_type" name="search_user_type" style="width:200px;" /></td>
		<td><input class="btn btn-lg btn-primary btn-block" name="search" value="Search" type="submit" /></td></tr>
	</tbody>
	</table>
	</form>
	<?php if(isset($mode)&& $mode=="select"){ ?>
	<center>	<h3><u>Edit User Type</u></h3></center><br>
	<?php echo form_open('masters/edit/user_type',array('role'=>'form')); ?>

	<div class="form-group">
		<label for="user_type" class="col-md-4">User Type</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="User Type" id="user_type" name="user_type" 
		<?php if(isset($user_type)){
			echo "value='".$user_type[0]->user_type."' ";
			}
		?>
		/>
		<?php if(isset($user_type)){ ?>
		<input type="hidden" value="<?php echo $user_type[0]->user_type_id;?>" name="user_type_id" />
		
		<?php } ?>
		</div>
	</div>
	

   	<div class="col-md-3 col-md-offset-4">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div>
	</form>
	<?php } ?>
	
	<?php if(isset($mode) && $mode=="search"){ ?>

	<h3 class="col-md-12">List of User Type</h3>
	<div class="col-md-12 "><strong>
	

<?php if($this->input->post('search_user_type')) echo "User Type starting with : ".$this->input->post('search_user_type'); ?>
	
	</strong>
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
	<th>S.No</th><th>User Type </th>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($user_type as $u){ ?>
	<?php echo form_open('masters/edit/user_type',array('id'=>'select_user_type_form_'.$u->user_type_id,'role'=>'form')); ?>
	<tr onclick="$('#select_user_type_form_<?php echo $u->user_type_id;?>').submit();" >
		<td><?php echo $i++; ?></td>
		<td><?php echo $u->user_type; ?>
		<input type="hidden" value="<?php echo $u->user_type_id; ?>" name="user_type_id" />
		<input type="hidden" value="select" name="select" />
		</td>

	</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div>