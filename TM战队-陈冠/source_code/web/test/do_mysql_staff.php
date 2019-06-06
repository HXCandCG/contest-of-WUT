<?php
	//update
	$staff_name = $_GET["name"];
	$staff_item = $_GET["item"];
	$staff_info = $_GET["info"];
	//clearing
	$staff_cl_name = $_GET["cl_name"];
	//delete
	$staff_de_name = $_GET["de_name"];
	
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	if(!empty($staff_name)&&!empty($staff_item)&&!empty($staff_info)){
		$sql = "UPDATE staff SET ".$staff_item." = '".$staff_info."' WHERE nickname = '".$staff_name."'";
		$con->query($sql);
		if(mysqli_affected_rows($con)!=0){
			echo "信息修改成功！";
		}else{
			echo "修改错误！ 请联系15171801220！";
		}
	}else if (!empty($staff_cl_name)) {
		$sql = "UPDATE staff SET salary = 0 WHERE nickname = '".$staff_cl_name."'";
		$con->query($sql);
		if(mysqli_affected_rows($con)!=0){
			echo "工资结算成功！";
		}else{
			echo "结算错误！ 请联系15171801220！";
		}
	}else if (!empty($staff_de_name)) {
		$sql = "DELETE FROM staff WHERE nickname = '".$staff_de_name."'";
		$con->query($sql);
		if(mysqli_affected_rows($con)!=0){
			echo "员工删除成功！";
		}else{
			echo "删除错误！ 请联系15171801220！";
		}
	}
	mysqli_close($con);
?>