
<!-- CONTENT DISPLAYED ON THE FRONT PAGE -->
<h3>Rides offered to: 
<?php 
if(!empty($_GET['dest'])) {
	$sql="SELECT * FROM destinations WHERE id = ".$_GET['dest'];
	$temp = mysql_query($sql);
    $selected_dest = mysql_fetch_assoc($temp);
    echo $selected_dest['name'];
}
?>
</h3>

<ul style="height:20px;">

<li class="small_text"><a href='/rides/' class='selectable'>All</a></li>
<?php

	//$sql="SELECT * FROM destinations WHERE 1";

	if(!empty($_GET['dest'])) {
	   $sql="SELECT * FROM destinations WHERE id != ".$_GET['dest'];
   	}else $sql="SELECT * FROM destinations WHERE 1";
	
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		echo "<li class='small_text'><a href='/rides/loc/".$row['id']."/' class='selectable' title='".$row['name']."'>".$row['name']."</a></li>";
	}
	
?>
</ul>
<hr>
<div id="info" style="width: 370px; float: right; margin: 0 10px">
<?php
	if(!empty($_GET['dest'])) {
	    echo "<h4 style='margin:0 0 10px;'>".$selected_dest['name']."</h4>".$selected_dest['address']."<br>
	          <a href='http://".$selected_dest['info']."' >".$selected_dest['info']."</a>";
	    
	} else echo "Refine your search with one of the above links to see destination info and location";
?>
	
	
	<div id="map_canvas" style="width: 370px; margin:10px 0;"></div>
</div>

<div id="rides" style="width: 400px;">
<?php

   if(!empty($_GET['dest'])) {
	   $sql="SELECT * FROM rides WHERE dest_id = ".$_GET['dest']." ORDER BY seats-taken DESC";
   }else $sql="SELECT * FROM rides WHERE 1 ORDER BY seats-taken DESC";

   $rides = mysql_query($sql);
   
   while ($row = mysql_fetch_assoc($rides)) {
      $sql="SELECT * FROM destinations WHERE id = ".$row['dest_id'];
	  $dests = mysql_query($sql);

      $temp = mysql_fetch_assoc($dests);
      $dest = $temp['name'];
      
      $sql="SELECT * FROM users WHERE user_id = ".$row['driver_id'];
	  $names = mysql_query($sql);

      $temp = mysql_fetch_assoc($names);
      $name = $temp['name'];
      $origin = $temp['address'];
      
      echo "<div id='ride' style='margin: 10px; padding:5px; height: 50px; width: 370px; border: 1px solid #999'>";
      echo "<img style='float:left; width: 50px;' src='https://graph.facebook.com/".$row['driver_id']."/picture' alt='".$name."' />";
      echo "<a href='/rides/view/".$row['id']."' class='reserve_seat small_text' title='".$name."' ";
      
      echo "style='float: right; height:40px; width: 45px; line-height: 20px; background: #CCC; padding: 5px; text-align: center'>";
      
      echo ($user_id == $row['driver_id'])? "edit" : "view";
      echo " ride</a>";

      echo "<div style='margin-left: 60px;'> <h4 style='margin: 5px 0 0;'>".$name;
      echo " <small> (".($row['seats']-$row['taken'])." seats left)";

            echo "</small>";
      echo "</h4>".$dest." ".$row['time']."</div>";
      echo "</div>";
   }

?>

</div> <!-- end rides div -->

<script type="text/javascript">

// initialize the map
initialize();
</script>