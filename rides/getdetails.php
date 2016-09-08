<?php
$q=$_GET["q"];

$con = mysql_connect("localhost","slocrus1_all","2cor129");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("slocrus1_slocru", $con);

$sql="SELECT * FROM drivers WHERE name = '".$q."'";

$result = mysql_query($sql);


$row = mysql_fetch_array($result);

$seats = $row['seats']-$row['taken'];
echo "<div id='info'>" ; //destination='".$row['destination']."' origin='".$row['origin']."' >";
//while($row = mysql_fetch_array($result)) {
  echo "<p>name:    ".$row['name']."<br />";
  echo "seats available: ".$seats."</p>";
  // echo "email:   ".$row['email']."<br />";
  // echo "phone:   " . $row['phone'] . "<br />";
  // echo "address: " . $row['address'] . "<br />"; // DON'T DISPLAY THIS B/C HAVE MAP
  //echo "<br />";
  echo "<a class='request' href='addRider.php?d=".$row['id']."' >Request this ride</a>";
//}
echo "</div>";
// echo "<div id='map_canvas' style='top:30px;'></div>";

mysql_close($con);
?> 