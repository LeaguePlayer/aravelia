<?php
if($reviews):
?>
<section class="content width">
    <h1>Что говорят о нас дети и их родители</h1>
    <div class="reviews">
        <? foreach($reviews as $r): ?>
            <div class="review">
                <div class="review_text">
                    <?=$r->text?>
                </div>
                <div class="review_author">
                    <span class="name"><?=$r->name?></span>
                    <span class="age"><?=$r->age?> <?=$r->ageLabel?></span>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</section>
<? endif; ?>