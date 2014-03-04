<?php
/* @var $this BasketController */
?>
<section class="content width">
    <h1>Ваша корзина</h1>
    <div class="basket page">
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
            <tr>
                <td class="img_product"><img src="/media/images/item6.jpg" width="40" height="40"></td>
                <td class="link_product"><a href="#">Футболка коллекционная</a></td>
                <td class="feature_product">Серая, XXL</td>
                <td class="count_product">
                    <input type="text" name="count[1]" data-id="1" data-price="1100" value="1"> шт.
                </td>
                <td class="price_product"><span>1 100</span> руб.</td>
                <td class="del_product"><a data-id="1" title="Удалить" href="#"></a></td>
            </tr>
            <tr>
                <td class="img_product"><img src="/media/images/item6.jpg" width="40" height="40"></td>
                <td class="link_product"><a href="#">Футболка коллекционная</a></td>
                <td class="feature_product">Серая, XXL</td>
                <td class="count_product">
                    <input type="text" name="count[2]" data-id="2" data-price="1200" value="1"> шт.
                </td>
                <td class="price_product"><span>1 200</span> руб.</td>
                <td class="del_product"><a data-id="2" title="Удалить" href="#"></a></td>
            </tr>
            <tr>
                <td class="img_product"><img src="/media/images/item6.jpg" width="40" height="40"></td>
                <td class="link_product"><a href="#">Футболка коллекционная</a></td>
                <td class="feature_product">Серая, XXL</td>
                <td class="count_product">
                    <input type="text" name="count[3]" data-id="3" data-price="1300" value="1"> шт.
                </td>
                <td class="price_product"><span>1 300</span> руб.</td>
                <td class="del_product"><a data-id="3" title="Удалить" href="#"></a></td>
            </tr>
            <tr>
                <td class="price_all_products" colspan="5">Итого: <span>18 454</span> руб.</td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <div class="order-complete">
            <input id="order-complete-button" class="more_button" type="submit" value="Оформить заказ">
            <p class="order-complete-text">
                <img src="/media/images/warning.png" alt="">
                Чтобы воспользоваться услугой <a target="_blank" href="/mobile.html">Мобильный продавец</a>, необходимо<br> добавить товаров на сумму более 500 руб.
            </p>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
