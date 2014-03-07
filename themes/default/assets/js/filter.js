$(function(){
	
	$(".filter .show-filter").on("click", function(){
		$(this).css("display", "none");
		$(".filter .hide-filter").css("display", "block");
		$(".filter .filter-form").css("display", "block");
		return false;
	});

	$(".filter .hide-filter").on("click", function(){
		$(this).css("display", "none");
		$(".filter .filter-form").css("display", "none");
		$(".filter .show-filter").css("display", "block");
		return false;
	});

	var offsetTop = $(".filter").offset().top;
	$(document).on({"scroll":filter_fixed,"load":filter_fixed}, {offsetTop:offsetTop});

});

/* Прикрепляет блок div.filter к верхнему краю экрана
 * @param int event.data.offsetTop - растояние от края экрана до блока div.filter
 */
var filter_fixed = function(event) {
    var height = $(".filter").height();
    height = height+40;
	if($(document).scrollTop() > event.data.offsetTop){
		$(".filter").css({
			"position" : "fixed",
			"top" : "0px",
			"z-index" : "9",
			"width" : "940px",
			"margin-top" : "0"
		});
		if($(document).scrollTop() > event.data.offsetTop+20){
			$(".filter").css({
				"box-shadow" : "#000 0px 6px 30px -13px"
			});
		}
		else {
			$(".filter").css({
				"box-shadow" : "none"
			});
		}
		$(".clothes").css("margin-top",height+"px");

	}
	else {
		$(".filter").css({
			"position" : "relative",
			"top" : "0px",
			"z-index" : "1",
			"width" : "940px",
			"box-shadow" : "none",
			"margin-top" : "20px"
		});
		$(".clothes").css("margin-top","0px");
	}
	return;
}