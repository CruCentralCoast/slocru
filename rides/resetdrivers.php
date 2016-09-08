<?php

// reset the driver's cars 0 taken seats, delete the waypoints

$con = mysql_connect("localhost", "slocrus1_all" ,"2cor129");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("slocrus1_slocru", $con);

$sql="UPDATE drivers SET taken = '0', wp_0='', wp_1='', wp_2='', wp_3='' ";
$result = mysql_query($sql);

mysql_close($con);
  
header("Location: index.php?msg=database has been reset!");


?>