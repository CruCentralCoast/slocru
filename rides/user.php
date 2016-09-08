<?php 

/*require_once 'include/constants.php';

$con = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
if (!$con) {
	die('Could not connect: ' . mysql_error());
}*/

// mysql_select_db("slocrus1_slocru", $con);

	// $user_id = $_GET['id'];
	//echo "user_id: ".$user_id."<br>";
	
	$sql="SELECT * FROM users WHERE user_id = '".$user_id."' LIMIT 1";

	$temp = mysql_query($sql);

	$user = mysql_fetch_assoc($temp);
    
    $user_name = $user['name'];
    $user_email = $user['email'];
    $user_phone = $user['phone'];
    $user_address = $user['address'];
    
    //echo "My info: <br>Name: ".$user_name."<br>
    //	  email: ".$user_email."<br>phone: ".$user_phone."<br>address: ".$user_address."<br>";
    
?>

<h3>My info:</h3>
<table width="800px" style="margin-top:10px;font-size:18px;">
	<tr>
		
		<td>
			<img style=' width: 50px; float: left; margin-left:10px;' src='https://graph.facebook.com/<?php echo $user['user_id'] ?>/picture' alt='<?php echo $name ?>' />
		</td>
		<td>
			Name: <br>Address: 
		</td>
		<td>
			<?php echo $user_name ?><br><?php echo $user_address ?>
		</td>
		<td>
			Email: <br>Phone:
		</td>
		<td>
			<?php echo $user_email ?><br><?php echo $user_phone ?>
		</td>
	</tr>
</table>
<small style="margin-left:10px;">
Your info is viewable by only you. <a href="/rides/about/">(Privacy info)</a>
<a href="mailto:theslocru@gmail.com?Subject=Info%20Change%20Request" style="margin-left:10px;">
Need to change your display information? Click here to email Slo Cru.</a></small>

<hr>

<h3>My Rides</h3>

<?php 

//echo $user_id;
$sql="SELECT * FROM seats WHERE user_id = '".$user_id."' ORDER BY pending ASC";
$result = mysql_query($sql);

while ($row = mysql_fetch_assoc($result)) {
	//echo "<li class='small_text'><a href='?dest=".$row['id']."&name=".$row['name']."' class='selectable' title='".$row['name']."'>".$row['name']."</a></li>";
	//echo "<p>ride_id: ".$row['ride_id']." role: ";
	
	// echo "ride_id: ".$row['ride_id'];
	
	$sql="SELECT * FROM rides WHERE `id` = ".$row['ride_id'];

	$ride = mysql_query($sql);
	$ride_details = mysql_fetch_assoc($ride);
	$time = $ride_details['time'];
	// $origin = $ride_details['origin'];
	//echo "time: ".$time;
	$dest = $ride_details['dest_name'];

	$sql="SELECT * FROM users WHERE user_id = ".$ride_details['driver_id'];
	$driver = mysql_query($sql);
    $driver_details = mysql_fetch_assoc($driver);
    
    //$name = $driver_details['name'];
    //$origin = $driver_details['address'];

	$value = ($row['role'] == 1)? "driver" : "passenger";
	$value .= ($row['pending'])? " <br>PENDING ": "";

    
    echo "<div class='my_ride' style='width:780px;'>";
    echo "<a href='/rides/view/".$row['ride_id']."' class='select_ride' value='".$value."' style='float: left; padding: 5px;width: 100px;background-color:#CCC;height:40px;margin: 10px 10px;text-align:center;'>";	
	echo $value;
	echo "</a>";
	
	echo "<p style='float:left;width: 330px;background-color: #CCC;margin: 10px 0 ;height: 40px;padding: 5px 10px;'>";
    echo "destination: ".$dest." ".$time."<br>";
    if(!$row['pending']) echo "origin: ".$driver_details['address']."<br>";
	echo "</p>";
	
	echo "<p style='float:left;width: 190px;background-color: #CCC;margin: 10px;height: 40px;padding: 5px 10px;'>";
	echo "driver: ".$driver_details['name']."<br>";
	if(!$row['pending']) echo "phone : ".$driver_details['phone'];
	echo "</p>";
	
	if($row['role'] == 1) {
		echo "<a class='remove_delete' data-action='delete' data-ride='".$row['ride_id']."' data-user='".$user_id."' data-pend='".$row['pending']."'";
		echo "style='float:right;width: 50px;background-color: #CCC;margin: 10px 0;height: 40px;padding: 5px 10px;'>";
		echo "delete<br>car";
		echo "</a>";
	
	} else {
		echo "<a class='remove_delete' data-action='remove' data-ride='".$row['ride_id']."' data-user='".$user_id."' data-pend='".$row['pending']."'";
		echo "style='float:right;width: 50px;background-color: #CCC;margin: 10px 0;height: 40px;padding: 5px 10px;'>";
		echo "delete<br>seat";
		echo "</a>";
	}
	echo "</div>";	
}

?>

<script type="text/javascript" >

$('.select_ride').each(function() {
	$(this).bind({
		mouseenter: function() {
			$(this).css('background-color', '#fff');
			$(this).text('view ride');
		},
		mouseleave: function() {
			$(this).css('background-color', '#ccc');
			$(this).html($(this).attr('value'));
		}
	});
});

$('.remove_delete').each(function(){
	$(this).bind('click',function(event){
		var action  = $(this).attr("data-action");
		var ride_id = $(this).attr("data-ride"); 
		var pass_id = $(this).attr("data-user");
		var pending = $(this).attr("data-pend");

		var dialog;
		
		if(action == 'remove') {
			dialog = 'Are you sure you want to remove yourself from this ride?';
		} else {
			dialog = 'Are you sure you want to delete this ride?';
		}
		
		if (confirm(dialog)) {
			// mail request link to driver
			$.ajax({
				//type: "GET",
				url: "/rides/"+action+"/"+ride_id+"/"+pass_id+"/"+pending,
				success: function(data) {
					//$('#content').html(data);
					alert(data);
					location.reload();
				}
			});
		}
		event.preventDefault();
	});
});


</script>
