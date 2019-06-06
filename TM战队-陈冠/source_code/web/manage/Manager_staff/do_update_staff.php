<?php
	$staff_name = $_GET["name"];
	$staff_item = $_GET["item"];
	$staff_info = $_GET["info"];
	
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
			if($staff_item == "nickname"){
				$sql = "UPDATE delivered SET nickname = '".$staff_info."' WHERE nickname = '".$staff_name."'";
				$con->query($sql);
				echo $staff_name."信息修改成功！";
			}else{
				echo $staff_name."信息修改成功！";
			}
		}else{
			echo "修改员工错误错误！ 请联系15171801220！";
		}
	}
	mysqli_close($con);
?>