/* GOOGLE MAPS functions */
  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
  var waypts =[]; // = [{ location:'572 e foothill blvd, 93405', stopover:true }];
function initialize() {
	directionsDisplay = new google.maps.DirectionsRenderer();
   var slo = new google.maps.LatLng(35.273933, -120.654259);
   var myOptions = {
   	zoom:12,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: slo
   }
   map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
   directionsDisplay.setMap(map);
}
  
function calcRoute(orig, dest) {
	// var start = document.getElementById("start").value;
   var start = orig; //document.getElementById("info").getAttribute("origin");
   var end = dest; //document.getElementById("info").getAttribute("destination");
   
   var request = {
      origin:start, 
      destination:end,
      waypoints:waypts, 
     	optimizeWaypoints: true,
      travelMode: google.maps.DirectionsTravelMode.DRIVING
   };
   directionsService.route(request, function(response, status) {
   	if (status == google.maps.DirectionsStatus.OK) {
      	directionsDisplay.setDirections(response);
   	}
   });
}

// php interfacing functions

// function to show the times for each service from church selected
// triggered by clicking one of the churches at top
// 
function showTimes(str, obj) {
document.getElementById("headline").innerHTML="Drivers to "+str;
document.getElementById("details").innerHTML="";
document.getElementById("drivers").innerHTML="Select a time above to see drivers";
document.getElementById("map_canvas").style.visibility="hidden";

// highlight selected destination, reset the rest
var destinations = document.getElementById("destinations");   
var churches = destinations.getElementsByTagName("a");   
for (var i = 0; i < churches.length; i++) {   
    churches[i].className = 'selectable';
}
obj.className = 'selected';

if (str==""){
  document.getElementById("times").innerHTML="<ul><li>Select a Church to see service times</li></ul>";
  return;
}
if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
}
else {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    document.getElementById("times").innerHTML=xmlhttp.responseText;
  }
}
xmlhttp.open("GET","gettimes.php?q="+str,true);
xmlhttp.send();
}

// triggered by clicking service time
function showUser(str, str2, obj) {
	document.getElementById("headline").innerHTML="Drivers to "+str+" at "+str2+".";
	document.getElementById("details").innerHTML="<b>Select a driver to get more info.</b>";
	document.getElementById("map_canvas").style.visibility="hidden";

	// highlight selected time, reset the rest
	var times = document.getElementById("times");   
	var services = times.getElementsByTagName("a");   
	for (var i = 0; i < services.length; i++) {   
   	services[i].className = 'selectable';
	}
	obj.className = 'selected';

	if (str=="") {
		document.getElementById("drivers").innerHTML="<b>Select a church and time to see rides.</b>";
  		//document.getElementById("details").innerHTML="<b>Select a driver to get more info.</b>";
  		return;
	}
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
	}
	else {// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {	
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    		document.getElementById("drivers").innerHTML=xmlhttp.responseText;
  		}
	}
	xmlhttp.open("GET","getuser.php?n="+str+"&s="+str2,true);
	xmlhttp.send();
}


// function to show the details from the drivers provided
// Triggered by clicking on a driver's name
function showDetails(str, obj, wps) {
	if (str==""){
	  document.getElementById("details").innerHTML="<b>select a driver to get more info.</b>";
	  return;
	}
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	    document.getElementById("details").innerHTML=xmlhttp.responseText;
	  }
	}
	xmlhttp.open("GET","getdetails.php?q="+str,true);
	xmlhttp.send();
	
	waypts.length = 0;
	
	var points = ['wp_0', 'wp_1', 'wp_2', 'wp_3'];
	
	for(var i = 0; i < wps; i++) {
		var loc = obj.getAttribute(points[i]);
		// waypts[i] = obj.getAttribute("wp_0");
		waypts.push({
      	location:loc,
         //location:"572 e Foothill Blvd, 93405",
         stopover:true
   	});
   }

	calcRoute(obj.getAttribute("origin"), obj.getAttribute("destination"));
	document.getElementById("map_canvas").style.visibility="visible";

}

