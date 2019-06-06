<?php
	$nickname = $_GET["nickname"];
	$phone = $_GET["phone"];
	$location = $_GET["location"];
	$sroom = $_GET["sroom"];
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}	
	
    $sql = "UPDATE temporder SET pay_status = 1 WHERE temp_nickname = '".$nickname."' ORDER BY temp_time DESC LIMIT 1";			
	$con->query($sql);
	if(mysqli_affected_rows($con)) {
		$res = "ok" ;
	}else{
		$res = "fail" ;
	}	

	if($res == "fail"){
		echo "pay_status状态更改失败 请联系15171801220！";	
	}else if($res == "ok"){	
		$sql = "DELETE FROM temporder WHERE temp_nickname = '".$nickname."' AND pay_status = 0 ";
		$con->query($sql);
		$sql = "SELECT * FROM temporder WHERE temp_nickname = '".$nickname."' AND pay_status = 1 ORDER BY temp_time DESC LIMIT 1";		
		$row = mysqli_fetch_Array($con->query($sql));
//		echo $nickname.$phone.$location.$sroom.$row['temp_time'].$row['temp_totalprice'].$row['temp_delifee'].$row['temp_order'];
		$sql = "INSERT INTO orderform VALUES (NULL,'".$nickname."','".$phone."','".$location."','".$sroom."','".$row['temp_time']."',".$row['temp_totalprice'].",".$row['temp_delifee'].",'".$row['temp_order']."')";
		$sql2 = "INSERT INTO undelivered VALUES (NULL,'".$nickname."','".$phone."','".$location."','".$sroom."','".$row['temp_time']."',".$row['temp_totalprice'].",".$row['temp_delifee'].",'".$row['temp_order']."')"; 		
		if($con->query($sql)&&$con->query($sql2)){
			echo "pass";
		}else{
			echo "订单载入失败 请联系15171801220！";
		}	
		    
	}
?>