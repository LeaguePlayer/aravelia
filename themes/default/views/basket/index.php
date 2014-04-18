<?php
/* @var $this BasketController */
$this->title = "Ваша корзина товаров";
?>
<?
if(!Yii::app()->request->isAjaxRequest)
    echo '<section class="content width">';
?>
    <h1>Ваша корзина</h1>
    <div class="basket page">
        <? if($products != null): ?>
        <form action="" method="post">
        <table id="basket-list">
            <thead>
            <tr>
                <th colspan="2">Товар</th>
                <th>Характеристики</th>
                <th>Колличество</th>
                <th class="price_product">Цена</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?
                $price = 0;
                foreach($products as $p):
                    $price += $p["price"];
            ?>
            <tr>
                <td class="img_product"><img src="<?=Product::getMainPhotoUrl($p["gllr_photos"], "small")?>" width="40"></td>
                <td class="link_product"><a target="_blank" href="/product?id=<?=$p["id"]?>"><?=$p["name"]?></a></td>
                <td class="feature_product"><?=$p["group"]?>, <?=$p["country"]?>, <?=$p["value"]?></td>
                <td class="count_product">
                    <input type="text" name="count[<?=$p["id"]?>]" data-id="<?=$p["id"]?>" data-balans="<?=$p["bid"]?>" data-price="<?=$p["price"]?>" data-count="<?=$p["count"]?>" value="1"> шт.
                </td>
                <td class="price_product"><span><?=$p["price"]?></span> руб.</td>
                <td class="del_product"><a data-id="<?=$p["id"]?>" title="Удалить" href="#"></a></td>
            </tr>
            <? endforeach; ?>
            <tr>
                <td class="price_all_products" colspan="5">Итого: <span><?=$price?></span> руб.</td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <div class="order-complete">
            <input id="order-complete-button" class="more_button" type="submit" value="Оформить заказ">
            <p class="order-complete-text">
                <img src="/media/images/warning.png" alt="">
                Чтобы воспользоваться услугой <a target="_blank" href="/page/mobile">Мобильный продавец</a>, необходимо<br> добавить товаров на сумму более 500 руб.
            </p>
            <div class="clearfix"></div>
        </div>
        <? else: ?>
            <p>В вашей корзине товаров нет.</p>
        <? endif; ?>
    </div>
    </form>
<?
if(!Yii::app()->request->isAjaxRequest)
    echo '</section>';
?>

<?
if(!Yii::app()->request->isAjaxRequest)
    $this->widget('application.components.favorite.favoriteWidget');
?>

<?
if(!Yii::app()->request->isAjaxRequest)
    $this->widget('application.components.see_products.seeProducts');
?>
