<script type="text/javascript" src="/js/jquery.collapser.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.demo6').collapser({
	target: 'siblings',
	effect: 'slide',
	expandHtml: 'Развернуть',
	collapseHtml: 'Свернуть',
	expandClass: 'expArrow',
	collapseClass: 'collArrow'
    });
    
    $('#add_good_but').live('click', function() {
        $('#tmp_form').load("/admin/goods/add/"+<?=$seria_id;?>);
        $('#tmp_form').dialog({
            'width': '1200',
            'height': '600',
            'title' : 'Добавление товара',
            close: function() {
                $('#tmp_form').html('');
            }
        })
        return false;
    })

    $('a.cl_edit_good').live('click', function() {
        $('#tmp_form').load("/admin/goods/editone/"+ $(this).parent().parent().attr('data_goodid') +"/");
        $('#tmp_form').dialog({
            'width': '1200',
            'height': '600',
            'title' : 'Редактирование товара',
            close: function() {
                $('#tmp_form').html('');
            }
        })
        return false;
    })

    $('a.cl_del_good').live('click', function() {
        return confirm('Удалить товар?');
    })

});

</script>
<?if(isset($mess) && $mess):?><div><p class="error"><?=$mess;?></p></div><?endif;?>
<div id="tmp_form">

</div>
<div class="grid_7">    
    <h2>Дерево серий</h2>
    <ul>
        <?=$shtml;?>
    </u>
</div>
<div class="grid_9">
    <h2>Рабочая зона</h2>
    <?if(isset($goods) && !is_array($goods) && $goods=='nogood'):?>
        <?if(isset($nogood) && $nogood==1):?>
            <b style="color:red">Нет товаров в серии</b><br>
            <a id="add_good_but" href="#">Добавить товар в серию</a>
        <?else:?>
            <b style="color:red">Выберите серию</b>
        <?endif;?>
    <?else:?>
    <a id="add_good_but" href="#">Добавить товар в серию</a>
    <table>
        <tr>
            <?foreach($shap as $v):?>
                <?if($v->onmain=='Y'):?>
                    <th><?=$v->name;?></th>
                <?endif;?>
            <?endforeach;?>
            <th>#</th>
            <th>x</th>
        </tr>
    <?foreach($goods as $v):?>
        <? $good = $v->get_value()->get_value();?>
        <tr class="goods_tr" data_goodid="<?=$good[0]->id_good;?>">
            <?foreach($good as $vv):?>
                <? if(in_array($vv->id_fieldtc, $onmain) && isset($vv->value)):?>
                    <td><?=$vv->value;?></td>
                <?endif;?>
            <?endforeach;?>
            <td><a class="cl_edit_good" href="">#</a></td>
            <td><a class="cl_del_good" href="/admin/goods/delone/<?=$good[0]->id_good;?>"><img src="/adminnn/images/ico/remove16.png"></a></td>
        </tr>
    
    
    <?endforeach;?>
    </table>
    <?endif;?>

</div>