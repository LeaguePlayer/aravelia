$(function(){

	$("#sertificat-order-form input[name='phone']").mask("8 (999) 999-99-99");
	// Валидация формы
	options = {
		submitHandler: function(form) {
			if($(".check_sert .switch-check:checked").length != 0) {
				$("#check_sert_message").css("display", "none");
				sertSubmit(form);
			}
			else {
				$("#check_sert_message").css("display", "block");
			}
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
	$("#sertificat-order-form").validate(options);

	// изменение количества сертификатов
	$(".count_sert input").on("keyup", function(){
        if($(this).val() < 1)
            return;
		var price = $(this).data("price"),
			count = $(this).val();
//		$(this).parent().next(".price_sert").children("span").html(number_format(price*count, 0, '.', ' '));
		$(".itog_sert_price span").html(number_format(priceCert(), 0, '.', ' '));
	});

    $(".count_sert input").on("change", function(){
        if($(this).val() < 1)
            $(this).val(1);
        var price = $(this).data("price"),
            count = $(this).val();
//		$(this).parent().next(".price_sert").children("span").html(number_format(price*count, 0, '.', ' '));
        $(".itog_sert_price span").html(number_format(priceCert(), 0, '.', ' '));
    });

	// вкл\отк сертификата
	$(".check_sert .switch-check").on("change", function(){
		$(".itog_sert_price span").html(number_format(priceCert(), 0, '.', ' '));
	});

	// отправляем форму
	var sertSubmit = function(form){
		ajaxload();
        $.ajax({
            type: "POST",
            url: "/site/sertificats",
            data: $(form).serialize()+"&"+$("#sertificats-list").serialize(),
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
                    onClose: function(){
                        window.location.reload();
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

	// функция подсчета итоговой цены
	var priceCert = function() {
		var price = 0;
		$(".count_sert input").each(function(i,e){
			if($(e).parent().next().next().find(".switch-check").prop("checked")){
				price += $(e).data("price")*$(e).val();
			}
		});
		return price;
	};

	var popover = function(text, el) {
		el.popover("destroy");
		el.popover({
			animation: true,
			placement: 'top',
			trigger: 'focus',
			content: text
		});
	};

});