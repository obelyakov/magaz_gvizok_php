<h1>Лифт <?=$good['150'];?></h1>

<!-- Блок продукции -->
<div class="product-page">
    <!-- Левая колонка -->
    <div class="col">
        <h3>Характеристики:</h3>

        <table class="parameters">
            <tr><td>Модель <td><?=$good['150'];?></tr>
            <tr><td>Грузоподъемность (кг)<td><?=$good['132'];?></tr>
            <tr><td>Скорость (м/с) <td><?=$good['133'];?></tr>
            <tr><td>Размеры кабины (Ш х Г)<td><?=$good['134'];?></tr>
            <tr><td>Размеры шахты (Ш х Г) <td><?=$good['135'];?></tr>
            <tr><td>Размеры дверей (Ш)<td><?=$good['136'];?></tr>
            <tr><td>Глубина приямка (мм) <td><?=$good['137'];?></tr>
            <tr><td>Высота последнего этажа (мм) <td><?=$good['138'];?></tr>
        </table>

        <?=$good['148'];?>

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