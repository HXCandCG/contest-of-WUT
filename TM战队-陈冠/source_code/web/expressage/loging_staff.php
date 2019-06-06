<?php
	session_start();
	require_once("getStaffInfo.php");
	$phone = $_GET["phone"];
	$password = md5($_GET["password"]);
	$remember = $_GET["remember"];
	$err_msg='';

	$row = getStaffInfo($phone,$password);
	if(empty($row)){
		$err_msg = "手机号或密码不正确";
		echo $err_msg;
	}else{
		$_SESSION["staff_info"]=$row;
		setcookie("staff_phone",$phone,time()+3600*24*365,"/");
		setcookie("staff_password",$password,time()+3600*24*365,"/");
		if($remember=="mui-switch mui-active"){		
			insert_staff_autolog($phone);
		}else{
			cancel_staff_autolog($row["phone"]);
		}


		if($row["phone"]=="17671701468"){
			echo "administrator";
		}else{
			echo "sucess";	
		}
	}
	

?>