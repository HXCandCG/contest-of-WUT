<?php
	session_start();
	require_once("getMemberInfo.php");
	$phone = $_GET["phone"];
	$password = md5($_GET["password"]);
	$remember = $_GET["remember"];
	$err_msg='';

	$row = getUserInfo($phone,$password);
	if(empty($row)){
		$err_msg = "手机号或密码不正确";
		echo $err_msg;
	}else{
		$_SESSION["user_info"]=$row;
		setcookie("phone",$phone,time()+3600*24*365,"/");
		setcookie("password",$password,time()+3600*24*365,"/");
		if($remember=="mui-switch mui-active"){
			insert_autolog($phone);
		}else{
			cancel_autolog($row["phone"]);
		}

		echo "sucess";
	}
	

?>