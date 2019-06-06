<?php
	$temp_nickname = $_GET["temp_nickname"];
	$temp_order = $_GET["temp_order"];
	$temp_totalprice = $_GET["temp_totalprice"];
	$temp_delifee = $_GET["temp_delifee"];
	$loc = $_GET["loc"]; 
	$sro = $_GET["sro"];
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	$time = date("Y-m-d H:i:s");
	$sql = "INSERT INTO temporder VALUES('".$temp_nickname."','".$temp_order."',".$temp_totalprice.",".$temp_delifee.",'".$time."',0,'".$loc."栋".$sro."室"."')";
	if($con->query($sql)){
		$response = "ok";
	}else{
		$response = "fail";
	}
	echo $response;
	mysqli_close($con);		
	
?>