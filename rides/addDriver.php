<?php 

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
	if(mysql_num_rows($result) == 0 ) {
		header ('Location: http://slocru.com/rides/login/');
	}
} else {
	// User not registered yet, keep at the login;
	header ('Location: http://slocru.com/rides/login/');
}

$msg = $user_id;
?>

<?php include('header.php'); ?>

<div id="content">

<h2>Please enter the information for the ride you are offering.</h2>


<hr>

<!-- form for inputting driver info 

** included info **
name
email
phone

seats
taken -- automatic - not entered by driver

destination -- automatically added
service - dropdown menu
address

-->

<form id='register' action='submit_driver.php' method='post'
    accept-charset='UTF-8'>
<fieldset >
<input type='hidden' name='submitted' id='submitted' value='1'/>

<label for='name' >Your Full Name*: </label><br />
<input type='text' name='name' id='name' maxlength="30" />
<br />

<label for='email' >Email*:</label><br />
<input type='text' name='email' id='email' maxlength="30" />
<br />

<label for='username' >Phone*:</label><br />
<input type='text' name='phone' id='phone' maxlength="15" />
<br />

<label for='address' >Your Address (including zip code)*:</label><br />
<input type='text' name='address' id='address' maxlength="60" />
<br />

<label for='church' >Destination*:</label><br />
<select name="church">
<?php
   $con = mysql_connect("localhost","slocrus1_all","2cor129");
   if (!$con)
   {
      die('Could not connect: ' . mysql_error());
   }

   mysql_select_db("slocrus1_slocru", $con);

   $sql="SELECT * FROM churches WHERE category='church'";

   $result = mysql_query($sql);
   while ($row = mysql_fetch_assoc($result)) {
      echo "<option value='".$row['name']."'>".$row['name']."</option>";
   }

   mysql_close($con);
?>
</select>
<br />
<label for='service' >Service*:</label><br />
<select name="service">
<option value="1">1st</option>
<option value="2">2nd</option>
<option value="3">3rd (if available)</option>
</select>
<br />

<label for='seats' >Available Seats*:</label><br />
<select name="seats">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select><br />

<input type='submit' name='Submit' value='Submit' />
</fieldset>
</form>

</div> <!-- end content -->
<?php include('footer.php'); ?>
</div> <!-- end wrapper -->

 
</body>
</html>





