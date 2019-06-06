<?php
	session_start();
	require_once("../../expressage/staff_checkloginStatus.php");
	require_once("../../expressage/getStaffInfo.php");
	staff_checklogin();
	$staff = $_SESSION["staff_info"];
	if($staff["phone"]!='17671701468'){
		header("location:/web/expressage/Courier_log.php?req_url=".$SERVER["REQUEST_URI"]);
	}
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	
	$name = $_GET["name"];
	$price = $_GET["price"];
	$type = $_GET["type"];
	$isfrom = $_GET["isfrom"];
	$fileName = "";
	$res = "";
	if(isset($_FILES["myfile"]))
	{
		$dir = "../../../web/img/".$isfrom."/"; //路径名,可以自己修改  
		file_exists($dir) || (mkdir($dir,0777,true) && chmod($dir,0777));
		if(!is_array($_FILES["myfile"]["name"])) //single file  
		{
			$fileName = $name.".".pathinfo($_FILES["myfile"]["name"])['extension']; 
			if(move_uploaded_file($_FILES["myfile"]["tmp_name"],$dir.$fileName)){
				$res = "m_page_goods.php";	
			}else{
				$res = "pic_fal";	
			}
			 
		}	
	}
	
	$sql = "INSERT INTO menu VALUES('".$name."',".$price.",".$type.",'/web/img/".$isfrom."/".$fileName."','".$isfrom."',0)";
	if($con->query($sql)){
		$res = $res."?inserting=".$isfrom;
	}else{
		$res = "god_fal";
	}
	
	echo $res;
	
	mysqli_close($con);
	
?>