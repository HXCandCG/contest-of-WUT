<?php
	$staff_de_name = $_GET["de_name"];
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	
	if (!empty($staff_de_name)) {
		$sql = "DELETE FROM staff WHERE nickname = '".$staff_de_name."'";
		$con->query($sql);
		if(mysqli_affected_rows($con)!=0){
			echo $staff_de_name."员工删除成功！";
		}else{
			echo "删除错误！ 请联系15171801220！";
		}
	}
	
	mysqli_close($con);
?>