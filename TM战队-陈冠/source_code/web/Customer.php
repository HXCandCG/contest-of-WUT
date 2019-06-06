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
		<title>点餐界面</title>
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
			if(user!="小仙女的粑粑"){
				alert("下周一开张呀 不着急咯~");
				window.location.href = "../Homepage.php";
			}
		</script>
	</head>
	


	<body>	
	<?php  echo "<h3>".$user["nickname"]." 欢迎光临！<h3>"; ?>
	<?php 
		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = 'HXCg0402.';
		$dbname = 'codepay';
		$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		if(! $con) {
			echo 'Could not connect';
		}
		$sql ="SELECT * FROM customer WHERE nickname = '".$user["nickname"]."'";
		$result = $con->query($sql);
		$row = mysqli_fetch_Array($result);
		echo "<h3>收货地址为".$row["location"]."栋".$row["sroom"]."寝室。<h3>"; 
	?>
	<script type='text/javascript'>
		var loc = "<?php echo $row["location"]?>";
		var sro = "<?php echo $row["sroom"]?>"; 
	</script>
			
			
			
	<h2 align="center">菜品</h2>

	<div id="food" >
		<?php
			/*<!--<li class="goods">
				<img class="food_img" src="img/pot_rice/川香鸡柳.jpg"/>
				<div  class="div_inline">
					<center><font id="food_name0" size="5" > 土豆烧肉盖饭 </font></center>
					<center><font id="food_price0" size="4" > 15 RMB </font></center>
					<center>
						<img class="btn_img" src="img/btn/btn_add.png"/>
						<font  size="7" class="num_box">0</font>
						<img class="btn_img" src="img/btn/btn_sub.png"/>
					</center>
				</div>			
			</li>*/			
			$dbhost = 'localhost:3306';
			$dbuser = 'root';
			$dbpass = 'HXCg0402.';
			$dbname = 'codepay';
			$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
			if(! $con) {
				echo 'Could not connect';
			}
			$sql = "SELECT menu_name,menu_price,menu_imgUrl FROM menu WHERE menu_type = 1 ORDER BY menu_price ASC";
			$result = $con->query($sql);
			$i=0;
			while($row = mysqli_fetch_Array($result)){		
				echo '
					<li class="goods">
						<img class="_img" src="'.$row[2].'"/>
						<div  class="div_inline">
							<center><font id="food_name'.$i.'" size="5" >'.$row[0].'</font></center>
							<center><font id="food_price'.$i.'" size="4" >'.$row[1].'</font>RMB</center>
							<center>
								<img class="btn_img" id="'.$row[0].'" onclick="add_btn(this);" src="img/btn/btn_add.png"/>
								<font  size="7" class="num_box">0</font>
								<img class="btn_img" id="'.$row[0].'|" onclick="sub_btn(this);" src="img/btn/btn_sub.png"/>
							</center>
						</div>			
					</li>
				
				';
				
				$i++;
			}
				
		?>
	</div>
	
	<h2 align="center">饮品</h2>
	<div id="drink">
		<?php
			$sql = "SELECT menu_name,menu_price,menu_imgUrl FROM menu WHERE menu_type = 2 ORDER BY menu_price ASC";
			$result = $con->query($sql);
			$i=0;
			while($row = mysqli_fetch_Array($result)){
				echo '
					<li class="goods">
						<img class="_img" src="'.$row[2].'"/>
						<div  class="div_inline">
							<center><font id="drink_name'.$i.'" size="5" >'.$row[0].'</font></center>
							<center><font id="drink_price'.$i.'" size="4" >'.$row[1].'</font>RMB</center>
							<center>
								<img class="btn_img" id="'.$row[0].'" onclick="add_btn(this);" src="img/btn/btn_add.png"/>
								<font  size="7" class="num_box">0</font>
								<img class="btn_img" id="'.$row[0].'|" onclick="sub_btn(this);" src="img/btn/btn_sub.png"/>
							</center>
						</div>			
					</li>
				
					';
				$i++;
			}
		?>
	</div>
	
	<h2 align="center">香烟</h2>
	<div id="ciggar">
		<?php
			$sql = "SELECT menu_name,menu_price,menu_imgUrl FROM menu WHERE menu_type = 3 ORDER BY menu_price ASC";
			$result = $con->query($sql);
			$i=0;
			while($row = mysqli_fetch_Array($result)){
				echo '
					<li class="goods">
						<img class="_img" src="'.$row[2].'"/>
						<div  class="div_inline">
							<center><font id="cig_name'.$i.'" size="5" >'.$row[0].'</font></center>
							<center><font id="cig_price'.$i.'" size="4" >'.$row[1].'</font>RMB</center>
							<center>
								<img class="btn_img" id="'.$row[0].'" onclick="add_btn(this);" src="img/btn/btn_add.png"/>
								<font  size="7" class="num_box">0</font>
								<img class="btn_img" id="'.$row[0].'|" onclick="sub_btn(this);" src="img/btn/btn_sub.png"/>
							</center>
						</div>			
					</li>
				';
				$i++;
			}
		?>
	</div>
	<br />
	
	<center><h2>填写新地址信息</h2></center>
	<table>
		<tr><td><b>楼号：</b></td>
			<td>
				<select id="location" class="mui-input-clear mui-input">
						<option value='default' style="color: #AAAAAA;" selected="selected">点击选择新楼号 </option>   
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
		<tr><td><b>宿舍号：</b></td><td><input placeholder="填写要修改的宿舍号" type="text" name="sroom" id="sroom" value="" /></td></tr>
	</table>
	<a href="javascript:update_location();" class="weui-btn weui-btn_default"><b>点击修改新地址</b></a>
	<br />
	<a href="choice_server.php" class="weui-btn weui-btn_default"><b>返回上一页</b></a>
	<br />
	<a href="javascript:out_log();" class="weui-btn weui-btn_warn"><b>退出登录</b></a>
	

	
	
	
	
	<div style="height: 45px;"></div>	
	<div class="navsss">
		<td>
			<font color="#FFFFFF" size="6">￥<span id="total">0</span>|</font>
		</td>
		<td>
			<font color="#FFFFFF" size="4">商品数量：<span id="itemQuantity">0</span> 件</font>
		</td>
		<a id="pay" class="weui-btn weui-btn_primary"><b>去结算</b></a>
	</div>	
	

	<script src="javascript/To_Customer_Js/outlog.js"></script>
	<script src="javascript/To_Customer_Js/add_sub_total.js"></script>	
	<script type="text/javascript" src="javascript/To_Customer_Js/updatelocat.js"></script>
	<script type="text/javascript" src="javascript/To_Customer_Js/pay_Btn.js" ></script>
	
	
	<nav class="nav nav5" onclick="Process_str(order_content);">
		<ul>
			<li>
				<a >已点商品</a>
				<ul id="float_order">
					<script src="javascript/To_Customer_Js/left_order.js"></script>
					<!--<li><a href="#">尔良鸡腿</a></li>
					<li><a href="#">Subnav Item</a></li>
					<li><a href="#">Subnav Item</a></li>-->
				</ul>
			</li>
		</ul>
	</nav>	

	
	</body>
	<?php mysqli_close($con); ?>
</html>