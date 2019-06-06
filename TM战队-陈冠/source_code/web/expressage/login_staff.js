var logHttp = GetXmlHttpObject();
var auto_log = document.getElementById("autoLogin");
var login = document.getElementById("login");
var remember = document.getElementById("autoLogin").className;

auto_log.onclick = function() {
	remember = document.getElementById("autoLogin").className;
}

login.onclick = function() {
	var phone = document.getElementById("phone").value;
	var Password = document.getElementById("password").value;
	if(phone == "" || Password == "") {
		alert("手机号和密码都不能为空！");
		return;
	} else {
		var url = "/web/expressage/loging_staff.php";
		url = url + "?phone=" + phone;
		url = url + "&password=" + Password;
		url = url + "&remember=" + remember;
		url = url + "&sid=" + Math.random();
		logHttp.open("POST", url, false);
		logHttp.send(null);
		if(logHttp.readyState == 4 || logHttp.readyState == "complete") {
			var txt = logHttp.responseText;
			if(txt == "sucess") {
				window.location.href = "staff_page.php";
			} else if(txt == "administrator") {
				window.location.href = "../manage/Manager_page.php";
			} else if(txt == "手机号或密码不正确") {
				alert(txt);
			}
		}
	}
}

function GetXmlHttpObject() {
	var xmlHttp = null;
	try {
		xmlHttp = new XMLHttpRequest();
	} catch(e) {
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch(e) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}