$(function(){

	// табы информации товара
	$(".tabs a").on("click", function(){
		var content_id = $(this).parents(".tabs").data("content");
		$(".tabs .tabs-item").removeClass("active");
		$(this).parent().addClass("active");
		$("#"+content_id).children("div").css("display", "none");
		$($(this).attr("href")).css("display", "block");
		return false;
	});

	// запрещаем отправку формы, отправляем AJAXом
	$("#form-product_add").on("submit", function(){
		ajaxload();
		setTimeout(function(){
			$.modal.close();
			$("#modal-addProduct").modal({
				minHeight: 240,
				minWidth: 300,
				maxHeight: 240,
				maxWidth: 300,
				opacity: 80,
				overlayClose: true,
				focus: false,
				autoResize: false
			});
			formsubmit();
		},1000);
		return false;
	});

	var formsubmit = function(){
		//$(document).triggerHandler("changeProducts");
		return;
	};

	// добавление/удаление товара в избранное
	$("#addfavorite").on("click", function(){
		ajaxload();
		setTimeout(function(){
			$.modal.close();
			$("#modal-addFavorite").modal({
				minHeight: 255,
				minWidth: 300,
				maxHeight: 255,
				maxWidth: 300,
				opacity: 80,
				overlayClose: true,
				focus: false,
				autoResize: false
			});
			formsubmit();
		},1000);
		return false;
	});


});