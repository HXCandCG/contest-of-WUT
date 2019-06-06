window.onload = function() {
	var DELIVERY_PHONE = [
		"17671701468",//光头
		"17371436130",//李超
		"17740687783",//田翔
		"17371438825",//曹刚
		"18872404854",//周宵伟
		"15172602094"//王一航
	];

	var DLIVERY_PASSWORD = [
		"960924",//光头
		"qqq111.",//李超
		"t5891213x",//田翔
		"294314cg",//曹刚
		"123456",//周宵伟
		"w199836"//王一航
	];


	var script = document.createElement("script");
	script.type = "text/javascript";
	script.src = "jquery.js";
	document.getElementsByTagName('head')[0].appendChild(script);

	var enter_Btn = document.getElementById("enter");

	enter_Btn.onclick = function() {
		var phone_input = document.getElementById("phone").value;
		var password_input = document.getElementById("password").value;
		for(var i = 0; i < DELIVERY_PHONE.length; i++) {
			if(phone_input == DELIVERY_PHONE[i] && password_input == DLIVERY_PASSWORD[i]) {
				document.getElementById("enter_state").value = "right";
				//				alert(document.getElementById("enter_state").value);
				if(i==0){
					document.getElementById("zxl_state").value = "right";
				}
				document.getElementById("state").submit();
				//				self.location = "DeliveryDriver.jsp";
				return;
			}
		}
		alert("帐号密码不匹配！");
		
	}

}