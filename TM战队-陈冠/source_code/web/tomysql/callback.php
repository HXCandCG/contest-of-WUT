<?php
//"?forget_phone=" + forget_phone;
//"&forget_email=" + forget_email;
//"&newPassword=" + newPassword;
	$forget_phone = $_GET["forget_phone"];
	$forget_email = $_GET["forget_email"];
	$newPassword = md5($_GET["newPassword"]);
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	$sql = "UPDATE customer SET passkey = '$newPassword' WHERE phone = '$forget_phone' AND email = '$forget_email'";
	$con->query($sql);
	if(mysqli_affected_rows($con)!=0){
		echo "新密码修改成功！";
	}else{
		echo "手机号邮箱匹配错误！";
	}
	mysqli_close($con);
?>