<?php if(preg_match("^".base_url()."reports*^",current_url())){ ?>
<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
		<li class="disabled"><a href="#">Summary</a></li>
				<li><a href="<?php echo base_url();?>reports/districts">District</a></li>
				<li><a href="<?php echo base_url();?>reports/facility_types">Facility Type</a></li>
				<li><a href="<?php echo base_url();?>reports/grants">Grant</a></li>
		<li class="nav-divider"></li>
		<li class="disabled"><a href="#">Detailed</a></li>
				<li><a href="<?php echo base_url();?>reports/projects">Projects</a></li>
	<ul>
</div>
<div class="col-md-10 col-md-offset-2">	
<?php } else if(preg_match("^".base_url()."masters^",current_url()) || preg_match("^".base_url()."projects^",current_url())){ ?>
<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
		<li class="disabled"><a href="#">Add</a></li>
				<li><a href="<?php echo base_url();?>masters/add/agency">Agency</a></li>
				<li><a href="<?php echo base_url();?>masters/add/division">Division</a></li>
				<li><a href="<?php echo base_url();?>masters/add/grant">Grant</a></li>
				<li><a href="<?php echo base_url();?>projects/create">Project</a></li>
				<li><a href="<?php echo base_url();?>masters/add/facility">Facility</a></li>
				<li><a href="<?php echo base_url();?>masters/add/facility_type">Facility Type</a></li>
				<li><a href="<?php echo base_url();?>masters/add/user">Users</a></li>
		<li class="nav-divider"></li>
		<li class="disabled"><a href="#">Edit</a></li>
				<li><a href="<?php echo base_url();?>projects/update">Projects</a></li>
				<li><a href="<?php echo base_url();?>masters/edit/facility">Facility</a></li>
		<ul>
</div>
<div class="col-md-10 col-md-offset-2">	
<?php } ?>