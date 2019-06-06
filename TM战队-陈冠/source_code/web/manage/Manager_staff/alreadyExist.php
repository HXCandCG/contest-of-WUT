<?php
	//staff
	$s_phonenum = $_GET["s_phonenum"];
	$s_nickname = $_GET["s_nickname"];
	$s_email = $_GET["s_email"];


	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	$sql = "";
	if(! $con) {
		echo 'Could not connect';
	}
	
	$sql = "SELECT * FROM staff WHERE phone = '".$s_phonenum."' OR  nickname = '".$s_nickname."' OR email = '".$s_email."' ";
	
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