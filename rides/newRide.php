<h2>Create a new ride</h2>

<?php 

$sql="SELECT * FROM users WHERE user_id = '".$user_id."' LIMIT 1";
$temp = mysql_query($sql);
$user = mysql_fetch_assoc($temp);

$user_name = $user['name'];
$user_email = $user['email'];
$user_phone = $user['phone'];
$user_address = $user['address'];

//echo "Use info: <br>Listed Name: ".$user_name."<br>
//     email: ".$user_email."<br>phone: ".$user_phone."<br>address: ".$user_address."<br>";

?>

<div id="form_box" style="width:380px; float: left;">
<form id='register' action='/rides/submit_ride.php' method='post'
    accept-charset='UTF-8'>
<fieldset >
<input type='hidden' name='submitted' id='submitted' value='1'/>

<input type='hidden' name='driver_id' id='driver_id' value='<?php echo $user_id  ?>'/>

<label for='name' >The name to display*: </label><br />
<input type='text' name='name' id='name' maxlength="40" value='<?php echo $user_name ?>'/>
<br />

<label for='email' >Email*:</label><br />
<input type='text' name='email' id='email' maxlength="40" value='<?php echo $user_email ?>' />
<br />

<label for='phone' >Phone*:</label><br />
<input type='text' name='phone' id='phone' maxlength="15" value='<?php echo $user_phone ?>' />
<br />

<label for='address' >Your SLO address and zip code*:</label><br />
<textarea name='address' id='address' rows="2" columns="40" ><?php echo $user_address ?></textarea>
<br />

<label for='dest_id' >Destination*:</label><br />
<select name="dest_id">
<?php
   $sql="SELECT * FROM destinations WHERE 1";

   $result = mysql_query($sql);
   while ($row = mysql_fetch_assoc($result)) {
      echo "<option value='".$row['id']."'>".$row['name']."</option>";
   }

   //mysql_close($con);
?>
</select>

<br><label for='time' >Time*:</label><br />
<input type='text' name='time' id='time' maxlength="15" placeholder='look up times at right' />
<br />

<label for='seats' >Available seats*:</label><br />
<select name="seats">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select><br />

<label for='info' >Notes:</label><br />
<textarea name='info' id='info' rows="2" columns="40" placeholder="Any special info about your ride"></textarea>
<br />

<input type='submit' name='Submit' value='Submit' />
</fieldset>
</form>

</div> <!-- end form div -->

<div id="dest_info" style="width:380px; float: left;">
<h4>Service times for reference:</h4>

<?php
  $sql="SELECT * FROM destinations WHERE 1";

  $result = mysql_query($sql);
  while ($row = mysql_fetch_assoc($result)) {
    echo "<p>".$row['name']."<br>";
	echo $row['time1'].", ";
	echo $row['time2'].", ";
	echo $row['time3'];
	echo "</p>";
    
  }
  echo "<p style='color:#8D4242'>NOTE: The Slo Cru weekly meeting will be on campus for the first two weeks of Fall Quarter</p>";
?>
</div>