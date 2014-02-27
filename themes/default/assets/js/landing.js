$(function(){
	
	$(".fancybox").fancybox();

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
	$(".order_club_form input[name='phone']").mask("8(999)999-99-99");

});