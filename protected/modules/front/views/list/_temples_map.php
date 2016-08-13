<div class="test_both"></div>
<div style="height:auto;overflow:hidden;z-index:-999;   ">
<div id="googleMap1" ></div>
</div>

<style>

@media only screen and (min-width: 720px) and (max-width: 1600px) {

#googleMap1
{
width: 100%; 
height:720px;
}
}


@media only screen  and (max-width: 480px) {

#googleMap1
{
width: 100%; 
height:300px;
margin-top:30px;
}
.test_both
{
 clear:both;
}
}
</style>



<script>

var iconBase = '<?php echo Yii::app()->request->baseUrl; ?>/image/temple_r1.png';



function initialize1() {
  var myLatlng = new google.maps.LatLng(9.9194,78.1194);
  var mapOptions = {
    zoom: 10,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('googleMap1'), mapOptions);

  <?php  for($i=0;$i<count($mapdetails);$i++) { ?>
 
              var marker<?php echo $i; ?> = new google.maps.Marker({
                position: new google.maps.LatLng(<?php echo $mapdetails[$i]->latitude; ?>, <?php echo $mapdetails[$i]->logtitute; ?>),
                map: map,
				title:'<?php echo $mapdetails[$i]->temple_name ?>',
				 icon: iconBase,

              });
		  marker<?php echo $i; ?>.setMap(map); 
				
				var test = '<?php echo $i;  ?>';
			  
				var infowindow = new google.maps.InfoWindow({
				content:test,
				});

				google.maps.event.addListener(marker<?php echo $i; ?>, 'click', function() 
				{
	infowindow.setContent("<div style='font-weight: bold;cursor:pointer;width:100%;height:50px !important; '><a href='<?php echo CHtml::normalizeUrl(array("detail/temple/id/".helpers::simple_encrypt($mapdetails[$i]->id))); ?>' style='color:#cb202d;'>"+this.title+"</a></div>");
				infowindow.open(map,marker<?php echo $i; ?>);
				});	 
		  
	<?php } ?>	

}
</script>

<script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="//maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyDNAAxLarqtFrao0T3s3XELHlAqB2nM6tY&amp;callback=initialize1" defer></script>
