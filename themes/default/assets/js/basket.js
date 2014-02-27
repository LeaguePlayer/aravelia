$(function(){

	/////////////////////////////////////////////////////////////////////
	// временно пишем в куки
	var products = new Array();
	products[0] = {
		id: 1,
		count: 1,
		price: 1100
	};
	products[1] = {
		id: 2,
		count: 1,
		price: 1200
	};
	products[2] = {
		id: 3,
		count: 1,
		price: 1300
	};
	$.cookie("products", JSON.stringify(products));
	//////////////////////////////////////////////////////////////////

	// считаем итоговую цену
	$(document).ready(function(){
		$(".price_all_products span").html(number_format(priceSumm(), 0, '.', ' '));
	});

	// считаем итоговую цену при изменении количества товара
	$(".count_product input").on("change", function(){
		if($(this).val() < 1)
			$(this).val(1);
		$(this).parent().next(".price_product").children("span").html(number_format($(this).val()*$(this).data("price"), 0, '.', ' '));
		$(".price_all_products span").html(number_format(priceSumm(), 0, '.', ' '));
		$(document).triggerHandler("changeProducts");
	});
	
	// всплывающее окно оформления заказа
	$("input#order-complete-button").on("click", function(){
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
				$("#modal-order input[name='phone']").mask("8(999)999-99-99");
				// Валидация формы
				options = {
					submitHandler: function(form) {
						formsubmit(form);
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
							required: true
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
				};
				$_modal_order.find("form").validate(options);
			}
		});
		return false;
	});

	// всплывающее окно полного оформления заказа
	$("a#big-order-complete-button").on("click", function(){

		// если имя пользователь уже вводил в окне оформления заказа
		if($("#modal-order input[name='name']").val().length > 1){
			$("#modal-order-big input[name='name']").val($("#modal-order input[name='name']").val());
		}
		if($("#modal-order input[name='phone']").val().length > 1){
			$("#modal-order-big input[name='phone']").val($("#modal-order input[name='phone']").val());
		}

		$.modal.close();
		var $_modal_order = $("#modal-order-big");
		$.modal($_modal_order, {
			minHeight: 530,
			minWidth: 300,
			maxHeight: 530,
			maxWidth: 300,
			opacity: 80,
			overlayClose: true,
			focus: false,
			autoResize: false,
			onShow: function(dialog){
				// Валидация формы
				$("#modal-order-big input[name='phone']").mask("8(999)999-99-99");
				options = {
					submitHandler: function(form) {
						formsubmit(form);
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
							required: true,
							maxlength: 16,
							minlength: 14
						},
						address: {
							required: true,
							minlength: 10,
							maxlength: 1000
						},
						delivery: {
							required: true
						},
						pay: {
							required: true
						},
						messages: {
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
				};
				$_modal_order.find("form").validate(options);
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

	// отправляем форму
	var formsubmit = function(form){
		ajaxload();
		setTimeout(function(){
			$.modal.close();
			$("#modal-order-true").modal({
				minHeight: 280,
				minWidth: 300,
				maxHeight: 280,
				maxWidth: 300,
				opacity: 80,
				overlayClose: true,
				focus: false,
				autoResize: false
			});
		},1000);
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
				price: $(element).data("price")
			};
		});
		$.cookie("products", JSON.stringify(products));
		return price;
	};

});