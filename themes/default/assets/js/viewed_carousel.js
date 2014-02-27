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

});