<h1>Новости</h1>
<div class="news-list">
    <!-- Закрывающие dt и dd тут можно опустить, стандарт позволяет -->
    <?foreach($list as $v):?>
    <dl>
        <dt>
        </dt><dd>
        <p class="title"><a href="/news/item/<?=$v->id;?>"><?=$v->title;?></a></p>
        <p><?=$v->anons;?></p>
        <p class="date">/ <?=date('d.m.Y', strtotime($v->date));?> /</p>
        </dd>
    </dl>
    <?endforeach;?>
</div>
<div class="pagination">
    <div class="title">Страницы:</div>
    <a href="#" class="prev">←</a>
    <div class="pages">
        <?foreach($pl as $v):?>
        <?endforeach;?>
        <a href="#">1</a>
        <a href="#">2</a>
        <div>3</div>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">7</a>
        <a href="#">8</a>
        <a href="#">9</a>
        <a href="#">10</a>
    </div>
    <a href="#" class="next">→</a>
</div>
