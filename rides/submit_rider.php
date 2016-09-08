<?php

set_include_path('../../php/');
//require_once 'Mail.php';

include('Mail.php');
include('Mail/mime.php');

// variables available:
// driverID
// name
// email
// phone
// address

$driver = $_GET["d"];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];


$con = mysql_connect("localhost", "slocrus1_all" ,"2cor129");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("slocrus1_slocru", $con);

// Add rider to rider database

// $sql="SELECT * FROM drivers WHERE destination = '".$n."' AND service = '".$s."' ORDER BY seats DESC";
// INSERT INTO riders VALUES (NULL, 'name', 'email', 'phone', 'address', 'driver ID', 'has_ride');
$sql="INSERT INTO riders VALUES(null,'".$name."', '".$email."', '".$phone."', '".$address."', '".$driver."', '0');";
$result = mysql_query($sql);



$sql="SELECT * FROM drivers WHERE id = '".$driver."'";  // get the info for the driver
$result = mysql_query($sql);
$driverinfo = mysql_fetch_array($result); // the array of driver information


$sql="SELECT * FROM riders WHERE name = '".$name."'";  // get the info for the driver
$result = mysql_query($sql);
$riderinfo = mysql_fetch_array($result); // the array of driver information

// send email to notify driver and include add rider link

$from = "slocrusade@gmail.com";
$to = $driverinfo['email']; // the driver's email
   
$subject = "Ride to church request";

$seatsRemain = $driverinfo['seats'] - 1;

	// Constructing the email
   $sender = "Slo Crusade Rideshare <slocrusade@gmail.com>";           // Your name and email address
   $recipient = $driverinfo['email'];;                           				  // The Recipients name and email address
   $subject = "Ride to church request";                                // Subject for the email
   $body = "Hi ".$driverinfo['name'].", \n\n ".$name." has requested a seat in your car to ".$driverinfo['destination']." for the ".$driverinfo['service']." service.\n";
	// $body .= "If you can give them a ride, please contact them at ".$phone." or ".$email.".\n";
	$body .= "If you give ".$name." a ride, you will have ".$seatsRemain." seat(s) left.\n";
	$body .= "\nThank you,\nSlo Crusade Rideshare.\n\n";
	$body .= "Copy and paste this link into your browser to add the rider to your car: http://slocrusade.com/rides/updateCar.php?d=".$driverinfo['id']."&r=".$riderinfo['id'];
   
   $html = "<html><body><p>Hi ".$driverinfo['name'].", <br /> ".$name." has requested a seat in your car to ";
   $html .= $driverinfo['destination']." for the ".$driverinfo['service']." service.<br />";
   $html .= "<a href='http://slocrusade.com/rides/updateCar.php?d=".$driverinfo['id']."&r=".$riderinfo['id']."' >Go to this link to add rider to car</a><br />";
   //$html .= "If you can give them a ride, please contact ".$name." at ".$phone." or ".$email.".<br />";
   $html .= "If you give ".$name." a ride, you will have ".$seatsRemain." seat(s) left.<br />";
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
        

	/*
   $host = "ssl://smtp.gmail.com";
   $port = "465";
   $username = "nathanwhughes@gmail.com";
   $password = "mammoth88";

   $headers = array ('From' => $from,
   	'To' => $to,
      'Subject' => $subject);
   	$smtp = Mail::factory('smtp',
      	array ('host' => $host,
         'port' => $port,
         'auth' => true,
         'username' => $username,
         'password' => $password));

     $mail = $smtp->send($to, $headers, $body);

	if (PEAR::isError($mail)) {
   	echo("<p>" . $mail->getMessage() . "</p>");
   } else {
      echo("<p>Message successfully sent!</p> <a href='JavaScript:window.close()'>Close</a>");
   }
   */
   
   mysql_close($con);

//echo "Ride requested from ".$driver.".";
header("Location: index.php?msg=Ride has been requested, the driver will be sent an email with your request. When they respond, you will be notified.");

?>