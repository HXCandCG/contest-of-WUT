<?php
	session_start();
	require_once("../../expressage/staff_checkloginStatus.php");
	require_once("../../expressage/getStaffInfo.php");
	require_once("../M_number.php");
	staff_checklogin();
	$staff = $_SESSION["staff_info"];
	if($staff["phone"]!=$M_id){
		header("location:/web/expressage/Courier_log.php?req_url=".$SERVER["REQUEST_URI"]);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link href="../../css/logineed.css" rel="stylesheet" />
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<style type="text/css">
			.code{
			        background:url(code_bg.jpg);
			        font-family:Arial;
			        font-style:italic;
			         color:blue;
			         font-size:30px;
			         border:0;
			         padding:2px 3px;
			         letter-spacing:3px;
			         font-weight:bolder;             
			         float:left;            
			         cursor:pointer;
			         width:150px;
			         height:60px;
			         line-height:60px;
			         text-align:center;
			         vertical-align:middle;
			         margin: 4px;
			
			}
		    a{
		        text-decoration:none;
		        font-size:12px;
		        color:#288bc4;
		    }
		    a:hover {
		       text-decoration:underline;
		    }
		</style>
		<title>员工注册</title>
	</head>
	<body onload="createCode()">
		


		
		<div id="login_ui"  class="mui-content" style="background-size:cover; background-image: none">
			
			<form id="login-form" class="mui-input-group">
				<div class="mui-input-row">
					<label>手机号</label>
					<input id="phoneNum" type="text" class="mui-input-clear mui-input" placeholder="请输入手机号">
				</div>
				<div class="mui-input-row">
					<label>昵称</label>
					<input id="nickname" type="text" class="mui-input-clear mui-input" placeholder="十个字以内">
				</div>
				<div class="mui-input-row">
					<label>密码</label>
					<input id="Password" type="password" class="mui-input-clear mui-input" placeholder="请输入密码">
				</div>
				<div class="mui-input-row">
					<label>重复密码</label>
					<input id="repeatPassword" type="password" class="mui-input-clear mui-input" placeholder="请再次输入密码">
				</div>
				<div class="mui-input-row">
					<label>邮箱</label>
					<input id="email" type="text" class="mui-input-clear mui-input" placeholder="用于找回密码">
				</div>
				<div class="mui-input-row">
					<label>负责区域</label>
					<select id="location" class="mui-input-clear mui-input">
						<option value='default' style="color: #AAAAAA;" selected="selected">点击选择 ▼</option>   
						<option value='X1'>男寝西一</option>
						<option value='X2'>男寝西二</option>
						<option value='X3'>男寝西三</option>
						<option value='X4'>男寝西四</option>
						<option value='X5'>男寝西五</option>
						<option value='X6'>男寝西六</option>
						<option value='X7'>男寝西七</option>
						<option value='X8'>男寝西八</option>
						<option value='X9'>男寝西九</option>
						<option value='X10'>男寝西十</option>
						<option value='D1'>女寝东一</option>
						<option value='D2'>女寝东二</option>
						<option value='D3'>女寝东三</option>
						<option value='D4'>女寝东四</option>
						<option value='D5'>女寝东五</option>
						<option value='D6'>女寝东六</option>
						<option value='D7'>女寝东七</option>
						<option value='D8'>女寝东八</option>
						<option value='D9'>女寝东九</option>
						<option value='D10'>女寝东十</option>
					</select>
					<!--<input id="location" type="text" class="mui-input-clear mui-input" placeholder="格式:例如西七就填X7">-->
				</div>
<!-- 				<div class="mui-input-row">
					<label>寝室号</label>
					<input id="sroom" type="text" class="mui-input-clear mui-input" placeholder="填写三位数字">
				</div> -->
				<div class="mui-input-row">
					<label>验证码：</label>
					<input id="inputCode" type="text" class="mui-input-clear mui-input" placeholder="可以不注意大小写">	
				</div>
				

			</form>	
			<tr><!--<a  href="#">看不清换一张</a>-->
            	<td> <div class="code" id="checkCode" onclick="createCode()" ></div></td>
            	<td><font style="line-height: 60px;"  onclick="createCode()" size="5" color="#007AFF"><center >看不清换一张</center></font></td>
        	</tr>
			
			<div class="mui-content-padded">
				<button id="register" class="mui-btn mui-btn-block mui-btn-primary">注册</button>
				<button id="back" onclick="javascript:window.location.href ='m_page_staff.php' " class="mui-btn mui-btn-block mui-btn-primary">返回</button>
			</div>
			
		</div>
		
		<script src="register_staff.js"></script>	
		
		<script src="../../javascript/To_login_Js/mui.min.js"></script>
	
	
	
	</body>
		
	
</html>