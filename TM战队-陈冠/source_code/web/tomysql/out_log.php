<?php
	session_start();
	require_once("checkloginStatus.php");
	require_once("getMemberInfo.php");
	$user = $_SESSION["user_info"];
	cancel_autolog($user["phone"]);
	setcookie("phone","",time()-3600*24*365);
	setcookie("password","",time()-3600*24*365);
	unset($_SESSION["user_info"]);
	$response = "success";
	echo $response;
?>