<?php
	require_once("getMemberInfo.php");
	function checklogin(){
		if(empty($_SESSION["user_info"])){
			if(empty($_COOKIE["phone"])||empty($_COOKIE["password"])){
				header("location:/web/login/login.php?req_url=".$SERVER["REQUEST_URI"]);
			}else{
				$user = getUserInfo($_COOKIE["phone"],$_COOKIE["password"]);
				if(empty($user)){
					header("location:/web/login/login.php?req_url=".$SERVER["REQUEST_URI"]);
				}else{
					$_SESSION["user_info"] = $user;
				}
			}
		}
	}
	
	function PrimaryCheckLog(){
		if(!empty($_COOKIE["phone"]) && !empty($_COOKIE["password"])){
			$user = getUserInfo($_COOKIE["phone"],$_COOKIE["password"]);
			if(empty($user)){
				echo "<h1>账户已过期！</h1>";
				return false;
			}else{
				$_SESSION["user_info"] = $user;
				return true;
			}
		}
	}
?>