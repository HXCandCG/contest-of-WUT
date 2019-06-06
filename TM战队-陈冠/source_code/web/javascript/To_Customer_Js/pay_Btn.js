var Menu_Text = new Array();
var total_price = 0.00;
var deli_fee = 0.00;
var total_num = 0;
var order_content = "|";

document.getElementById("pay").onclick = function (){
	if(total_price==0||total_num==0||order_content=="|"){//||deli_fee==0
		alert("请先下单吧~");
		return ;
	}else{
		allprice = total_price+deli_fee;
		var temphttp = GetXmlHttpObject();
		var url="/web/tomysql/insert_order/temp_order.php";
		url = url + "?temp_nickname=" + user;
		url = url + "&temp_order="+ order_content;
		url = url + "&temp_totalprice="+ allprice;
		url = url + "&temp_delifee="+ deli_fee;
		url = url + "&loc="+ loc;
		url = url + "&sro="+ sro;
		url = url + "&sid="+ Math.random();
		temphttp.open("POST",url,false);
		temphttp.send(null);
		if (temphttp.readyState==4 || temphttp.readyState=="complete"){ 
			if(temphttp.responseText == "fail"){
				alert("程序错误！请联系15171801220！");
				return ;
			}else if(temphttp.responseText=="ok"){
				window.location.href = "codepay/demo.php";
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
