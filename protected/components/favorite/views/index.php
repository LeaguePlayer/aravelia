<?php
if($favorites):
?>
<section class="recent width box-white favorites">
    <a href="#" id="clear_favorites" class="link-blue">Удалить все</a>
    <a href="#" id="favorites_in_basket" class="link-pink">Переместить все в корзину</a>
    <h2>Избранные товары</h2>
    <div class="favorites-carousel">
        <a href="#" class="prev" onclick="return false;"></a>
        <a href="#" class="next" onclick="return false;"></a>

        <div class="favorites-carousel-items">
            <ul>
                <!--
                 <li>
                     <img src="/media/images/item1.jpg" alt="" width="80" height="80" >
                     <div class="favorite-control">
                         <a href="#" class="basket_favorite">В корзину</a>
                         <a href="#" class="view_favorite">Cмотреть</a>
                         <a href="#" class="del_favorite">Удалить</a>
                     </div>
                 </li>
             -->
            <? foreach($favorites as $f): ?>
                <li><a title="<?=$f["name"]?>" href="/product?id=<?=$f["id"]?>"><img src="/media/images/item1.jpg" alt="<?=$f["name"]?>" width="80" height="80" ></a></li>
            <? endforeach; ?>
            </ul>
        </div>
    </div>
</section>
<?
endif;
?>