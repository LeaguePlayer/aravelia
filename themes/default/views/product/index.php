<?php
/* @var $this ProductController */
$this->title = $model->name;
?>

<section class="content width">
    <h1><?=$model->name?></h1>
    <div class="page left shadow product">
        <div class="product_top">
            <div class="product_img">
                <? if($photos):
                    foreach($photos as $k => $p):
                    ?>
                        <? if($k===0): ?>
                            <a class="fancybox" rel="photo" href="<?=$p->getUrl("big")?>"><img src="<?=$p->getUrl("medium")?>" alt="<?=$p->name?>"></a>
                        <? else: ?>
                            <a class="fancybox" rel="photo" href="<?=$p->getUrl("big")?>"><img width="75" src="<?=$p->getUrl("small")?>" alt="<?=$p->name?>"></a>
                    <?
                        endif;
                    endforeach;
                else:
                    ?>
                    <img src="/media/images/no_photo.png" alt="Нет фото"/>
                    <?
                endif;
                ?>
            </div>
            <div class="product_feature">
                <div class="product_text">
                    <p><?=$model->wswg_desc?></p>
                </div>
                <div class="product_price">
                    <span><?=$sizes[0]["price"]?></span> руб.
                </div>
                <div class="product_addbasket">
                    <form id="form-product_add" action="" method="post">
                        <input type="hidden" name="product_id" value="<?=$model["id"]?>" />
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