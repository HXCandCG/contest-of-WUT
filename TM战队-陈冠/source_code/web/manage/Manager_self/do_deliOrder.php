<?php
	$timer = $_GET["timer"];
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	$ress = "";
	$ress .= "<tr>";
	$ress .= "<th>客户</th>";
	$ress .= "<th>电话/时间</th>";
	$ress .= "<th>地址</th>";
	$ress .= "<th>价格</th>";
	$ress .= "<th>配送费</th>";
	$ress .= "<th>内容</th>";
	$ress .= "</tr>";
	
	if($timer == ""){
		$sql = "SELECT * FROM delivered ORDER BY ord_time DESC";
	}else{
		$sql = "SELECT * FROM delivered WHERE ord_time >= '".$timer." 00:00:00' AND ord_time <= '".$timer." 23:59:59' ORDER BY ord_time DESC";	
	}
	$ressult = $con->query($sql);
	while($row = mysqli_fetch_Array($ressult)){
		$ress .= "<tr>";
		$ress .= "<td>".$row['ord_name']."</td>";
		$ress .= "<td>".$row['ord_phone']."</br>".$row['ord_time']."</td>";
		$ress .= "<td>".$row['ord_location']."|".$row['ord_sroom']."</td>";
		$ress .= "<td>".$row['ord_price']."</td>";
		$ress .= "<td>".$row['ord_delifee']."</td>";
		$ress .= "<td>".doContent($row['ord_content'])."</td>";
		$ress .= "</tr>";
		$ress .= "<tr>";
		$ress .= "<th>配送员</th>";
		$ress .= "<td>".$row['nickname']."</td>";
		$ress .= "</tr>";
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
	
	echo $ress;
	mysqli_close($con);	
?>