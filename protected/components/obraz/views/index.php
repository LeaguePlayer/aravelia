<?php
if($products):
?>
<div class="page right shadow product">
    <div class="modal-title">Похожие товары</div>
    <div class="clothes">
        <? foreach($products as $p): ?>
            <a href="/product?id=<?=$p["id"]?>" class="item">
                <img width="220" src="<?=Product::getMainPhotoUrl($p["gllr_photos"], "medium")?>">
                <div class="item-title">
                    <div>
                        <h5><?=$p["name"]?></h5>
                    </div>
                </div>
            </a>
        <? endforeach; ?>
    </div>
</div>
<?
endif;
?>