<?php
	$goods_de_name = $_GET["de_name"];
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	$sql = "SELECT menu_imgUrl FROM menu WHERE menu_name = '".$goods_de_name."'";
	$result = $con->query($sql);
	$row = mysqli_fetch_Array($result);
	if (!empty($goods_de_name)) {
		$sql = "DELETE FROM menu WHERE menu_name = '".$goods_de_name."'";
		$con->query($sql);
		if(mysqli_affected_rows($con)!=0){
			if(unlink("../../..".$row["menu_imgUrl"])){
				echo $goods_de_name."商品删除成功！";	
				mysqli_close($con);
			}else{
				echo "图片删除错误！请联系15171801220!";	
			}
		}else{
			echo "删除错误！ 请联系15171801220！";
		}
	}
?>