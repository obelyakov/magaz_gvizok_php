<script>
    $(document).ready(function(){
        $("#edit").submit(function() {
            $(this).ajaxSubmit(function(data) {
                $('#tmp_form').text('');
                $('#tmp_form').dialog('destroy');
                //$(data).appendTo($('#tmp_message_form'));//.appendTo
            });
            return false;
        })
        
    });
</script>
Редактирование товара
<form method="post" action="/admin/goods/ajax_edit_post" id="edit">
    <input type="hidden"  name="good_id" value="<?=$good_id;?>">
    <input type="hidden"  name="seria_id" value="<?=$seria_id;?>">
<? foreach($tcf as $v):?>
    <b><?=$v->name;?></b> <small>(<?=$v->descr;?>)</small><br>
    <?if($v->ftype == 'text'):?>
        <textarea name="id_filedtc[<?=$v->id_filedtc;?>]" cols="150" rows="10"><?=$val[$v->id_filedtc];?></textarea>
    <?else:?>
        <input type="text" name="id_filedtc[<?=$v->id_filedtc;?>]" size="150" value="<?=$val[$v->id_filedtc];?>"><br>
    <?endif;?>
<? endforeach; ?>
        <input type="submit" value="Редактировать">
</form>