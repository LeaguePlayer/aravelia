<?php
if($products != null):
?>
<section class="recent width box-white">
    <a href="#" id="clear_viewed" class="link-blue">Очистить все</a>
    <h2>Недавно просмотренные</h2>
    <div class="viewed-carousel">
        <a href="#" class="prev" onclick="return false;"></a>
        <a href="#" class="next" onclick="return false;"></a>

        <div class="viewed-carousel-items">
            <ul>
                <? foreach($products as $p): ?>
                <li><a title="<?=$p["name"]?>" href="/product?id=<?=$p["id"]?>"><img src="<?=Product::getMainPhotoUrl($p["gllr_photos"])?>" alt="" width="80" height="80" ></a></li>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
</section>
<?
endif;
?>