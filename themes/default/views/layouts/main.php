<?php
	$cs = Yii::app()->clientScript;
	$cs->registerCssFile($this->getAssetsUrl().'/css/normalize.min.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/popover.min.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/main.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/style.css');
	
	$cs->registerScriptFile($this->getAssetsUrl().'/js/vendor/modernizr-2.6.2.min.js', CClientScript::POS_HEAD);

	$cs->registerScriptFile($this->getAssetsUrl().'/js/min/jquery-1.9.1.min.js', CClientScript::POS_HEAD);
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
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title><?=$this->title?> / Aravelia</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,800,700,300&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
</head>
<body>
<?
//echo "<pre>";
//print_r($this->cat);
//echo "</pre>";
?>
<header>
    <div class="header width">
        <a href="/page/1" class="logo"><img src="/media/images/logo.png" alt="Aravelia. Клубный салон детской одежды."></a>
        <a href="/page/3" class="club-name">
            <div class="club-name-body">
                <h1>Детский клуб</h1>
                <h5>салона детской одежды</h5>
            </div>
        </a>
        <div class="cart-wrap">
            <a href="/basket" class="cart">
                <h4>Ваша  корзина</h4>
                <h5 id="basket_info"><span class="products_count">0</span> <span class="products_count_text">товаров</span>, <span class="products_price">0</span> руб.</h5>
            </a>
        </div>
    </div>
</header>

<nav class="top-menu width">
    <div class="top-menu-body">
        <ul>
            <li class="item">
                <a href="/catalog?group=Девочка">Девочка</a><span></span>
                <div class="subitems">
                    <ul>
                        <? foreach($this->cat["girls"] as $k=>$v): ?>
                            <li class="subitem">
                                <a href="/catalog?group=Девочка&char=<?=$k?>"><?=$k?></a>
                                <ul>
                                    <? foreach($v as $c): ?>
                                        <li><a href="/catalog?group=Девочка&char=98-104&cat=<?=$c["id"]?>"><?=$c["name"]?></a></li>
                                    <? endforeach; ?>
                                </ul>
                            </li>
                        <? endforeach; ?>
<!--                        <li class="subitem">-->
<!--                            <a href="/catalog?group=Девочка&char=104-110">104-110</a>-->
<!--                            <ul>-->
<!--                                <li><a href="/catalog?group=Девочка&char=104-110&cat=210">Блузки</a></li>-->
<!--                                <li><a href="/catalog?group=Девочка&char=104-110&cat=198">Футболки</a></li>-->
<!--                                <li><a href="/catalog?group=Девочка&char=104-110&cat=206">Юбки</a></li>-->
<!--                                <li><a href="/catalog?group=Девочка&char=104-110&cat=214">Брюки</a></li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                        <li class="subitem">-->
<!--                            <a href="/catalog?group=Девочка&char=110-116">110-116</a>-->
<!--                            <ul>-->
<!--                                <li><a href="/catalog?group=Девочка&char=110-116&cat=210">Блузки</a></li>-->
<!--                                <li><a href="/catalog?group=Девочка&char=110-116&cat=198">Футболки</a></li>-->
<!--                                <li><a href="/catalog?group=Девочка&char=110-116&cat=206">Юбки</a></li>-->
<!--                                <li><a href="/catalog?group=Девочка&char=110-116&cat=214">Брюки</a></li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                        <li class="subitem">-->
<!--                            <a href="/catalog?group=Девочка&char=116-122">116-122</a>-->
<!--                            <ul>-->
<!--                                <li><a href="/catalog?group=Девочка&char=116-122&cat=210">Блузки</a></li>-->
<!--                                <li><a href="/catalog?group=Девочка&char=116-122&cat=198">Футболки</a></li>-->
<!--                                <li><a href="/catalog?group=Девочка&char=116-122&cat=274">Юбки</a></li>-->
<!--                                <li><a href="/catalog?group=Девочка&char=116-122&cat=214">Брюки</a></li>-->
<!--                            </ul>-->
<!--                        </li>-->
                    </ul>
                </div>
            </li>
            <li class="item">
                <a href="/catalog?group=Мальчик">Мальчик</a><span></span>
                <div class="subitems">
                    <ul>
                        <li class="subitem">
                            <a href="/catalog?group=Мальчик&char=80-86">80-86</a>
                            <ul>
                                <li><a href="/catalog?group=Мальчик&char=80-86&cat=365">Майка</a></li>
                                <li><a href="/catalog?group=Мальчик&char=80-86&cat=182">Рубашка</a></li>
                                <li><a href="/catalog?group=Мальчик&char=80-86&cat=120">Брюки</a></li>
                                <li><a href="/catalog?group=Мальчик&char=80-86&cat=227">Колготки</a></li>
                            </ul>
                        </li>
                        <li class="subitem">
                            <a href="/catalog?group=Мальчик&char=86-98">86-98</a>
                            <ul>
                                <li><a href="/catalog?group=Мальчик&char=86-98&cat=147">Майка</a></li>
                                <li><a href="/catalog?group=Мальчик&char=86-98&cat=182">Рубашка</a></li>
                                <li><a href="/catalog?group=Мальчик&char=86-98&cat=120">Брюки</a></li>
                                <li><a href="/catalog?group=Мальчик&char=86-98&cat=361">Куртка</a></li>
                            </ul>
                        </li>
                        <li class="subitem">
                            <a href="/catalog?group=Мальчик&char=98-110">98-110</a>
                            <ul>
                                <li><a href="/catalog?group=Мальчик&char=98-110&cat=147">Майка</a></li>
                                <li><a href="/catalog?group=Мальчик&char=98-110&cat=372">Рубашка</a></li>
                                <li><a href="/catalog?group=Мальчик&char=98-110&cat=357">Брюки</a></li>
                                <li><a href="/catalog?group=Мальчик&char=98-110&cat=143">Куртка</a></li>
                            </ul>
                        </li>
                        <li class="subitem">
                            <a href="/catalog?group=Мальчик&char=110-122">110-122</a>
                            <ul>
                                <li><a href="/catalog?group=Мальчик&char=110-122&cat=307">Майка</a></li>
                                <li><a href="/catalog?group=Мальчик&char=110-122&cat=262">Рубашка</a></li>
                                <li><a href="/catalog?group=Мальчик&char=110-122&cat=214">Брюки</a></li>
                                <li><a href="/catalog?group=Мальчик&char=110-122&cat=335">Свитер</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="item">
                <a href="/catalog?group=Малыши">Малыши</a><span></span>
                <div class="subitems">
                    <ul>
                        <li class="subitem">
                            <a href="/catalog?group=Малыши&char=40-56">40-56</a>
                            <ul>
                                <li><a href="/catalog?group=Малыши&char=40-56&cat=200">Шапка</a></li>
                                <li><a href="/catalog?group=Малыши&char=40-56&cat=136">Комбинезон</a></li>
                            </ul>
                        </li>
                        <li class="subitem">
                            <a href="/catalog?group=Малыши&char=56-68">56-68</a>
                            <ul>
                                <li><a href="/catalog?group=Малыши&char=56-68&cat=390">Распашонка</a></li>
                                <li><a href="/catalog?group=Малыши&char=56-68&cat=161">Пижама</a></li>
                                <li><a href="/catalog?group=Малыши&char=56-68&cat=117">Боди</a></li>
                                <li><a href="/catalog?group=Малыши&char=56-68&cat=371">Подарочный набор</a></li>
                            </ul>
                        </li>
                        <li class="subitem">
                            <a href="/catalog?group=Малыши&char=68-74">68-74</a>
                            <ul>
                                <li><a href="/catalog?group=Малыши&char=68-74&cat=179">Распашонка</a></li>
                                <li><a href="/catalog?group=Малыши&char=68-74&cat=140">Кофта</a></li>
                                <li><a href="/catalog?group=Малыши&char=68-74&cat=120">Брюки</a></li>
                            </ul>
                        </li>
                        <li class="subitem">
                            <a href="/catalog?group=Малыши&char=74-86">74-86</a>
                            <ul>
                                <li><a href="/catalog?group=Малыши&char=74-86&cat=117">Боди</a></li>
                                <li><a href="/catalog?group=Малыши&char=74-86&cat=120">Брюки</a></li>
                                <li><a href="/catalog?group=Малыши&char=74-86&cat=140">Кофта</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="item">
                <a href="#">По брендам</a><span></span>
                <div class="subitems">
                    <ul>
                        <li class="subitem">
                            <a href="#">Младенцы</a>
                            <ul>
                                <li><a href="#">Верх</a></li>
                                <li><a href="#">Низ</a></li>
                                <li><a href="#">Боди, ползунки</a></li>
                                <li><a href="#">Комплекты</a></li>
                            </ul>
                        </li>
                        <li class="subitem">
                            <a href="#">Младенцы</a>
                            <ul>
                                <li><a href="#">Верх</a></li>
                                <li><a href="#">Низ</a></li>
                                <li><a href="#">Боди, ползунки</a></li>
                                <li><a href="#">Комплекты</a></li>
                            </ul>
                        </li>
                        <li class="subitem">
                            <a href="#">Младенцы</a>
                            <ul>
                                <li><a href="#">Верх</a></li>
                                <li><a href="#">Низ</a></li>
                                <li><a href="#">Боди, ползунки</a></li>
                                <li><a href="#">Комплекты</a></li>
                            </ul>
                        </li>
                        <li class="subitem">
                            <a href="#">Младенцы</a>
                            <ul>
                                <li><a href="#">Верх</a></li>
                                <li><a href="#">Низ</a></li>
                                <li><a href="#">Боди, ползунки</a></li>
                                <li><a href="#">Комплекты</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <p class="main-phone">8  (3452) 52-07-92</p>
        <a href="#" class="feedback">Написать нам</a>
    </div>
</nav>

<?php echo $content; ?>

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

<!-- Модальное окно оформления заказа -->
<div id="modal-order">
    <div class="modal-header">
        <div class="modal-title">Оформление заявки</div>
    </div>
    <div class="modal-content">
        <form method="post">
            <input type="text" name="name" placeholder="Ваше имя">
            <input type="text" name="phone" placeholder="Телефон">
            <input type="submit" class="more_button" value="Отправить">
        </form>
    </div>
    <div class="modal-footer">
        <p>
            <img src="/media/images/lock.png" alt="lock">
            Введенные личные данные в безопасности и не будут переданы третьим лицам
        </p>
        <p>
            У вас есть лишние 2 минуты?<br>
            Можете <a href="#" id="big-order-complete-button" class="link-blue">перейти к полному<br> оформлению заказа</a>
        </p>
    </div>
</div>

<!-- Модальное окно полного оформления заказа -->
<div id="modal-order-big">
    <div class="modal-header">
        <div class="modal-title">Оформление заявки</div>
    </div>
    <div class="modal-content">
        <form method="post">
            <input type="text" name="name" placeholder="Ваше имя">
            <input type="text" name="phone" placeholder="Телефон">
            <input type="text" name="email" placeholder="E-mail">
            <textarea name="address" placeholder="Ваш адрес" rows="3"></textarea>
            <textarea name="messages" placeholder="Комментарий" rows="3"></textarea>
            <input type="submit" class="more_button" value="Оформить заявку">
        </form>
    </div>
    <div class="modal-footer">
        <p>
            <img src="/media/images/lock.png" alt="lock">
            Введенные личные данные в безопасности и не будут переданы третьим лицам
        </p>
    </div>
</div>

<!-- Модальное успешного оформления заказа -->
<div id="modal-order-true">
    <div class="modal-header">
        <div class="modal-title">Спасибо</div>
    </div>
    <div class="modal-content">
        <p>
            Вы удачно оформили заказ на нашем сайте. Наш мненеджер обязательно свяжеться с вами для уточненния заказа. Мы всегда рады видеть Вас в нашем магазине.
        </p>
        <p>
            Мы также регулярно проводим мероприятия и конкурсы, Вашим детям понравится!
        </p>
    </div>
    <div class="modal-footer">
        <a href="/" class="more_button">В клуб</a>
    </div>
</div>

<!-- Модальное окно добавления товара в корзину -->
<div id="modal-addProduct">
    <div class="modal-header">
        <div class="modal-title">Товар в корзине</div>
    </div>
    <div class="modal-content">
        <p>
            Теперь вы можете перейти в корзину для оформления заказа, либо продолжить покупки
        </p>
    </div>
    <div class="modal-footer">
        <a href="/basket" class="more_button">Перейти в корзину</a>
        <a href="#" onclick="$.modal.close(); return false;" class="more_button">Вернуться к покупкам</a>
    </div>
</div>

<!-- Модальное окно добавления товара в избранное -->
<div id="modal-addFavorite">
    <div class="modal-header">
        <div class="modal-title">Товар добавлен<br> в избранное</div>
    </div>
    <div class="modal-content">
        <p>
            Теперь вы можете перейти в корзину для просмотра избранных товаров, либо продолжить покупки
        </p>
    </div>
    <div class="modal-footer">
        <a href="/basket" class="more_button">Перейти в корзину</a>
        <a href="#" onclick="$.modal.close(); return false;" class="more_button">Вернуться к покупкам</a>
    </div>
</div>

</body>
</html>