<?php
require("slocrusaderideshare_dbinfo.php");
set_include_path('../../php/');

$driver=$_GET["d"];

$con = mysql_connect("localhost", $username, $password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("slocrus1_slocru", $con);

$query="SELECT * FROM drivers WHERE id = '".$driver."'";
$result = mysql_query($query);
$driverInfo = mysql_fetch_array($result);

$query="SELECT * FROM riders WHERE driver = '".$driver."'";
$riderInfo = mysql_query($query);
// $riderInfo = mysql_fetch_array($result);
 
mysql_close($con);
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="<?php echo $str_language; ?>" xml:lang="<?php echo $str_language; ?>">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SLO Rides to Church</title>

<link rel="stylesheet" type="text/css" href="style.css" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<!-- functions for onclick() events and loading the google map -->


<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAEyXbu_3Q23CwHLWCabCwS4MHbCN_Dmh8&sensor=true" type="text/javascript"></script>

<script type="text/javascript"> 

/* GOOGLE MAPS functions */
  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
  var waypts =[]; // = [{ location:'572 e foothill blvd, 93405', stopover:true }];

function calcRoute(orig, dest) {
	// var start = document.getElementById("start").value;
   var start = orig; //document.getElementById("info").getAttribute("origin");
   var end = dest; //document.getElementById("info").getAttribute("destination");
   
   var request = {
      origin:start, 
      destination:end,
      waypoints:waypts, 
     	optimizeWaypoints: true,
      travelMode: google.maps.DirectionsTravelMode.DRIVING
   };
   directionsService.route(request, function(response, status) {
   	if (status == google.maps.DirectionsStatus.OK) {
      	directionsDisplay.setDirections(response);
   	}
   });
}

function initialize() {
	directionsDisplay = new google.maps.DirectionsRenderer();
   var slo = new google.maps.LatLng(35.273933, -120.654259);
   var myOptions = {
   	zoom:12,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: slo
   }

   map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
   directionsDisplay.setMap(map);
   directionsDisplay.setPanel(document.getElementById('directions-panel'));

   
   var origin; 
   var destination;
   
	$.ajax({
		type: "GET",
		url: "phpsqlajax_genxml.php?d="+<?php echo $driver ?>,
		dataType: "xml",
		success: function(xml) {
			$(xml).find('driver').each(function(){
				var id = $(this).attr('id');
				var name = $(this).attr('name');
				origin = $(this).attr('address');
				destination = $(this).attr('destination');
				
				var points = ['wp_0', 'wp_1', 'wp_2', 'wp_3'];
				var i = 0;
				while($(this).attr(points[i]) != '') {
					// waypts[i] = obj.getAttribute("wp_0");
					waypts.push({
      				location:$(this).attr(points[i]),
         			stopover:true
   				});
					i++;
   			}
   			
				//$('#info').append( id + '<br /> ' + name + '<br /> ' + origin + '<br />'+destination);
				calcRoute(origin, destination);
			});
		}
	}); 
	
   // Calculate the route
   // calcRoute(origin, destination);
   //calcRoute("206 Via San Blas, 93401", "Calvary SLO, 93401");
}

</script> 

  
</head>

<!-- loads the google map when page loads -->
<body onload="initialize();">


<?php if ($msg != '') { 
	echo "<div id='header'>".$msg."</div>";
} ?>
<div id="wrapper">



<h1 style="float:left"><a href="http://slocrusade.com/rides/" >RIDES TO CHURCH</a></h1>
<!-- <a href="http://slocrusade.com/rides/?type=other" ><p style="margin:20px 0 0; float:left;">(and other places)</p></a> -->
<h3 style="float:right; padding: 10px 20px 10px 0;">
	<a href="http://slocrusade.com/rides/" >Get a Ride</a> | 
	<a href="addDriver.php" >Give a Ride</a>
</h3>
<div style="clear:both"></div>

<div id="content">

<?php echo "<h2>Viewing ".$driverInfo['name']."'s car to ".$driverInfo['destination']." ".$driverInfo['service']." service.</h2>"; ?>


<hr>

<div id="map_canvas" style="width: 500px; height: 300px"></div>

<div id="info">
<!-- <h3>Riders in your car</h3>
<?php 
while ($row = @mysql_fetch_assoc($riderInfo)){ 
	echo "<h4>".$row['name']."</h4>";
	echo "<p><a href='mailto:".$row['email']."'>".$row['email']."</a><br />".$row['phone']."</p>";
}

?> -->
<h3 style="clear:both">Driving Directions</h3>
<div id="directions-panel"></div>

</div> <!-- end content -->
<?php include('footer.php'); ?>

</div> <!-- end wrapper -->
 
</body>
</html>





