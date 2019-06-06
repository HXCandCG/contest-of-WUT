$(".menu").mousedown(function(){
	$(this).toggleClass("closed");
	
	if($(this).hasClass("closed")) {
		$(".main.button").text("Love");
	} else {
		$(".main.button").text("You");
	}
})