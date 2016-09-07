<?php 
set_include_path('../../php/');
//require_once 'Mail.php';

include('Mail.php');
include('Mail/mime.php');


$driverID=$_GET["d"];	// the id for the driver
$riderID=$_GET["r"];		// the id for the rider
$func=$_GET["f"];			// the function for this script - add or drop a rider from a car


// connect to the database to add or remove the rider to or from the driver's car
$con = mysql_connect("localhost", "slocrus1_all" ,"2cor129");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("slocrus1_slocru", $con);


// load the driver
$sql="SELECT * FROM drivers WHERE id = '".$driverID."'";
$result = mysql_query($sql);
$driverinfo = mysql_fetch_array($result);

$sql="SELECT * FROM riders WHERE id = '".$riderID."'";
$result = mysql_query($sql);
$riderinfo = mysql_fetch_array($result);

if($riderinfo['has_ride'] == 1){
	// rider already has a ride
	header("Location: index.php?msg=".$riderinfo['name']." has already been added.");
	mysql_close($con);
	return;
}

/* if($func == 'drop'){
	if($riderinfo['has_ride'] == 0){
		// rider already has a ride
		header("Location: index.php?msg=".$riderinfo['name']." has already been added.");
		mysql_close($con);
		return;
	}
	// remove the waypoint from the driver
	// adjust the taken value
	
	header("Location: index.php?msg=".$riderinfo['name']." has been dropped from your ride.");
	mysql_close($con);
	return;
}
*/

// add the rider's address to the correct waypoint for the driver
$sql="UPDATE drivers SET wp_".$driverinfo['taken']."='".$riderinfo['address']."' WHERE id='".$driverinfo['id']."';";
$result = mysql_query($sql);

$taken = $driverinfo['taken'] + 1;
$sql="UPDATE drivers SET taken='".$taken."' WHERE id='".$driverinfo['id']."';";
$result = mysql_query($sql);

$sql="UPDATE riders SET has_ride=1 WHERE id='".$riderinfo['id']."';";
$result = mysql_query($sql);

// $riderinfo = mysql_fetch_array($result);

//$sql="INSERT INTO riders VALUES(null,'".$name."', '".$email."', '".$phone."', '".$address."', '".$driver."');";
//$result = mysql_query($sql);

// send driver an email

$seatsRemain = $driverinfo['seats'] - $driverinfo['taken'] - 1; //taken hasn't been updated since changing

// Constructing the email
   $sender = "Slo Crusade Rideshare <slocrusade@gmail.com>";           // Your name and email address
   $recipient = $driverinfo['email'];;                           				  // The Recipients name and email address
   $subject = $riderinfo['name']." added to your car";                               // Subject for the email
   $body = "Hi ".$driverinfo['name'].", \n\n ".$riderinfo['name']." has been added to your ride to ".$driverinfo['destination']." for the ".$driverinfo['service']." service.\n";
	$body .= "Please contact them at ".$riderinfo['phone']." or ".$riderinfo['email']." to arrange when and where to meet.\n";
	$body .= "your ride has ".$seatsRemain." seat(s) left. View your ride at: http://www.slocrusade.com/rides/viewcar.php?d=".$driverinfo['id']."\n";
	$body .= "\nThank you,\nSlo Crusade Rideshare.\n\n";
	// $body .= "Copy and paste this link into your browser to add the rider to your car: http://slocrusade.com/rides/updateCar.php?d=".$driverinfo['id']."&r=".$riderinfo['id'];
   
   $html = "<html><body><p>Hi ".$driverinfo['name'].", <br /> ".$riderinfo['name']." has has been added to your ride to ";
   $html .= $driverinfo['destination']." for the ".$driverinfo['service']." service.<br />";
   // $html .= "<a href='http://slocrusade.com/rides/updateCar.php?d=".$driverinfo['id']."&r=".$riderinfo['id']."' >Go to this link to add rider to car</a>";
   $html .= "Please contact ".$riderinfo['name']." at ".$riderinfo['phone']." or ".$riderinfo['email']." to arrange when and where to meet.<br />";
   $html .= "Your ride now has ".$seatsRemain." seat(s) left. <a href='http://www.slocrusade.com/rides/viewcar.php?d=".$driverinfo['id']."'>View your ride here</a><br />";
   $html .= "<br />Thank you,<br />Slo Crusade Rideshare.<br />";
   // $html .= "<a href='http://slocrusade.com/rides/updateCar.php?d=".$driverinfo['id']."&r=".$riderinfo['id']."' >Click here to add rider to car</a>";
   $html .= "</p></body></html>";  // HTML version of the email
   
   $crlf = "\n";
  	$headers = array(
   	'From'          => $sender,
   	'Return-Path'   => $sender,
   	'Subject'       => $subject
   	);
 
	// Creating the Mime message
	$mime = new Mail_mime($crlf);
 
	// Setting the body of the email
	$mime->setTXTBody($body);
	$mime->setHTMLBody($html);
 
	$body = $mime->get();
	$headers = $mime->headers($headers);
 
	// Sending the email
	$mail =& Mail::factory('mail');
	$mail->send($recipient, $headers, $body);

// send rider an email



mysql_close($con);

header("Location: index.php?msg=Rider has been added to your car. Thank you!");

?>