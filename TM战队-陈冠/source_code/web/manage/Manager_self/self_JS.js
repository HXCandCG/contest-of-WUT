		function seeEarning(){
			var month = document.getElementById("check_month").value;
			if(month == "default"){
				alert("请选择查看月份！");
				return ;
			}else{
				var monhttp = GetXmlHttpObject();
				var url="/web/manage/Manager_self/do_showEarning.php";
				url = url + "?month=" + month;
				url = url + "&sid="+ Math.random();
				monhttp.open("POST",url,false);
				monhttp.send(null);
				if (monhttp.readyState==4 || monhttp.readyState=="complete"){
					document.getElementById("showEarning").innerHTML = monhttp.responseText;
				}
			}
		}
		
		
		function checkDeliTable(){
			var timer = document.getElementById("timer").value;
			var timerhttp = GetXmlHttpObject();
			var url="/web/manage/Manager_self/do_deliOrder.php";
			url = url + "?timer=" + timer;
			url = url + "&sid="+ Math.random();
			timerhttp.open("POST",url,false);
			timerhttp.send(null);
			if (timerhttp.readyState==4 || timerhttp.readyState=="complete"){
				document.getElementById("deliTable").innerHTML = timerhttp.responseText;
			}
		
		}
		
		function hidedeliTable(){
			window.location.href = "../Manager_self/s_page.php";
		}
		
		function setEarning(){
			var month = document.getElementById("settle_month").value;
			var account = document.getElementById("earn_yet").value;
			if(month == "default" || account == 0 || account == ""){
				alert("月份或金额填写有问题！");
				return ;
			}else{
				if(confirm("一旦结算数据不予恢复！请谨慎操作！")){
					var settlehttp = GetXmlHttpObject();
					var url="/web/manage/Manager_self/do_setEarning.php";
					url = url + "?setmonth=" + month;
					url = url + "&account="+ account;
					url = url + "&sid="+ Math.random();
					settlehttp.open("POST",url,false);
					settlehttp.send(null);
					if (settlehttp.readyState==4 || settlehttp.readyState=="complete"){
						alert(settlehttp.responseText);
						window.location.href = "s_page.php";
						return;
					}
				}else{
					return ;
				}
				
			}
		}
		
		  
		document.getElementById("undeliTable").style.display = "none";
		
		
		
		function showundeliTable(){
			document.getElementById("undeliTable").style.display = "block";
		}
		
		function hideundeliTable(){
			document.getElementById("undeliTable").style.display = "none";
		}  
		  
		  
		function back(){
			window.location.href = "s_page.php";
		}
		
		function getTimeOrder(){
			var myDate = new Date();  
			//var timeHeader = myDate.getFullYear()+"-"+(myDate.getMonth()+1)+"-"+myDate.getDate();
			var timeHeader = "2018-02-21";
			var start = document.getElementById("startTime").value;
			var end =  document.getElementById("endTime").value;
			
			var timehttp = GetXmlHttpObject();
			var url="/web/manage/Manager_self/do_showTimeOrder.php";
			url = url + "?startTime=" + start;
			url = url + "&endTime=" + end;
			url = url + "&Time=" + timeHeader;
			url = url + "&sid="+ Math.random();
			timehttp.open("POST",url,false);
			timehttp.send(null);
			if (timehttp.readyState==4 || timehttp.readyState=="complete"){
				document.getElementById("showArea").innerHTML = timehttp.responseText;
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