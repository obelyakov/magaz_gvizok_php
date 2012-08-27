<script type="text/javascript" src="/js/jquery.collapser.js"></script>
<?if(isset($mess) && $mess):?><div><p class="error"><?=$mess;?></p></div><?endif;?>
<div id="tmp_form">

</div>
<div class="grid_16  ">
    <h2>Рабочая зона</h2>
    <? if(isset($act_ok) and $act_ok=='add_ok'):?>
        <p style="color:red;">Новость успешно добавлена</p>
    <? elseif( $act_ok=='del_ok'):?>
        <p style="color:red;">Новость успешно удалена</p>
    <?endif;?>
    <a href="/admin/news/add/">Добавить</a>
    <ul>
    <?foreach($list as $i):?>
        <li><a href="/admin/news/edit/<?=$i->id;?>"><?=$i->title;?></a>
            <a href="/admin/news/del/<?=$i->id;?>"><img src="http://newlegion.loc/adminnn/images/ico/remove16.png"></img></a></li>
    <?endforeach;?>
    </ul>
</div>