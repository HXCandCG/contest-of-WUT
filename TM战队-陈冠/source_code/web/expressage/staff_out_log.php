<?php
	session_start();
	require_once("staff_checkloginStatus.php");
	require_once("getStaffInfo.php");
	staff_checklogin();
	$staff = $_SESSION["staff_info"];
	$user = $_SESSION["staff_info"];
	cancel_staff_autolog($user["phone"]);
	setcookie("staff_phone","",time()-3600*24*365);
	setcookie("staff_password","",time()-3600*24*365);
	unset($_SESSION["staff_info"]);
	$response = "success";
	echo $response;
?>