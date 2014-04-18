<section class="content width">
    <h1>Подарочные сертификаты</h1>
    <div class="page left shadow">
        <? if($sertificats): ?>
        <form id="sertificats-list">
        <table id="sertificat-list">
            <tbody>
            <? foreach($sertificats as $sert): ?>
            <tr>
                <td class="img_sert"><img src="<?=$sert->imgBehaviorPhoto->getImageUrl("small")?>" width="40" height="40"></td>
                <td class="title_sert"><?=$sert->name?></td>
                <td class="count_sert">
                    <input type="text" name="count[<?=$sert->id?>]" value="1" data-id="<?=$sert->id?>" data-price="<?=$sert->price?>"> шт.
                </td>
                <td class="price_sert"><span><?=$sert->price?></span> руб.</td>
                <td class="check_sert">
                    <div class="switch">
                        <input name="sert[<?=$sert->id?>]" type="checkbox" id="switch-<?=$sert->id?>" class="switch-check">
                        <label for="switch-<?=$sert->id?>" class="switch-label">
                            Опция
                            <span class="switch-slider switch-slider-on"></span>
                            <span class="switch-slider switch-slider-off"></span>
                        </label>
                    </div>
                </td>
            </tr>
            <? endforeach; ?>
            <tr>
                <td colspan="4" class="itog_sert_price">
                    <div id="check_sert_message" class="popover top" style="top: -155px;left: 497px;">
                        <div class="arrow"></div>
                        <div class="popover-content" style="height: 42px;">
                            <p style="padding: 0;margin: 0;">Выберите сертификат</p>
                        </div>
                    </div>
                    Итого: <span>0</span> руб.
                </td>
                <td></td>
            </tr>
            </tbody>
        </table>
        </form>
        <? endif; ?>
    </div>

    <div class="page right shadow">
        <div class="modal-header">
            <div class="modal-title">Приобрести сертификат</div>
        </div>
        <div class="modal-content">
            <form id="sertificat-order-form" method="post">
                <input type="text" name="name" placeholder="Ваше имя">
                <input type="text" name="phone" placeholder="Телефон">
                <? if($address): ?>
                    <select name="address">
                        <? foreach($address as $a): ?>
                        <option value="Забрать на <?=$a?>">Забрать на <?=$a?></option>
                        <? endforeach; ?>
                    </select>
                <? endif; ?>
                <input type="submit" class="more_button" value="Оформить">
            </form>
        </div>
        <div class="modal-footer">
            <p>
                <img src="/media/images/lock.png" alt="lock">
                Введенные личные данные в безопасности и не будут переданы третьим лицам
            </p>
        </div>
    </div>

    <div class="clearfix"></div>
</section>