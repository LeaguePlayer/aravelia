$(function(){
	var options;

	if($(".viewed-carousel-items ul li").length < 10) {
		options = {
			btnNext: "",
	        btnPrev: "",
	        visible: $(".viewed-carousel-items ul li").length
		};
	}
	else {
		options = {
			btnNext: ".viewed-carousel .next",
        	btnPrev: ".viewed-carousel .prev",
	        visible: 9
		};
	}

	$(".viewed-carousel-items").jCarouselLite(options);

    // клилк по ссылке очистить все
    $("#clear_viewed").on("click", function(){
        $.cookie("see_products", null);
        $(this).parent("section").hide(700);
        return false;
    });

});