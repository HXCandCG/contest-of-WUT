<?php
	session_start();
	require_once("../expressage/staff_checkloginStatus.php");
	require_once("../expressage/getStaffInfo.php");
	require_once("M_number.php");
	staff_checklogin();
	$staff = $_SESSION["staff_info"];
	if($staff["phone"]!=$M_id){
		header("location:/web/expressage/Courier_log.php?req_url=".$SERVER["REQUEST_URI"]);
	}
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>总管理员页面</title>
		<link rel="stylesheet" type="text/css" href="../css/Btn.css" />
	</head>
	<body>
		<a style="border: dashed" href="Manager_staff/m_page_staff.php" class="weui-btn weui-btn_plain-default"><b>员工管理</b></a>
		<br /><br /><br /><br /><br /><br /><br /><br /><br />
		<a style="border: dashed" href="Manager_merchant/m_page_merchant.php" class="weui-btn weui-btn_plain-default"><b>商户交互</b></a>
		<br /><br /><br /><br /><br /><br /><br /><br /><br />
		<a style="border: dashed" href="Manager_self/s_page.php" class="weui-btn weui-btn_plain-default"><b>利益测算</b></a>
	</body>
</html>