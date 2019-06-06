<?php
	session_start();
	require_once("staff_checkloginStatus.php");
	require_once("getStaffInfo.php");
	staff_checklogin();
	$staff = $_SESSION["staff_info"];
	$staff_name = $_GET["name"];
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}else{
		$sql = "SELECT salary FROM staff WHERE nickname = '".$staff_name."'";
		$resu = $con->query($sql);
		$res = mysqli_fetch_Array($resu);
		$sq = "SELECT total_salary FROM staff WHERE nickname = '".$staff_name."'";
		$resu = $con->query($sq);
		$ro = mysqli_fetch_Array($resu);
		echo $res["salary"]."|".$ro["total_salary"];		
	}
?>