<?php
	session_start();
	require_once("tomysql/checkloginStatus.php");
	require_once("tomysql/getMemberInfo.php");
	checklogin();
	$user = $_SESSION["user_info"];
//	for($i=0;$i<count($user);$i++){
//		echo $user['money'];
//		echo "</br>";
//	}
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="stylesheet" type="text/css" href="css/table.css"/>
		<title>快递页面</title>
		<style type="text/css">
			@import url("css/Btn.css");
		</style>
		<style type="text/css">
			input{
				font-size: 24px; 
				width: 99%; 
				height: 30px; 
				border: black solid 1px;
			}
			select{
				font-size: 25px; 
				width: 100%; 
				height: 35px; 
				border: black solid 1px;
			}
			.goods{
				list-style-type: none;
				border: outset;
				height: 110px;
				width: 100%;
			}
			._img{
				float: left;
				width: 50%;
				height: inherit;
			}
			.div_inline{
				display: inline;
			}
			.btn_img{
				height: inherit;
				width: 10%;
			
			}
			.num_box{
				height: inherit;
			}
			.out_log{
				width: 100%;
				height: 20px;
				border: #000000 solid 3px;
			}
			
			.navsss {
			    width:100%;
			    height:45px;
			    margin:0px auto;
			    position:fixed;
			    bottom:0;
			    background: #000000;
			    opacity: 0.9;
			}
			
			#pay{
				float: right;
			}
		</style>
		<link rel="stylesheet" href="css/orderstyle.css">

		<script type='text/javascript'>
			var user = "<?php echo $user["nickname"]?>";
		</script>
	</head>
	


	<body>	
	<?php  echo "<h3>".$user["nickname"]." 欢迎光临！<h3>"; ?>
	
	
	<center><h2>填写收货地址信息</h2></center>
	<table>
		<tr><td><b>件数：</b></td><td><input placeholder="收货数量 3￥/件" type="text" name="number" id="number" value="" /></td></tr>
		<tr><td><b>楼号：</b></td>
			<td>
				<select id="location" class="mui-input-clear mui-input">
						<option value='default' style="color: #AAAAAA;" selected="selected">点击选择楼号 </option>   
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
			</td>
		</tr>
		<tr><td><b>宿舍号：</b></td><td><input placeholder="填写收货的宿舍号" type="text" name="sroom" id="sroom" value="" /></td></tr>
		<tr><td><b>取件地址：</b></td><td><input placeholder="填写取件地址" type="text" name="get_loc" id="get_loc" value="" /></td></tr>
	</table>
	<a href="javascript:update_location();" class="weui-btn weui-btn_default"><b>点击确认地址</b></a>
	
	<br />
	<a href="javascript:out_log();" class="weui-btn weui-btn_warn"><b>退出登录</b></a>
	

	
	
	
	
	<div style="height: 45px;"></div>	
	<div class="navsss">
		<td>
			<font color="#FFFFFF" size="6">￥<span id="total">0</span>|</font>
		</td>
		<td>
			<font color="#FFFFFF" size="4">代领数量：<span id="itemQuantity">0</span> 件</font>
		</td>
		<a id="pay" class="weui-btn weui-btn_primary"><b>去结算</b></a>
	</div>	
	

	<script src="javascript/To_Customer_Js/outlog.js"></script>
	<script type="text/javascript" src="javascript/To_Customer_Js/updatelocat.js"></script>
	<script type="text/javascript" src="javascript/To_Customer_Js/pay_Btn.js" ></script>
	
	

	
	</body>
	<?php mysqli_close($con); ?>
</html>