$(function(){
	var options;

	if($(".favorites-carousel-items ul li").length < 10) {
		options = {
			btnNext: "",
	        btnPrev: "",
	        visible: $(".favorites-carousel-items ul li").length
		};
	}
	else {
		options = {
			btnNext: ".favorites-carousel .next",
        	btnPrev: ".favorites-carousel .prev",
	        visible: 9
		};
	}

	$(".favorites-carousel-items").jCarouselLite(options);

});