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
});
</script>
<?if(isset($mess) && $mess):?><div><p class="error"><?=$mess;?></p></div><?endif;?>
<div class="grid_7">    
    <h2>Дерево</h2>
    Добавить серию в первый уровнь <?=$level0_addbut;?>
    <ul>
        <?=$shtml;?>
    </u>
</div>
<div class="grid_9">
    <h2>Рабочая зона</h2>
    
    <?if(isset($mode)):?>
        <h3><?=$wzn;?></h3>
        <p><b>Путь</b>: <?=$path;?></p>
        <form method="post">
            <input type="hidden" name="id" value="<? if(isset($item->id_seria)) echo $item->id_seria;?>">
        <label>
            Наименование серии<input type="text" name="sname" value="<? if(isset($item->sname)) echo $item->sname;?>">
        </label>
        <label>
            Товарная категория
            <select name="id_tovcat">
                <option value="0">Не выбрана...</option>
                <?foreach($tc as $v):?>
                    <option <?if(isset($item) && $item->id_tovcat==$v->id_tovcat):?>selected<?endif;?> value="<?=$v->id_tovcat;?>"><?=$v->name;?></option>
                <?endforeach;?>
            </select>
        </label>
            <input type="submit" name="edit_seria" value="Ок"><input type="reset" value="Сброс">
        </form>
    <?endif;?>
</div>
            


    
