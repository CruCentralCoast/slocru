<?php
$driver=$_GET["d"];

$con = mysql_connect("localhost","slocrus1_all","2cor129");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("slocrus1_slocru", $con);

$drvnfo="SELECT * FROM drivers WHERE id = '".$driver."'";

$result = mysql_query($drvnfo);

$row = mysql_fetch_array($result);

 
mysql_close($con);
?> 

<?php include('header.php'); ?>


<div id="content">

<?php echo "<h2>Requesting ride from ".$row['name']." to ".$row['destination']." ".$row['service']." service.</h2>"; ?>


<hr>

<!-- form for filling out rider info 

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

<form id='register' action=<?php echo "'submit_rider.php?d=".$driver."'" ?> method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Please fill out all information.</legend>
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

<label for='address' >Your Address (please include zip code):</label><br />
<input type='text' name='address' id='address' maxlength="60" />
<br />


<input type='submit' name='Submit' value='Submit' />
</fieldset>
</form>

</div> <!-- end content -->
<?php include('footer.php'); ?>

</div> <!-- end wrapper -->
 
</body>
</html>





