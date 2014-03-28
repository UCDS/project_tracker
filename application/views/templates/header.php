<?php $thispage="h4a"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title><?php echo $title; ?> - APMSIDC</title>
	<link rel="stylesheet" type="text/css" 
	href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	
	<script type="text/javascript" 
	src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" 
	src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrap">
    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">APMSIDC</a>
          <a class="navbar-brand" href="#">- Project Tracker</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php if(current_url()==base_url()){ echo "class='active'";}?>><a href="/apmsidc/home">Home</a></li>
	<?php if($this->session->userdata('logged_in')) { ?>
			<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Add Masters<b class="caret"></b></a>
				<ul class="dropdown-menu">
				<li><a href="<?php echo base_url();?>masters/add/agency">Add Agency</a></li>
				<li><a href="<?php echo base_url();?>masters/add/divisions">Add Division</a></li>
				<li><a href="<?php echo base_url();?>masters/add/grant">Add Grant</a></li>
				<li><a href="<?php echo base_url();?>masters/add/facility">Add Facility</a></li>
				<li><a href="<?php echo base_url();?>projects/create">Add Project</a></li>
				<li><a href="<?php echo base_url();?>masters/add/users">Add Users</a></li>
			
				</ul>
			</li>
			<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Edit Masters <b class="caret"></b></a>
				<ul class="dropdown-menu">
				
				<li><a href="<?php echo base_url();?>masters/edit/agency">Edit Agency</a></li>
				<li><a href="<?php echo base_url();?>masters/edit/divisions">Edit Division</a></li>
				<li><a href="<?php echo base_url();?>masters/edit/facility">Edit Facility</a></li>
				<li><a href="<?php echo base_url();?>masters/edit/grant">Edit Grant</a></li>
				<li><a href="<?php echo base_url();?>projects/update">Edit Projects</a></li>
				<li><a href="<?php echo base_url();?>masters/edit/users">Edit Users</a></li>
				</ul>
			</li>
            <li <?php if(preg_match("/reports/",current_url())){ echo "class='active'";}?>>
				<a href="<?php echo base_url();?>reports">Reports</a>
			</li>
	<?php } ?>
            
		</ul>
	<?php if($this->session->userdata('logged_in')) { ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a><?php echo $this->session->userdata('logged_in')[0]['username']; ?></a></li>
            <li><a href="<?php echo base_url();?>home/logout">Logout</a></li>
          </ul>	
	<?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container">