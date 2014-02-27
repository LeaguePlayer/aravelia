$(function(){

	if($(".photo-carousel").length > 0){

		$(".photo-carousel").each(function(i,e){
			var id = $(e).attr("id"),
				options;

			if($("#" + id + " .photo-carousel-items ul li").length < 10) {
				options = {
					btnNext: "",
			        btnPrev: "",
			        visible: $("#" + id + " .photo-carousel-items ul li").length
				};
			}
			else {
				options = {
					btnNext: "#" + id + " .next",
		        	btnPrev: "#" + id + " .prev",
			        visible: 9
				};
			}

			$("#" + id + " .photo-carousel-items").jCarouselLite(options);
		});

	}

});