<?php
	function getStaffInfo($phone,$password){
		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = 'HXCg0402.';
		$dbname = 'codepay';
		$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		if(! $con) {
			echo 'Could not connect';
		}
		$sql = "SELECT * FROM staff WHERE phone = '".$phone."' AND passkey = '".$password."' ";
		$result = $con->query($sql);
		return mysqli_fetch_Array($result);
		mysqli_close($con);
	}
	
	function insert_staff_autolog($phone){
		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = 'HXCg0402.';
		$dbname = 'codepay';
		$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		if(! $con) {
			echo 'Could not connect';
		}
		$sql = "UPDATE staff SET auto_log = 'true' WHERE phone = '".$phone."'";
		$con->query($sql);		
		mysqli_close($con);
	}
	
	function cancel_staff_autolog($phone){
		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = 'HXCg0402.';
		$dbname = 'codepay';
		$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		if(! $con) {
			echo 'Could not connect';
		}
		$sql = "UPDATE staff SET auto_log = 'false' WHERE phone = '".$phone."'";
		$con->query($sql);		
		mysqli_close($con);
	}
	
	function get_staff_autoStatus($phone){
		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = 'HXCg0402.';
		$dbname = 'codepay';
		$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		if(! $con) {
			echo 'Could not connect';
		}
		$sql = "SELECT auto_log FROM staff WHERE phone = '".$phone."'";
		$result = $con->query($sql);		
		$row = mysqli_fetch_Array($result);
		if($row[0] == "true"){
			if($phone == '17671701468'){
				mysqli_close($con);
				header("location:/web/manage/Manager_page.php");
			}else{
				mysqli_close($con);
				header("location:/web/expressage/staff_page.php");
			}
			
		}else{
			mysqli_close($con);	
			return ;
		}
		mysqli_close($con);	
	}
?>