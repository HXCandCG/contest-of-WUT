function out_log(){
	var temp = confirm("确定取消登录吗？取消后下次登录需要重新输入帐号密码！");
	if(temp){
		var outhttp = GetXmlHttpObject();
		var url="/web/expressage/staff_out_log.php";
		url = url + "?sid="+ Math.random();
		outhttp.open("POST",url,false);
		outhttp.send(null);
		if (outhttp.readyState==4 || outhttp.readyState=="complete"){
			if(outhttp.responseText=="success"){
				window.location.href = "Courier_log.php";
			}
		}
	}
}

function manager_out_log(){
	var temp = confirm("确定取消登录吗？取消后下次登录需要重新输入帐号密码！");
	if(temp){
		var outhttp = GetXmlHttpObject();
		var url="/web/expressage/staff_out_log.php";
		url = url + "?sid="+ Math.random();
		outhttp.open("POST",url,false);
		outhttp.send(null);
		if (outhttp.readyState==4 || outhttp.readyState=="complete"){
			if(outhttp.responseText=="success"){
				window.location.href = "../../expressage/Courier_log.php";
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