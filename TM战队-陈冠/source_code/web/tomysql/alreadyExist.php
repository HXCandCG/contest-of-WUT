<?php
	//customer
	$phonenum = $_GET["phonenum"];
	$nickname = $_GET["nickname"];
	$email = $_GET["email"];


	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	$sql = "";
	if(! $con) {
		echo 'Could not connect';
	}

	$sql = "SELECT * FROM customer WHERE phone = '".$phonenum."' OR  nickname = '".$nickname."' OR email = '".$email."' ";	

	
	$result = $con->query($sql);
	$row = mysqli_fetch_Array($result);
	if(empty($row[0])){
		$response = "1";
	}else{
		$response = "0";
	}
	echo $response;
	mysqli_close($con);	
?>