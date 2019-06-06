showSalary();
document.getElementById("fresh").onclick =function(){
	window.location.href = "/web/expressage/staff_page.php?sid="+Math.random();
}


function showSalary(){
	var salaryhttp = GetXmlHttpObject();
	var url="/web/expressage/show_salary.php";
	url = url + "?name="+ "<?php echo $staff['nickname']; ?>";
	url = url + "&sid="+ Math.random();
	salaryhttp.open("POST",url,false);
	salaryhttp.send(null);
	if (salaryhttp.readyState==4 || salaryhttp.readyState=="complete"){ 
		var arr_salary = salaryhttp.responseText.split("|");
		document.getElementById("unsettle").innerHTML = arr_salary[0];
		document.getElementById("total").innerHTML = arr_salary[1];
	}
}





function deli_btn(element){
	var sure =  confirm("确认后，后台有实时记录，你将承担本单配送全部责任，请核实后点击！");
	if(!sure){
		return ;
	}else if(sure){
		var id = element.id;
		var surehttp = GetXmlHttpObject();
		var url="/web/expressage/ordTransfer.php";
		url = url + "?id=" + id;
		url = url + "&staff_name="+ "<?php echo $staff['nickname']; ?>";
		url = url + "&sid="+ Math.random();
		surehttp.open("POST",url,false);
		surehttp.send(null);
		if (surehttp.readyState==4 || surehttp.readyState=="complete"){ 
			if(surehttp.responseText != "ok"){
				alert(surehttp.responseText);
				return ;
			}else if(surehttp.responseText=="ok"){
				location.reload(true);
				return ;
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