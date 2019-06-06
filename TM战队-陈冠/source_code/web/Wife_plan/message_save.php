<!DOCTYPE html>
<!-- saved from url=(0049)http://www.dcloud.io/hellomui/examples/input.html -->

<html lang="zh">
	<head>
		
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Hello MUI</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!--标准mui.css-->
		<link rel="stylesheet" href="./Hello MUI_files/mui.min.css">
		<!--App自定义的css-->
		<link rel="stylesheet" type="text/css" href="./Hello MUI_files/app.css">
		<style>
			h5 {
				margin: 5px 7px;
			}
						
		</style>
		<script type="text/javascript">
			function junmpleft()
			{
				window.history.back();
			}
			function junmpright()
			{
				window.history.forward();
			}
			
			function showTime() {
				var myDate=new Date();
				var timer;
				var dater = myDate.getFullYear() + "-" + sup(myDate.getMonth()+1) + "-" + sup(myDate.getDate());
				var time = sup(myDate.getHours()) + ":" + sup(myDate.getMinutes()) + ":" + sup(myDate.getSeconds());
				timer = dater +" "+ time;
				return timer;
			}
			function sup ( n ){ 
				return (n<10) ? '0'+n : n; 
			}
		</script>
		<link href="css/styles.css" rel="stylesheet" />
		<link href="css/inserthtml.com.radios.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="css/MyStyle.css">
	</head>

	<body style="background-size: cover; background-image: url(images/Homepage3.jpg);">
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-arrowleft mui-pull-left" onclick="junmpleft()"></a>
			<h1 class="mui-title"><b>留下什么吧~</b></h1>
		</header>
			
		<div class="mui-content" style="background-color: rgba(0,0,0,0);">
			<div class="mui-content-padded" style="margin: 1px;">
				<div class="mui-input-row" ><!--style="margin: 10px 5px;"-->
					<textarea id="textarea1" placeholder="Our story is unfinished........" rows="10" style="background-color: rgba(0,0,0,0.2);"></textarea>
				</div>
				<div class="mui-button-row">
					
					<script type="text/javascript">
						var xmlHttp;
						xmlHttp = GetXmlHttpObject();
						
						function cancel(){
							document.getElementById("textarea1").value = "";
						}
						
						function sure(){
							var content = document.getElementById("textarea1").value;
							if(content == ""){
								alert("宝宝还是给我留点儿什么呗~");
							}else if(xmlHttp==null){
								alert ("Browser does not support HTTP Request");
								return ;
							}else{
								var is_from;
								var sex = confirm("是小仙女不~");
								if(sex){
									is_from = "小仙女";
								}else{
									is_from = "臭粑粑";
								}
								var time = showTime();
								var url="sendTo_db.php";
								url=url+"?m_content="+content;
								url=url+"&m_data="+time;
								url=url+"&m_from="+is_from;
								url=url+"&sid="+Math.random();
								xmlHttp.onreadystatechange=stateChanged;
								xmlHttp.open("POST",url,true);
								xmlHttp.send(null);
							}
						}
						function stateChanged(){
							if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
						 		alert("老婆你的留言送到啦~");
						 		document.getElementById("textarea1").value = "";
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
					</script>

					<button type="button" class="mui-btn mui-btn-primary" onclick="sure()">确认</button>&nbsp;&nbsp;
					<button type="button" class="mui-btn mui-btn-danger" onclick="cancel()">取消</button>

				    
					
					
				</div>
			</div> 
			
			<div id="photo-list">
				<ul id="scroll">
					<script type="text/javascript">
						var photonum = 31;
						function insertphoto(element){
							var rnum =  Math.round(Math.random()*element);
							for (var i=rnum;i<(element+rnum);i++) {
								document.write('<li><a href="#"><img src="images/psb ('+(i%element)+').jpg" width="400x" height="320px" alt=""/></a></li>');
							}
						}
						insertphoto(photonum);
					</script>
				</ul>
				<script type="text/javascript" src="js/MoveEffect.js"></script>
			</div>
		</div>

		
	

	</body>
</html>
