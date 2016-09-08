<?php 

$ride_id = $_GET['ride_id'];
$editable = false;

$sql="SELECT * FROM rides WHERE id = '".$ride_id."' LIMIT 1";

$rides = mysql_query($sql);

// get assoc for the ride details
$ride_details = mysql_fetch_assoc($rides);

$sql="SELECT * FROM users WHERE user_id = ".$ride_details['driver_id'];
$names = mysql_query($sql);

// get assoc for the driver details
$driver_details = mysql_fetch_assoc($names);
$name = $driver_details['name'];

// check to see if active user is the driver for the ride
// if so, give them editing privileges.
if ($user_id == $ride_details['driver_id']) {
	$editable = true;
} 

?>
<div id="ride_info" style="height:40px;">
	<?php if($editable) {?>
		<a id='delete_ride' data-ride="<?php echo $ride_id ?>" data-user="<?php echo $user_id ?>" href="#delete" style="float:right; margin-right:10px; padding:10px; background-color:#fff;">Delete this ride</a>
	<?php } else { ?>
		<a id="request_ride" data-ride="<?php echo $ride_id ?>" data-user="<?php echo $user_id ?>" href="/rides/request/<?php echo $ride_details['id'] ?>" style="float:right; margin-right:10px; padding:10px; background-color:#fff;">Request a seat in this ride</a>
	<?php } ?>
	
	<img style=' width: 50px; float: left; margin-left:10px;' src='https://graph.facebook.com/<?php echo $ride_details['driver_id'] ?>/picture' alt='<?php echo $name ?>' />
	<h3 style="margin-left:70px">
		Ride to <?php echo $ride_details['dest_name']." <small><em>at</em></small> ".$ride_details['time'] ?><br>
		Driver: <?php echo $driver_details['name'] ?>
	</h3>
	
</div> <!-- end info div -->

<hr>

<div id="seats" style="width: 370px; float:right; margin:10px 10px 0;">

<?php if($ride_details['info'] != '') { ?>
	<h3 style="padding:5px; margin:0;background-color:#EEE; border:1px solid #CCC;">
		Notes:
	</h3>
	<p style='padding:0 5px;'>
		<?php echo $ride_details['info']; ?>
	</p>
<?php } //end notes if statement ?>

<h3 style="padding:5px; margin:0;background-color:#EEE; border:1px solid #CCC;">
	Passengers in this car
	<?php echo "<small>(".$ride_details['taken']." of ".$ride_details['seats']." seats)</small>"; ?>
</h3>

<?php

if($editable && $ride_details['taken'] > 0) {
	echo "<p style='padding:0 5px;'>Please contact the riders in your car to coordinate pick up and drop off times.</p>";
}

	$sql = "SELECT * FROM seats WHERE ride_id = '".$ride_id."' AND role != '1' AND pending = false";
	$result = mysql_query($sql);
	while ($seat = mysql_fetch_assoc($result)) {
		$temp="SELECT * FROM users WHERE user_id = ".$seat['user_id'];
		$rider = mysql_query($temp);
		$rider_info = mysql_fetch_assoc($rider);
		
		echo "<p style='padding:0 5px;'>";
		echo "<b>".$rider_info['name']."</b>";
		if($editable) {
			echo " <a href='#remove' class='remove_rider' data-pass='".$rider_info['user_id']."' data-ride='".$ride_id."' data-pend='0'>(remove)</a><br>";
			echo $rider_info['address']."<br>";
			echo $rider_info['phone']."<br>";
			echo "<a href='mailto:".$rider_info['email']."'>".$rider_info['email']."</a>";
		}
		echo "</p>";
		
		$rider_true = ($user_id == $rider_info['user_id'])? true : false;
	}

if($editable) {

	echo "<h3 style='padding:5px; margin:0;background-color:#EEE; border:1px solid #CCC;'>Pending passengers</h3>";

	$sql = "SELECT * FROM seats WHERE ride_id = '".$ride_id."' AND role != '1' AND pending = true";
	
	$result = mysql_query($sql);
	while ($seat = mysql_fetch_assoc($result)) {
		$temp="SELECT * FROM users WHERE user_id = ".$seat['user_id'];
		$rider = mysql_query($temp);
		$rider_info = mysql_fetch_assoc($rider);
		
		echo "<p style='padding:0 5px;'>";
		echo "<b>".$rider_info['name']."</b>";
		if($editable) {
			echo "(<a class='accept_rider' href='#accept' data-pass='".$rider_info['user_id']."' data-ride='".$ride_id."'>accept</a>
				  /<a href='#remove' class='remove_rider' data-pass='".$rider_info['user_id']."' data-ride='".$ride_id."' data-pend='1'>deny</a>)<br>";
			echo $rider_info['address']."<br>";
			echo $rider_info['phone']."<br>";
			echo "<a href='mailto:".$rider_info['email']."'>".$rider_info['email']."</a>";
		}
		echo "</p>";
	}
}
?>
</div> <!-- end seats -->

<div id="map_and_directions" style="margin: 20px 10px;">
	<div id="map_canvas" style="width: 380px; margin:0; float: none;"></div>
	<?php 
		if($editable) echo "<h4>Directions</h4><div id='directions-panel' style='width:380px'></div>";
		if($rider_true) {
			echo "<h3 style='margin-left:0;'>Contact info for your ride </h3>
				  <h4>Phone: ".$driver_details['phone']."</h4><h4>Email: ".$driver_details['email']."</h4>";
		}
	?>
</div>



<script type="text/javascript">
// initialize the map

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
      center: slo,
      streetViewControl: false
   }

   map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
   directionsDisplay.setMap(map);
   <?php echo ($editable) ? "directionsDisplay.setPanel(document.getElementById('directions-panel'));" : ""; ?>

   var origin; 
   var destination;
   
	$.ajax({
		type: "GET",
		url: "/rides/phpsqlajax_genxml.php?id="+<?php echo $ride_id ?>,
		dataType: "xml",
		success: function(xml) {
			$(xml).find('ride').each(function(){
				var id = $(this).attr('id');
				//var name = $(this).attr('name');
				origin = $(this).attr('origin');
				destination = $(this).attr('destination');
				var taken = $(this).attr('taken');
				
				for(var i=0; i < taken; i++){
					waypts.push({
      					location:$(this).attr("wp_"+i),
         				stopover:true
   					});
				}
				
				//$('#info').append( id + '<br /> ' + name + '<br /> ' + origin + '<br />'+destination);
				calcRoute(origin, destination);
			});
		}
	}); 
}

initialize();

// add confirm action to seat request
$('#request_ride').bind('click',function(event){
	var ride_id = $(this).attr("data-ride"); 
	var user_id = $(this).attr("data-user");
	
	if (confirm('Request this ride?')) {
		// mail request link to driver
		$.ajax({
			//type: "GET",
			url: "/rides/seat.php?action=request&ride_id="+ride_id+"&user_id="+user_id,
			success: function(data) {
				//$('#content').html(data);
				alert(data); //'Ride requested, you will receive an email when the driver confirms your seat.');
			}
		});
    }
	event.preventDefault();
});

//http://slocru.com/rides/seat.php?action=add&ride_id=11&pass_id=805837737


$('.accept_rider').each(function(){
	$(this).bind('click',function(event){
		var ride_id = $(this).attr("data-ride"); 
		var pass_id = $(this).attr("data-pass");
	
		if (confirm('Add this rider to your car?')) {
			// mail request link to driver
			$.ajax({
				//type: "GET",
				url: "/rides/add/"+ride_id+"/"+pass_id,
				success: function(data) {
					//$('#content').html(data);
					//alert('The Rider has been added to your ride');
					location.reload();
				}
			});
		}
		event.preventDefault();
	});
});

$('.remove_rider').each(function(){
	$(this).bind('click',function(event){
		var ride_id = $(this).attr("data-ride"); 
		var pass_id = $(this).attr("data-pass");
		var pending = $(this).attr("data-pend");

		if (confirm('Delete this rider from your car?')) {
			// mail request link to driver
			$.ajax({
				//type: "GET",
				url: "/rides/remove/"+ride_id+"/"+pass_id+"/"+pending,
				success: function(data) {
					//$('#content').html(data);
					//alert('The Rider has been added to your ride');
					location.reload();
				}
			});
		}
		event.preventDefault();
	});
});
$('#delete_ride').bind('click',function(event){
	// var action  = $(this).attr("data-action");
	var ride_id = $(this).attr("data-ride"); 
	var pass_id = $(this).attr("data-user");
	// var pending = $(this).attr("data-pend");
	
	if (confirm('Are you sure you want to delete this ride?')) {
		// mail request link to driver
		$.ajax({
			//type: "GET",
			url: "/rides/delete/"+ride_id+"/"+pass_id+"/0",
			success: function(data) {
				//$('#content').html(data);
				alert(data);
				location.href="/rides/user/";
			}
		});
	}
	event.preventDefault();
});


</script>
