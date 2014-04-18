<section class="content">
    <nav class="main-tiles width">
        <a href="/page/about" class="tile">
            <img src="/media/images/aesthetic.jpg">
            <div class="tile-title">
                <p>Помогаем сформировать эстетическое развитие</p>
            </div>
        </a>
        <a href="/page/mobile" class="tile">
            <img src="/media/images/mobile-shop.jpg">
            <div class="tile-title">
                <p>Магазин у Вас дома!</p>
                <p>Мобильный продавец</p>
            </div>
        </a>
        <a href="/page/sertificats" class="tile">
            <img src="/media/images/gift.jpg">
            <div class="tile-title">
                <p>Не знаете, что подарить?</p>
                <p>Подарите подарочный сертификат!</p>
            </div>
        </a>
    </nav>
    <? if($products): ?>
    <div class="clothes width">
        <? foreach($products as $p): ?>
        <a href="/product?id=<?=$p["id"]?>" class="item">
            <img src="<?=Product::getMainPhotoUrl($p["gllr_photos"],"medium")?>">
            <div class="item-title">
                <div>
                    <h5><?=$p["name"]?></h5>
                </div>
            </div>
        </a>
        <? endforeach; ?>
    </div>
    <? endif; ?>
</section>

<section class="activity width">
    <div class="take-part">
        <h3>Ваш ребенок может поучаствовать в самых ярких мероприятиях нашего клуба</h3>
        <a href="/page/landing" class="more_button">Узнать больше</a>
    </div>
</section>