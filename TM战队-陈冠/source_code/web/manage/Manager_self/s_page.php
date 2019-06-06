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
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>我方利益界面</title>
		<link rel="stylesheet" href="../../css/Btn.css" />
		<link rel="stylesheet" type="text/css" href="../../css/table.css"/>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	</head>
	<style>
		.time{
				font-size: 25px; 
				width: 60%; 
				height: 30px; 
				border: black solid 1px;
		}
		
		.timer{
				font-size: 25px; 
				width: 55%; 
				height: 30px; 
				border: black solid 1px;
		}
		.select{
				font-size: 25px; 
				width: 99%; 
				height: 35px; 
				border: black solid 1px;
			}
		.seeOrder{
			border: double;
		}
		
	</style>
	<body>
		<center><h1>我方利益界面</h1></center>
		<div class="seeOrder">
			<center><h3>当日时间段订单查询👇</h3></center>
			<center><h4>(ps:直接点击查看所有)</h4></center>
			<center>
				<label>起始时间</label>
				<input class="time" id="startTime" defaultValue="" type="time"/>
				</br>
				</br>
				<label>截至时间</label>
				<input class="time" id="endTime" defaultValue="" type="time"/>
			</br>
			</center>
			
			<div id="showArea"></div>
			<center>
				<a href="javascript:getTimeOrder();" class="weui-btn weui-btn_mini weui-btn_primary">查看</a>
				<a href="javascript:back();" class="weui-btn weui-btn_mini weui-btn_default">还原</a>
			</center>		
		</div>

		
		<div class="seeOrder">
			<center><h3>全总未送订单查看👇</h3></center>
			<table class="gridtable" id="undeliTable">
				<tr>
					<th>客户</th>
					<th>电话/时间</th>
					<th>地址</th>
					<th>价格</th>
					<th>配送费</th>
					<th>内容</th>
				</tr>
				<tr>
					<?php
						$sql = "SELECT * FROM undelivered ORDER BY ord_time DESC";
						$result = $con->query($sql);
						while($row = mysqli_fetch_Array($result)){
							echo "<tr>";
							echo "<td>".$row['ord_name']."</td>";
							echo "<td>".$row['ord_phone']."</br>".$row['ord_time']."</td>";
							echo "<td>".$row['ord_location']."|".$row['ord_sroom']."</td>";
							echo "<td>".$row['ord_price']."</td>";
							echo "<td>".$row['ord_delifee']."</td>";
							echo "<td>".doContent($row['ord_content'])."</td>";
							echo "</tr>";
						}
						
						function doContent($str){
							$item = "";
							$z = explode("|",$str);
							array_shift($z);
							array_pop($z);
							$z = array_filter($z);
							$num = array_count_values($z);
							$z = array_unique($z);
							foreach($z as $value){
								$item .= $value." X ".$num[$value]."</br>";
							}
							return $item;
						}
					?>
				</tr>
			</table>
			<center>
				<a href="javascript:showundeliTable();" class="weui-btn weui-btn_mini weui-btn_primary">显示</a>
				<a href="javascript:hideundeliTable();" class="weui-btn weui-btn_mini weui-btn_default">收起</a>
			</center>
		</div>
		
		<div class="seeOrder">
			<center><h3>全总已送订单查看👇</h3></center>
			<center><h4>(ps:直接点击查看所有)</h4></center>
			<center>
				<label><b>选择查看日期：</b></label>
				<input class="timer" id="timer" defaultValue="" type="date"/>
				<br />
			</center>
			<table class="gridtable" id="deliTable">
				
			</table>
			<center>
				<a href="javascript:checkDeliTable();" class="weui-btn weui-btn_mini weui-btn_primary">查看</a>
				<a href="javascript:hidedeliTable();" class="weui-btn weui-btn_mini weui-btn_default">收起</a>
			</center>			
		</div>
		
		<div class="seeOrder">
			<center><h3>我方收入查看👇</h3></center>
			<table border="1px" width="100%">
				<tr>
					<td>
						<select id="check_month" class="select">
							<option value='default' style="color: #AAAAAA;" selected="selected">选择月份</option>   
							<option value='01'>一月</option>
							<option value='02'>二月</option>
							<option value='03'>三月</option>
							<option value='04'>四月</option>
							<option value='05'>五月</option>
							<option value='06'>六月</option>
							<option value='07'>七月</option>
							<option value='08'>八月</option>
							<option value='09'>九月</option>
							<option value='10'>十月</option>
							<option value='11'>十一月</option>
							<option value='12'>十二月</option>
						</select>
					</td>
					<td>
						<center>
							<a href="javascript:seeEarning();" class="weui-btn weui-btn_mini weui-btn_primary">查看</a>
							<a href="javascript:back();" class="weui-btn weui-btn_mini weui-btn_default">收起</a>	
						</center>
					</td>
				</tr>	
			</table>
			<table width="100%" class="gridtable" id="showEarning">
				
			</table>
		</div>
		
		<div class="seeOrder">
			<center><h3>我方收入结算👇</h3></center>
			<table border="1px" width="100%">
				<tr>
					<td style="width: 30%;">
						<select  id="settle_month" class="select">
							<option value='default' style="color: #AAAAAA;" selected="selected">月份</option>   
							<option value='01'>一月</option>
							<option value='02'>二月</option>
							<option value='03'>三月</option>
							<option value='04'>四月</option>
							<option value='05'>五月</option>
							<option value='06'>六月</option>
							<option value='07'>七月</option>
							<option value='08'>八月</option>
							<option value='09'>九月</option>
							<option value='10'>十月</option>
							<option value='11'>十一月</option>
							<option value='12'>十二月</option>
						</select>
					</td>
					<td>
						<input class="select" placeholder="在此输入结算的金额" type="number" name="earn_yet" id="earn_yet" value="" />
					</td>
				</tr>	
			</table>
			<a href="javascript:setEarning();" class="weui-btn weui-btn_primary"><b>结算</b></a>
		</div>
		
		<br />
		
		<h3><center><b>今年我方收入曲线图👇</b></center></h3>
		
		<canvas id="myChart" width="300" height="400"></canvas>
		
		<br />
		
		<a href="../Manager_page.php" style="border: dashed" class="weui-btn weui-btn_default"><b>返回上一页</b></a>
		
		<br />
		
		<a href="javascript:manager_out_log();" class="weui-btn weui-btn_warn"><b style="color: white;">退出登录</b></a>
	</body>
	
	<script src="../../expressage/staff_outlog.js"></script>
	<script src="../../Chart.js-2.7.1/dist/chart.js"></script>
	<script src="self_JS.js"></script>
	<script type="text/javascript">
		//select * from undelivered WHERE ord_time>'2018-02-21 22:25:00' and ord_time<'2018-02-21 22:28:00'
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
	    type: 'line',
	    data: {
	       labels: [
	       //"red", "Blue", "Yellow", "Green", "Purple", "Orange"
	       <?php
	       		$dateName = array(1,2,3,4,5,6,7,8,9,10,11,12);
	       				        	
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
	        	
	        	take_dataname($dateName);		        			        	
	       	?>
	       ],
	        datasets: [{
	            label: '收入（￥￥￥）',
	            data: [
	            //2, 5, 4, 3, 2, 1
	            
	            <?php
	            	function take_datanum($name,$conn){
		        		$i = 1 ;
		        		$year = date("Y");
			       		foreach($name as $val){
			       			$sql = "SELECT earn_total FROM earning WHERE earn_time = '".$year."-".$val."-01'";
			       			$result = $conn->query($sql);
			       			$row = mysqli_fetch_Array($result);
			       			echo $row["earn_total"];
			        		if($i<count($name))
		        			{
		        				echo ",";	
		        				$i++;
		        			}
			        	}
		        	}
		        	
		        	take_datanum($dateName,$con);		            	
	            ?>
	            
	            ],
	            backgroundColor: [
	            	<?php $txt = rand_color($dateName);?>
	            ],
	            borderColor: [
	            	<?php echo $txt;?>
	            ],
	            borderWidth: 1
	        }]
	    },
	    });
		
	</script>
</html>
<?php mysqli_close($con);?>