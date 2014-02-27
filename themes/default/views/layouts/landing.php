<?php
$cs = Yii::app()->clientScript;
$cs->registerCssFile($this->getAssetsUrl().'/css/normalize.min.css');
$cs->registerCssFile($this->getAssetsUrl().'/css/popover.min.css');
$cs->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox.css');
$cs->registerCssFile($this->getAssetsUrl().'/css/main.css');
$cs->registerCssFile($this->getAssetsUrl().'/css/style.css');

$cs->registerScriptFile($this->getAssetsUrl().'/js/vendor/modernizr-2.6.2.min.js', CClientScript::POS_HEAD);

$cs->registerScriptFile($this->getAssetsUrl().'/js/min/jquery-1.9.1.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.fancybox.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/jcarousellite.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.simplemodal.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.maskedinput.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.validate.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/min/validatorMessages.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/min/global.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/popover.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/min/feedback.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.cookie.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/min/mobile.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/min/sertificat.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/min/photo-carousel.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/min/landing.min.js', CClientScript::POS_END);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title>Детский клуб / Aravelia</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,800,700,300&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" media="screen" href="css/superfish.css">
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/popover.min.css">
    <link rel="stylesheet" href="css/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body class="landing">

<nav class="top-menu width">
    <div class="top-menu-body">
        <img src="/media/images/logo2.png" alt="Аравелия, клубный салон детской одежды">
        <a href="/page/1" class="goto_site">Вернуться на сайт</a>
        <p class="main-phone">8  (3452) 52-07-92</p>
        <a href="#" class="feedback">Написать нам</a>
    </div>
</nav>

<section class="box-white shadow section">
    <img src="/media/images/about.jpg" alt="">
    <h2>О клубе</h2>
    <p>
        Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
    </p>
    <p>
        Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
    </p>
    <p>
        Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
    </p>
    <div class="clearfix"></div>
</section>

<section class="box-white shadow section">
    <img src="/media/images/about.jpg" alt="">
    <h2>
        30 декабря<br>
        Новогодняя сказка в Аравелии
    </h2>
    <p>
        Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
    </p>
    <p>
        Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
    </p>
    <p>
        <a href="#form-club" class="more_button">Записаться на мероприятие</a>
    </p>
    <div class="clearfix"></div>
</section>

<section class="box-white shadow section">
    <h2>Посмотрите как прошло прошлое мероприятие</h2>
    <div id="photo1" class="photo-carousel">
        <a href="#" class="prev" onclick="return false;"></a>
        <a href="#" class="next" onclick="return false;"></a>

        <div class="photo-carousel-items">
            <ul>
                <li><a href="#"><img src="/media/images/item1.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item2.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item3.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item4.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item5.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item6.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item7.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item1.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item2.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item3.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item4.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item5.jpg" alt="" width="80" height="80" ></a></li>
            </ul>
        </div>
    </div>
    <div class="video_content">
        <div class="video">
            <iframe src="//player.vimeo.com/video/80644479" width="516" height="290" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
        <div class="video_description">
            <p>
                Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
            </p>
            <p>
                Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
            </p>
        </div>
        <div class="clearfix"></div>
    </div>
</section>

<section class="box-white shadow section">
    <h2>Конкурсные работы</h2>
    <p>
        Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
    </p>
    <div class="photos">
        <a class="fancybox" rel="photos" href="/media/images/item1.jpg" title="Супер пупер"><img src="/media/images/item1.jpg" alt="" /></a>
        <a class="fancybox" rel="photos" href="/media/images/item1.jpg" title="Супер пупер"><img src="/media/images/item1.jpg" alt="" /></a>
        <a class="fancybox" rel="photos" href="/media/images/item1.jpg" title="Супер пупер"><img src="/media/images/item1.jpg" alt="" /></a>
        <a class="fancybox" rel="photos" href="/media/images/item1.jpg" title="Супер пупер"><img src="/media/images/item1.jpg" alt="" /></a>
        <a class="fancybox" rel="photos" href="/media/images/item1.jpg" title="Супер пупер"><img src="/media/images/item1.jpg" alt="" /></a>
        <a class="fancybox" rel="photos" href="/media/images/item1.jpg" title="Супер пупер"><img src="/media/images/item1.jpg" alt="" /></a>
        <a class="fancybox" rel="photos" href="/media/images/item1.jpg" title="Супер пупер"><img src="/media/images/item1.jpg" alt="" /></a>
        <a class="fancybox" rel="photos" href="/media/images/item1.jpg" title="Супер пупер"><img src="/media/images/item1.jpg" alt="" /></a>
    </div>
</section>

<section class="box-white shadow section">
    <h2>Прошедшие мероприятия</h2>
    <div id="photo2" class="photo-carousel">
        <a href="#" class="prev" onclick="return false;"></a>
        <a href="#" class="next" onclick="return false;"></a>

        <div class="photo-carousel-items">
            <ul>
                <li><a href="#"><img src="/media/images/item1.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item2.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item3.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item4.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item5.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item6.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item7.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item1.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item2.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item3.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item4.jpg" alt="" width="80" height="80" ></a></li>
                <li><a href="#"><img src="/media/images/item5.jpg" alt="" width="80" height="80" ></a></li>
            </ul>
        </div>
    </div>
</section>

<section class="content width">
    <h1>Что говорят о нас дети и их родители</h1>
    <div class="reviews">
        <div class="review">
            <div class="review_text">
                Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
            </div>
            <div class="review_author">
                <span class="name">Сергей Долатов</span>
                <span class="age">6 лет</span>
            </div>
        </div>
        <div class="review">
            <div class="review_text">
                Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
                Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
                Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
            </div>
            <div class="review_author">
                <span class="name">Сергей Долатов</span>
                <span class="age">6 лет</span>
            </div>
        </div>
        <div class="review">
            <div class="review_text">
                Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
                Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
            </div>
            <div class="review_author">
                <span class="name">Сергей Долатов</span>
                <span class="age">6 лет</span>
            </div>
        </div>
        <div class="review">
            <div class="review_text">
                Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
            </div>
            <div class="review_author">
                <span class="name">Сергей Долатов</span>
                <span class="age">6 лет</span>
            </div>
        </div>
    </div>
</section>

<section class="box-white shadow section">
    <h2>Вступай в клуб!</h2>
    <p>
        Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
    </p>
    <div class="order_club_form">
        <form id="form-club" action="" method="post">
            <input type="text" name="name" placeholder="Ваше имя">
            <input type="text" name="child_name" placeholder="Имя ребенка">
            <input type="text" name="email" placeholder="E-mail">
            <input type="text" name="child_age" placeholder="Возраст ребенка">
            <input type="text" name="phone" placeholder="Ваш телефон">
            <select name="" id="">
                <option value="">Да, участвовать в мероприятиях</option>
                <option value="">Нет, не участвовать в мероприятиях</option>
            </select>
            <input type="submit" class="more_button" value="Отправить">
        </form>
        <p>
            <img src="/media/images/lock.png" alt="lock">
            Введенные личные данные<br>в безопасности и не будут переданы<br>третьим лицам
        </p>
    </div>
</section>

<nav class="bottom-menu width">
    <ul>
        <li><a href="/page/2">О компании</a></li>
        <li><a href="/page/3">Детский клуб</a></li>
        <li><a href="/page/4">Мобильный продавец</a></li>
        <li><a href="/page/5">Подарочные сертификаты</a></li>
        <li><a href="/page/6">Контакты</a></li>
    </ul>
</nav>

<nav class="bottom-links width">
    <div class="girls">
        <a href="#" class="title">Девочки</a>
        <ul>
            <li><a href="#">Верх</a></li>
            <li><a href="#">Низ</a></li>
            <li><a href="#">Куртки</a></li>
            <li><a href="#">Платья</a></li>
            <li><a href="#">Комплекты</a></li>
            <li><a href="#">Нижнее белье</a></li>
            <li><a href="#">Обувь</a></li>
        </ul>
    </div>
    <div class="boys">
        <a href="#" class="title">Мальчики</a>
        <ul>
            <li><a href="#">Верх</a></li>
            <li><a href="#">Низ</a></li>
            <li><a href="#">Куртки</a></li>
            <li><a href="#">Платья</a></li>
            <li><a href="#">Комплекты</a></li>
            <li><a href="#">Нижнее белье</a></li>
            <li><a href="#">Обувь</a></li>
        </ul>
    </div>
    <div class="babies">
        <a href="#" class="title">Младенцы</a>
        <ul>
            <li><a href="#">Верх</a></li>
            <li><a href="#">Низ</a></li>
            <li><a href="#">Боди, ползунки</a></li>
            <li><a href="#">Комплекты</a></li>
            <li><a href="#">Нижнее белье</a></li>
            <li><a href="#">Обувь</a></li>
        </ul>
    </div>
    <div class="brands">
        <a href="#" class="title">По брендам</a>
        <ul>
            <li><a href="#">Senbodulun</a></li>
            <li><a href="#">Barcarola</a></li>
            <li><a href="#">Gakkard</a></li>
            <li><a href="#">Wojcik</a></li>
            <li><a href="#">Clayeux</a></li>
            <li><a href="#">Peary Cook</a></li>
            <li><a href="#">Pulka</a></li>
        </ul>
    </div>
</nav>

<footer>
    <div class="footer-wrap">
        <div class="footer width">
            <p class="copyright">© 2013, ООО «<span>Аравелия</span>»</p>
            <p class="adress">Тюмень, ул. Луговая 2-я, 30, ТРЦ “Па-На-Ма”, 3-й этаж</p>
            <a href="http://amobile-studio.ru" class="a-mobile">Всегда только лучшие идеи</a>
        </div>
    </div>
</footer>

<!-- Модальное окно отправки сообщения -->
<div id="modal-feedback">
    <div class="modal-header">
        <div class="modal-title">Вы можете<br>оставить сообщение<br>или задать вопрос</div>
    </div>
    <div class="modal-content">
        <form method="post">
            <input type="text" name="name" placeholder="Ваше имя">
            <input type="text" name="email" placeholder="E-mail">
            <textarea name="message" placeholder="Сообщение" rows="3"></textarea>
            <input type="submit" class="more_button" value="Отправить">
        </form>
    </div>
    <div class="modal-footer"></div>
</div>

<!-- Модальное успешной отправки сообщения -->
<div id="modal-feedback-true">
    <div class="modal-header">
        <div class="modal-title">Спасибо</div>
    </div>
    <div class="modal-content">
        <p>
            Ваше сообщение отправлено!
            Мы ответим в ближайшее время.
        </p>
    </div>
    <div class="modal-footer">
        <a href="/" class="more_button">В клуб</a>
    </div>
</div>

</body>
</html>