<h1>Наши объекты</h1>

<ul class="gallery">
    <?foreach($list  as $v):?>
    <li>
        <a href="/uploads/<?=$v->fname;?>" rel="prettyPhoto[gallery]" title="<?=$v->text;?>">
            <span><i class="icon-zoom"></i></span>
            <img src="/uploads/thumb_<?=$v->fname;?>">
        </a>
        <?=$v->text;?>
    </li>
    <?endforeach;?>
</ul>

<!--div class="pagination">
    <div class="title">Страницы:</div>
    <div class="pages">
        <div>1</div>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">7</a>
        <a href="#">8</a>
        <a href="#">9</a>
        <a href="#">10</a>
    </div>
    <a href="#" class="next">&rarr;</a>
</div-->