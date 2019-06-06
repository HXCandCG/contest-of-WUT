

function Process_str(str){
	var parent = document.getElementById("float_order");
	var order_txt = dostring(str);
	parent.innerHTML ="";
	if(str.length==0){
		return ;
	}else{
		for (var index=0;index<order_txt.length;index++) {
			var li = document.createElement("li");
			var arch = document.createElement("a");
			var txt = document.createTextNode(order_txt[index]);
			arch.appendChild(txt);
			li.appendChild(arch);
			parent.appendChild(li);
		}
	}
}

function dostring(order_txt){
	order_txt = order_txt.split("|");
	order_txt.shift();
	var non_repeat = quchong1(order_txt);
	var sup_txt = new Array();
	var str = "";
	for (var i=0;i<order_txt.length;i++){
		str += order_txt[i];
	}
	for (var i=0;i<non_repeat.length-1;i++){
		sup_txt[i] = makeNum(str,non_repeat[i]);
	}
	return sup_txt;
}					
			
function quchong1(arrays){  
    var arr = new Array();    //定义一个临时数组  
    for(var i = 0; i < arrays.length; i++){    //循环遍历当前数组  
        //判断当前数组下标为i的元素是否已经保存到临时数组  
        //如果已保存，则跳过，否则将此元素保存到临时数组中  
        if(arr.indexOf(arrays[i]) == -1){  
            arr.push(arrays[i]);  
        }  
    }  
    return arr;  
}  

function makeNum(str,word){
	var len = word.length;
	var regex = new RegExp(word, 'g');
	var result = str.match(regex).length;
    return word+" X "+String(result);
}					
			