
	<?php 
	echo validation_errors();
	if(isset($mode)&& $mode=="select"){ ?>
	<center>	<h3><u><b>Edit Division</b></u></h3></center><br>
	<?php  echo form_open('masters/edit/divisions',array('role'=>'form')); ?>


	<div class="form-group">
		<label for="divisions" class="col-md-4">Division Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Division Name" id="division" name="division" 
		<?php if(isset($divisions)){
			echo "value='".$divisions[0]->division."' ";
			}
		?>
		/>
		<?php if(isset($divisions)){ ?>
		<input type="hidden" value="<?php echo $divisions[0]->division_id;?>" name="division_id" />
		
		<?php } ?>
		</div>
	</div>
	<div class="form-group">
		<label for="district_name" class="col-md-4" >District</label>
		<div  class="col-md-8">
		<select name="district_name" id="district_name" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($districts as $di){
			echo "<option value='$di->district_id'";
			if(isset($divisions) && $divisions[0]->district_id==$di->district_id)
				echo "selected";
			echo ">$di->district_name</option>";
		}
		?>
		</select>
		</div>
	</div>	
	<div class="form-group">
		<label for="longitude" class="col-md-4">Longitude</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Longitude " id="longitude" name="longitude"
		<?php if(isset($divisions)){
			echo "value='".$divisions[0]->longitude."' ";
			}
		?>
		/>
</div></div>
	<div class="form-group">
		<label for="latitude" class="col-md-4">Latitude</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Latitude" id="latitude" name="latitude"
		<?php if(isset($divisions)){
			echo "value='".$divisions[0]->latitude."' ";
			}
		?>
		/>
</div></div>

	</div>
   	<div class="col-md-3 col-md-offset-4">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div>
	</form>
	<?php } ?>
	<h3><?php if(isset($msg)) echo $msg;?></h3>	
	<div class="col-md-12">
	<?php echo form_open('masters/edit/divisions',array('role'=>'form','class'=>'form-inline','name'=>'search_division'));?>
	<h3> Search Division </h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr>
		<td>
		
	<select name="search_district" id="search_district" class="form-control" style="width:150px">
		<option value="" disabled selected >District</option>
		<?php foreach($districts as $di){
			echo "<option value='$di->district_id'>$di->district_name</option>";
		}
		?>
		</select>
		<input type="text" class="form-control" placeholder="Division Name" id="search_division" name="search_division" style="width:200px;" /></td>
	
		<td><input class="btn btn-lg btn-primary btn-block" name="search" value="Search" type="submit" /></td></tr>
	</tbody>
	</table>
	</form>
	<?php if(isset($mode) && $mode=="search"){ ?>
	<h3 class="col-md-12">List of Divisions</h3>
	<div class="col-md-12 "><strong>

	<?php if($this->input->post('search_divisions')) echo "Division name starting with : ".$this->input->post('search_divisions'); ?>
	<?php if($this->input->post('search_divisions')) echo "Division : ".$divisions[0]->district; ?>
	</strong>
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
	<th>S.No</th><th>Division Name </th><th>District</th><th>Longitude</th><th>Latitude</th>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($divisions as $d){ ?>
	<?php echo form_open('masters/edit/divisions',array('id'=>'select_divisions_form_'.$d->division_id,'role'=>'form')); ?>
	<tr onclick="$('#select_divisions_form_<?php echo $d->division_id;?>').submit();" >
		<td><?php echo $i++; ?></td>
		<td><?php echo $d->division; ?>
		<input type="hidden" value="<?php echo $d->division_id; ?>" name="division_id" />
		<input type="hidden" value="select" name="select" />
		</td>
		<td><?php echo $d->district_name; ?></td>
		<td><?php echo $d->longitude; ?></td>
		<td><?php echo $d->latitude; ?></td>
	
	</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div>