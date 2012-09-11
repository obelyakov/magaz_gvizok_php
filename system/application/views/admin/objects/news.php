<script type="text/javascript" src="/js/jquery.collapser.js"></script>
<?if(isset($mess) && $mess):?><div><p class="error"><?=$mess;?></p></div><?endif;?>
<div id="tmp_form">

</div>
<div class="grid_16  ">
    <h2>Рабочая зона</h2>
    <? if(isset($act_ok) and $act_ok=='add_ok'):?>
        <p style="color:red;">Объект успешно добавлен</p>
    <? elseif( $act_ok=='del_ok'):?>
        <p style="color:red;">Объект успешно удален</p>
    <?endif;?>
    <a href="/admin/objects/add/">Добавить</a>
    <ul>
    <?if(is_array($list)) foreach($list as $i):?>
        <li><a href="/admin/objects/edit/<?=$i->id;?>"><?=word_limiter($i->text, 7);?></a>
            <a href="/admin/objects/del/<?=$i->id;?>"><img src="http://newlegion.loc/adminnn/images/ico/remove16.png"></img></a></li>
    <?endforeach;?>
    </ul>
</div>