<?php

require_once 'include/constants.php';

$con = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
if (!$con) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("slocrus1_slocru", $con);


$ride_id=$_GET["id"];

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("rides");
$parnode = $dom->appendChild($node); 

//$query = "SELECT * FROM drivers WHERE 1 ";// id='".$driver."'";
$query="SELECT * FROM rides WHERE id = '".$ride_id."'";

$result = mysql_query($query);
if (!$result) {  
  die('Invalid query: ' . mysql_error());
} 

header("Content-type: text/xml"); 

// Iterate through the rows, adding XML nodes for each

// no longer need loop functionality
//while ($row = @mysql_fetch_assoc($result)){ 
// $row = @mysql_fetch_assoc($result); 
$row = mysql_fetch_array($result);

  // ADD TO XML DOCUMENT NODE  
  $node = $dom->createElement("ride");  
  $newnode = $parnode->appendChild($node);   
  $newnode->setAttribute("id",$row['id']);
  // $newnode->setAttribute("name",$row['name']);
  $newnode->setAttribute("seats",$row['seats']);
  $newnode->setAttribute("taken",$row['taken']);
  $newnode->setAttribute("origin", $row['origin']);  
  // get church address
  $query="SELECT address FROM destinations WHERE id = '".$row['dest_id']."'";
  $destResult = mysql_query($query);
  if (!$destResult) {  
    die('Invalid query: ' . mysql_error());
  } 
  $destInfo = mysql_fetch_array($destResult);

  $newnode->setAttribute("destination", $destInfo['address']);  
  

if($row['taken'] > 0) {
	$wp = 0;
	
	$sql = "SELECT * FROM seats WHERE ride_id = '".$ride_id."' AND role != '1' AND pending = false";
	$result = mysql_query($sql);
	while ($seat = mysql_fetch_assoc($result)) { 
		$temp="SELECT * FROM users WHERE user_id = ".$seat['user_id'];
		$rider = mysql_query($temp);
		$rider_info = mysql_fetch_assoc($rider);
	
		$newnode->setAttribute("wp_".$wp, $rider_info['address']);
		$wp++;
	}
}


echo $dom->saveXML();

?>