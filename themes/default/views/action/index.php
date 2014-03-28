<?php

?>

<? if($model): ?>
    <section class="box-white shadow section">
        <? if($model->img_photo): ?>
            <img src="<?=$model->getImageUrl("normal")?>" alt="">
        <? endif; ?>
        <h2>
            <?=SiteHelper::russianDate($model->dt_date)?><br>
            <?=$model->name?>
        </h2>
        <?=$model->wswg_desc?>
        <div class="clearfix"></div>
    </section>
<? endif; ?>

<? if(!empty($model->wswg_concurs_desc)): ?>
    <section class="box-white shadow section">
        <h2>Конкурсные работы</h2>
        <?=$model->wswg_concurs_desc?>
        <? if($concursGallery): ?>
            <div class="photos">
                <? foreach($concursGallery as $photo): ?>
                    <a class="fancybox" rel="photos" href="<?=$photo->getUrl("big")?>" title="<?=$photo->name.".".$photo->description?>"><img src="<?=$photo->getUrl("normal")?>" alt="" /></a>
                <? endforeach; ?>
            </div>
        <? endif; ?>
    </section>
<? endif; ?>

<? if($model): ?>
    <section class="box-white shadow section">
        <h2>Как прошло мероприятие</h2>
        <? if($photoGallery): ?>
            <div id="photo1" class="photo-carousel">
                <a href="#" class="prev" onclick="return false;"></a>
                <a href="#" class="next" onclick="return false;"></a>

                <div class="photo-carousel-items">
                    <ul>
                        <? foreach($photoGallery as $p): ?>
                            <li><a class="fancybox" rel="action" href="<?=$p->getUrl("big");?>" title="<?=$p->name.". ".$p->description?>"><img src="<?=$p->getUrl("small");?>" alt="" width="80" height="80" ></a></li>
                        <? endforeach; ?>
                    </ul>
                </div>
            </div>
        <? endif; ?>
        <div class="video_content">
            <? if($model->video): ?>
                <div class="video">
                    <iframe src="//player.vimeo.com/video/<?=($model->video)?>" width="516" height="290" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            <? endif; ?>
            <div class="video_description">
                <?=$model->wswg_desc;?>
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