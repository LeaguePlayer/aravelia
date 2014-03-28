    <? if($model->type == Order::getType("sertificat")):
        $orderCert = $model->orderCertificates;
        if($orderCert):
        ?>
        <h3>Заказанные сертификаты</h3>
        <table class="table table-striped">
            <tr>
                <th>#</th>
                <th>Сертификат</th>
                <th>Кол-во</th>
                <th>Цена</th>
            </tr>
            <? foreach($orderCert as $k => $cert): ?>
            <tr>
                <td><?=($k+1)?></td>
                <td><a target="_blank" href="/admin/certificate/update/id/<?=$cert->certificate_id?>"><?=$cert->certificate->name?></a></td>
                <td><?=$cert->count?> шт.</td>
                <td><?=number_format($cert->price,2,"."," ")?> руб.</td>
            </tr>
            <? endforeach; ?>
            <tr>
                <td style="text-align: right" colspan="3"><b>Итого:</b></td>
                <td><?=number_format($model->price,2,"."," ")?> руб.</td>
            </tr>
        </table>
    <?
        endif;
    endif;
    ?>

    <? if($model->type == Order::getType("product")):
        $orderProducts = $model->orderProducts;
        if($orderProducts):
            ?>
            <h3>Заказанные товары</h3>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Товар</th>
                    <th>Артикул</th>
                    <th>Размер</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                </tr>
                <? foreach($orderProducts as $k => $p): ?>
                    <tr>
                        <td><?=($k+1)?></td>
                        <td><a target="_blank" href="/admin/product/update/id/<?=$p->product_id?>"><?=$p->product->name?></a></td>
                        <td><?=$p->product->article?></td>
                        <td>1</td>
                        <td><?=$p->count?> шт.</td>
                        <td><?=number_format($p->price,2,"."," ")?> руб.</td>
                    </tr>
                <? endforeach; ?>
                <tr>
                    <td style="text-align: right" colspan="5"><b>Итого:</b></td>
                    <td><?=number_format($model->price,2,"."," ")?> руб.</td>
                </tr>
            </table>
        <?
        endif;
    endif;
    ?>