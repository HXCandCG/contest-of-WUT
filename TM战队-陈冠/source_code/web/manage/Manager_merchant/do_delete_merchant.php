<?php
	$merchant_de_name = $_GET["de_name"];
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'codepay';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	
	if (!empty($merchant_de_name)) {
		$sql = "DELETE FROM merchant WHERE merchant_name = '".$merchant_de_name."'";
		$con->query($sql);
		if(mysqli_affected_rows($con)!=0){	
			$sql = "DELETE FROM menu WHERE isfrom = '".$merchant_de_name."'";
			$con->query($sql);
			if(mysqli_affected_rows($con)!=0){
				if(delDirAndFile("../../../web/img/"."$merchant_de_name",1)){
					mysqli_close($con);
					echo $merchant_de_name."商户删除成功！";	
				}else{
					echo "图片目录删除错误！ 请联系15171801220！";
				}
			}
			else{
				echo "删除菜品错误！ 请联系15171801220！";
			}
		}else{
			echo "删除商户错误！ 请联系15171801220！";
		}
	}	
	
	function delDirAndFile($path, $delDir = TRUE) {
    $handle = opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir)
            return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
}
?>