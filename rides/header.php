<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="<?php echo $str_language; ?>" xml:lang="<?php echo $str_language; ?>">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SLO Rides to Church</title>

<link rel="stylesheet" type="text/css" href="style.css" />

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<!-- functions for onclick() events and loading the google map -->
<script type="text/javascript" src="funcs.js"></script>

</head>

<!-- loads the google map when page loads -->
<body onload="initialize();">


<?php if ($msg != '') { 
	echo "<div id='header'>".$msg."</div>";
} ?>
<div id="wrapper">



<h1 style="float:left"><a href="http://slocru.com/rides/" >RIDES TO CHURCH</a></h1>
<!-- <a href="http://slocrusade.com/rides/?type=other" ><p style="margin:20px 0 0; float:left;">(and other places)</p></a> -->
<h3 style="float:right; padding: 10px 20px 10px 0;">
	<a href="http://slocru.com/rides/" >Get a Ride</a> | 
	<a href="addDriver.php" >Give a Ride</a>
</h3>
<div style="clear:both"></div>