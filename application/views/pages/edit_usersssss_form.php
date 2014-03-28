
	<?php if(isset($mode)&& $mode=="select"){ ?>
	<center>	<h3><u>Edit Users</u></h3></center><br>
	<?php echo form_open('masters/edit/users',array('role'=>'form')); ?>

	<div class="form-group">
		<label for="user_type" class="col-md-4" >User Type</label>
		<div  class="col-md-8">
		<select name="user_type" id="user_type" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($facility_types as $user_type){
			echo "<option value='$user_type->user_id'";
			if(isset($users) && $users[0]->user_id==$user_type->user_id)
				echo " SELECTED ";
			echo ">$user_type->user_type</option>";
		}
		?>
		</select>
		</div>
	</div>	
	<div class="form-group">
		<label for="username" class="col-md-4">User Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="User Name" id="username" name="username" 
		<?php if(isset($users)){
			echo "value='".$users[0]->username."' ";
			}
		?>
		/>
		<?php if(isset($users)){ ?>
		<input type="hidden" value="<?php echo $users[0]->user_id;?>" name="user_id" />
		
		<?php } ?>
		</div>
	</div>
	
		<div class="form-group">
		<label for="password" class="col-md-4">Password</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Password" id="password" name="password" 
		<?php if(isset($users)){
			echo "value='".$users[0]->password."' ";
			}
		?>
		/>
	</div></div>

	
		<div class="form-group">
		<label for="first_name" class="col-md-4">First Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name" 
		<?php if(isset($users)){
			echo "value='".$users[0]->first_name."' ";
			}
		?>
		/>
	</div></div>
		
		<div class="form-group">
		<label for="last_name" class="col-md-4">Last Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Last Name" id="last_name" name="last_name" 
		<?php if(isset($users)){
			echo "value='".$users[0]->last_name."' ";
			}
		?>
		/>
	</div></div>
		<div class="form_group">
		<label for="gender" class="col-md-4">Gender</label>
		<div  class="col-md-8">
		<label class="radio-inline" for="male">
		<input type="radio" name="gender" id="male" value="M" />Male 
		</label>
		<label for="female" class="radio-inline"> 
		<input type="radio" id="female" name="gender" value="F" /> 
		Female
		</label>
		<?php if(isset($users)){
			echo "value='".$users[0]->gender."' ";
			}
		?>
		/>
		</div>
</div>

	<div class="form-group">
		<label for="dob" class="col-md-4">DOB</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="DOB" id="dob" name="dob" 
		<?php if(isset($users)){
			echo "value='".$users[0]->dob."' ";
			}
		?>
		/>
	</div></div>
	<div class="form-group">
		<label for="phone_no" class="col-md-4">Phone Number</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Phone Number" id="phone_no" name="phone_no" 
		<?php if(isset($users)){
			echo "value='".$users[0]->phone_no."' ";
			}
		?>
		/>
	</div></div>
	<div class="form-group">
		<label for="email_id" class="col-md-4">Email Id</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Email Id" id="email_id" name="email_id" 
		<?php if(isset($users)){
			echo "value='".$users[0]->email_id."' ";
			}
		?>
		/>
	</div></div>
	<div class="form-group">
		<label for="address" class="col-md-4">Address</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Address" id="address" name="address" 
		<?php if(isset($users)){
			echo "value='".$users[0]->address."' ";
			}
		?>
		/>
	</div></div>
	<div class="form-group">
		<label for="country" class="col-md-4">Country</label>
		<div  class="col-md-8">
		<input type="text" readonly class="form-control" value="India" id="country" name="country" 
		<?php if(isset($users)){
			echo "value='".$users[0]->country."' ";
			}
		?>
		/>
	</div></div>
	<div class="form-group">
		<label for="state" class="col-md-4">State</label>
		<div  class="col-md-8">
		<input type="text" readonly class="form-control" value="Andhra Pradesh" id="state" name="state" 
		<?php if(isset($users)){
			echo "value='".$users[0]->state."' ";
			}
		?>
		/>
	</div></div>
	<div class="form-group">
		<label for="city" class="col-md-4">City</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="City" id="city" name="city" 
		<?php if(isset($users)){
			echo "value='".$users[0]->city."' ";
			}
		?>
		/>
</div></div>
<div class="form-group">
		<label for="pincode" class="col-md-4">Pincode</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Pincode" id="pincode" name="pincode" 
		<?php if(isset($users)){
			echo "value='".$users[0]->pincode."' ";
			}
		?>
		/>
	</div></div>
   	<div class="col-md-3 col-md-offset-4">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div>
	</form>
	<?php } ?>
	<h3><?php if(isset($msg)) echo $msg;?></h3>	
	<div class="col-md-12">
	<?php echo form_open('masters/edit/users',array('role'=>'form','class'=>'form-inline','name'=>'search_user'));?>
	<h3> Search Users </h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr>
		<td>
		<select name="search_user_type" id="search_user_type" class="form-control" style="width:180px">
		<option value="" disabled selected>Type</option>
		<?php foreach($user_type as $user_type){
			echo "<option value='$user_type->user_id'>$user_type->user_type</option>";
		}
		?>
		</select>
		
		<input type="text" class="form-control" placeholder="User Name" id="search_username" name="search_username" style="width:200px;" /></td>
		<td><input class="btn btn-lg btn-primary btn-block" name="search" value="Search" type="submit" /></td></tr>
	</tbody>
	</table>
	</form>
	<?php if(isset($mode) && $mode=="search"){ ?>

	<h3 class="col-md-12">List of Users</h3>
	<div class="col-md-12 "><strong>
	<?php if($this->input->post('search_user_type')) echo "User Type : ".$Users[0]->user_type; ?>
	<?php if($this->input->post('search_username')) echo "User name starting with : ".$this->input->post('search_username'); ?>

	</strong>
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
	<th>S.No</th><th>User Type </th><th>User Name</th><th>First Name</th><th>Last Name</th>
	<th>Gender</th><th>DOB</th><th>Phone No</th><th>Email Id</th><th>Country</th><th>State</th><th>City</th><th>Pincode</th>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($users as $u){ ?>
	<?php echo form_open('masters/edit/users',array('id'=>'select_users_form_'.$u->user_id,'role'=>'form')); ?>
	<tr onclick="$('#select_users_form_<?php echo $u->user_id;?>').submit();" >
		<td><?php echo $i++; ?></td>
		<td><?php echo $u->user_type; ?>
		<input type="hidden" value="<?php echo $u->user_id; ?>" name="user_id" />
		<input type="hidden" value="select" name="select" />
		</td>
		<td><?php echo $u->username; ?></td>
		<td><?php echo $u->password; ?></td>
		<td><?php echo $u->first_name; ?></td>
		<td><?php echo $u->last_name; ?></td>
		<td><?php echo $u->gender; ?></td>
		<td><?php echo $u->dob; ?></td>
		<td><?php echo $u->phone_no; ?></td>
		<td><?php echo $u->email_id; ?></td>
		<td><?php echo $u->country; ?></td>
		<td><?php echo $u->state; ?></td>
		<td><?php echo $u->city; ?></td>
		<td><?php echo $u->pincode; ?></td>
	</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div>