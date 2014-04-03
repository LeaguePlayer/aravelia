<?php
/* @var $this CatalogController */
$this->title = "Каталог товаров";
?>
<section class="content width">
    <h1><?=$cat_text?></h1>

    <div class="filter">
        <? if($categories):
            $get_cat = $get;
            if(isset($_GET["cat"])){
                $key = array_search("cat=".$_GET["cat"],$get_cat);
                if($key !== false)
                    unset($get_cat[$key]);
            }
            if(isset($_GET["page"])){
                $key = array_search("page=".$_GET["page"],$get_cat);
                if($key !== false)
                    $get_cat[$key] = "page=1";;
            }
            ?>
        <ul>
            <? foreach($categories as $c): ?>
            <li <?=($_GET['cat']==$c["id"]) ? 'class="active"' : ''; ?>><a href="/catalog?<?=implode("&",$get_cat)?>&cat=<?=$c["id"]?>"><?=$c["name"]?></a></li>
            <? endforeach; ?>
        </ul>
        <? else: ?>

        <? endif; ?>
        <div class="expand">
            <a href="#" class="show-filter">Развернуть фильтр</a>
            <a href="#" class="hide-filter">Свернуть фильтр</a>
            <div class="filter-form">
                <form>

                    <? if($brands): ?>
                        <select name="brand">
                            <option value="0">Бренд</option>
                            <? foreach($brands as $b): ?>
                                <option value="<?=$b['code']?>" <? echo ($b["code"]==$_GET["brand"]) ? 'selected="selected"' : '' ?>><?=$b['name']?></option>
                            <? endforeach; ?>
                        </select>
                    <? endif; ?>

                    <? if($groups): ?>
                        <select name="group">
                            <? foreach($groups as $g): ?>
                                <? if(!empty($g["group"])): ?>
                                    <option value="<?=$g["group"]?>" <? echo ($g["group"]==$_GET["group"]) ? 'selected="selected"' : '' ?>><?=$g["group"]?></option>
                                <? endif; ?>
                            <? endforeach; ?>
                        </select>
                    <? endif; ?>

                    <? if($this->cat["girls"]): ?>
                    <select name="char">
                        <option>Ростовка</option>
                        <? foreach($this->cat["girls"] as $k=>$v): ?>
                            <option value="<?=$k?>"><?=$k?></option>
                        <? endforeach; ?>
                    </select>
                    <? endif; ?>
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
                    <? if($p["photo_id"] != null): ?>
                        <img width="220" src="/media/images/<?=$p["photo_id"]?>medium.jpg">
                    <? else: ?>
                        <img width="220" src="/media/images/no_photo2.png">
                    <? endif; ?>
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

<? if($pages->pageCount>1): ?>
<div class="width box-white pagination">
    <?php $this->widget('CLinkPager', array(
        'pages' => $pages,
        'header' => '',
    )) ?>
</div>
<? endif; ?>

<?
$this->widget('application.components.see_products.seeProducts');
?>