$(function(){

	number_format = function( number, decimals, dec_point, thousands_sep ) {
		var i, j, kw, kd, km;

		// input sanitation & defaults
		if( isNaN(decimals = Math.abs(decimals)) ){
			decimals = 2;
		}
		if( dec_point == undefined ){
			dec_point = ",";
		}
		if( thousands_sep == undefined ){
			thousands_sep = ".";
		}

		i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

		if( (j = i.length) > 3 ){
			j = j % 3;
		} else{
			j = 0;
		}

		km = (j ? i.substr(0, j) + thousands_sep : "");
		kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
		//kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
		kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");


		return km + kw + kd;
	};

	// слушаем событие изменения товара из корзины и изменяем данные корзины в шапке
	$(document).on("changeProducts", function(){
		basketInfo();
	});

	$(document).ready(function(){
		basketInfo();

		/* Placeholder for IE */
	    if(navigator.appName === "Microsoft Internet Explorer") { // Условие для вызова только в IE
	        $("form").find("input[type='text']").each(function() {
	            var tp = $(this).attr("placeholder");
	            $(this).attr('value',tp).css('color','#ccc');
	        }).focusin(function() {
	            var val = $(this).attr('placeholder');
	            if($(this).val() == val) {
	                $(this).attr('value','').css('color','#303030');
	            }
	        }).focusout(function() {
	            var val = $(this).attr('placeholder');
	            if($(this).val() == "") {
	                $(this).attr('value', val).css('color','#ccc');
	            }
	        });

	        /* Protected send form */
	        $("form").submit(function() {
	            $(this).find("input[type='text']").each(function() {
	                var val = $(this).attr('placeholder');
	                if($(this).val() == val) {
	                    $(this).attr('value','');
	                }
	            })
	        });
	    }
	});

	var basketInfo = function() {
        var products = null;
        if($.cookie("products"))
		    products = JSON.parse($.cookie("products"));

		if(products !== null) {
			// считаем количество и цену товара
			var count = 0, // количество товаров
				count_text = 'товаров',  // текст
				price = 0; // цена

			for (var i = 0; i < products.length; i++) {
				count += parseInt(products[i].count);
				price += products[i].count*products[i].price;
			}

			if((count > 1 && count < 5) || (count > 10 && count[1] > 1 && count[1] < 5)) {
				count_text = 'товара';
			}
			else {
				count_text = 'товаров';
			}
			if((count === 1) || (count > 20 && count[1] === 1)){
				count_text = 'товар';
			}

			$("#basket_info .products_count").html(count);
			$("#basket_info .products_count_text").html(count_text);
			$("#basket_info .products_price").html(number_format(price, 0, '.', ' '));
		}
		else {
			$("#basket_info .products_count").html("0");
			$("#basket_info .products_count_text").html("товаров");
			$("#basket_info .products_price").html("0");
		}
		return true;
	};

});