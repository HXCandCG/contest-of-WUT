<?php
	session_start();
	require_once("staff_checkloginStatus.php");
	require_once("getStaffInfo.php");
	staff_checklogin();
	$staff = $_SESSION["staff_info"];
	if($staff["phone"]=="17671701468"){
		header("location:/web/manage/Manager_page.php");
	}
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>工作页面</title>
		<style type="text/css">
			@import url("../css/Btn.css");
			@import url("../css/staff.css");
		</style>
		
	</head>
	


	<body>
		<center> 
			<h1> 起步不易&nbsp;共勉克难 </h1>
			<h2> <?php echo $staff["nickname"];?> 欢迎回来!</h2>
		</center>
		
		<?php
			$dbhost = 'localhost:3306';
			$dbuser = 'root';
			$dbpass = 'HXCg0402.';
			$dbname = 'codepay';
			$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
			if(! $con) {
				echo 'Could not connect';
			}
			$sql = "SELECT * FROM undelivered WHERE ord_location = '".$staff["location"]."' ORDER BY ord_time ASC ";
			$result = $con->query($sql);		
			
			function tostring($str){
				$res = array();
				$z = explode("|",$str);
				array_shift($z);
				array_pop($z);
				$num = array_count_values($z);
				$z = array_unique($z);
				$res = "";
				foreach($z as $value){
					$res .=  "<p class='plan-dishes'>".$value." X ".$num[$value]."</p>";
				}
				return $res;
			}		
		?>
		<div class="plans">
		    <?php
		    	while($row = mysqli_fetch_Array($result)){
		    		echo 
		    		'
		    			<div class="plan">
					     	<h3 class="plan-title">'.$row["ord_name"].'</h3>
					      	'.tostring($row["ord_content"]).'
					      	<span class="plan-unit">Tel:'.$row["ord_phone"].'</span>
					      	<ul class="plan-features">
					      		<span class="plan-feature-name"> 楼号</span>
					       	 	<li class="plan-feature">'.$row["ord_location"].'</li>
					       	 	<span class="plan-feature-name"> 寝室号</span>
					       	 	<li class="plan-feature">'.$row["ord_sroom"].'</li>
					       	 	<span class="plan-feature-name"> 本单收入</span>
					        	<li class="plan-feature">'.$row["ord_delifee"].' ￥</li>
					        	<span class="plan-feature-name"> 下单日期</span>
					        	<li class="plan-feature">'.date('m月d日',strtotime($row["ord_time"])).'</li>
					        	<span class="plan-feature-name"> 下单时间</span>
					        	<li class="plan-feature">'.date('H:i',strtotime($row["ord_time"])).'</li>
					      	</ul>
					      	<a id="'.$row["id"].'" onclick = "deli_btn(this);" class="plan-button"><b>确认送达</b></a>
					    </div>
		    		';
		    	}
		    	?>
		</div>
		
		
		 		
		<a href="javascript:out_log();" class="weui-btn weui-btn_warn"><b style="color: white;">退出登录</b></a>
		<div style="height: 60px;"></div>	
		<div class="navsss">
			<td>
				<font style=" position: absolute; top: 5px;" class="fontt" color="#FFFFFF" size="5">
					未结工资:<span id="unsettle">0.0</span>￥
				</font>
				</br>
				<font  style=" position: absolute; bottom: 8px;" class="fontt" color="#FFFFFF" size="5">
					总收入:<span id="total">0.0</span>￥
				</font>
			</td>
			<a id="fresh" class="fresh weui-btn weui-btn_primary"><b>刷新订单</b></a>
		</div>	
	</body>
	<script src="staff_outlog.js"></script>
	<script type="text/javascript">	
		showSalary();
		document.getElementById("fresh").onclick =function(){
			window.location.href = "/web/expressage/staff_page.php?sid="+Math.random();
		}
		
		
		function showSalary(){
			var salaryhttp = GetXmlHttpObject();
			var url="/web/expressage/show_salary.php";
			url = url + "?name="+ "<?php echo $staff['nickname']; ?>";
			url = url + "&sid="+ Math.random();
			salaryhttp.open("POST",url,false);
			salaryhttp.send(null);
			if (salaryhttp.readyState==4 || salaryhttp.readyState=="complete"){ 
				var arr_salary = salaryhttp.responseText.split("|");
				document.getElementById("unsettle").innerHTML = arr_salary[0];
				document.getElementById("total").innerHTML = arr_salary[1];
			}
		}
		
		
		
		
		
		function deli_btn(element){
			var sure =  confirm("确认后，后台有实时记录，你将承担本单配送全部责任，请核实后点击！");
			if(!sure){
				return ;
			}else if(sure){
				var id = element.id;
				var surehttp = GetXmlHttpObject();
				var url="/web/expressage/ordTransfer.php";
				url = url + "?id=" + id;
				url = url + "&staff_name="+ "<?php echo $staff['nickname']; ?>";
				url = url + "&sid="+ Math.random();
				surehttp.open("POST",url,false);
				surehttp.send(null);
				if (surehttp.readyState==4 || surehttp.readyState=="complete"){ 
					if(surehttp.responseText != "ok"){
						alert(surehttp.responseText);
						return ;
					}else if(surehttp.responseText=="ok"){
						location.reload(true);
						return ;
					}
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
	</script>
	<?php mysqli_close($con); ?>
</html>