<?php
	
	$setmonth = $_GET["setmonth"];
	$account = $_GET["account"];
	
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	$year = date("Y");
	$sql ="UPDATE earning SET earn_not_yet = earn_not_yet-".$account.",earn_yet = earn_yet+".$account." WHERE earn_time = '".$year."-".$setmonth."-01'";
	$con->query($sql);
	if(mysqli_affected_rows($con)!=0){
		echo $setmonth."月成功结算".$account."元";
	}else{
		echo "结算错误！ 请联系15171801220！";
	}
	
	mysqli_close($con);
?>