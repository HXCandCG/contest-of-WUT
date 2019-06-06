<?php
	session_start();
	require_once("staff_checkloginStatus.php");
	require_once("getStaffInfo.php");
	staff_checklogin();
	$staff = $_SESSION["staff_info"];
	$id = $_GET["id"];
	$name = $_GET["staff_name"];
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}else{
		$sql = "SELECT * FROM undelivered WHERE id = ".$id;
		$result = $con->query($sql);
		$un_ord = mysqli_fetch_Array($result);
		if($un_ord[0]==null){
			echo "查询错误 请联系15171801220";
		}else{
			$sql = "UPDATE staff set salary = salary + ".$un_ord['ord_delifee']."  WHERE nickname = '".$name."'";
			$con->query($sql);
			if(mysqli_affected_rows($con)==0&&$un_ord["ord_delifee"]!=0){
				echo "更新错误1 请联系15171801220";
			}else{
				$sql = "UPDATE staff set total_salary = total_salary + ".$un_ord['ord_delifee']."  WHERE nickname = '".$name."'";
				$con->query($sql);
				if(mysqli_affected_rows($con)==0&&$un_ord["ord_delifee"]!=0){
					echo "更新错误2 请联系15171801220";
				}else{
					$sql = "UPDATE staff set work_num = work_num + 1  WHERE nickname = '".$name."'";
					$con->query($sql);
					if(mysqli_affected_rows($con)==0&&$un_ord["ord_delifee"]!=0){
						echo "更新错误3 请联系15171801220";
					}else{
						if(($res=clearingFormerchant($un_ord['ord_content'],$con))!='ok'){
							echo $res;
						}else{
							$sql = 
							"INSERT INTO delivered VALUES 
							(NULL,'".$un_ord["ord_name"]."','".$un_ord["ord_phone"]."','".$un_ord["ord_location"]."','".$un_ord["ord_sroom"]."','".$un_ord["ord_time"]."',".$un_ord["ord_price"].",".$un_ord['ord_delifee'].",'".$un_ord['ord_content']."','".$name."')";
							if($con->query($sql)){
								$sql = "DELETE FROM undelivered WHERE id = ".$id;
								$con->query($sql);
								if(mysqli_affected_rows($con)==0){
									echo "删除错误 请联系15171801220";
								}else{
									if(($res=statisticsSales($un_ord['ord_content'],$con))!="ok"){
										echo $res;
									}else{
										echo "ok";	
									}
								}
							}else{
								echo "插入错误 请联系15171801220";
							}
						}
					}
				}
			}
		}	
	}
	
	function statisticsSales($str,$conn){
		$the_result = "";
		$z = explode("|",$str);
		array_shift($z);
		array_pop($z);
		$num = array_count_values($z);
		$z = array_unique($z);
		foreach($z as $value){
			$sql = "SELECT isfrom FROM menu WHERE menu_name = '".$value."'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_Array($result);
			if($row['isfrom']==null){
				$the_result = "菜品来源查询错误！请联系15171801220";
			}else{
				$merchant_name = $row['isfrom'];
				$sql ="UPDATE merchant set sales = sales+ ".$num[$value]." WHERE merchant_name = '".$merchant_name."'";
				$conn->query($sql);
				if(mysqli_affected_rows($conn)==0){
					$the_result = '商户销量更新错误！ 请联系15171801220！';
				}else{
					$the_result = "ok";
				}
			}
		}
		return $the_result;
	}
	
	
	function clearingFormerchant($str,$conn){
		$the_result = "";
		$z = explode("|",$str);
		array_shift($z);
		array_pop($z);
		$num = array_count_values($z);
		$z = array_unique($z);
		foreach($z as $value){
			$sql = "SELECT menu_price FROM menu WHERE menu_name = '".$value."'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_Array($result);
			if($row['menu_price'] == null){
				$the_result = '菜品价格查询错误！ 请联系15171801220！';
			}else{
				$price = $row['menu_price'];
				$sql = "SELECT price_spread FROM merchant,menu WHERE menu_name = '".$value."' AND merchant_name = isfrom";
				$result = $conn->query($sql);
				$row = mysqli_fetch_Array($result);
				if($row['price_spread'] == null){
					$the_result = '商户差价查询错误！ 请联系15171801220！';
				}else{
					$spread = $row['price_spread'];
					$sql = "SELECT merchant_name FROM merchant,menu WHERE menu_name = '".$value."' AND merchant_name = isfrom";
					$result = $conn->query($sql);
					$row = mysqli_fetch_Array($result);
					if($row['merchant_name'] == null){
						$the_result = '商户名查询错误！ 请联系15171801220！';
					}else{
						$merchant_name = $row['merchant_name'];
						$sql = "UPDATE merchant set cope_with = cope_with+(".$price."-".$spread.")*".$num[$value].",total_cope = total_cope+(".$price."-".$spread.")*".$num[$value]."
						WHERE merchant_name = '".$merchant_name."'";
						$conn->query($sql);
						
						if(mysqli_affected_rows($conn)==0){
							$the_result = '商户收入更新错误！ 请联系15171801220！';
						}else{
							$nowDate = date("Y-m")."-01";
							$sql = "UPDATE earning set earn_total = earn_total+".$spread."*".$num[$value].",earn_not_yet = earn_not_yet+".$spread."*".$num[$value]."
							WHERE earn_time = '".$nowDate."'";
							$conn->query($sql);
							
							if(mysqli_affected_rows($conn)==0){
								$the_result = '我方收入更新错误！ 请联系15171801220！';
							}else{
								$sql = "UPDATE menu set sell_number = sell_number + ".$num[$value]." WHERE menu_name = '".$value."'";
								$conn->query($sql);
								if(mysqli_affected_rows($conn)==0){
									$the_result = '卖出菜品数量更新错误！ 请联系15171801220！';
								}else{
									$the_result = "ok";
								}
							}	
						}
					}					
				}
			}
		}
		return $the_result;
	}
	
?>