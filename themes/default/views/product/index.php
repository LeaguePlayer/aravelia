<?php
/* @var $this ProductController */
?>

<section class="content width">
    <h1><?=$product["name"]?></h1>
    <div class="page left shadow product">
        <div class="product_top">
            <div class="product_img">
                <a class="fancybox" rel="photo" href="/media/images/nike.jpg"><img src="/media/images/nike.jpg" alt=""></a>
                <a class="fancybox" rel="photo" href="/media/images/nike.jpg"><img width="75" src="/media/images/nike.jpg" alt=""></a>
                <a class="fancybox" rel="photo" href="/media/images/nike.jpg"><img width="75" src="/media/images/nike.jpg" alt=""></a>
                <a class="fancybox" rel="photo" href="/media/images/nike.jpg"><img width="75" src="/media/images/nike.jpg" alt=""></a>
                <a class="fancybox" rel="photo" href="/media/images/nike.jpg"><img width="75" src="/media/images/nike.jpg" alt=""></a>
            </div>
            <div class="product_feature">
                <div class="product_text">
                    <p><?=$product["wswg_desc"]?></p>
                </div>
                <div class="product_price">
                    <span><?=$sizes[0]["price"]?></span> руб.
                </div>
                <div class="product_addbasket">
                    <form id="form-product_add" action="" method="post">
                        <input type="hidden" name="product_id" value="<?=$product["id"]?>" />
                        <select name="size" id="size">
                            <option value="0">Ростовка</option>
                            <?
                            if($sizes):
                                foreach($sizes as $s):
                            ?>
                            <option data-price="<?=$s["price"]?>" value="<?=$s["id"]?>"><?=$s["value"]?></option>
                            <?
                                endforeach;
                            endif;
                            ?>
                        </select>
                        <input type="submit" class="more_button" value="Добавить в корзину">
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="product_middle">
            <span class="count_info">В наличии на складе</span>
            <a href="#" id="addfavorite">Добавить в избранное</a>
        </div>
        <div class="product_bottom">
            <ul class="tabs" data-content="product_info">
                <li class="tabs-item active"><a href="#info">Информация</a></li>
                <li class="tabs-item"><a href="#delivery">Доставка</a></li>
                <li class="tabs-item"><a href="#mobile">Мобильный продавец</a></li>
            </ul>
            <div id="product_info" class="tabs-content">
                <div id="info">
                    <p>
                        1 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                    </p>
                </div>
                <div id="delivery">
                    <p>
                        2 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                    </p>
                </div>
                <div id="mobile">
                    <p>
                        3 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                    </p>
                </div>
            </div>
        </div>
    </div>

<?
$this->widget('application.components.obraz.obrazWidget');
?>

    <div class="clearfix"></div>
</section>
<?
$this->widget('application.components.see_products.seeProducts');
?>