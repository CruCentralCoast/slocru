<?php
$n=$_GET["n"];
$s=$_GET["s"];

// echo "destination: ".$n."<br />";
// echo "service: ".$s;

$con = mysql_connect("localhost","slocrus1_all","2cor129");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("slocrus1_slocru", $con);

$sql="SELECT * FROM drivers WHERE destination = '".$n."' AND service = '".$s."' ORDER BY (seats-taken) DESC";

$result = mysql_query($sql);

$sql ="SELECT * FROM churches WHERE name='".$n."'";

$row = mysql_fetch_array(mysql_query($sql));
$dest = $row['address']; 

$x = 0; // the number of drivers

while($row = mysql_fetch_array($result)) {
	$seats = $row['seats']-$row['taken'];
	// print the link with javascript call
	echo "<a href='#'	 onclick='showDetails(this.title, this, ".$row['taken'].")' title='".$row['name']."' ";
	// echo "destination='".$row['destination']."' origin='".$row['origin']."'>";
	echo "destination='".$dest."' origin='".$row['address']."' ";
	
	if($row['wp_0'] != '') {
		echo "wp_0='".$row['wp_0']."' ";
		
		if($row['wp_1'] != '') {
			echo "wp_1='".$row['wp_1']."' ";
			
			if($row['wp_2'] != '') {
				echo "wp_2='".$row['wp_2']."' ";
				
				if($row['wp_3'] != '') {
					echo "wp_3='".$row['wp_3']."' ";
				}
			}
		}	
	}
	
	echo ">"; //close anchor tag
	echo $row['name']." (".$seats." seats)"."</a><br />";
	$x++;
}

if ($x == 0) {
	echo "No drivers available";
}

mysql_close($con);
?> 
