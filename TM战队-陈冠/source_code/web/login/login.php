<?php
	session_start();
	require_once("../tomysql/checkloginStatus.php");
	require_once("../tomysql/getMemberInfo.php");
	
	if(PrimaryCheckLog()){
		$user = $_SESSION["user_info"];
		get_autoStatus($user["phone"]);
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<link href="../css/logineed.css" rel="stylesheet" />
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>登陆</title>
	</head>
	<body>
		
		
		
		
		<div id="login_ui"  class="mui-content" style="background-size:cover; background-image: none">
			
			<form id="login-form" class="mui-input-group">
				<div class="mui-input-row">
					<label>手机号</label>
					<input id="phone" type="text" class="mui-input-clear mui-input" placeholder="请输入手机号">
				</div>
				<div class="mui-input-row">
					<label>密码</label>
					<input id="password" type="password" class="mui-input-clear mui-input" placeholder="请输入密码">
				</div>
			</form>
			
			<form class="mui-input-group">
				<ul class="mui-table-view mui-table-view-chevron">
					<li class="mui-table-view-cell">
						自动登录
						<div id="autoLogin" class="mui-switch"><!--很重要的地方啊-->
							<div class="mui-switch-handle"></div>
						</div>
					</li>
				</ul>
			</form>
			
			<div class="mui-content-padded">
				<button id="login" class="mui-btn mui-btn-block mui-btn-primary">登录</button>
				<button id="back" onclick="javascript:window.location.href ='../../Homepage.php' " class="mui-btn mui-btn-block mui-btn-primary">返回首页</button>
				<div class="link-area">
					<a id="reg" href="register.html">注册账号</a> 
					<span class="spliter">|</span> 
					<a id="forgetPassword" href="forget.html">忘记密码</a>
				</div>
			</div>
			
		</div>
		
		<script src="../javascript/To_login_Js/mui.min.js"></script>
		<script src="../javascript/To_login_Js/login_page.js"></script>
	
	
	</body>
		
	
</html>
