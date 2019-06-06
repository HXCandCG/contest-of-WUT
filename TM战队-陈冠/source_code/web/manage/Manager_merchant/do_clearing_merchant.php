<?php
	$merchant_cl_name = $_GET["cl_name"];
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	
	if (!empty($merchant_cl_name)) {
		$sql = "UPDATE merchant SET cope_with = 0 WHERE merchant_name = '".$merchant_cl_name."'";
		$con->query($sql);
		if(mysqli_affected_rows($con)!=0){
			echo $merchant_cl_name."收入结算成功！";
		}else{
			echo "结算错误！ 请联系15171801220！";
		}
	}
	mysqli_close($con);
?>