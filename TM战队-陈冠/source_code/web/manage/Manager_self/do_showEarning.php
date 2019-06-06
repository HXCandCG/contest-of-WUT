<?php
	$month = $_GET["month"];
	

	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	$res = "";
	$year = date("Y");
	$sql ="SELECT * FROM earning WHERE earn_time = '".$year."-".$month."-01'";
	$result = $con->query($sql);
	$res .= "<tr>";
	$res .= "<th>本月总收入</th>";
	$res .= "<th>未结算收入</th>";
	$res .= "<th>已结算收入</th>";
	$res .= "</tr>";
	$row = mysqli_fetch_Array($result);
	
	$res .= "<tr>";
	$res .= "<td>".$row['earn_total']."</td>";
	$res .= "<td>".$row['earn_not_yet']."</td>";	
	$res .= "<td>".$row['earn_yet']."</td>";
	$res .= "</tr>";

	
	echo $res;
	mysqli_close($con);
?>