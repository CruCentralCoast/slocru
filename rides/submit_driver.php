<?php
require("slocrusaderideshare_dbinfo.php");

// variables available:
// name
// email
// phone
// address
// seats
// church 
// address
// service

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$seats = $_POST['seats'];
$church = $_POST['church'];
$address = $_POST['address'];
$service = $_POST['service'];



$con = mysql_connect("localhost", $username , $password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("slocrus1_slocru", $con);

// convert the service from 1, 2, 3 to the service time
$sql="SELECT * FROM churches WHERE name = '".$church."'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);   
if($service == '1') {
	$service = $row['service1'];
} else if ($service == '2') {
	$service = $row['service2'];
} else {
	$service = $row['service3'];
}


// $sql="SELECT * FROM drivers WHERE destination = '".$n."' AND service = '".$s."' ORDER BY seats DESC";
// INSERT INTO drivers VALUES(8, 'Chris Wall', 3, 0, 'cw@example.com', '(800)555-5555', 'Calvary SLO', '9:00am', '405 Higuera, San Luis Obispo, CA');
$sql="INSERT INTO drivers VALUES(null,'".$name."', '".$seats."', '0', '".$email."', '".$phone."', '".$church."', '', '', '', '', '".$service."', '".$address."');";
$result = mysql_query($sql);

/* $sql ="SELECT * FROM churches WHERE name='".$n."'";

$row = mysql_fetch_array(mysql_query($sql));
$dest = $row['address']; 

$x = 0; // the number of drivers

while($row = mysql_fetch_array($result)) {
	// print the link with javascript call
	echo "<a href='#'	 onclick='showDetails(this.title, this)' title='".$row['name']."' ";
	// echo "destination='".$row['destination']."' origin='".$row['origin']."'>";
	echo "destination='".$dest."' origin='".$row['address']."'>";
	echo $row['name']." (".$row['seats']." seats)"."</a><br />";
	$x++;
}
*/
   mysql_close($con);

header("Location: index.php?msg=Your car has been added to the database, we will contact you if someone signs up for a ride, thank you!");

?>