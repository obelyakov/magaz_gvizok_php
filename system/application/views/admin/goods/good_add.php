<script>
    $(document).ready(function(){
        $("#add").submit(function() {
            $(this).ajaxSubmit(function(data) {
                $('#tmp_form').text('');
                $('#tmp_form').dialog('destroy');
                //$(data).appendTo($('#tmp_message_form'));//.appendTo
            });
            return false;
        })
        
    });
</script>

Добавление товара
<form method="post" action="/admin/goods/ajax_add_post" id="add">
    <input type="hidden"  name="seria_id" value="<?=$seria_id;?>">
<? foreach($tcf as $v):?>
    <b><?=$v->name;?></b> <small>(<?=$v->descr;?>)</small><br>
    <?if($v->ftype == 'text'):?>
        <textarea name="id_filedtc[<?=$v->id_filedtc;?>]" cols="150" rows="10"></textarea>
    <?else:?>
        <input type="text" name="id_filedtc[<?=$v->id_filedtc;?>]" size="150"><br>
    <?endif;?>
<? endforeach; ?>
        <input type="submit" value="Добавить">
</form>