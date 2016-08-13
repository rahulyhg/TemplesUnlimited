<div id="googleMap" style="width: 500px; height:300px; "></div>	

<script>
	$(document).ready(function() {
	setTimeout(initialize, 5);
	});
	
	
	function initialize()
	{
	var myLatlng = new google.maps.LatLng(<?php echo $latitude; ?>,<?php echo $logtitute; ?>);
	var mapOptions = {
	zoom: 8,
	center: myLatlng
	}
	
	var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
	
	var marker = new google.maps.Marker({
	position: myLatlng,
	map: map,
	title: '<?php echo $temple_name; ?>'
	});
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>

	<style>
	.mainpage img, .textwidget img, .entry-content img, .advertising-box img
	{
	max-width: 10000% !important;
	}
	</style>
