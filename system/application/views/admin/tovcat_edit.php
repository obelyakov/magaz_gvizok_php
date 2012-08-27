<style>
    input.tcf {width: 200px;}
    input.tcf50 {width: 50px;}
    input.tcf100 {width: 100px;}
    input.tcf300 {width: 300px;}
    select.tcf100 {width: 100px;}
    a.act{text-decoration: none;}
</style>

<script>
    $(document).ready(function () {
        $('#addbut').click(function(){
            $('#fieldlist tbody>tr:last').clone(true).insertAfter('#fieldlist tbody>tr:last');
            // ставим id = пустоте т.к. новое поле
            $('#fieldlist tbody>tr:last td .id_filedtc').val("");
            return false;
        });
        

        $('table td #delrow').click(function(){
            $(this).parent().parent().remove();return false;
        });
    });
    
</script>
<?if(isset($mess) && $mess):?><div><p class="error"><?=$mess;?></p></div><?endif;?>
<h1>Добавление товарной категории</h1>
<form method="post" action="/admin/tovcat/addedit/">
<? if(isset($id) && $id):?>
    <input type="hidden" name="id" value="<?=$id;?>">
<?endif;?>
<div class="grid_8">
    <p>
        <label for="name">Название <small>Название только для внутреннего использования</small></label>
        <input type="text" name="tc_name" value="<?if(isset($tc[0]->name)) echo $tc[0]->name;?>">
    </p>
</div>    
<div class="grid_8">
    <p>
        <label for="descr">Описание<small>Описание только для внутреннего использования</small></label>
        <input type="text" name="tc_descr" value="<?if(isset($tc[0]->descr)) echo $tc[0]->descr;?>">
    </p>
</div>

<div class="grid_16">
<h2>Поля (характеристики товарной категории)</h2>
<table id="fieldlist">
    <thead>
    <tr>
        <th>Название</th>
        <th>Тип</th>
        <th>Размер</th>
        <th>Порядок</th>
        <th>На главной</th>
        <th>Описание</th>
        <th title="Добавить строку"><a href="#" class="act" id="addbut">+</a></th>
    </tr>
    </thead>
    <tbody>
    <?if(isset($tcf) && $tcf):?>
        <!-- если редактируем -->
        <? foreach($tcf as $v):?>
            <tr>
                <td>
                    <input type="hidden" name="id_filedtc[]" class="id_filedtc" value="<?=$v->id_filedtc;?>">
                    <input type="text" name="name[]" class="tcf100" value="<?=$v->name;?>">
                </td>
                <td>
                    <select name="ftype[]" class="tcf100">
                        <option value="string" <?if($v->ftype=='string'):?>selected<?endif;?>>Строка</option>
                        <option value="int" <?if($v->ftype=='int'):?>selected<?endif;?>>Число</option>
                        <option value="text" <?if($v->ftype=='text'):?>selected<?endif;?>>Текст</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="size[]" class="tcf50" value="<?=$v->size;?>">
                </td>
                <td>
                    <input type="text" name="order[]" class="tcf50" value="<?=$v->order;?>">
                </td>
                <td>
                    <select name="onmain[]" class="tcf100">
                        <option value="Y" <?if($v->onmain=='Y'):?>selected<?endif;?>>Да</option>
                        <option value="N" <?if($v->onmain=='N'):?>selected<?endif;?>>Нет</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="descr[]" class="tcf100" value="<?=$v->descr;?>">
                </td>
                <td><a id="delrow" class="act" href="#" >-</a></td>
            </tr>
        <?endforeach;?>
        
    <?else:?>
    <tr>
        <td>
            <input type="text" name="name[]" class="tcf300">
        </td>
        <td>
            <select name="ftype[]" class="tcf100">
                <option value="string">Строка</option>
                <option value="int">Число</option>
                <option value="text">Текст</option>
            </select>
        </td>
        <td>
            <input type="text" name="size[]" class="tcf50">
        </td>
        <td>
            <input type="text" name="descr[]" class="tcf300">
        </td>
        <td><a id="delrow" class="act" href="#">-</a></td>
    </tr>
    <? endif;?>
    </tbody>
    
</table>    
<input type="submit" name="addedit" value="Добавить">
</div>


</form>