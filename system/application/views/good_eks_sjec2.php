<h1>Эскалаторы SJEC <?=$good['152'];?></h1>

<!-- Блок продукции -->
<div class="product-page">
    <!-- Левая колонка -->
    <div class="col">
        <h3>Характеристики:</h3>

        <table class="parameters">
            <tr><td>Модель <td><?=$good['152'];?></tr>
            <tr><td>Угол наклона(град)<td><?=$good['139'];?></tr>
            <tr><td>Ширина ступени (мм)<td><?=$good['140'];?></tr>
            <tr><td>Высота подъема (м)<td><?=$good['141'];?></tr>
            <tr><td>Скорость (м/с) <td><?=$good['142'];?></tr>
        </table>

        <?=$good['149'];?>

        <? if(isset($file) && count($file)):?>
        <h3>Скачать материалы:</h3>

        <div class="attachments">
            <?foreach($file as $v):?>
            <p><a href="/uploads/<?=$v->fname;?>"><?=$v->real_fname;?></a></p>
            <?endforeach;?>
        </div>
        <? endif;?>
    </div>
    <!-- /Левая колонка. Правая колонка -->
    <div class="col">
        <div class="carousel">
            <div class="full-image">
                <? if(isset($foto) && count($foto)):?><img src="/uploads/<?=$foto[0]->fname?>"><?endif;?>
            </div>
            <div class="thumbs">
                <i class="icon-prev1"></i>
                <i class="icon-next1"></i>
                <div class="thumbs-scroller">
                    <ul>
                        <? if(isset($foto) && count($foto)):?>
                            <?foreach($foto as $v):?>
                                <li><a href="/uploads/<?=$v->fname?>"><img src="/uploads/thumb_<?=$v->fname?>"></a></li>
                            <?endforeach;?>
                        <?endif;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Колонка 2-->
</div>
<!-- /Блок продукции -->