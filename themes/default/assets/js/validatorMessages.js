jQuery.extend(jQuery.validator.messages, {
        required: "Заполните это поле",
        remote: "Исправьте это поле чтобы продолжить",
        email: "Введите корректный email адрес",
        url: "Введите верный URL",
        date: "Введите правильную дату",
        dateISO: "Введите правильную дату (ISO)",
        number: "Введите число",
        digits: "Введите только цифры",
        creditcard: "Введите правильный номер вашей кредитной карты",
        equalTo: "Повторите ввод значения еще раз",
        accept: "Пожалуйста, введите значение с правильным расширением",
        maxlength: jQuery.format("Нельзя вводить более {0} символов"),
        minlength: jQuery.format("Должно быть не менее {0} символов"),
        rangelength: jQuery.format("Введите от {0} до {1} символов"),
        range: jQuery.format("Введите число от {0} до {1}"),
        max: jQuery.format("Число должно быть не более {0}"),
        min: jQuery.format("Число должно быть не менее {0}")
});

jQuery.validator.addMethod("select", function(value, element){
        if(value=="0")
                return false;
        else
                return true;
}, "Выберите из выпадающего списка");

jQuery.validator.addMethod("russian", function(value, element){
        return !/[A-Za-z0-9]/.test(value);
}, "Можно использовать только буквы русского алфавита");

jQuery.validator.addMethod("rusdate", function(value, element){
        var arrDate = value.split(".");
        if(arrDate[0]<1 || arrDate[0]>31)
                return false;
        if(arrDate[1]<1 || arrDate[1]>12)
                return false;
        if(arrDate[2]<1930)
                return false;
        return true;
}, "Введите правильную дату");