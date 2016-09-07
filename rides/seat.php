<?php

set_include_path('../../php/');

include('Mail.php');
include('Mail/mime.php');

require_once 'include/constants.php';

$con = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
if (!$con) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("slocrus1_slocru", $con);

//echo $_GET['action']." ".$user_id." on ride".$_GET['ride_id'];

// The action to be taken by the page. 
$action = $_GET['action'];
$ride_id = $_GET['ride_id'];
$user_id = $_GET['user_id'];

//echo "action: ".$action;
//echo "<br>ride_id: ".$ride_id;
//echo "<br>user_id: ".$user_id;

if(isset($_GET['pass_id'])) {
	$pass_id = $_GET['pass_id'];
	//echo "<br>pass_id: ".$pass_id;
}

// MAIN STUFF

if($action == 'remove') {
	remove_seat($pass_id, $ride_id);
}

if($action == 'delete') {
	// passed ride_id, pass_id, user_id
	
	// check to ensure user and ride are the same
	$sql="SELECT * FROM rides WHERE id = '".$ride_id."' LIMIT 1";
	$ride = mysql_query($sql);
	$ride_info = mysql_fetch_assoc($ride);
	
	// double checking - pass_id of user that clicked delete must match the car. 
	if($ride_info['driver_id'] != $pass_id) {
		echo "It does not appear that you are the driver for that ride. Unable to delete.";
		die;
	}
	
	// now delete the ride and all seats for that ride.
	$sql = "SELECT * FROM seats WHERE ride_id = '".$ride_id."' AND role != '1'";
	$seats = mysql_query($sql);
	while ($seat = mysql_fetch_assoc($seats)) {
		remove_seat($seat['user_id'], $ride_id);
	}
	
	// delete the driver
	$sql = "DELETE FROM `seats` WHERE user_id = '".$pass_id."' AND ride_id = ".$ride_id;
	$result = mysql_query($sql);
	
	// delete the ride
	$sql = "DELETE FROM `rides` WHERE id = ".$ride_id;
	$result = mysql_query($sql);

	
	echo "The ride has been deleted.";
	die;
	
}


// FUNCTIONS

function send_mail($recipient, $subject, $body, $html) {
	$sender = "Rides to Church <theslocru@gmail.com>";         // Your name and email address
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
}


// -- REQUEST -- 
// The user requested a ride from the view ride page
if($action == 'request') {
	// needs the user_id that requested the ride
	// as well as the ride_id of the ride requested
	
	$sql = "SELECT * FROM seats WHERE user_id = '".$user_id."' AND ride_id = '".$ride_id."' LIMIT 1";
	$result = mysql_query($sql);
	if (mysql_num_rows($result)){
		//echo "Already in DB!";
		echo 'Request denied. You already requested a seat in this ride';
		die;
	}
	
	$sql = "INSERT INTO `seats` (`id`, `user_id`, `ride_id`, `role`, `pending`) 
		    VALUES (NULL, '".$user_id."', '".$ride_id."', '2', true)";
	$result = mysql_query($sql);
	
	$sql="SELECT * FROM users WHERE user_id = '".$user_id."' LIMIT 1";
	$temp = mysql_query($sql);
	$user = mysql_fetch_assoc($temp);
	// user_id, name, email, phone, address, ride_id
	
	$user_name = $user['name'];
	$user_email = $user['email'];
	$user_phone = $user['phone'];
	$user_address = $user['address'];
	
	//echo "name: ".$user_name."<br>";
	
	$sql="SELECT * FROM rides WHERE id = '".$ride_id."' LIMIT 1";
	$ride = mysql_query($sql);
	$ride_info = mysql_fetch_assoc($ride);
	// seats, taken, driver_id, dest_id, dest_name, time, origin
	
	//echo "dest: ".$ride_info['dest_name']."<br>";
	
	$sql="SELECT * FROM users WHERE user_id = '".$ride_info['driver_id']."' LIMIT 1";
	$driver = mysql_query($sql);
	$driver_info = mysql_fetch_assoc($driver);
	// user_id, name, email, phone, address, ride_id
	
   
	// calculate the seats remaining
	$seatsRemain = $ride_info['seats'] - 1;

	// Constructing the email
	$recipient = $driver_info['email'];
	$subject = "Rides to Church Request";
	
	$body = "Hi ".$driver_info['name'].", \n\n ".$user_name." has requested a seat in your ride \"".$ride_info['dest_name']." ".$ride_info['time']."\".\n";
	$body .= "If you give ".$user_name." a ride, you will have ".$seatsRemain." seat(s) left.\n";
	$body .= "\nThank you,\nRides to Church.\n\n";
	$body .= "Copy and paste this link into your browser to respond to the request: http://slocru.com/rides/view/".$ride_id;
    $body .= "\nIf you add ".$user_name." to your car, please contact them via email:".$user_email." or phone:".$user_phone." to arrange the details.";
   
	$html = "<html><body><p>Hi ".$driver_info['name'].", <br /> ".$user_name." has requested a seat in your ride \"";
	$html .= $ride_info['dest_name']." ".$ride_info['time']."\".<br />";
	$html .= "If you give ".$user_name." a ride, you will have ".$seatsRemain." seat(s) left.<br />";
	$html .= "<a href='http://slocru.com/rides/view/".$ride_id."' >Go to this link to view your car and respond to this request</a><br />";
	$html .= "If you add ".$user_name." to your car, please contact them via email:".$user_email." or phone:".$user_phone." to arrange the details.<br>";
	$html .= "<br />Thank you,<br />Rides to Church.<br />";
	$html .= "</p></body></html>";  // HTML version of the email   
   
	send_mail($recipient, $subject, $body, $html);
	
	echo 'Ride requested, you will receive an email when the driver confirms your seat.';
	die;
	
} // end REQUEST 


// -- ADD --
// for responding to request
// http://slocru.com/rides/seat.php?action=add&ride_id={ride_id}&pass_id={pass_id}
if($action == 'add') {
	// 'add passenger to car' by changing pending value on seat to false
	$sql = "UPDATE `seats` SET pending = false WHERE user_id = ".$pass_id." AND ride_id = ".$ride_id;
	$result = mysql_query($sql);
	
	// Increment taken for the ride
	$sql = "UPDATE `rides` SET taken = taken+1 WHERE id = ".$ride_id;
	$result = mysql_query($sql);
	
	$sql="SELECT * FROM rides WHERE id = '".$ride_id."' LIMIT 1";
	$ride = mysql_query($sql);
	$ride_info = mysql_fetch_assoc($ride);
	
	$sql="SELECT * FROM users WHERE user_id = '".$pass_id."' LIMIT 1";
	$pass = mysql_query($sql);
	$pass_info = mysql_fetch_assoc($pass);
	// user_id, name, email, phone, address, ride_id
	
	// Constructing the email
	$recipient = $pass_info['email'];
	$subject = "Rides to Church Confirmation";
	
	$body = "Hi ".$pass_info['name'].", \n\n Your request for a seat on the ride ";
	$body .= "\"".$ride_info['dest_name']." ".$ride_info['time']."\" has been confirmed.\n";
	$body .= "to view the ride go to: http://slocru.com/rides/view/".$ride_id;
	$body .= "\nor go to http://slocru.com/rides/user for the driver's contact info\n";
	$body .= "\nThank you,\nRides to Church.\n\n";
   
	$html = "<html><body><p>Hi ".$pass_info['name'].", <br /> Your request for a seat on the ride \"";
	$html .= $ride_info['dest_name']." ".$ride_info['time']."\" has been confirmed.<br />";
	$html .= "<a href='http://slocru.com/rides/view/".$ride_id."' >Go to this link to view the car</a><br />";
	$html .= "<a href='http://slocru.com/rides/user/' >Or go to this link to find the driver's contact info</a>.<br />";
	$html .= "<br />Thank you,<br />Rides to Church.<br />";
	$html .= "</p></body></html>";  // HTML version of the email   
   
	send_mail($recipient, $subject, $body, $html);
	
}


function remove_seat($pass_id, $ride_id) {
	// delete the entry from 'seats' for the passenger
	$sql = "DELETE FROM `seats` WHERE user_id = '".$pass_id."' AND ride_id = ".$ride_id;
	$result = mysql_query($sql);
	
	// decrement the taken seats if seat was not pending
	if(isset($_GET['pend'])) {
		$pending = $_GET['pend'];
	
		if($pending == false && role != 1) {
			// taken needs to be decremented
			$sql = "UPDATE `rides` SET taken = taken-1 WHERE id = ".$ride_id;
			$result = mysql_query($sql);
		}
	}
	
	//email the passenger
	
	$sql="SELECT * FROM users WHERE user_id = '".$pass_id."' LIMIT 1";
	$pass = mysql_query($sql);
	$pass_info = mysql_fetch_assoc($pass);
 	
 	$sql="SELECT * FROM rides WHERE id = '".$ride_id."' LIMIT 1";
	$ride = mysql_query($sql);
	$ride_info = mysql_fetch_assoc($ride);
 	
	// Constructing the email
	$recipient = $pass_info['email'];
	$subject = "Rides to Church seat cancelation";
	
	$seat_status = ($pending)? "pending seat" : "seat";
	
	$body = "Hi ".$pass_info['name'].", \n\n Your ".$seat_status." on the ride ";
	$body .= "\"".$ride_info['dest_name']." ".$ride_info['time']."\" has been canceled.\n";
	$body .= "Copy and paste this link into your browser to view alternative rides: http://slocru.com/rides/loc/".$ride_info['dest_id'];
	$body .= "\n\nRides to Church.\n\n";
   
	$html = "<html><body><p>Hi ".$pass_info['name'].", <br /> Your ".$seat_status." on the ride \"";
	$html .= $ride_info['dest_name']." ".$ride_info['time']."\" has been canceled.<br />";
	$html .= "<a href='http://slocru.com/rides/loc/".$ride_info['dest_id']."' >Go to this link to view alternative rides</a><br />";
	$html .= "<br /><br />Rides to Church.<br />";
	$html .= "</p></body></html>";  // HTML version of the email   
   
	send_mail($recipient, $subject, $body, $html);
	
}


?>