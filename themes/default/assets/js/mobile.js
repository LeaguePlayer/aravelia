$(function(){

	// всплывающее окно оформления заказа
	$("a#order-button").on("click", function(){
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
			minHeight: 455,
			minWidth: 300,
			maxHeight: 455,
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

});