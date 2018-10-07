$(document).ready(function(){




	$(".ul-dropfree").find("li:has(ul)").prepend('<div class="drop"></div>');
	$(".ul-dropfree div.drop").click(function() {
		if ($(this).nextAll("ul").css('display')=='none') {
			$(this).nextAll("ul").slideDown(100);
			$(this).css({'background-position':"-11px 0"});
		} else {
			$(this).nextAll("ul").slideUp(100);
			$(this).css({'background-position':"0 0"});
		}
	});
	$(".ul-dropfree").find("ul").slideUp(100).parents("li").children("div.drop").css({'background-position':"0 0"});


	$(".ul-drop").find("li:has(ul)").prepend('<div class="drop"></div>');
	$(".ul-drop div.drop").click(function() {
		if ($(this).nextAll("ul").css('display')=='none') {
			$(this).nextAll("ul").slideDown(100);
			$(this).css({'background-position':"-11px 0"});
		} else {
			$(this).nextAll("ul").slideUp(100);
			$(this).css({'background-position':"0 0"});
		}
	});
	$(".ul-drop").find("ul").slideUp(100).parents("li").children("div.drop").css({'background-position':"0 0"});



    $(".lasttreedrophide").click(function(){
		$("#lasttree").find("ul").slideUp(100).parents("li").children("div.drop").css({'background-position':"0 0"});
	});
    $(".lasttreedropshow").click(function(){
		$("#lasttree").find("ul").slideDown(100).parents("li").children("div.drop").css({'background-position':"-11px 0"});
	});




});