<?php
/* @var $this CatalogController */
?>
<section class="content width">
    <h1>Одежда для малышей, <?=$_GET["char"]?> см.</h1>

    <div class="filter">
        <ul>
            <li class="active"><a href="#">Верх</a></li>
            <li><a href="#">Низ</a></li>
            <li><a href="#">Куртки</a></li>
            <li><a href="#">Платья</a></li>
            <li><a href="#">Комплекты</a></li>
            <li><a href="#">Нижнее белье</a></li>
            <li><a href="#">Обувь</a></li>
        </ul>
        <div class="expand">
            <a href="#" class="show-filter">Развернуть фильтр</a>
            <a href="#" class="hide-filter">Свернуть фильтр</a>
            <div class="filter-form">
                <form>
                    <select>
                        <option>Бренд Gakkard</option>
                        <option>Бренд Gakkard</option>
                        <option>Бренд Gakkard</option>
                    </select>
                    <select>
                        <option>Девочки</option>
                        <option>Мальчики</option>
                        <option>Младенцы</option>
                    </select>
                    <select>
                        <option>Ростовка 116-170</option>
                        <option>Ростовка 116-170</option>
                        <option>Ростовка 116-170</option>
                    </select>
                    <input type="submit" class="more_button" value="Применить фильтр">
                </form>
            </div>
        </div>
    </div>

        <?
        if(count($products)>0):
        ?>
            <div class="clothes">
            <?
            foreach($products as $p):
            ?>
                <a href="/product?id=<?=$p["id"]?>" class="item">
                    <img src="/media/images/item1.jpg">
                    <div class="item-title">
                        <div>
                            <h5><?=$p["name"]?></h5>
                        </div>
                    </div>
                </a>
            <?
            endforeach;
            ?>
            </div>
        <?
        else:
        ?>
            <div class="page shadow">
                <h2>Товаров не найдено!</h2>
            </div>
        <?
        endif;
        ?>
</section>

<section class="recent width box-white">
    <a href="#" id="clear_viewed" class="link-blue">Очистить все</a>
    <h2>Недавно просмотренные</h2>
    <div class="viewed-carousel">
        <a href="#" class="prev" onclick="return false;"></a>
        <a href="#" class="next" onclick="return false;"></a>

        <div class="viewed-carousel-items">
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