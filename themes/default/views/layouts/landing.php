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
</head>
<body class="landing">

<nav class="top-menu width">
    <div class="top-menu-body">
        <img src="/media/images/logo2.png" alt="Аравелия, клубный салон детской одежды">
        <a href="/" class="goto_site">Вернуться на сайт</a>
        <p class="main-phone">8  (3452) 52-07-92</p>
        <a href="#" class="feedback">Написать нам</a>
    </div>
</nav>


<?=$content?>

<?
$this->widget('application.components.reviews.reviewsWidget');
?>

<section class="box-white shadow section">
    <h2>Вступай в клуб!</h2>
    <p>
        Сплошной фон излучения меньше толщины галактики, так называемых радиозвездах. Света очень велико и радиообъектов после открытия дискретных источников радиоизлучения не. Являются объектами, входящими в перспективе можно надеяться.
    </p>
    <div class="order_club_form">
        <form id="form-club" action="/site/getclub" method="post">
            <input type="text" name="name" placeholder="Ваше имя">
            <input type="text" name="child_name" placeholder="Имя ребенка">
            <input type="text" name="email" placeholder="E-mail">
            <input type="text" name="child_age" placeholder="Возраст ребенка">
            <input type="text" name="phone" placeholder="Ваш телефон">
            <select name="status_user" id="">
                <option value="1">Да, участвовать в мероприятиях</option>
                <option value="2">Нет, не участвовать в мероприятиях</option>
            </select>
            <input type="submit" class="more_button" value="Отправить">
        </form>
        <p>
            <img src="/media/images/lock.png" alt="lock">
            Введенные личные данные<br>в безопасности и не будут переданы<br>третьим лицам
        </p>
    </div>
</section>

<? if($this->mainMenu): ?>
    <nav class="bottom-menu width">
        <ul>
            <? foreach($this->mainMenu as $m): ?>
                <li><a href="<?=$m["url"]?>"><?=$m["label"]?></a></li>
            <? endforeach; ?>
        </ul>
    </nav>
<? endif; ?>

<nav class="bottom-links width">
    <div class="girls">
        <a href="/catalog?group=Девочка" class="title">Девочка</a>
        <? if($this->bottomMenu["girls"]): ?>
            <ul>
                <? foreach($this->bottomMenu["girls"] as $item): ?>
                    <li><a href="/catalog?group=Девочка&cat=<?=$item["id"]?>"><?=$item["name"]?></a></li>
                <? endforeach; ?>
            </ul>
        <? endif; ?>
    </div>
    <div class="boys">
        <a href="/catalog?group=Мальчик" class="title">Мальчик</a>
        <? if($this->bottomMenu["boys"]): ?>
            <ul>
                <? foreach($this->bottomMenu["boys"] as $item): ?>
                    <li><a href="/catalog?group=Мальчик&cat=<?=$item["id"]?>"><?=$item["name"]?></a></li>
                <? endforeach; ?>
            </ul>
        <? endif; ?>
    </div>
    <div class="babies">
        <a href="/catalog?group=Малыши" class="title">Малыши</a>
        <? if($this->bottomMenu["childs"]): ?>
            <ul>
                <? foreach($this->bottomMenu["childs"] as $item): ?>
                    <li><a href="/catalog?group=Малыши&cat=<?=$item["id"]?>"><?=$item["name"]?></a></li>
                <? endforeach; ?>
            </ul>
        <? endif; ?>
    </div>
    <div class="brands">
        <a href="#" onclick="return false" class="title">По брендам</a>
        <? if($this->bottomMenu["brands"]): ?>
            <ul>
                <? foreach($this->bottomMenu["brands"] as $item): ?>
                    <li><a href="/catalog?brand=<?=$item["code"]?>"><?=$item["name"]?></a></li>
                <? endforeach; ?>
            </ul>
        <? endif; ?>
    </div>
</nav>

<footer>
    <div class="footer-wrap">
        <div class="footer width">
            <p class="copyright">© 2013, ООО «<span>Аравелия</span>»</p>
            <p class="adress">Тюмень, ул. Луговая 2-я, 30, ТРЦ “Па-На-Ма”, 3-й этаж</p>
            <a target="_blank" href="http://amobile-studio.ru" class="a-mobile">Всегда только лучшие идеи</a>
        </div>
    </div>
</footer>

<!-- Модальное окно отправки сообщения -->
<div id="modal-feedback">
    <div class="modal-header">
        <div class="modal-title">Вы можете<br>оставить сообщение<br>или задать вопрос</div>
    </div>
    <div class="modal-content">
        <form method="post" action="/site/feedback">
            <? Yii::app()->session["feedback_key"] = md5(uniqid()); ?>
            <input type="hidden" name="key" value="<?=Yii::app()->session["feedback_key"]?>" />
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
        <a href="/page/landing" class="more_button">В клуб</a>
        <a href="/" class="more_button">В интернет-магазин</a>
    </div>
</div>

</body>
</html>