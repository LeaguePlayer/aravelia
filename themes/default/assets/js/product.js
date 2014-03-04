$(function(){
    $(".product_img .fancybox").fancybox();

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
        if($("#size").val() == "0"){
            popover("Выберите ростовку", $("#size"));
            $("#size").css("border-color", "#ff0000");
            return false;
        }
        else {
            $('#size').popover('destroy');
            $("#size").css("border-color", "lightgray");
        }
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
			productAdd();
		},500);
		return false;
	});

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
            favoriteAdd();
		},500);
		return false;
	});

    // Добавляем товар в избранное
    var favoriteAdd = function(){
        var favorites = null,
            product_id = $("input[name='product_id']").val();

        if($.cookie("favorites"))
            favorites = JSON.parse($.cookie("favorites"));

        if(favorites != null){
            favorites.forEach(function(val,i){
                if(val.id == product_id) {
                    return true;
                }
            });
            favorites.push({
                id: product_id
            });
        }
        else {
            favorites = new Array();
            favorites[0] = {
                id: product_id
            };
            $.cookie("favorites", JSON.stringify(favorites));
        }
    };

    // Добавление товара в корзину
    var productAdd = function(){

        var products = null,
            product_id = $("input[name='product_id']").val(),
            characteristic_id = $("#size").val(),
            price = $("#size option:selected").data("price");

        if($.cookie("products"))
            products = JSON.parse($.cookie("products"));

        if(products != null){
            products.forEach(function(val,i){
                if(val.id == product_id) {
                    return true;
                }
            });
            products.push({
                id: product_id,
                count: 1,
                price: price,
                char: characteristic_id
            });
            $.cookie("products", JSON.stringify(products));
        }
        else {
            products = new Array();
            products[0] = {
                id: product_id,
                count: 1,
                price: price,
                char_id: characteristic_id
            };
            $.cookie("products", JSON.stringify(products));
        }
        $(document).triggerHandler("changeProducts");
    }

    var popover = function(text, el) {
        el.popover("destroy");
        el.popover({
            animation: true,
            placement: 'top',
            trigger: 'hover',
            content: text
        });
    };


});