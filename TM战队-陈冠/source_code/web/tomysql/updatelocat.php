<?php
	$nickname = $_GET["nickname"];
	$locat = $_GET["locat"];
	$sroom = $_GET["sroom"];


	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	$sql = "UPDATE customer SET location = '".$locat."',sroom = '".$sroom."' WHERE nickname = '".$nickname."'";
	if(! $con) {
		echo 'Could not connect';
	}
	$con->query($sql);
	if(mysqli_affected_rows($con)!=0){
		echo "地址更新成功！";
	}else{
		echo "地址更新失败 请联系15171801220!";
	}
	
	mysqli_close($con);	
?>