<?php

include "src/facebook.php";
require_once '../include/constants.php';

define('APP_ID', '106567406163337');
define('APP_SECRET', 'b14778505d4757cb1ffe7cd9cc692ae6');


$facebook = new Facebook(array(
'appId' => APP_ID,//$app_id,
'secret' => APP_SECRET,//$app_secret,
'cookie' => true,
'domain'=>'slocru.com/',
));

// connect to the database
$con = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
if (!$con) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("slocrus1_slocru", $con);

$user_id = $facebook->getUser();

if($user_id) {
	$sql = "SELECT * FROM `users` WHERE  `user_id` = ".$user_id." LIMIT 1";
	//$sql = "SELECT * FROM users WHERE user_id = '".$user_id."' LIMIT 1";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0 ) {
		/*
		echo "<h1>SUCCESS!!!</h1>";
		$user = mysql_fetch_array($result);
		echo "user: ".$user_id;	

		echo "name: ".$user['name'];
		
		header('Location: ../');

	} else {
		// User not registered yet, keep at login
		// header('Location: login.php');
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >

<head>

<style type="text/css" >

#login {
	width: 350px;
	height: 330px;
	margin: 100px auto;
}
</style>
</head>

<body>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '106567406163337', // App ID
      channelUrl : '//slocru.com/rides/login/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional initialization code here
    
	FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
        // the user is logged in and has authenticated your
        // app, and response.authResponse supplies
        // the user's ID, a valid access token, a signed
        // request, and the time the access token 
        // and signed request each expire
        var uid = response.authResponse.userID;
        var accessToken = response.authResponse.accessToken;
    
        document.getElementById('status').innerHTML = uid;
    
      } else if (response.status === 'not_authorized') {
        // the user is logged in to Facebook, 
        // but has not authenticated your app
        document.getElementById('status').innerHTML = 'not authorized';

      } else {
        // the user isn't logged in to Facebook.
        document.getElementById('status').innerHTML = 'not logged in';
      }
	});
 
  }; //end window.fbAsyncInit

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
   
   
</script>

<div class="fb-login-button">Login with Facebook</div>

<div 
	class="fb-registration" 
	data-fields="[{'name':'name'}, {'name':'email'},
				  {'name':'phone','description':'Phone Number',
                'type':'text'}, {'name':'address', 'description':'Your Address','type':'text'}]" 
	data-redirect-uri="http://slocru.com/rides/login/index.php" >
</div>

<div id="status">
	not changed
</div>


</body>

</html>
