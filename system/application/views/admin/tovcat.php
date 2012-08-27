<?if(isset($items) && is_array($items)):?>
<h1>Товарные категории</h1>
<table>
    <tr><th>#</th><th>Название</th><th>Описание</th><th colspan="2" style="width:200px;">Действия</th></tr>
<? foreach($items as $v):?>
<tr>
    <td><?=$v->id_tovcat;?></td>
    <td><?=$v->name;?></td>
    <td><?=$v->descr;?></td>
    
    <td><a href="/admin/tovcat/edit/<?=$v->id_tovcat;?>" class="edit">Редактировать</a></td>
    <td><a href="/admin/tovcat/del_tovcat/<?=$v->id_tovcat;?>" class="delete">Удалить</a></td>

</tr>


<?endforeach;?>


</table>
<?else:?>
Пока ничего нет
<?endif;?>
<form action="/admin/tovcat/add/" method="post">
<input type="submit" name="add" value="Новую">
</form>