$(function(){
	
	$("a.feedback").on("click", function(){

		// всплывающее окно отправки сообщения
		var $_modal_feedback = $("#modal-feedback");
		$.modal($_modal_feedback, {
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
						message: {
							required: true,
							maxlength: 500
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
				$_modal_feedback.find("form").validate(options);
			}
		});
		return false;
	});

	popover = function(text, el) {
		el.popover("destroy");
		el.popover({
			animation: true,
			placement: 'top',
			trigger: 'focus',
			content: text
		});
	};

	// отправляем форму
	var formsubmit = function(form) {
		ajaxload();
        $.ajax({
            type: "POST",
            url: $(form).attr("action"),
            data: $(form).serialize(),
            success: function(){
                $.modal.close();
                $("#modal-feedback-true").modal({
                    minHeight: 160,
                    minWidth: 300,
                    maxHeight: 160,
                    maxWidth: 300,
                    opacity: 80,
                    overlayClose: true,
                    focus: false,
                    autoResize: false
                });
            },
            error: function(data){
                $.modal.close();
                console.log(data);
            }
        });
	};

});