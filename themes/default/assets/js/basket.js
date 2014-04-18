(function(){

	// считаем итоговую цену
	$(document).on("ready", function(){
		$(".price_all_products span").html(number_format(priceSumm(), 0, '.', ' '));
	});

	// считаем итоговую цену при изменении количества товара
	$(".count_product input").on("change", function(){
        if($(this).val() > $(this).data("count")) {
            $(this).val($(this).data("count"));
            popover("В наличии на складе: " + $(this).data("count"), $(this));
        }

		if($(this).val() < 1)
			$(this).val(1);
		$(this).parent().next(".price_product").children("span").html(number_format($(this).val()*$(this).data("price"), 0, '.', ' '));
		$(".price_all_products span").html(number_format(priceSumm(), 0, '.', ' '));
		$(document).triggerHandler("changeProducts");
	});
	
	// всплывающее окно оформления заказа
	$("input#order-complete-button").on("click", function(){
        var priceS = priceSumm();
        if(priceS>=500){
            $("#modal-order .more_button").css("float", "right");
            $("#modal-order .mobile-checkbox").css("display", "block");
        }
        else {
            $("#modal-order .more_button").css("float", "none");
            $("#modal-order .mobile-checkbox").css("display", "none");
        }
        $("#big-order-complete-button").addClass('basket');
        var $_modal_order = $("#modal-order");
        $.modal($_modal_order, {
            minHeight: 320,
            minWidth: 300,
            maxHeight: 320,
            maxWidth: 300,
            opacity: 80,
            overlayClose: true,
            focus: false,
            autoResize: false,
            onShow: function(dialog){
                // Валидация формы
                $("#modal-order input[name='phone']").mask("8 (999) 999-99-99");
                $_modal_order.find("form").validate({
                    submitHandler: function(form) {
                        orderSubmit(form);
                        return false;
                    },
                    errorClass: "control-group error",
                    rules: {
                        name: {
                            required: true,
                            russian: true,
                            maxlength: 250
                        },
                        phone: {
                            required: true,
                            maxlength: 20,
                            minlength: 14
                        }
                    },
                    errorPlacement: function(error, element) {
                        var er;
                        er = element.attr("name");
                        return popover(error.text(), element);
                    },
                    highlight: function(element, errorClass) {
                        return $(element).addClass(errorClass);
                    },
                    unhighlight: function(element, errorClass) {
                        return $(element).removeClass(errorClass);
                    }
                });
            }
        });
        return false;
	});

	// всплывающее окно полного оформления заказа
	$("#modal-order").on("click", "#big-order-complete-button.basket", function(){
		// если имя пользователь уже вводил в окне оформления заказа
		if($("#modal-order input[name='name']").val().length > 1){
			$("#modal-order-big input[name='name']").val($("#modal-order input[name='name']").val());
		}
		if($("#modal-order input[name='phone']").val().length > 1){
			$("#modal-order-big input[name='phone']").val($("#modal-order input[name='phone']").val());
		}

		$.modal.close();
		var $_modal_order_big = $("#modal-order-big");
		$.modal($_modal_order_big, {
			minHeight: 540,
			minWidth: 300,
			maxHeight: 540,
			maxWidth: 300,
			opacity: 80,
			overlayClose: true,
			focus: false,
			autoResize: false,
			onShow: function(dialog){
				// Валидация формы
				$("#modal-order-big input[name='phone']").mask("8 (999) 999-99-99");
                $_modal_order_big.find("form").validate({
                    submitHandler: function(form) {
                        orderSubmit(form);
                        return false;
                    },
                    errorClass: "control-group error",
                    rules: {
                        name: {
                            required: true,
                            russian: true,
                            maxlength: 250
                        },
                        email: {
                            required: true,
                            email: true,
                            maxlength: 250
                        },
                        phone: {
                            required: true
                        },
                        address: {
                            required: true,
                            minlength: 10,
                            maxlength: 1000
                        },
                        messages: {
                            minlength: 0,
                            maxlength: 1000
                        }
                    },
                    errorPlacement: function(error, element) {
                        var er;
                        er = element.attr("name");
                        return popover(error.text(), element);
                    },
                    highlight: function(element, errorClass) {
                        return $(element).addClass(errorClass);
                    },
                    unhighlight: function(element, errorClass) {
                        return $(element).removeClass(errorClass);
                    }
                });
			}
		});
		return false;
	});

	// удаление товара из корзины
	$(".del_product a").on("click",function(){
		var $_this = $(this);
		deleteProduct($_this);
		return false;
	});

	var popover = function(text, el) {
		el.popover("destroy");
		el.popover({
			animation: true,
			placement: 'top',
			trigger: 'focus',
			content: text
		});
	};


    var orderSubmit = function(form){
        ajaxload();
        $.ajax({
            type: "POST",
            url: $(form).attr("action"),
            data: $(form).serialize(),
            dataType: "json",
            success: function(data){
                console.log(data);
                $.modal.close();
                $("#modal-order-true").modal({
                    minHeight: 280,
                    minWidth: 300,
                    maxHeight: 280,
                    maxWidth: 300,
                    opacity: 80,
                    overlayClose: true,
                    focus: false,
                    autoResize: false,
                    onClose: function(dialog){
                        ajaxload();
                        $("div.basket").html("<p>В вашей корзине товаров нет.</p>");
                        $(document).triggerHandler("ready");
                        $(document).triggerHandler("changeProducts");
                        setTimeout(function(){$.modal.close();},1000);
                    }
                });
                return true;
            },
            error: function(data){
                $.modal.close();
                console.log(data);
            }
        });
    };

	// функция удаления товара
	// генерирует событие changeProducts
	// @param jquery element - ссылка по которой кликнули
	var deleteProduct = function(element){
		if($("#basket-list tbody tr").length === 2){
			$(".basket .order-complete").fadeOut(500);
			element.parents("#basket-list").fadeOut(500, function(){
				$(this).remove();
				$.cookie("products", null);
				$(document).triggerHandler("changeProducts");
				$("div.basket").html("<p>В вашей корзине товаров нет.</p>");
			});
		}
		else {
			element.parents("tr").fadeOut(500, function(){
				$(this).remove();
				$(".price_all_products span").html(number_format(priceSumm(), 0, '.', ' '));
				$(document).triggerHandler("changeProducts");
			});
		}
	};

	// функция для подсчета итоговой цены
	// также формируем куки
	var priceSumm = function(){
		var price = 0;
		var products = new Array();
		$(".count_product input").each(function(index, element){
			price += $(element).data("price")*$(element).val();
			products[index] = {
				id: $(element).data("id"),
				count: $(element).val(),
				price: $(element).data("price"),
                balans_id: $(element).data("balans")
			};
		});
		$.cookie("products", JSON.stringify(products));
		return price;
	};
}());