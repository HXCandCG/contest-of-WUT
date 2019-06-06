window.onload = function() {
	/*
	 * 
	 * 本文档用来计算页面总价数目
	 * 
	 */
	var Be_Paid = 0; //需支付
	var Toltal_Price = 0; //商品总价
	var Delivery_Fee = 0; //配送费
	var business_profit = 0; //商家所得
	var DIS_PRICE_DIFFERENCE = 2; //菜品差价--------------------------------------------------------------------------
	var other_profit = 0; //非菜品成本
	var DRK_PRICE_DIFFERENCE = 0.5; //饮品差价=========================================================================
	var CIG_PRICE_DIFFERENCE = 1; //烟草差价===========================================================================
	var our_got = 0; //我方所得

	//菜品板块初始化赋值
	var DIS_NUM = 10; //加菜注意出-------------------------------------------------------------------------------------
	var Dis_ID = new Array([DIS_NUM]);
	var Dis_Select_state = new Array([DIS_NUM]);
	var Dis_name = new Array([DIS_NUM]);
	for(var i = 0; i < DIS_NUM; i++) {
		var x = document.getElementById("dis");
		var y = x.getElementsByTagName("p");
		Dis_Select_state[i] = false;
		Dis_ID[i] = document.getElementById("dis" + i);
		Dis_name[i] = y[i].innerHTML + "\n";
	}
	var Dis_Price = [12, 12, 13, 13, 13, 13, 13, 13, 14, 15]; //菜品价格--------------------------------------
	var Delivery_dis_fee = 1; //配送费

	//菜品板块事件绑定
	for(i = 0; i < DIS_NUM; i++) {
		(function(index) {
			Dis_ID[i].onclick = function() {
				if(!Dis_Select_state[index]) {
					Dis_Select_state[index] = true;
					Toltal_Price += Dis_Price[index];
					Delivery_Fee += Delivery_dis_fee;
					Order_form += Dis_name[index];
					business_profit += (Dis_Price[index] - DIS_PRICE_DIFFERENCE);
					document.getElementById("diss" + index).value = "1";
					Be_Paid = Toltal_Price + Delivery_Fee;
					document.getElementById("Goods_Fee").innerHTML = ("商品费：" + Toltal_Price + "￥");
					document.getElementById("Deli_Fee").innerHTML = ("配送费：" + Delivery_Fee + "￥");
					document.getElementById("Amount_To").innerHTML = ("总计" + Be_Paid + "￥");
				} else {
					Dis_Select_state[index] = false;
					Toltal_Price -= Dis_Price[index];
					Delivery_Fee -= Delivery_dis_fee;
					Order_form = Order_form.replace(Dis_name[index], "");
					business_profit -= (Dis_Price[index] - PRICE_DIFFERENCE);
					document.getElementById("diss" + index).value = "";
					Be_Paid = Toltal_Price + Delivery_Fee;
					document.getElementById("Goods_Fee").innerHTML = ("商品费：" + Toltal_Price + "￥");
					document.getElementById("Deli_Fee").innerHTML = ("配送费：" + Delivery_Fee + "￥");
					document.getElementById("Amount_To").innerHTML = ("总计" + Be_Paid + "￥");
				}		
			}
		})(i);
	}

	//饮品板块初始化赋值
	var DRK_NUM = 6; //加菜注意出
	var Drk_ID = new Array([DRK_NUM]);
	var Drk_Select_state = new Array([DRK_NUM]);
	var Drk_name = new Array([DRK_NUM]);
	for(var i = 0; i < DRK_NUM; i++) {
		var x = document.getElementById("drinking");
		var y = x.getElementsByTagName("p");
		Drk_Select_state[i] = false;
		Drk_ID[i] = document.getElementById("drinking" + i);
		Drk_name[i] = y[i].innerHTML + "\n";
	}
	var Drk_Price = [3.5, 3.5, 3.5, 3.5, 4.5, 4.5];
	var Delivery_drk_fee = 0.5;

	//饮品板块事件绑定
	for(i = 0; i < DRK_NUM; i++) {
		(function(index) {
			Drk_ID[i].onclick = function() {
				if(!Drk_Select_state[index]) {
					Drk_Select_state[index] = true;
					Toltal_Price += Drk_Price[index];
					Delivery_Fee += Delivery_drk_fee;
					Order_form += Drk_name[index];
					other_profit += (Drk_Price[index] - DRK_PRICE_DIFFERENCE);
					document.getElementById("drck" + index).value = "1";
				} else {
					Drk_Select_state[index] = false;
					Toltal_Price -= Drk_Price[index];
					Delivery_Fee -= Delivery_drk_fee;
					Order_form = Order_form.replace(Drk_name[index], "");
					other_profit -= (Drk_Price[index] - DRK_PRICE_DIFFERENCE);
					document.getElementById("drck" + index).value = "";
				}
				Be_Paid = Toltal_Price + Delivery_Fee;
				document.getElementById("Goods_Fee").innerHTML = ("商品费：" + Toltal_Price + "￥");
				document.getElementById("Deli_Fee").innerHTML = ("配送费：" + Delivery_Fee + "￥");
				document.getElementById("Amount_To").innerHTML = ("总计" + Be_Paid + "￥");
			}
		})(i);
	}

	//烟板块初始化赋值
	var CIG_NUM = 3; //加菜注意出
	var Cig_ID = new Array([CIG_NUM]);
	var Cig_Select_state = new Array([CIG_NUM]);
	var Cig_name = new Array([CIG_NUM]);
	for(var i = 0; i < CIG_NUM; i++) {
		var x = document.getElementById("cigarette");
		var y = x.getElementsByTagName("p");
		Cig_Select_state[i] = false;
		Cig_ID[i] = document.getElementById("cigarette" + i);
		Cig_name[i] = y[i].innerHTML + "\n";
	}
	var Cig_Price = [15, 15, 20];
	var Delivery_cig_fee = 0.5;

	//烟板块事件绑定
	for(i = 0; i < CIG_NUM; i++) {
		(function(index) {
			Cig_ID[i].onclick = function() {
				if(!Cig_Select_state[index]) {
					Cig_Select_state[index] = true;
					Toltal_Price += Cig_Price[index];
					Delivery_Fee += Delivery_cig_fee;
					Order_form += Cig_name[index];
					other_profit += (Cig_Price[index] - CIG_PRICE_DIFFERENCE);
					document.getElementById("cigger" + index).value = "1";
				} else {
					Cig_Select_state[index] = false;
					Toltal_Price -= Cig_Price[index];
					Delivery_Fee -= Delivery_cig_fee;
					Order_form = Order_form.replace(Cig_name[index], "");
					other_profit -= (Cig_Price[index] - CIG_PRICE_DIFFERENCE);
					document.getElementById("cigger" + index).value = "";
				}
				Be_Paid = Toltal_Price + Delivery_Fee;
				document.getElementById("Goods_Fee").innerHTML = ("商品费：" + Toltal_Price + "￥");
				document.getElementById("Deli_Fee").innerHTML = ("配送费：" + Delivery_Fee + "￥");
				document.getElementById("Amount_To").innerHTML = ("总计" + Be_Paid + "￥");
			}
		})(i);
	}

	//支付处理

	//订单商品处理
	var Pay_Btn = document.getElementById("pay"); //支付按钮id绑定
	var Order_form = document.getElementById("infom").value; //订单餐品信息 最终传给 配送员.jsp
	var Category_address = document.getElementById("Address_floor").value; //用于 配送员.jsp地址分类
	//订单地址处理
	var room_Num = ""; //房间号
	var Address_Num = ""; //楼号
	//检索选中的楼号
	function check_Address() {
		var radio_ary = document.getElementsByName("room");
		for(var i = 0; i < radio_ary.length; i++) {
			if(radio_ary[i].checked == true) {
				return radio_ary[i].value;
			}
		}
	}

	//支付按钮时间绑定
	Pay_Btn.onclick = function() {
		Address_Num = check_Address(); //确定选中的楼号
		room_Num = document.getElementById("roomNUM").value; //确定填写的房间号
		var StringToNum = Number(room_Num); //用于检查房间号是否为数字
		if(Order_form == "") {
			//检查是否没有点单
			alert("请选购商品后再重新下单！");
			return;
		} else if(room_Num == "" || isNaN(StringToNum) || Address_Num == "") {
			//检查地址的正确性
			alert("地址填写格式错误或者填写为空，请正确填写后再次下单。\n（寝室号只能填数字）");
			return;
		} else {
			if(confirm("请确定是否配送到以下地址：\n" +
					Address_Num + " " + room_Num +
					"\n请确认配送以下商品：\n" +
					Order_form +
					"合计:" + Be_Paid + "￥\n" +
					"\n若确认地址以及商品无误后下单\n支付成功后订单不予更改或取消"))
			//最后确认的入口接下来就直接支付 以下代码都是默认支付成功后的执行部分
			{ //默认支付成功 后期得到微信支付接口后在另行做出调整
				//数据传递操作
				//				document.getElementById("price").value = Be_Paid.toString();
				Order_form += (room_Num); //将数据装入订单信息
				Category_address = Address_Num; //将数据装入位置0信息
				our_got = Be_Paid - other_profit - business_profit - Delivery_Fee;

				document.getElementById("Address_floor").value = Category_address;
				document.getElementById("infom").value = Order_form;
				document.getElementById("salaryOfdeli").value = Delivery_Fee.toString();
				document.getElementById("business_profits").value = business_profit.toString();
				document.getElementById("other_profits").value = other_profit.toString();
				document.getElementById("total_money").value = Be_Paid.toString();
				document.getElementById("our_got").value = our_got.toString();
				document.getElementById("needPaid").value = Be_Paid.toString();
				document.getElementById("add_num").value = "add_1";

				//				document.getElementById("Foo").submit();
				document.getElementById("bePaid").submit();
			} else {
				return;
			}
		}
	}

}