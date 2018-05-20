<!DOCTYPE html>
<?php
	require "connect.php";
	$quality = $_GET["w_quality"];
	$date = $_GET["date"];
	$date = date("Y-m-d");

	/*$positions_query = "SELECT * FROM positions WHERE Position='".$position."'";
	$is_positions_query_run = mysqli_query($connect,$positions_query);
	$positions_execute = mysqli_fetch_assoc($is_positions_query_run);*/
	$readings_query = "SELECT * FROM readings WHERE Date='".$date."'";
	$is_readings_query_run = mysqli_query($connect,$readings_query);
	if(mysqli_num_rows($is_readings_query_run)!=0){

		while($reading_execute = mysqli_fetch_assoc($is_readings_query_run)){
			$positions_query = "SELECT * FROM positions WHERE ID='1'";
			$is_positions_query_run = mysqli_query($connect,$positions_query);
			$positions_execute = mysqli_fetch_assoc($is_positions_query_run);
			$dataPoints1[] = array("label"=>$reading_execute["Time"],"y"=>$reading_execute[$quality],"position"=>$positions_execute["Position"]);
		}
	}
	else{
		echo "yako";
		$status = false ; 
		$message1 = "No data on that date";
	}
	
?>
<html lang="en">
<head>
	<title><?php session_start();
				 echo $_SESSION['lastname']." Viewing";?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<style>
/*.limiter.img{
	border-radius: 50%;
}*/
</style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script>
window.onload = function () {
 
var chart1 = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	//theme: "light2",
	title:{
		text: "Quality"
	},
	axisX:{
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	axisY:{
		title: "Units",
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	toolTip:{
		enabled: false
	},
	data: [{
		type: "area",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});
chart1.render();
}
</script>

</head>
<body>
	<div class="container">
		<div class="row" v-align="middle">
			<div class="col-md-4 col-sm-4">
				<img src="images/logo.png" alt="IMG" height="100" width="100" align="right">
			</div>
			<div class="col-md-6 col-sm-8">
				<h4 align="center">Real Time Water Quality Measurement System</h4>
			</div>
		</div>
	</div>
	
	<div class="limiter">
		<div class="container-login100">

	<br>
	<div style='float:left;width:10%;background-color: grey;height:768px'>
					<br><br>
					
					<a class='btn btn-warning' style='width:100%;' href="user.php"><b><i class='fa fa-long-arrow-left m-l-5' aria-hidden='true'></i>Back</b></a>
					<br><br><br><br>
					<a class='btn btn-warning' style='width:100%;' href="index.php"><b>Logout</b></a>
				</div>
	<div style="float:right;width:90%;">
		<div class="container" style="min-height: 105px;background-color: white;">
		<div class="row">
			<div class="col-md-6">
				<table class="table table-inverted">
					<h3>Temperature</h3>
					<tbody>
							<?php

							// echo "<pre>"; 
							foreach ($dataPoints1 as $data) {
								echo "<tr><td>".$date."</td><td>".$data['position']."</td><td>".$data['label']."</td><td>".$data['y']."</td></tr>";
							}
							 ?>						
					</tbody>
				</table>
			</div>
			<div class='col-md-6'>
				<div id='chartContainer1' style='min-height: 100px; max-width: 100%; margin: 0px auto; float:right; width:75%;'></div>
			</div>
	<iframe 
	   width='600' 
	   height='350' 
	   frameborder='0' 
	   scrolling='no' 
	   marginheight='0' 
	   marginwidth='0' 
	   src='http://maps.google.com/maps?f=q=colombo&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=".$positions_execute["Latitude"].",".$positions_execute["Longitude"].
	   "(custom heading)&amp;output=embed'>
	</iframe>
		</div>
	</div>

	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script src="https://unpkg.com/vue@2.5.16/dist/vue.js"></script>
	<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

	<script>
		function myMap() {
		var mapOptions = {
		    center: new google.maps.LatLng(51.5, -0.12),
		    zoom: 10,
		    mapTypeId: google.maps.MapTypeId.HYBRID
		}
		var map = new google.maps.Map(document.getElementById("map"), mapOptions);
		}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
</body>
</html>