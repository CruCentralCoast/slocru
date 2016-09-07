<?php 

// register.php
// takes return call from facebook after a user registers,
// stores the returned info in the database, then sends
// the user to the index page.

require_once '../include/constants.php';

// connect to the database
$con = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
if (!$con) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("slocrus1_slocru", $con);

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

if ($_REQUEST && 0) {
  echo '<p>signed_request contents:</p>';
  $response = parse_signed_request($_REQUEST['signed_request'], 
                                   APP_SECRET);
  echo '<pre>';
  print_r($response);
  echo '</pre>';
  
  // get values.
  $user_name = $response["registration"]["name"];
  $user_email = $response["registration"]["email"];
  $user_phone = $response["registration"]["phone"];
  $user_address = $response["registration"]["address"];
  $user_id = $response["user_id"];

  // insert into database
  $sql= "INSERT INTO `users` (`id`, `user_id`, `name`, `email`, `phone`, `address`) 
       VALUES (NULL, '".$user_id."', '".$user_name."', '".$user_email."', '".$user_phone."', '".$user_address."');";

  //$sql= "INSERT INTO `slocrus1_slocru`.`users` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `dest_id`, `seats`, `taken`) 
  //      VALUES (NULL, '".$user_id."', '".$user_name."', '".$user_email."', '".$user_phone."', 'here', '3', '4', '1');";

  $result = mysql_query($sql);

} else {
  echo '$_REQUEST is empty';
}

?>