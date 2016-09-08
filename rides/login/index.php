<?php

// index.php for slocru.com/rides/login

require_once '../include/constants.php';
include "src/facebook.php";

// connect to the database
$con = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
if (!$con) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("slocrus1_slocru", $con);

define('APP_ID', '106567406163337');
define('APP_SECRET', 'b14778505d4757cb1ffe7cd9cc692ae6');


function parse_signed_request($signed_request, $secret) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

  // decode the data
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);

  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
    error_log('Unknown algorithm. Expected HMAC-SHA256');
    return null;
  }

  // check sig
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    return null;
  }

  return $data;
}

function base64_url_decode($input) {
    return base64_decode(strtr($input, '-_', '+/'));
}

if ($_REQUEST && !empty($_REQUEST['signed_request'])) {
  //echo '<p>signed_request contents:</p>';
  $response = parse_signed_request($_REQUEST['signed_request'], 
                                   APP_SECRET);
  
  
  /* // dump the contents of the array
  echo '<pre>';
  print_r($response);
  echo '</pre>';
  */
  
  // get values.
  $user_name = mysql_real_escape_string($response["registration"]["name"]);
  $user_email = mysql_real_escape_string($response["registration"]["email"]);
  $user_phone = mysql_real_escape_string($response["registration"]["phone"]);
  $user_address = mysql_real_escape_string($response["registration"]["address"]);
  $user_id = mysql_real_escape_string($response["user_id"]);

  // insert into database
  $sql= "INSERT INTO `users` (`id`, `user_id`, `name`, `email`, `phone`, `address`) 
       VALUES (NULL, '".$user_id."', '".$user_name."', '".$user_email."', '".$user_phone."', '".$user_address."');";

  //$sql= "INSERT INTO `slocrus1_slocru`.`users` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `dest_id`, `seats`, `taken`) 
  //      VALUES (NULL, '".$user_id."', '".$user_name."', '".$user_email."', '".$user_phone."', 'here', '3', '4', '1');";

  $result = mysql_query($sql);
  
  header ('Location: ../');

} else {
  // echo '$_REQUEST is empty';
  // allow user to register or log in
}


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
		/*echo "<h2>user is already registered</h2>";
		$user = mysql_fetch_array($result);
		echo "user: ".$user_id;	
		echo "name: ".$user['name'];
		*/
		// if user logged in, send to main site
		header ('Location: ../');
	} else {
		// User not registered yet, keep at the login;
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
<head>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>		

<style type="text/css" >

body {
	background-color: #ccc;
}

h4 {
	margin: 5px 0;
	padding: 0;
}
#login {
	width: 500px;
	margin: 100px auto;
	border: 1px solid #999;
	padding: 10px;
	background-color: white;
	font-family: Helvetica, Verdana, sans-serif;
}

.login_button {
	padding: 10px;
}
</style>


<script type="text/javascript">

function onlogin() {
	//document.getElementById('status_of_login').innerHTML('logged in, redirect to site');
	window.location.href = "http://slocru.com/rides/";

}
</script>
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
		    
			// forward the user to 
			window.location.href = "http://slocru.com/rides/";
			
		} else if (response.status === 'not_authorized') {
			// the user is logged in to Facebook, 
		    // but has not authenticated your app
		} else {
		    // the user isn't logged in to Facebook.
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

<h1 id="status_of_login"></h1>

<div id="login">
	<h1 style="margin-top:-50px;">Rides to Church</h1>
	<h4>Please register or log in to use Rides to Church</h4>
	<span class="login_button">Already registered? 

	<fb:login-button
		on-login="onLogin()"
	></fb:login-button>
	<small>If at first the system does not log you in, please try refreshing the page. Thanks</small>

	</span>
<!--<div 
	class="fb-registration" 
	data-fields="[{'name':'name'}, {'name':'email'},
				  {'name':'phone','description':'Phone Number',
                'type':'text'}, {'name':'address', 'description':'Your Address','type':'text'}]" 
	data-redirect-uri="http://slocru.com/rides/login/" >
	redirect-uri="http://slocru.com/rides/login/"
</div> -->

	<fb:registration 
  		fields="[{'name':'name'}, {'name':'email'},
			     {'name':'phone','description':'Phone Number (123-456-7890)',
            	 'type':'text'}, {'name':'address', 'description':'Your SLO Address (and zip)','type':'text'}]" 
 		
 		fb_only="true"
		width="500" 
		style="margin-top:10px"
		scrolling="false"
		>
	</fb:registration>
	<span><a href="#privacy" id="open_window">Privacy Info</a></span>
</div> <!-- end login div -->


<div id="privacy_info" style="z-index:9999;width:500px; height:200px; background:#fff;border:10px solid #888; position:fixed; top:100px; margin-left:-260px; left: 50%; visibility:hidden;">
	<div style="width:100%; height: 32px; background:#888">
		<a href="#close" id="close_window" style="float:right;padding:5px; color:#fff;">close</a>
		<h3 style="padding:5px; margin:0; float:left; color:#fff;">Privacy Info</h3>
	</div>
	<p style="margin:0; padding:10px;">
	We understand your personal information is important to you, and Rides to Church is 
	built with that in mind to maximize privacy and security. Facebook authentication is
	used to ensure that members using Rides to Church are real people, just like you. 
	Your personal information is never shared with others until you request a ride, or 
	confirm a passenger on your ride, so that you can communicate with them. If you have
	questions, or would like to have your account and personal information removed from 
	Rides to Church, please email <a href="mailto:theslocru@gmail.com">theslocru@gmail.com</a>.
</p>
</div>


<script type="text/javascript">

$(function() {	
	
	$('#open_window').bind('click',function(event){
		$('#privacy_info').css('visibility', 'visible');
		
		$('#close_window').bind('click',function(event){
			$('#privacy_info').css('visibility', 'hidden');
			event.preventDefault();

		});
		event.preventDefault();
	});
	
}); // end function
</script>

</body>

</html>
