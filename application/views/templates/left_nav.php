<?php if(preg_match("^".base_url()."reports*^",current_url())){ 
	foreach($functions as $f){
		if(preg_match("^Reports*^",$f->user_function)){ ?>
			<div class="col-sm-3 col-md-2 sidebar-left">
				<ul class="nav nav-sidebar">
					<li class="disabled"><a href="#">Summary</a></li>
						<?php foreach($functions as $f){
							if($f->user_function == "Reports - District"){ ?>
							<li><a href="<?php echo base_url();?>reports/divisions">Division</a></li>
						<?php break; }
						}
						foreach($functions as $f){
							if($f->user_function == "Reports - District"){ ?>
							<li><a href="<?php echo base_url();?>reports/districts">District</a></li>
						<?php break; }
						}
						foreach($functions as $f){
							if($f->user_function == "Reports - Facility type"){ ?>
							<li><a href="<?php echo base_url();?>reports/facility_types">Facility Type</a></li>
						<?php break; } 
						}
						foreach($functions as $f){
							if($f->user_function == "Reports - Scheme"){ ?>
							<li><a href="<?php echo base_url();?>reports/grants">Scheme</a></li>
						<?php break; } 
						}
						foreach($functions as $f){
							if($f->user_function == "Reports - User Department"){ ?>
							<li><a href="<?php echo base_url();?>reports/user_departments">User Department</a></li>
						<?php break; }
						}
						foreach($functions as $f){
							if($f->user_function == "Reports - Agency"){ ?>
							<li><a href="<?php echo base_url();?>reports/agencies">Agency</a></li>
						<?php break; }
						} ?>
				<ul>
			</div>
		<?php 
			break; 
		} 
	} ?>
<div class="col-md-10 col-md-offset-2">	
<?php } else if(preg_match("^".base_url()."masters^",current_url()) || preg_match("^".base_url()."projects^",current_url()) || preg_match("^".base_url()."staff^",current_url()) || preg_match("^".base_url()."user_panel^",current_url())){ ?>
<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
		<li class="disabled"><a href="#">Add</a></li>
			<?php 
				foreach($functions as $f){
					if($f->user_function=="Agencies" && $f->add==1){ ?>
						<li><a href="<?php echo base_url();?>masters/add/agency">Agency</a></li>
				<?php break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="Divisions" && $f->add==1){ ?>
						<li><a href="<?php echo base_url();?>masters/add/division">Division</a></li>
				<?php
					break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="Schemes" && $f->add==1){ ?>
						<li><a href="<?php echo base_url();?>masters/add/grant">Grant</a></li>
				<?php 
					break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="Works" && $f->add==1){ ?>
						<li><a href="<?php echo base_url();?>projects/create">Project</a></li>
				<?php 
					break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="Facilities" && $f->add==1){ ?>
						<li><a href="<?php echo base_url();?>masters/add/facility">Facility Name</a></li>
				<?php 
					break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="User Departments" && $f->add==1){ ?>
						<li><a href="<?php echo base_url();?>masters/add/user_department">User Department</a></li>
				<?php 
					break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="Facility Types" && $f->add==1){ ?>				
						<li><a href="<?php echo base_url();?>masters/add/facility_type">Facility Type</a></li>
				<?php 
					break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="Agency" && $f->add==1){ ?>
						<li><a href="<?php echo base_url();?>masters/add/user">Users</a></li>
				<?php 
					break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="Staff" && $f->add==1){ ?>
						<li><a href="<?php echo base_url();?>staff/add/staff">Staff</a></li>
					<?php
						break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="Staff Roles" && $f->add==1){ ?>
						<li><a href="<?php echo base_url();?>staff/add/staff_role">Staff Role</a></li>
					<?php 
						break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="Staff Categories" && $f->add==1){ ?>
						<li><a href="<?php echo base_url();?>staff/add/staff_category"> Staff Category</a></li>
					<?php 
						break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="Users" && $f->add==1){ ?>
						<li><a href="<?php echo base_url();?>user_panel/create_user">User</a></li>
					<?php 
						break;
					}
				}
				?>
		<li class="nav-divider"></li>
		<li class="disabled"><a href="#">Edit</a></li>
				<?php 
				foreach($functions as $f){
					if($f->user_function=="Works" && $f->edit==1){ ?>
						<li><a href="<?php echo base_url();?>projects/update">Projects</a></li>
					<?php
						break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="Facilities" && $f->edit==1){ ?>
						<li><a href="<?php echo base_url();?>masters/edit/facility">Facility Name</a></li>
					<?php 
						break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="User Departments" && $f->edit==1){ ?>
						<li><a href="<?php echo base_url();?>masters/edit/user_department">User Department</a></li>
					<?php
						break;
					}
				}
				foreach($functions as $f){
					if($f->user_function=="Facility Types" && $f->edit==1){ ?>
						<li><a href="<?php echo base_url();?>masters/edit/facility_types">Facility Types</a></li>
					<?php
						break;
					}
				}
				?>
		<ul>
</div>
<div class="col-md-10 col-md-offset-2">
<?php 
}
?>