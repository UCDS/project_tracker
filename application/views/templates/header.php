<?php $thispage="h4a"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title><?php echo $title; ?> - APMSIDC</title>
	<link rel="stylesheet" type="text/css" 
	href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" 
	href="<?php echo base_url(); ?>assets/css/theme.default.css">
	
	<script type="text/javascript" 
	src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" 
	src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript" 
	src="<?php echo base_url();?>assets/js/custom.js"></script> -->
		
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.widgets.min.js"></script>
	<script>
		$(function(){  
		var options = {
			widthFixed : true,
			showProcessing: true,
			headerTemplate : '{content} {icon}', // Add icon for jui theme; new in v2.7!

			widgets: [ 'default', 'zebra', 'stickyHeaders','filter' ],

			widgetOptions: {

			  // extra class name added to the sticky header row
			  stickyHeaders : '',
			  // number or jquery selector targeting the position:fixed element
			  stickyHeaders_offset : 0,
			  // added to table ID, if it exists
			  stickyHeaders_cloneId : '-sticky',
			  // trigger "resize" event on headers
			  stickyHeaders_addResizeEvent : true,
			  // if false and a caption exist, it won't be included in the sticky header
			  stickyHeaders_includeCaption : false,
			  // The zIndex of the stickyHeaders, allows the user to adjust this to their needs
			  stickyHeaders_zIndex : 2,
			  // jQuery selector or object to attach sticky header to
			  stickyHeaders_attachTo : null,
			  // scroll table top into view after filtering
			  stickyHeaders_filteredToTop: true,

			  // adding zebra striping, using content and default styles - the ui css removes the background from default
			  // even and odd class names included for this demo to allow switching themes
			  zebra   : ["ui-widget-content even", "ui-state-default odd"],
			  // use uitheme widget to apply defauly jquery ui (jui) class names
			  // see the uitheme demo for more details on how to change the class names
			  uitheme : 'jui'
			}
		  };
			$("#table-1").tablesorter(options);
		});
	</script>
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
            <li <?php if(current_url()==base_url()){ echo "class='active'";}?>><a href="<?php echo base_url();?>home">Home</a></li>
	<?php if($this->session->userdata('logged_in')) { ?>
			<li class="dropdown">
			<a <?php if(preg_match("/masters/",current_url()) || preg_match("/projects/",current_url())){ echo "class='active'";}?> href="<?php echo base_url();?>projects/create">Operations</a></li>
            <li <?php if(preg_match("/reports/",current_url())){ echo "class='active'";}?>>
				<a href="<?php echo base_url();?>reports">Reports</a>
			</li>
	<?php } ?>
            
		</ul>
	<?php if($this->session->userdata('logged_in')) { ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a><?php $user=$this->session->userdata('logged_in'); echo $user['username']; ?></a></li>
            <li><a href="<?php echo base_url();?>home/logout">Logout</a></li>
          </ul>	
	<?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container">