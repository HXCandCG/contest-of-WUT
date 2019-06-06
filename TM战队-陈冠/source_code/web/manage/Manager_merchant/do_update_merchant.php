<?php
	$merchant_name = $_GET["name"];
	$merchant_item = $_GET["item"];
	$merchant_info = $_GET["info"];
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	
	if(!empty($merchant_name)&&!empty($merchant_item)&&!empty($merchant_info)){
		if($merchant_item=="price_spread"){
			$sql = "UPDATE merchant SET ".$merchant_item." = ".$merchant_info." WHERE merchant_name = '".$merchant_name."'";
		}else{
			$sql = "UPDATE merchant SET ".$merchant_item." = '".$merchant_info."' WHERE merchant_name = '".$merchant_name."'";	
		}
		$con->query($sql);
		if(mysqli_affected_rows($con)!=0){
			if($merchant_item=="merchant_name"){
				$sql = "UPDATE menu SET isfrom = '".$merchant_info."' WHERE isfrom = '".$merchant_name."'";
				$con->query($sql);
				echo $merchant_name."信息修改成功！";
			}	
		}else{
			echo "商家修改错误！ 请联系15171801220！";
		}
	}
	mysqli_close($con);
?>