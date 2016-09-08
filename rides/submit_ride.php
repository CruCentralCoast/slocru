<?php
// require("slocrusaderideshare_dbinfo.php");

require_once 'include/constants.php';

$con = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
if (!$con) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("slocrus1_slocru", $con);

// variables available:
// name
// email
// phone
// address
// seats
// church 
// address
// service

$driver_id = $_POST['driver_id'];
$name = mysql_real_escape_string($_POST['name']);
$email = mysql_real_escape_string($_POST['email']);
$phone = mysql_real_escape_string($_POST['phone']);
$address = mysql_real_escape_string($_POST['address']);
$seats = mysql_real_escape_string($_POST['seats']);
$dest_id = mysql_real_escape_string($_POST['dest_id']);
//$dest_name = mysql_real_escape_string($_POST['dest_name']);
$time = mysql_real_escape_string($_POST['time']);

$info = mysql_real_escape_string($_POST['info']);

$sql="SELECT * FROM destinations WHERE id = '".$dest_id."'";

$dest = mysql_query($sql);
$dest_info = mysql_fetch_assoc($dest);

$dest_name = $dest_info['name'];

/* DEBUG 
echo "driver_id: ".$driver_id."<br>";
echo "name: ".$name."<br>";
echo "email: ".$email."<br>";
echo "address: ".$address."<br>";
echo "seats: ".$seats."<br>";
echo "dest_id: ".$dest_id."<br>";
echo "dest_name: ".$dest_name."<br>";
echo "time: ".$time."<br>";
*/

// Create ride with driver info
$sql="INSERT INTO `rides` (`id`, `seats`, `taken`, `driver_id`, `origin`, `dest_id`, `dest_name`, `time`, `info`) 
      VALUES (NULL, '".$seats."', '0', '".$driver_id."', '".$address."', '".$dest_id."', '".$dest_name."', '".$time."', '".$info."')";
//$sql="INSERT INTO drivers VALUES(null,'".$name."', '".$seats."', '0', '".$email."', '".$phone."', '".$church."', '', '', '', '', '".$service."', '".$address."');";
$result = mysql_query($sql);

//$ride_info = mysql_fetch_assoc($result);
$ride_id = mysql_insert_id(); //$ride_info['id'];  

//echo "ride_id: ".$ride_id;
// create seat in the car for the driver
$sql="INSERT INTO `seats` (`id`, `user_id`, `ride_id`, `role`) 
      VALUES (NULL, '".$driver_id."', '".$ride_id."', '1')";

$result = mysql_query($sql);


//echo "debug";

header ('Location: /rides/view/'.$ride_id);
?>

<a href="/rides/" >Return to front page</a>