

function add_btn(element){
	var goods_name = element.id;
	var goods_price = parseFloat(element.parentNode.previousSibling.previousSibling.firstChild.textContent);
	var goods_num = parseInt(element.nextSibling.nextSibling.textContent);
	//总体费用结算
	total_price +=goods_price;
	//订单信息装载
	order_content += goods_name +"|";
	//总件数统计
	total_num += 1;
	//单品显示处理
	goods_num += 1;
	//配送费结算
	if(total_price!=0){
		deli_fee = (parseInt(total_price/10)+1)*0.5;
		if(deli_fee>=5){
			deli_fee = 5;
		}
	}else{
		deli_fee = 0;
	}
	
	element.nextSibling.nextSibling.textContent = goods_num;
	
	document.getElementById("total").innerHTML = total_price+deli_fee;
	document.getElementById("itemQuantity").innerHTML = total_num;
}


function sub_btn(element){
	var goods_name = element.id;
	var goods_price = parseFloat(element.parentNode.previousSibling.previousSibling.firstChild.textContent);
	var goods_num = parseInt(element.previousSibling.previousSibling.textContent);
	if(goods_num<=0||total_num<=0||total_price<=0||deli_fee<=0||order_content=="|"){
		return ;
	}else{
		//总体费用结算
		total_price -= goods_price;
		//订单信息装载
		order_content = order_content.replace(goods_name,"");
		//总件数统计
		total_num -= 1;
		//单品显示处理
		goods_num -= 1;
		//配送费结算
		if(total_price!=0){
			deli_fee = (parseInt(total_price/10)+1)*0.5;
			if(deli_fee>=5){
				deli_fee = 5;
			}
		}else{
			deli_fee = 0;
		}
		element.previousSibling.previousSibling.textContent = goods_num;
		
		document.getElementById("total").innerHTML = total_price+deli_fee;
		document.getElementById("itemQuantity").innerHTML = total_num;
	}
	
}


