<?php
	$merchant_in_name = $_GET["name"];
	$merchant_in_tel = $_GET["tel"];
	$merchant_in_spread = $_GET["spread"];
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	
	if (!empty($merchant_in_name)) {
		$sql = "INSERT INTO merchant VALUES ('".$merchant_in_name."','".$merchant_in_tel."',".$merchant_in_spread.",0,0,0)";
		
		if($con->query($sql)){
			echo $merchant_in_name."添加成功！";
		}else{
			echo "添加失败！ 请联系15171801220！";
		}
	}
	mysqli_close($con);

?>