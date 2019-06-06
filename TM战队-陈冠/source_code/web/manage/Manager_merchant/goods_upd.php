<?php
	$goodname = $_GET["name"];
	$goodinfo = $_GET["info"];
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	
	if(!empty($goodname)&&!empty($goodinfo)){
		$sql = "UPDATE menu SET menu_price = ".$goodinfo." WHERE menu_name = '".$goodname."'";	
		$con->query($sql);
		if(mysqli_affected_rows($con)!=0){
			echo $merchant_name."价格修改成功！";
		}else{
			echo "修改错误！ 请联系15171801220！";
		}
	}
	mysqli_close($con);
?>