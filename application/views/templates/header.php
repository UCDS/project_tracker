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
	<link rel="stylesheet" type="text/css" 
	href="<?php echo base_url(); ?>assets/css/selectize.css">
	
	<script type="text/javascript" 
	src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" 
	src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript" 
	src="<?php echo base_url();?>assets/js/custom.js"></script> -->
		
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.widgets.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.colsel.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.print.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.selectize.js"></script>
	<script>
		$(function(){ 
		$('.select-box').selectize({
			sortField: 'text'
		});
		var options = {
			widthFixed : true,
			showProcessing: true,
			headerTemplate : '{content} {icon}', // Add icon for jui theme; new in v2.7!

			widgets: [ 'default', 'zebra', 'print','columnSelector', 'stickyHeaders','filter' ],

			widgetOptions: {

			// target the column selector markup
			columnSelector_container : $('#columnSelector'),
			// column status, true = display, false = hide
			// disable = do not display on list
			columnSelector_columns : {
				0: 'disable' /*,  disabled no allowed to unselect it */
				/* 1: false // start hidden */
			},
			// remember selected columns
			columnSelector_saveColumns: true,
	
			// container layout
			columnSelector_layout : '<label><input type="checkbox">{name}</label>',
			// data attribute containing column name to use in the selector container
			columnSelector_name  : 'data-name',
	
			/* Responsive Media Query settings */
			// enable/disable mediaquery breakpoints
			columnSelector_mediaquery: true,
			// toggle checkbox name
			columnSelector_mediaqueryName: 'Auto: ',
			// breakpoints checkbox initial setting
			columnSelector_mediaqueryState: true,
			// responsive table hides columns with priority 1-6 at these breakpoints
			// see http://view.jquerymobile.com/1.3.2/dist/demos/widgets/table-column-toggle/#Applyingapresetbreakpoint
			// *** set to false to disable ***
			columnSelector_breakpoints : [ '20em', '30em', '40em', '50em', '60em', '70em' ],
			// data attribute containing column priority
			// duplicates how jQuery mobile uses priorities:
			// http://view.jquerymobile.com/1.3.2/dist/demos/widgets/table-column-toggle/
			columnSelector_priority : 'data-priority',
		  print_title      : 'table',          // this option > caption > table id > "table"
		  print_dataAttrib : 'data-name', // header attrib containing modified header name
		  print_rows       : 'f',         // (a)ll, (v)isible or (f)iltered
		  print_columns    : 's',         // (a)ll, (v)isible or (s)elected (columnSelector widget)
		  print_extraCSS   : '.table{border:1px solid #ccc;} tr,td{background:white}',          // add any extra css definitions for the popup window here
		  print_styleSheet : '', // add the url of your print stylesheet
		  // callback executed when processing completes - default setting is null
		  print_callback   : function(config, $table, printStyle){
			// do something to the $table (jQuery object of table wrapped in a div)
			// or add to the printStyle string, then...
			// print the table using the following code
			$.tablesorter.printTable.printOutput( config, $table.html(), printStyle );
			},
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
		  $('.print').click(function(){
			$('#table-1').trigger('printTable');
		  });
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
				<a href="<?php echo base_url();?>reports/summary/districts">Reports</a>
			</li>
	<?php } ?>
            
		</ul>
	<?php if($this->session->userdata('logged_in')) { ?>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown  <?php if(preg_match("^".base_url()."user_panel^",current_url())){ echo "active";}?>">
			<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown"><?php $logged_in=$this->session->userdata('logged_in');echo $logged_in['username']; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url()."user_panel/change_password";?>">Change Password</a></li>
				  <li class="divider"></li>
				<li><a href="<?php echo base_url();?>home/logout">Logout</a></li>
				</ul>
			
          </ul>	
	<?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container">