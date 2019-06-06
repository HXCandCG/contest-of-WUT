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
	
	$merchant_name = $_GET["inserting"];
	$goods_name = array();
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>菜单操作页面</title>
		<style type="text/css">
			img{
				width: 100%;
				height: 150px;
			}
			input,select{
				font-size: 23px; 
				width: 99%; 
				height: 33px; 
				border: black solid 1px;
			}
			.file{ position:absolute; top:0; right:80px; height:24px; filter:alpha(opacity:0);opacity: 0;width:260px }
		</style>
		<link rel="stylesheet" href="../../css/Btn.css" />
		<link rel="stylesheet" type="text/css" href="../../css/table.css"/>
	</head>
	<body>
		<center><h1><b><?php echo $merchant_name;?>商品展示👇</b></h1></center>
		<table class='gridtable'>
			<?php 
				$sql = "SELECT * FROM menu WHERE isfrom = '".$merchant_name."' ORDER BY menu_price ASC";
				$temp = 0;
				$result = $con->query($sql);
				echo "
						<tr>
							<th><b>菜名<b></th>
							<th><b>图片<b></th>
							<th><b>价格<b></th>
						</tr>";
				while($row = mysqli_fetch_Array($result)){
					array_push($goods_name,$row['menu_name']);
					echo '
						<tr> 
							<td><h3>'.$row["menu_name"].'</h3></td>
							<td><img src="'.$row["menu_imgUrl"].'"></td>
							<td><b>'.$row["menu_price"].'￥<b></td>
						</tr>
					';
				}
			?>
		</table>
		</br>
		
		<center><h1><b><?php echo $merchant_name;?>商品操作👇</b></h1></center>
		<table class='gridtable'>
			<tr>
				<td><b>菜品添加</b></td>
				<td>
				    <center><h2><b>菜品名称编辑👇</b></h2></center>
				    <input id="name" value="" placeholder="输入菜品名"; type="text" />
				    <center><h2><b>菜品价格编辑👇</b></h2></center>
				    <input id="price" value="" placeholder="输入菜品价格"; type="text" />
				    <center><h2><b>菜品种类选择👇</b></h2></center>
				    <select name="type" id="type">
				    	<option value="default">种类选择</option>
				    	<option value="1">食品</option>
				    	<option value="2">饮品</option>
				    	<option value="3">烟/日杂</option>
				    </select>
				    <center><h2><b>菜品图片选择预览👇</b></h2></center>
				    <span onclick="file.click()"  class="weui-btn weui-btn_default">浏览手机图片...</span>
				    <input type="file" name="file" class="file" id="file" size="28" accept="image/*" onchange="loadImageFile()" />
				    </br>
				    <img id="uploadPreview"/>
    			</td>
				<td><a href="javascript:UpladFile();" class="weui-btn weui-btn_mini weui-btn_primary"><b>添加</b></a></td>
			</tr>
			<tr>
				<td><b>商品价格修改</b></td>
				<td>
					<select id="update">
						<option value="default">选择商品名</option>
						<?php
							foreach($goods_name as $val){
								echo "<option value='".$val."'>".$val."</option>";
							}
							
						?>
					</select>
					<input id="infoo" value="" placeholder="输入修改价格"; type="text" />
				</td>
				<td><a href="javascript:updategoods();" class="weui-btn weui-btn_mini weui-btn_default"><b>修改</b></a></td>
			</tr>
			<tr>
				<td><b>商品删除</b></td>
				<td>
					<select id="delete">
						<option value="default">选择删除菜名</option>
						<?php
							foreach($goods_name as $val){
								echo "<option value='".$val."'>".$val."</option>";
							}
							
						?>
					</select>
				</td>
				<td><a href="javascript:deletegoods();" class="weui-btn weui-btn_mini weui-btn_warn"><b>删除</b></a></td>
			</tr>
		</table>
		
		</br>
		
		<center><h1><b>菜品销量环状图👇</b></h1></center>
		<canvas id="myChart" width="300" height="400"></canvas>
		
		</br>
		
		<a href="m_page_merchant.php" class="weui-btn weui-btn_default"><b>返回上一页</b></a>
	</body>
	
	<script src="../../Chart.js-2.7.1/dist/chart.js">	
	</script>
	<script type="text/javascript">
		function updategoods(){
				var name = document.getElementById("update").value;
				var info = document.getElementById("infoo").value;
				if(name == "default"||info == ""){
					alert("选择不能为空！");
					return ;
				}else{
					if (confirm("确认将"+name+"价格修改成"+info+"￥?")) {
						var updhttp = GetXmlHttpObject();
						var url="/web/manage/Manager_merchant/goods_upd.php";
						url = url + "?name=" + name;
						url = url + "&info="+ info;
						url = url + "&sid="+ Math.random();
						updhttp.open("POST",url,false);
						updhttp.send(null);
						if (updhttp.readyState==4 || updhttp.readyState=="complete"){ 
							//刷新
							alert(updhttp.responseText);
							location.reload();
						}
					}else{
						return ;
					}
				}
				
			}
		
		function deletegoods(){
			var goodsname = document.getElementById("delete").value;
			if(goodsname=="default"){
				alert("输入不能为空！");
				return ;
			}else{
				if(confirm("删除后，以往菜品统计数据不予恢复，确认将‘"+goodsname+"’下架吗？")){
					var delhttp = GetXmlHttpObject();
					var url="/web/manage/Manager_merchant/goods_del.php";
					url = url + "?de_name=" + goodsname;
					url = url + "&sid="+ Math.random();
					delhttp.open("POST",url,false);
					delhttp.send(null);
					if (delhttp.readyState==4 || delhttp.readyState=="complete"){ 
						var result = delhttp.responseText;
						alert(result);
						location.reload();
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
		
		var xhr;
	    function createXMLHttpRequest()
	    {
	        if(window.ActiveXObject)
	        {
	            xhr = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        else if(window.XMLHttpRequest)
	        {
	            xhr = new XMLHttpRequest();
	        }
	    }
	    
	    function UpladFile()
	    {
	    	var name = document.getElementById("name").value;
	    	var price = document.getElementById("price").value;
	    	var type = document.getElementById("type").value;
	    	var txt_url = document.getElementById("file").value;
	    	if(name==""||price==""||type=="default"||txt_url==""){
	    		alert("选项不能为空！");
	    		return ;
	    	}else{
	    		var fileObj = document.getElementById("file").files[0];
		        var url = '/web/manage/Manager_merchant/goods_add.php';
		        url = url + "?name=" + name;
		        url = url + "&price=" + price;
		        url = url + "&type=" + type;
		        url = url + "&isfrom=" + "<?php echo $merchant_name; ?>";
		        url = url + "&sid="+ Math.random();
		        var form = new FormData();
		        form.append("myfile", fileObj);
		        createXMLHttpRequest();
		        xhr.onreadystatechange = handleStateChange;
		        xhr.open("post", url, true);
		        xhr.send(form);
	    	}
	        
	    }
	    function handleStateChange()
	    {
	        if(xhr.readyState == 4)
	        {
	            if (xhr.status == 200 || xhr.status == 0)
	            {
	                var result = xhr.responseText;
	                if(result == "pic_fal"){
	                	alert("图片添加失败！");
	                	return ;
	                }else if(result == "god_fal"){
	                	alert("菜品添加失败！");
	                	return ;
	                }else{
	                	alert("操作成功！");
	                	window.location.href = result;
	                }
	               
	                
	            }
	        }
	    }
	    oFReader = new FileReader();
	    
	    oFReader.onload = function(oFREvent){
	    	document.getElementById("uploadPreview").src = oFREvent.target.result;
	    }
	    
	    function loadImageFile(){
	    	if(document.getElementById("file").files.length === 0){return ;}
	    	var oFile = document.getElementById("file").files[0];
	    	oFReader.readAsDataURL(oFile);
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
	    type: 'doughnut',
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
	        	
	        	take_dataname($goods_name);		        			        	
	       	?>
	       ],
	        datasets: [{
	            label: '售出量',
	            data: [
	            //2, 5, 4, 3, 2, 1
	            
	            <?php
	            	function take_datanum($name,$conn){
		        		$i = 1 ;
			       		foreach($name as $val){
			       			$sql = "SELECT sell_number FROM menu WHERE menu_name = '".$val."'";
			       			$result = $conn->query($sql);
			       			$row = mysqli_fetch_Array($result);
			       			echo $row["sell_number"];
			        		if($i<count($name))
		        			{
		        				echo ",";	
		        				$i++;
		        			}
			        	}
		        	}
		        	
		        	take_datanum($goods_name,$con);		            	
	            ?>
	            
	            ],
	            backgroundColor: [
	            	<?php $txt = rand_color($goods_name);?>
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