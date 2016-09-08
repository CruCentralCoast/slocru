<?php
// index.php for slocru.com/rides

$msg = $_GET['msg'];
$type = $_GET['type'];

/*require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();
*/


require_once 'include/constants.php';
include "login/src/facebook.php";

// connect to the database
$con = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
if (!$con) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("slocrus1_slocru", $con);

define('APP_ID', '106567406163337');
define('APP_SECRET', 'b14778505d4757cb1ffe7cd9cc692ae6');


$facebook = new Facebook(array(
'appId' => APP_ID,//$app_id,
'secret' => APP_SECRET,//$app_secret,
'cookie' => true,
'domain'=>'slocru.com/',
));

$user_id = $facebook->getUser();
if($user_id) {
	
	$sql = "SELECT * FROM `users` WHERE  `user_id` = ".$user_id." LIMIT 1";
	//$sql = "SELECT * FROM users WHERE user_id = '".$user_id."' LIMIT 1";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0 ) {
		/* echo "<h2>user is already registered</h2>";
		
		$user = mysql_fetch_array($result);
		echo "user: ".$user_id;	

		echo "name: ".$user['name'];
		*/
		
		// if user logged in, send to main site
		// $msg = $user_id;
	} else {
		// User not registered yet, keep at the login;
		header ('Location: http://slocru.com/rides/login/');
	}
} else {
	// User not registered yet, keep at the login;
	header ('Location: http://slocru.com/rides/login/');
}


if($type == '') $type='church';
?>


<?php include('header.php'); ?>


<div id="content">

<ul class="destinations" id="destinations">
	<li>Select a Destination:</li>
<?php
   $con = mysql_connect("localhost","slocrus1_all","2cor129");
   if (!$con)
   {
      die('Could not connect: ' . mysql_error());
   }

   mysql_select_db("slocrus1_slocru", $con);

   $sql="SELECT * FROM churches WHERE category='".$type."'";

   $result = mysql_query($sql);
   while ($row = mysql_fetch_assoc($result)) {
      echo "<li><a href='#".$row['name']."' class='selectable' onclick='showTimes(this.title, this)' title='".$row['name']."'>".$row['name']."</a></li>";
   }

   mysql_close($con);
?>

</ul>

<div style="clear:both"></div>


<div id="times">
<ul>
	<li>Select a <?php if($type == "church") { echo "church";} else { echo "destination";} ?> to see times</li>
</ul>
</div> <!-- times -->

<div style="clear:both"></div>

<hr>

<h3 id="headline" value="drivers">Drivers</h3>
<div id="drivers"><!-- <b>Select a church to see rides to that church.</b> --></div>

<div id="details"><!-- <b>Select a driver to get more info.</b> --></div>
<div id="map_canvas" style="visibility:hidden"></div>

</div> <!-- end content -->

<?php include('footer.php'); ?>
</div> <!-- end wrapper -->
 
</body>
</html>

