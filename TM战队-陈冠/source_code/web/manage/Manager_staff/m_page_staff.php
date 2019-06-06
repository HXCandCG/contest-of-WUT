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
	
	$staffnames = array();
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	$sql = "SELECT * FROM staff WHERE phone != '17671701468'";
	$result = $con->query($sql);
	
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>员工管理</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" href="../../css/Btn.css" />
		<link rel="stylesheet" type="text/css" href="../../css/table.css"/>
	</head>
	<body>
		<h2><center><b>员工信息👇</b></center></h2>
		<table class="gridtable">
			<tr>
				<th>Tel</th>
				<th>昵称</th>
				<th>负责区块</th>
				<th>未结工资</th>
				<th>总收入</th>
				<th>单量</th>
			</tr>	
			<?php
				
				
				while($row = mysqli_fetch_Array($result)){
					array_push($staffnames,$row['nickname']);
					echo "
					<tr>
						<td>".$row['phone']."</td>
						<td>".$row['nickname']."</td>
						<td>".$row['location']."</td>
						<td>".$row['salary']."</td>
						<td>".$row['total_salary']."</td>
						<td>".$row['work_num']."</td>
					</tr>
					";
				}
			?>
		</table>
		
		<br />
		
		<h3><center><b>员工信息操作👇</b></center></h3>
		<table border="1px">
			<tr>
				<td>
					<b>更改员工信息：</b>
				</td>
				<td>
					<b>员工名:</b>
					<select style="width: 100px; height: 30px;"  id="update_name" >  
						<option value='default' style="color: #AAAAAA;" selected="selected">此处选择</option> 
						<?php
							foreach($staffnames as $val){
								echo "<option value='".$val."'>".$val."</option>";
							}	
						?>       
					</select>
					<br />
					<b>修改项:</b>
					<select style=" width: 100px; height: 30px;"  id="update_item" >
						<option value='default' style="color: #AAAAAA;" selected="selected">此处选择</option>   
						<option value='phone'>电话号码</option>
						<option value='nickname'>员工名</option>
						<option value='email'>邮箱</option>
						<option value='location'>负责区域</option>      
					</select>
					<br />
					<input id="infoo" value="" placeholder="在此输入修改信息"; style="font-size: 25px; width: 99%; height: 30px; border: black solid 1px;" type="text" />
				</td>
				<td>
					<a href="javascript:update_staff();" class="weui-btn weui-btn_mini weui-btn_default">更改</a>
				</td>
			</tr>
			<tr>
				<td>
					<b>结算员工工资：</b>
				</td>
				<td>
					<select style="width: 100px; height: 30px;"  id="Clearing" > 
						<option value='default' style="color: #AAAAAA;" selected="selected">此处选择</option>     
						<?php
							foreach($staffnames as $val){
								echo "<option value='".$val."'>".$val."</option>";
							}	
						?> 
					</select>
				</td>
				<td>
					<a href="javascript:clearing_salary();" class="weui-btn weui-btn_mini weui-btn_default">结算</a>
				</td>
			</tr>
			<tr>
				<td>
					<b>删除当前员工：</b>
				</td>
				<td>
					<select style="width: 100px; height: 30px;"  id="delete" >
						<option value='default' style="color: #AAAAAA;" selected="selected">此处选择</option>      
						<?php
							foreach($staffnames as $val){
								echo "<option value='".$val."'>".$val."</option>";
							}	
						?>    
					</select>
				</td>
				<td>
					<a href="javascript:delete_staff();" class="weui-btn weui-btn_mini weui-btn_warn">删除</a>
				</td>
			</tr>
		</table>
		
		<br />
		
		<a href="staff_register.php" class="weui-btn weui-btn_default"><b>员工注冊通道</b></a>
		
		<br />
		
		<h3><center><b>员工业绩饼状图(单量)👇</b></center></h3>
		
		<canvas id="myChart" width="300" height="400"></canvas>
		
		<br />
		
		<br />
		
		<h3><center><b>员工总收入柱状图👇</b></center></h3>
		
		<canvas id="myChart1" width="300" height="400"></canvas>
		
		<br />
		
		<a href="../Manager_page.php" class="weui-btn weui-btn_default"><b>返回上一页</b></a>
		<a href="javascript:manager_out_log();" class="weui-btn weui-btn_warn"><b style="color: white;">退出登录</b></a>
		
		<script src="../../Chart.js-2.7.1/dist/chart.js">	
		</script>
		<script src="../../expressage/staff_outlog.js"></script>	
		<script>
			function clearing_salary(){
				var name = document.getElementById("Clearing").value;
				if(name == "default"){
					alert("选择不能为空！");
				}else{
					if(confirm("结算后数据不予恢复，确认将‘"+name+"’的工资置为零吗？若工资本身为 0 结算将报错！")){
						var clearhttp = GetXmlHttpObject();
						var url="/web/manage/Manager_staff/do_clearing_staff.php";
						url = url + "?cl_name=" + name;
						url = url + "&sid="+ Math.random();
						clearhttp.open("POST",url,false);
						clearhttp.send(null);
						if (clearhttp.readyState==4 || clearhttp.readyState=="complete"){ 
							//刷新
							alert(clearhttp.responseText);
							window.location.href = "m_page_staff.php";
						}
					}else{
						return ;
					}
				}
			}

			function delete_staff(){
				var name = document.getElementById("delete").value;
				if(name == "default"){
					alert("选择不能为空！");
				}else{
					if(confirm("删除后，以往个人数据不予恢复，确认将‘"+name+"’剔除员工队列吗？")){
						var deletehttp = GetXmlHttpObject();
						var url="/web/manage/Manager_staff/do_delete_staff.php";
						url = url + "?de_name=" + name;
						url = url + "&sid="+ Math.random();
						deletehttp.open("POST",url,false);
						deletehttp.send(null);
						if (deletehttp.readyState==4 || deletehttp.readyState=="complete"){ 
							//刷新
							alert(deletehttp.responseText);
							window.location.href = "m_page_staff.php";
						}
					}else{
						return ;
					}
				}
			}
			
			function update_staff(){
				var name = document.getElementById("update_name").value;
				var item = document.getElementById("update_item").value;
				var info = document.getElementById("infoo").value;
				if(name == "default"|| item == "default" ||info == ""){
					alert("选择不能为空！");
					return ;
				}else if(item == "email"&&!checkemail(info)){
					alert("邮箱修改错误！");
					return ;
				}else if(item == "phone" && info.length!=11){
					alert("手机号长度有问题！");
					return ;
				}else if(item == "nickname" && info.length>10){
					alert("名称长度错误！");
					return ;
				}else if(item == "location" && !checklocation(info)){
					return ;
				}else{
					if (confirm("一旦修改难以恢复！继续请确认！")) {
						var uphttp = GetXmlHttpObject();
						var url="/web/manage/Manager_staff/do_update_staff.php";
						url = url + "?name=" + name;
						url = url + "&item="+ item;
						url = url + "&info="+ info;
						url = url + "&sid="+ Math.random();
						uphttp.open("POST",url,false);
						uphttp.send(null);
						if (uphttp.readyState==4 || uphttp.readyState=="complete"){ 
							//刷新
							alert(uphttp.responseText);
							window.location.href = "m_page_staff.php";
						}
					}else{
						return ;
					}
				}
				
			}
			
			function checkemail( email_address ){
			 	var regex = /^([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)$/g;
				if ( regex.test( email_address ) ){
			        return true;
				}else{
			        return false;
				}
			}
			
			
			function checklocation(element){
			 	var regex = /^[X|D]\d{1,2}$/;
				if ( regex.test( element ) ){
			        return true;
				}else{
					alert("地址输入错误！")
			        return false;
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
			
			<?php		   
        		function take_datanum($name,$conn){
	        		$i = 1 ;
		       		foreach($name as $val){
		       			$sql = "SELECT work_num FROM staff WHERE nickname = '".$val."'";
		       			$result = $conn->query($sql);
		       			$row = mysqli_fetch_Array($result);
		       			echo $row["work_num"];
		        		if($i<count($name))
	        			{
	        				echo ",";	
	        				$i++;
	        			}
		        	}
	        	}
	        	
	        	function take_datanum1($name,$conn){
	        		$i = 1 ;
		       		foreach($name as $val){
		       			$sql = "SELECT total_salary FROM staff WHERE nickname = '".$val."'";
		       			$result = $conn->query($sql);
		       			$row = mysqli_fetch_Array($result);
		       			echo $row["total_salary"];
		        		if($i<count($name))
	        			{
	        				echo ",";	
	        				$i++;
	        			}
		        	}
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
		        	
		        	take_dataname($staffnames);		        			        	
		       	?>
		       ],
		        datasets: [{
		            label: '# of Votes',
		            data: [
		            //2, 5, 4, 3, 2, 1
		            
		            <?php
			        	take_datanum($staffnames,$con);		            	
		            ?>
		            
		            ],
		            backgroundColor: [
		            	<?php $txt = rand_color($staffnames);?>
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
			       	take_dataname($staffnames);		        			        	
		       	?>
		       ],
		        datasets: [{
		            label: 'RMB',
		            data: [
		            //2, 5, 4, 3, 2, 1
		            
		            <?php
			        	take_datanum1($staffnames,$con);		            	
		            ?>
		            
		            ],
		            backgroundColor: [
		            	<?php $txt = rand_color($staffnames);?>
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
	











