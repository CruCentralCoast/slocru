<?php
// index.php for slocru.com/rides

$msg = $_GET['msg'];
$type = $_GET['type'];

/*require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();
*/


require_once 'include/constants.php';
include "login/src/facebook.php";

// connect to the database
$con = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
if (!$con) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("slocrus1_slocru", $con);

define('APP_ID', '106567406163337');
define('APP_SECRET', 'b14778505d4757cb1ffe7cd9cc692ae6');


$facebook = new Facebook(array(
'appId' => APP_ID,//$app_id,
'secret' => APP_SECRET,//$app_secret,
'cookie' => true,
'domain'=>'slocru.com/',
));

$user_id = $facebook->getUser();
if($user_id) {
	
	$sql = "SELECT * FROM `users` WHERE  `user_id` = ".$user_id." LIMIT 1";
	//$sql = "SELECT * FROM users WHERE user_id = '".$user_id."' LIMIT 1";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0 ) {
		/* echo "<h2>user is already registered</h2>";
		
		$user = mysql_fetch_array($result);
		echo "user: ".$user_id;	

		echo "name: ".$user['name'];
		*/
		
		// if user logged in, send to main site
		// $msg = $user_id;
	} else {
		// User not registered yet, keep at the login;
		header ('Location: http://slocru.com/rides/login/');
	}
} else {
	// User not registered yet, keep at the login;
	header ('Location: http://slocru.com/rides/login/');
}


if($type == '') $type='church';
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="<?php echo $str_language; ?>" xml:lang="<?php echo $str_language; ?>">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SLO Rides to Church</title>

<link rel="stylesheet" type="text/css" href="http://slocru.com/rides/style.css" />

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<!-- functions for onclick() events and loading the google map -->
<!--  NO longer need
<script type="text/javascript" src="http://slocru.com/rides/funcs.js"></script> -->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>		

<script type="text/javascript">
/* GOOGLE MAPS functions */
  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
  var waypts =[]; // = [{ location:'572 e foothill blvd, 93405', stopover:true }];
function initialize() {
	directionsDisplay = new google.maps.DirectionsRenderer();
	var slo = new google.maps.LatLng(35.273933, -120.654259);
	var myOptions = {
		zoom:12,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		center: slo
	}
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	// directionsDisplay.setMap(map);
	
	<?php if(isset($_GET['dest'])) { 

		$sql="SELECT * FROM destinations WHERE `id` = ".$_GET['dest'];
		$dest = mysql_query($sql);
		$dest_details = mysql_fetch_assoc($dest);
		$lat = $dest_details['lat'];
		$long = $dest_details['long'];

		echo "// The marker for the chosen destination 		
		var destinationLoc = new google.maps.LatLng($lat, $long);
		var marker = new google.maps.Marker({
			position: destinationLoc,
			map: map,
			title:'Destination Location',
			content: 'Destination Location'
		});
		
		//infoWindow.setOptions({content: 'Destination Location'});
     	//infoWindow.open(map, marker);
     	";
	}?>
}
</script>

</head>


<!-- <body onload="initialize();"> -->
<body>

<?php if ($msg != '') { 
	echo "<div id='header'>".$msg."</div>";
} ?>
<div id="wrapper">



<h1 style="float:left"><a href="http://slocru.com/rides/" >RIDES TO CHURCH </a><a href="/rides/about/" style="font-size:14px;">about</a></h1>
<!-- <a href="http://slocrusade.com/rides/?type=other" ><p style="margin:20px 0 0; float:left;">(and other places)</p></a> -->
<h4 style="float:right; padding: 15px 20px  0 0;">
	<a href="http://slocru.com/rides/" id="user_info">View Rides</a> | 
	<a href="http://slocru.com/rides/user/" id="user_info">My Info</a> | 
	<a href="http://slocru.com/rides/new/" id="offer_ride">Offer a Ride</a> 
	<!--| 
	 <a href="http://slocru.com/rides/" >Get a Ride</a> | 
	<a href="addDriver.php" >Give a Ride</a> -->
</h4>
<div style="clear:both"></div>


<div id="content">
<?php 
// include the content for the front page

if(!isset($_GET['page'])) {
	include('main.php');
} else {
	$page = $_GET['page'];
	include($page.'.php');
}
?>

</div> <!-- end content -->

<?php include('footer.php'); ?>
</div> <!-- end wrapper -->
 
 <script type="text/javascript">

$(function() {	
	/*$('#user_info').bind('click',function(event){
		
		$('#content').text('Loading...');
		
		//$("#content").load("user.php", {user_id: <?php echo $user_id ?>});
		event.preventDefault();
	});
	
		
	$('#offer_ride').bind('click',function(event){
		
		$('#content').text('Not yet working, sorry.');
		
		//$("#content").load("user.php", {user_id: <?php echo $user_id ?>});
		event.preventDefault();
	});
	*/
	
	$('.reserve_seat').each(function() {
		$(this).bind({
			mouseenter: function() {
				$(this).css('background-color', '#fff');
			},
			mouseleave: function() {
				$(this).css('background-color', '#ccc');
			}
		});
	});
	
	
}); // end function

</script>

</body>
</html>

