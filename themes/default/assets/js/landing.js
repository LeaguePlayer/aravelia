$(function(){
	
	$(".fancybox").fancybox();

	options = {
		submitHandler: function(form) {
			clubSubmit(form);
			return false;
		},
		errorClass: "control-group error",
		rules: {
			name: {
				required: true,
				russian: true,
				maxlength: 250
			},
			child_name: {
				required: true,
				russian: true,
				maxlength: 250
			},
			email: {
				required: true,
				email: true,
				maxlength: 250
			},
			child_age: {
				required: true,
				number: true,
				maxlength: 2
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
	$(".order_club_form form").validate(options);
	$(".order_club_form input[name='phone']").mask("8 (999) 999-99-99");

    var clubSubmit = function(form){
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
                document.getElementById('form-club').reset();
            },
            error: function(data){
                $.modal.close();
                console.log(data);
            }
        });
    };

});