function update_location(){
	var locat = document.getElementById("location").value;
	var sroom = document.getElementById("sroom").value;
	if(locat!="default"&&sroom!=""){
		if(confirm("确定更换地址为"+locat+"栋"+sroom+"室吗？")){
			var uplocathttp = GetXmlHttpObject();
			var url="/web/tomysql/updatelocat.php";
			url = url + "?nickname=" + user;
			url = url + "&locat=" + locat;
			url = url + "&sroom=" + sroom;
			url = url + "&sid="+ Math.random();
			uplocathttp.open("POST",url,false);
			uplocathttp.send(null);
			if (uplocathttp.readyState==4 || uplocathttp.readyState=="complete"){ 
				alert(uplocathttp.responseText);
				window.location.href = "Customer.php";
			}
		}else{
			return ;
		}
	}else{
		alert("更改内容不能为空！");
		return ;
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