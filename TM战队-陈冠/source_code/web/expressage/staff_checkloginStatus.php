<?php
	require_once("getStaffInfo.php");
	function staff_checklogin(){
		if(empty($_SESSION["staff_info"])){
			if(empty($_COOKIE["staff_phone"])||empty($_COOKIE["staff_password"])){
				header("location:/web/expressage/Courier_log.php?req_url=".$SERVER["REQUEST_URI"]);
			}else{
				$user = getStaffInfo($_COOKIE["staff_phone"],$_COOKIE["staff_password"]);
				if(empty($user)){
					header("location:/web/expressage/Courier_log.php?req_url=".$SERVER["REQUEST_URI"]);
				}else{
					$_SESSION["staff_info"] = $user;
					return true;
				}
			}
		}
	}
	
	

	function staff_PrimaryCheckLog(){
		if(!empty($_COOKIE["staff_phone"])&&!empty($_COOKIE["staff_password"])){
			$user = getStaffInfo($_COOKIE["staff_phone"],$_COOKIE["staff_password"]);
			if(empty($user)){
				echo "<h1>账户已过期！</h1>";
				return false;
			}else{
				$_SESSION["staff_info"] = $user;
				return true;
			}
		}
	}
?>