<?php
//print_r($model);

?>
<? if($model): ?>
<section class="box-white shadow section">
    <? if($model->img_preview): ?>
        <img src="<?=$model->getImageUrl("normal")?>" alt="">
    <? endif; ?>
    <?=$model->wswg_body?>
    <div class="clearfix"></div>
</section>
<? endif; ?>

<? if($action): ?>
<section class="box-white shadow section">
    <? if($action->img_photo): ?>
        <img src="<?=$action->getImageUrl("normal")?>" alt="">
    <? endif; ?>
    <h2>
        <?=SiteHelper::russianDate($action->dt_date)?><br>
        <?=$action->name?>
    </h2>
    <?=$action->wswg_desc?>
    <p>
        <a href="#form-club" class="more_button">Записаться на мероприятие</a>
    </p>
    <div class="clearfix"></div>
</section>
<? endif; ?>

<? if(!empty($action->wswg_concurs_desc)): ?>
    <section class="box-white shadow section">
        <h2>Конкурсные работы</h2>
        <?=$action->wswg_concurs_desc?>
    <? if($concursGallery): ?>
        <div class="photos">
            <? foreach($concursGallery as $photo): ?>
                <a class="fancybox" rel="photos" href="<?=$photo->getUrl("big")?>" title="<?=$photo->name.".".$photo->description?>"><img src="<?=$photo->getUrl("normal")?>" alt="" /></a>
            <? endforeach; ?>
        </div>
    <? endif; ?>
    </section>
<? endif; ?>

<? if($oldAction): ?>
<section class="box-white shadow section">
    <h2>Посмотрите как прошло прошлое мероприятие</h2>
    <? if($oldActionGallery): ?>
    <div id="photo1" class="photo-carousel">
        <a href="#" class="prev" onclick="return false;"></a>
        <a href="#" class="next" onclick="return false;"></a>

        <div class="photo-carousel-items">
            <ul>
                <? foreach($oldActionGallery as $p): ?>
                <li><a class="fancybox" rel="action" href="<?=$p->getUrl("big");?>" title="<?=$p->name.". ".$p->description?>"><img src="<?=$p->getUrl("small");?>" alt="" width="80" height="80" ></a></li>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
    <? endif; ?>
    <div class="video_content">
        <? if($oldAction->video): ?>
        <div class="video">
            <?=($oldAction->video)?>
        </div>
        <? endif; ?>
        <div class="video_description">
            <?=$oldAction->wswg_desc;?>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
<? endif; ?>

<? if($oldActionAll): ?>
<section class="box-white shadow section">
    <h2>Прошедшие мероприятия</h2>
    <div id="photo2" class="photo-carousel">
        <a href="#" class="prev" onclick="return false;"></a>
        <a href="#" class="next" onclick="return false;"></a>

        <div class="photo-carousel-items">
            <ul>
                <? foreach($oldActionAll as $oa): ?>
                <li><a title="<?=$oa->name?>" href="/action?id=<?=$oa->id?>"><img src="<?=$oa->getImageUrl("small")?>" alt="" width="80" height="80" ></a></li>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
</section>
<? endif; ?>