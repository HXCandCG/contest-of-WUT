<?php
	$startTime = $_GET["startTime"];
	$endTime = $_GET["endTime"];
	$Time = $_GET["Time"];
	

	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	$res = "";
	$allitem = "";
	if(empty($startTime)||empty($endTime)){
		$sql ="SELECT * FROM undelivered";
	}else{
		$sql ="SELECT * FROM undelivered WHERE ord_time>'".$Time." ".$startTime.":00"."' and ord_time<'".$Time." ".$endTime.":00"."' order by ord_time ASC";	
	}
	
	$result = $con->query($sql);
	$res .= "<table width='100%' class='gridtable'><tr>";
	$res .= "<th>客户</th>";
	$res .= "<th>电话/时间</th>";
	$res .= "<th>地址</th>";
	$res .= "<th>价格</th>";
	$res .= "<th>配送费</th>";
	$res .= "<th>内容</th>";
	$res .= "</tr>";
	while($row = mysqli_fetch_Array($result)){
		$res .= "<tr>";
		$res .= "<td>".$row['ord_name']."</td>";
		$res .= "<td>".$row['ord_phone']."</br>".date("H:i:s",strtotime($row['ord_time']))."</td>";
		$res .= "<td>".$row['ord_location']."|".$row['ord_sroom']."</td>";
		$res .= "<td>".$row['ord_price']."</td>";
		$res .= "<td>".$row['ord_delifee']."</td>";
		$res .= "<td>".doContent($row['ord_content'])."</td>";
		$res .= "</tr>";
		$allitem .= $row['ord_content'];
	}
	
	$res .= "</table>";
	$res .= "<center><h3>".$startTime."—".$endTime."商品需求统计👇<h3></center>";
	$res .= "<table border='1px'><tr><td>".doContent($allitem)."</td></tr></table>";
	
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
	
	echo $res;
	mysqli_close($con);
?>