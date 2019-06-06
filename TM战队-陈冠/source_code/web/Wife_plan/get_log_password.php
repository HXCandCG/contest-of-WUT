<?php
	$q = $_GET["q"];
	$p = $_GET["p"];
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'wife_db';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	$sql = "SELECT * FROM users WHERE ulog = '".$q."'";
	$result = $con->query($sql);
	$row = mysqli_fetch_Array($result);
	if($p == $row[1]){
		$response = 1;
	}else{
		$response = 0;
	}
	echo $response;
	mysqli_close($con);	
?>
