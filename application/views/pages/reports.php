 <script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?&sensor=true&region=IN">
  </script>
  <script>
  //['Hyderabad',17.86,80.64,5,'getnpo.php?npo=1'],['Some city',19.86,80.64,5,'getnpo.php?npo=1']
	var points = [
	<?php 
	$loop_count=0;
	$array_count=count($district_summary);
	foreach($district_summary as $district){ 
		echo "[
		'$district->district_name,\\n Total Works : $district->total_projects\\n Works not started : $district->not_started \\n Works in  progress : $district->work_in_progress \\n Works Completed : $district->work_completed',$district->latitude,$district->longitude,100,'".base_url()."reports/districts/$district->district_id']";
		if($loop_count<$array_count){
		echo ",";
		}
		$loop_count++;
	}
	?>
	
	];
	function setMarkers(map, cities) {
	    var shape = {
	        coord: [1, 1, 1, 20, 18, 20, 18, 1],
	        type: 'poly'
	    };
	    for (var i = 0; i < cities.length; i++) {
	        var flag = new google.maps.MarkerImage(
	            'http://googlemaps.googlermania.com/google_maps_api_v3/en/Google_Maps_Marker.png',
	        new google.maps.Size(37, 34),
	        new google.maps.Point(0, 0),
	        new google.maps.Point(10, 34));
	        var place = cities[i];
	        var myLatLng = new google.maps.LatLng(place[1], place[2]);
	        var marker = new google.maps.Marker({
	            position: myLatLng,
	            map: map,
	            icon: flag,
	            shape: shape,
	            title: place[0],
	            zIndex: place[3],
	            url: place[4]
	        });
	        google.maps.event.addListener(marker, 'click', function () {
	        window.location.href = this.url;
	        });
	    }
	}
	function initialize() {
		// Create an array of styles.


	    var myOptions = {
	    center: new google.maps.LatLng(17.324167, 79.134766),
	        zoom: 6,
	   mapTypeControlOptions: {
	      mapTypeIds: [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.TERRAIN, google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID ]
	    }
	    };
		
	    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	    map.setOptions({draggable: true, zoomControl: true, scrollwheel: false, disableDoubleClickZoom: false});

	     setMarkers(map, points);
	}
	
	google.maps.event.addDomListener(window,'load',initialize);
  </script>
  
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			
			<h1>Reports</h1>	
			<ul>
				<li><a href="<?php echo base_url();?>reports/districts">Summary - District Wise</a></li>
				<li><a href="<?php echo base_url();?>reports/facility_types">Summary - Facility type Wise</a></li>
				<li><a href="<?php echo base_url();?>reports/grants">Summary - Grant Wise</a></li>
				<li><a href="<?php echo base_url();?>reports/projects">Projects - Detailed</a></li>
			</ul>
		</div>
	</div>			
	<div id="map_canvas" style="width: 750px; height: 400px; margin:20px;"></div>

