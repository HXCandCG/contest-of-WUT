<!DOCTYPE html>
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
	
	$merchantNames = array();
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	$sql = "SELECT * FROM merchant ";
	$result = $con->query($sql);
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>商户交互</title>
		<link rel="stylesheet" href="../../css/Btn.css" />
		<link rel="stylesheet" type="text/css" href="../../css/table.css"/>
		<style type="text/css">
			input{
				font-size: 25px; 
				width: 99%; 
				height: 30px; 
				border: black solid 1px;
			}
		</style>
	</head>
	<body>
		<h2><center><b>商户信息👇</b></center></h2>
		<table class="gridtable">
			<tr>
				<th>商户名</th>
				<th>老板电话</th>
				<th>差价</th>
				<th>未结算</th>
				<th>历史总收入</th>
				<th>销量</th>
			</tr>	
			<?php											
				while($row = mysqli_fetch_Array($result)){
					array_push($merchantNames,$row['merchant_name']);
					echo "
					<tr>
						<td>".$row['merchant_name']."</td>
						<td>".$row['boss_tel']."</td>
						<td>".$row['price_spread']."</td>
						<td>".$row['cope_with']."</td>
						<td>".$row['total_cope']."</td>
						<td>".$row['sales']."</td>
					</tr>
					";
				}
			?>
		</table>
		
		<br />
		
		<center><b><h2>操作商户👇</h2></b></center>
		<table border="1px">
			<tr>
				<td>
					<b>更改商户信息：</b>
				</td>
				<td>
					<b>商户名:</b>
					<select style="width: 100px; height: 30px;"  id="update_name" >  
						<option value='default' style="color: #AAAAAA;" selected="selected">此处选择</option> 
						<?php
							foreach($merchantNames as $val){
								echo "<option value='".$val."'>".$val."</option>";
							}	
						?>       
					</select>
					<br />
					<b>修改项:</b>
					<select style=" width: 100px; height: 30px;"  id="update_item" >
						<option value='default' style="color: #AAAAAA;" selected="selected">此处选择</option>   
						<option value='boss_tel'>商户号码</option>
						<option value='merchant_name'>商户名</option>
						<option value='price_spread'>差价</option>     
					</select>
					<br />
					<input id="infoo" value="" placeholder="在此输入修改信息"; type="text" />
				</td>
				<td>
					<a href="javascript:update_merchant();" class="weui-btn weui-btn_mini weui-btn_default">更改</a>
				</td>
			</tr>
			<tr>
				<td>
					<b>结算商户收入：</b>
				</td>
				<td>
					<select style="width: 100px; height: 30px;"  id="Clearing" > 
						<option value='default' style="color: #AAAAAA;" selected="selected">此处选择</option>     
						<?php
							foreach($merchantNames as $val){
								echo "<option value='".$val."'>".$val."</option>";
							}	
						?> 
					</select>
				</td>
				<td>
					<a href="javascript:clearing_merchant();" class="weui-btn weui-btn_mini weui-btn_default">结算</a>
				</td>
			</tr>
			<tr>
				<td>
					<b>查看商户商品：</b>
				</td>
				<td>
					<form id="check" action="m_page_goods.php" method="get">
						<select style="width: 100px; height: 30px;" name="inserting"  id="inserting" > 
							<option value='default' style="color: #AAAAAA;" selected="selected">此处选择</option>     
							<?php
								foreach($merchantNames as $val){
									echo "<option value='".$val."'>".$val."</option>";
								}	
							?> 
						</select>
					</form>
				</td>
				
				<td>
					<a id="submit" class="weui-btn weui-btn_mini weui-btn_default">查看</a>
				</td>
			</tr>
			
			<script type="text/javascript">
					document.getElementById("submit").onclick = function(){
						if(document.getElementById("inserting").value=="default"){
							alert("选择不能为空！");
							return ;
						}else{
							document.getElementById("check").submit();	
						}
					}
			</script>
			
			<tr>
				<td>
					<b>增加一个商户：</b>
				</td>
				<td>
					<label><b>商户名称：</b>
					<br />
					<input id="name" value="" placeholder="输入商户名"; type="text" />
					</label>
					<label><b>老板电话：</b>
					<br />
					<input id="tel" value="" placeholder="输入商户电话"; type="text" />	
					</label>
					<label><b>初始差价：</b>
					<br />
					<input id="spread" value="" placeholder="输入差价"; type="text" />	
					</label>
				</td>
				<td>
					<a href="javascript:inserting_merchant();" class="weui-btn weui-btn_mini weui-btn_primary">增加</a>
				</td>
			</tr>
			<tr>
				<td>
					<b>删除当前商户：</b>
				</td>
				<td>
					<select style="width: 100px; height: 30px;"  id="delete" >
						<option value='default' style="color: #AAAAAA;" selected="selected">此处选择</option>      
						<?php
							foreach($merchantNames as $val){
								echo "<option value='".$val."'>".$val."</option>";
							}	
						?>    
					</select>
				</td>
				<td>
					<a href="javascript:delete_merchant();" class="weui-btn weui-btn_mini weui-btn_warn">删除</a>
				</td>
			</tr>
		</table>
		
		<br />
		
		<h3><center><b>商户销售量比(认清主要客户)👇</b></center></h3>
		
		<canvas id="myChart" width="300" height="400"></canvas>
		
		<br />
		
		<h3><center><b>商户历史总收入柱状图👇</b></center></h3>
		
		<canvas id="myChart1" width="300" height="400"></canvas>
		
		<br />
		
		<a href="../Manager_page.php" class="weui-btn weui-btn_default"><b>返回上一页</b></a>
		
		<br />
		
		<a href="javascript:manager_out_log();" class="weui-btn weui-btn_warn"><b style="color: white;">退出登录</b></a>
		
		<script src="../../Chart.js-2.7.1/dist/chart.js"></script>
		<script src="../../expressage/staff_outlog.js"></script>
		<script>
			
			function inserting_merchant(){
				var name = document.getElementById("name").value;
				var tel = document.getElementById("tel").value;
				var spread = document.getElementById("spread").value;
				if(name==""||tel==""||spread==""){
					alert("输入为空");
				}else if(tel.length!=11){
					alert("手机号长度有问题！");
					return ;
				}else if(name.length>10){
					alert("名称长度错误！");
					return ;
				}else{
					var clearhttp = GetXmlHttpObject();
					var url="/web/manage/Manager_merchant/do_insert_merchant.php";
					url = url + "?name=" + name;
					url = url + "&tel="+ tel;
					url = url + "&spread="+ spread;
					url = url + "&sid="+ Math.random();
					clearhttp.open("POST",url,false);
					clearhttp.send(null);
					if (clearhttp.readyState==4 || clearhttp.readyState=="complete"){ 
						//刷新
						alert(clearhttp.responseText);
						window.location.href = "m_page_merchant.php";
					}
				}
			}
			
			function clearing_merchant(){
				var name = document.getElementById("Clearing").value;
				if(name == "default"){
					alert("选择不能为空！");
				}else{
					if(confirm("结算后数据不予恢复，确认将‘"+name+"’剩余账目归0吗？若尾账本身为 0 结算将报错！")){
						var clearhttp = GetXmlHttpObject();
						var url="/web/manage/Manager_merchant/do_clearing_merchant.php";
						url = url + "?cl_name=" + name;
						url = url + "&sid="+ Math.random();
						clearhttp.open("POST",url,false);
						clearhttp.send(null);
						if (clearhttp.readyState==4 || clearhttp.readyState=="complete"){ 
							//刷新
							alert(clearhttp.responseText);
							window.location.href = "m_page_merchant.php";
						}
					}else{
						return ;
					}
				}
			}

			function delete_merchant(){
				var name = document.getElementById("delete").value;
				if(name == "default"){
					alert("选择不能为空！");
				}else{
					if(confirm("删除后，以往商户数据不予恢复，确认已与‘"+name+"’商户结束合作？")){
						var deletehttp = GetXmlHttpObject();
						var url="/web/manage/Manager_merchant/do_delete_merchant.php";
						url = url + "?de_name=" + name;
						url = url + "&sid="+ Math.random();
						deletehttp.open("POST",url,false);
						deletehttp.send(null);
						if (deletehttp.readyState==4 || deletehttp.readyState=="complete"){ 
							//刷新
							alert(deletehttp.responseText);
							window.location.href = "m_page_merchant.php";
						}
					}else{
						return ;
					}
				}
			}
			
			function update_merchant(){
				var name = document.getElementById("update_name").value;
				var item = document.getElementById("update_item").value;
				var info = document.getElementById("infoo").value;
				if(name == "default"|| item == "default" ||info == ""){
					alert("选择不能为空！");
					return ;
				}else if(item == "boss_tel" && info.length!=11){
					alert("手机号长度有问题！");
					return ;
				}else if(item == "merchant_name" && info.length>10){
					alert("名称长度错误！");
					return ;
				}else{
					if (confirm("一旦修改难以恢复！继续请确认！")) {
						var uphttp = GetXmlHttpObject();
						var url="/web/manage/Manager_merchant/do_update_merchant.php";
						url = url + "?name=" + name;
						url = url + "&item="+ item;
						url = url + "&info="+ info;
						url = url + "&sid="+ Math.random();
						uphttp.open("POST",url,false);
						uphttp.send(null);
						if (uphttp.readyState==4 || uphttp.readyState=="complete"){ 
							//刷新
							alert(uphttp.responseText);
							window.location.href = "m_page_merchant.php";
						}
					}else{
						return ;
					}
				}
				
			}
			
			function GetXmlHttpObject(){
				var xmlHttp=null;
				try{
					xmlHttp=new XMLHttpRequest();
				}catch (e){
					try{
						xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
					}catch (e){
						xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				}
				return xmlHttp;
			}
			
			<?php
				function rand_color($names){
					$i = 1 ;
					$txt = "";
		       		foreach($names as $val){
		       			$red = mt_rand(0,255);
		       			$yellow = mt_rand(0,255);
		       			$blue = mt_rand(0,255);
		       			echo '"rgba('.$red.','.$yellow.','.$blue.',0.2)"';
		       			$txt = $txt.'"rgba('.$red.','.$yellow.','.$blue.',1)"';
		       			
		        		if($i<count($names))
	        			{
	        				echo ",";	
	        				$txt = $txt.",";
	        				$i++;
	        			}
		        	}
		        	return $txt;
				}
				
			?>
			
			var ctx = document.getElementById("myChart").getContext("2d");
			var myChart = new Chart(ctx, {
		    type: 'pie',
		    data: {
		       labels: [
		       //"red", "Blue", "Yellow", "Green", "Purple", "Orange"
		       <?php		        	
		        	function take_dataname($names){
		        		$i = 1 ;
			       		foreach($names as $val){
			        		echo '"'.$val.'"';
			        		if($i<count($names))
		        			{
		        				echo ",";	
		        				$i++;
		        			}
			        	}
		        	}
		        	
		        	take_dataname($merchantNames);		        			        	
		       	?>
		       ],
		        datasets: [{
		            label: '# of Votes',
		            data: [
		            //2, 5, 4, 3, 2, 1
		            
		            <?php
		            	function take_datanum($name,$conn){
			        		$i = 1 ;
				       		foreach($name as $val){
				       			$sql = "SELECT sales FROM merchant WHERE merchant_name = '".$val."'";
				       			$result = $conn->query($sql);
				       			$row = mysqli_fetch_Array($result);
				       			echo $row["sales"];
				        		if($i<count($name))
			        			{
			        				echo ",";	
			        				$i++;
			        			}
				        	}
			        	}
			        	
			        	take_datanum($merchantNames,$con);		            	
		            ?>
		            
		            ],
		            backgroundColor: [
		            	<?php $txt = rand_color($merchantNames);?>
		            ],
		            borderColor: [
		            	<?php echo $txt;?>
		            ],
		            borderWidth: 1
		        }]
		    },
		    });	
			
			
			var ztx = document.getElementById("myChart1").getContext("2d");
			var myChart1 = new Chart(ztx, {
		    type: 'bar',
		    data: {
		       labels: [
		       //"red", "Blue", "Yellow", "Green", "Purple", "Orange"
		       <?php		        		        	
		        	take_dataname($merchantNames);		        			        	
		       	?>
		       ],
		        datasets: [{
		            label: 'RMB',
		            data: [
		            //2, 5, 4, 3, 2, 1
		            
		            <?php
		            	function take_datanum1($name,$conn){
			        		$i = 1 ;
				       		foreach($name as $val){
				       			$sql = "SELECT total_cope FROM merchant WHERE merchant_name = '".$val."'";
				       			$result = $conn->query($sql);
				       			$row = mysqli_fetch_Array($result);
				       			echo $row["total_cope"];
				        		if($i<count($name))
			        			{
			        				echo ",";	
			        				$i++;
			        			}
				        	}
			        	}
			        	
			        	take_datanum1($merchantNames,$con);		            	
		            ?>
		            
		            ],
		            backgroundColor: [
		                <?php $txt = rand_color($merchantNames);?>
		            ],
		            borderColor: [
		               	<?php echo $txt;?>
		            ],
		            borderWidth: 1
		        }]
		    },
		    });	
		</script>
		
		
		
	</body>
</html>
<?php mysqli_close($con); ?>