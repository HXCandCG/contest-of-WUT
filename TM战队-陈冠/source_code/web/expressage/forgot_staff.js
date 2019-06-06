var getback_btn = document.getElementById("getback");

getback_btn.onclick = function(){
	var forget_phone = document.getElementById("forget_phone").value;
	var forget_email = document.getElementById("forget_email").value;
	var newPassword = document.getElementById("newPassword").value;
	var newrepeatPassword = document.getElementById("newrepeatPassword").value;
	var vertificationCode = validateCode();
	if(!vertificationCode){
		return ;
	}else if(forget_phone==""||forget_email==""||newrepeatPassword==""||newPassword==""){
		alert("输入为空！");
		createCode();
		return ;
	}else if(newPassword!=newrepeatPassword){
		alert("两次密码输入不一致！");
		createCode();
		return ;
	}else if(forget_phone.length!=11){
		alert("手机号长度有问题！");
		createCode();
		return ;
	}else if(!checkemail(forget_email)){
		alert("邮箱输入有误！");
		createCode();
		return ;
	}else{
		var backhttp = GetXmlHttpObject();
		var url="/web/expressage/callback_staff.php";
		url = url + "?forget_phone=" + forget_phone;
		url = url + "&forget_email=" + forget_email;
		url = url + "&newPassword=" + newPassword;
		url = url + "&sid="+ Math.random();
		backhttp.open("POST",url,false);
		backhttp.send(null);
		if (backhttp.readyState==4 || backhttp.readyState=="complete"){ 
			var responseTxt = backhttp.responseText;
			if(responseTxt=="手机号邮箱匹配错误！"){
				alert(responseTxt);
				createCode();
				return ;
			}else{
				alert(responseTxt);
				window.location.href = "Courier_log.php";
			}
		}
	}
	
}

function checkemail( email_address ){
 	var regex = /^([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)$/g;
	if ( regex.test( email_address ) ){
        return true;
	}else{
        return false;
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

var code;
function createCode() {
    code = "";
    var codeLength = 6; //验证码的长度
    var checkCode = document.getElementById("checkCode");
    var codeChars = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 
    'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'); //所有候选组成验证码的字符，当然也可以用中文的
    for (var i = 0; i < codeLength; i++) 
    {
        var charNum = Math.floor(Math.random() * 52);
        code += codeChars[charNum];
    }
    if (checkCode) 
    {
        checkCode.className = "code";
        checkCode.innerHTML = code;
    }
    document.getElementsByClassName("code")[0].style.backgroundImage = "url(../img/verication_Imag/ver"+String(parseInt(Math.random()*10))+".jpg)";
}


function validateCode() 
{
    var inputCode = document.getElementById("inputCode").value;
    if (inputCode.length <= 0) 
    {
        alert("请输入验证码！");
        return false;
    }
    else if (inputCode.toUpperCase() != code.toUpperCase()) 
    {
        alert("验证码输入有误！");
        createCode();
        return false;
    }
    else 
    {
        return true;
    }        
}