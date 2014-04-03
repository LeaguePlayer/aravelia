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
        <a href="/" class="logo"><img src="/media/images/logo.png" alt="Aravelia. Клубный салон детской одежды."></a>
        <a href="/page/landing" class="club-name">
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
                    <? if($this->cat["girls"]): ?>
                    <ul>
                        <? foreach($this->cat["girls"] as $k=>$v): ?>
                            <li class="subitem">
                                <a href="/catalog?group=Девочка&char=<?=$k?>"><?=$k?></a>
                                <ul>
                                    <? foreach($v as $c): ?>
                                        <li><a href="/catalog?group=Девочка&char=<?=$k?>&cat=<?=$c["id"]?>"><?=$c["name"]?></a></li>
                                    <? endforeach; ?>
                                </ul>
                            </li>
                        <? endforeach; ?>
                    </ul>
                    <? else: ?>
                        <ul><li class="subitem"><a href="#">Нет товаров</a></li></ul>
                    <? endif; ?>
                </div>
            </li>
            <li class="item">
                <a href="/catalog?group=Мальчик">Мальчик</a><span></span>
                <div class="subitems">
                    <? if($this->cat["boys"]): ?>
                    <ul>
                        <? foreach($this->cat["boys"] as $k=>$v): ?>
                            <li class="subitem">
                                <a href="/catalog?group=Мальчик&char=<?=$k?>"><?=$k?></a>
                                <ul>
                                    <? foreach($v as $c): ?>
                                        <li><a href="/catalog?group=Мальчик&char=<?=$k?>&cat=<?=$c["id"]?>"><?=$c["name"]?></a></li>
                                    <? endforeach; ?>
                                </ul>
                            </li>
                        <? endforeach; ?>
                    </ul>
                    <? else: ?>
                        <ul><li class="subitem"><a href="#">Нет товаров</a></li></ul>
                    <? endif; ?>
                </div>
            </li>
            <li class="item">
                <a href="/catalog?group=Малыши">Малыши</a><span></span>
                <div class="subitems">
                    <? if($cat["childs"]): ?>
                    <ul>
                        <? foreach($this->cat["childs"] as $k=>$v): ?>
                            <li class="subitem">
                                <a href="/catalog?group=Малыши&char=<?=$k?>"><?=$k?></a>
                                <ul>
                                    <? foreach($v as $c): ?>
                                        <li><a href="/catalog?group=Малыши&char=<?=$k?>&cat=<?=$c["id"]?>"><?=$c["name"]?></a></li>
                                    <? endforeach; ?>
                                </ul>
                            </li>
                        <? endforeach; ?>
                    </ul>
                    <? else: ?>
                        <ul><li class="subitem"><a href="#">Нет товаров</a></li></ul>
                    <? endif; ?>
                </div>
            </li>
            <li class="item">
                <a href="#">По брендам</a><span></span>
                <div class="subitems">
                    <ul>
                        <li class="subitem">
                            <a href="/catalog?goup=Девочка">Девочка</a>
                            <? if($this->brands["girls"]): ?>
                            <ul>
                                <? foreach($this->brands["girls"] as $b): ?>
                                    <li><a href="/catalog?goup=Девочка&brand=<?=$b["code"]?>"><?=$b["name"]?></a></li>
                                <? endforeach; ?>
                            </ul>
                            <? else: ?>
                                <ul><li class="subitem"><a href="#">Нет брендов</a></li></ul>
                            <? endif; ?>
                        </li>
                        <li class="subitem">
                            <a href="/catalog?goup=Мальчик">Мальчик</a>
                            <? if($this->brands["boys"]): ?>
                                <ul>
                                    <? foreach($this->brands["boys"] as $b): ?>
                                        <li><a href="/catalog?goup=Мальчик&brand=<?=$b["code"]?>"><?=$b["name"]?></a></li>
                                    <? endforeach; ?>
                                </ul>
                            <? else: ?>
                                <ul><li class="subitem"><a href="#">Нет брендов</a></li></ul>
                            <? endif; ?>
                        </li>
                        <li class="subitem">
                            <a href="/catalog?goup=Малыши">Малыши</a>
                            <? if($this->brands["childs"]): ?>
                                <ul>
                                    <? foreach($this->brands["childs"] as $b): ?>
                                        <li><a href="/catalog?goup=Малыши&brand=<?=$b["code"]?>"><?=$b["name"]?></a></li>
                                    <? endforeach; ?>
                                </ul>
                            <? else: ?>
                                <ul><li class="subitem"><a href="#">Нет брендов</a></li></ul>
                            <? endif; ?>
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
        <form method="post" action="/site/feedback">
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
        <form method="post" action="/site/order">
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

<!-- Модальное окно оформления заказа -->
<div id="modal-order-mobile">
    <div class="modal-header">
        <div class="modal-title">Оформление заявки</div>
    </div>
    <div class="modal-content">
        <form method="post" action="/site/mobile">
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
            Можете <a href="#" id="big-order-complete-button-mobile" class="link-blue">перейти к полному<br> оформлению заказа</a>
        </p>
    </div>
</div>

<!-- Модальное окно полного оформления заказа -->
<div id="modal-order-big">
    <div class="modal-header">
        <div class="modal-title">Оформление заявки</div>
    </div>
    <div class="modal-content">
        <form method="post" action="/site/order">
            <input type="text" name="name" placeholder="Ваше имя">
            <input type="text" name="phone" placeholder="Телефон">
            <input type="text" name="email" placeholder="E-mail">
            <textarea name="address" placeholder="Ваш адрес" rows="3"></textarea>
            <select name="delivery" id="delivery">
                <option value="Курьерская доставка">Курьерская доставка (200 руб.)</option>
                <option value="Самовывоз">Самовывоз (0 руб.)</option>
            </select>
            <select name="payment" id="payment">
                <option value="Оплата банковской картой">Оплата банковской картой</option>
                <option value="Оплата наличными">Оплата наличными</option>
            </select>
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

<!-- Модальное окно полного оформления заказа мобильного продавца -->
<div id="modal-order-big-mobile">
    <div class="modal-header">
        <div class="modal-title">Оформление заявки</div>
    </div>
    <div class="modal-content">
        <form method="post" action="/site/mobile">
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