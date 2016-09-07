<?php
$q=$_GET["q"];


$con = mysql_connect("localhost","slocrus1_all","2cor129");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("slocrus1_slocru", $con);

$sql="SELECT * FROM churches WHERE name = '".$q."'";

$result = mysql_query($sql);

/* MATCH THIS FORMAT:
<ul>
	<li>Select a time:</li>
	<li class="selectable"><a href="#">9am</a></li>
	<li class="selectable"><a href="#">11am</a></li>
	<li class="selectable"><a href="#">6:30pm</a></li>
</ul>
*/

$row = mysql_fetch_array($result);
echo "<ul>";
	echo "<li>Select a time:</li>";
	$i=1;
	while($row['service'.$i] != ""){
		echo "<li ><a href='#' class='selectable' onclick='showUser(this.title, this.rel, this)' title='".$row['name']."' rel='".$row['service'.$i]."'>".$row['service'.$i]." </a></li>";
		$i ++;
	}
	/*
	echo "<li ><a href='#' class='selectable' onclick='showUser(this.title, this.rel, this)' title='".$row['name']."' rel='".$row['service1']."'>".$row['service1']." </a></li>";
	echo "<li><a href='#' class='selectable' onclick='showUser(this.title, this.rel, this)' title='".$row['name']."' rel='".$row['service2']."'>".$row['service2']." </a></li>";
	if ($row['service3'] != "") {
		echo "<li><a href='#' class='selectable' onclick='showUser(this.title, this.rel, this)' title='".$row['name']."' rel='".$row['service3']."'>".$row['service3']." </a></li>";
	}*/
echo "</ul>";
/*
while($row = mysql_fetch_array($result)) {
	// print the link with javascript call
	echo "<li class='selectable'><a href='#'	 onclick='showDetails(this.title)' title='".$row['name']."' >";
	echo $row['name']." (".$row['seats']." seats)"."</a><br />";
}*/



mysql_close($con);
?> 
