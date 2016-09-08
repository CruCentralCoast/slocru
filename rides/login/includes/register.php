<?php 

// register.php
// takes return call from facebook after a user registers,
// stores the returned info in the database, then sends
// the user to the index page.

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

$facebook = new Facebook(array(
'appId' => APP_ID,//$app_id,
'secret' => APP_SECRET,//$app_secret,
'cookie' => true,
'domain'=>'slocru.com/',
));


header ('Location: index.php');
?>