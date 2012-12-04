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