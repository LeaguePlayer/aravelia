$(function(){

    $.ajaxSetup({
        beforeSend: function(){
            $.modal.close();
            ajaxload();
        },
        complete: function(){
            setTimeout(function(){$.modal.close();},1000);
        },
        error: function(xhr, text, error){
            alert("Произошла ошибка при запросе! Обновите страницу или обратитесь к разработчикам!");
            console.log(xhr, text, error);
        }
    });

    $("#clear_favorites").on("click", function(){
        $.cookie("favorites", null);
        $(this).parent("section").hide(700);
        return false;
    });

    $("#favorites_in_basket").on("click", function(){
        $.ajax({
            url: "/basket",
            data: "html",
            success: function(html){
                $(".content.width").html(html);
            },
            complete: function(){
                var $_basketjs = $("script[src*='basket.min.js']");
                var src = $_basketjs.attr("src");
                $_basketjs.remove();
                $.ajax({
                    type: "GET",
                    url: src,
                    dataType: "script",
                    success: function(js){
                        $("body").append('<script type="text/javascript" src="' +src+ '">'+ js +'</script>');
                        $(document).triggerHandler("ready");
                        $("#clear_favorites").triggerHandler("click");
                    }
                });
            }
        });
        return false;
    });

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