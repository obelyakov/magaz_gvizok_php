<table cellpadding="10px">
<tr>
    <td valign="bottom"><img src="/i/shap/6.png"> </td>
    <td valign="bottom"><img src="/i/shap/12.png"> </td>
    <td valign="bottom"><img src="/i/shap/8.png"> </td>
    <td valign="bottom"><img src="/i/shap/9.png"> </td>
    <td valign="bottom"><img src="/i/shap/7.png"> </td>
    <td valign="bottom"><img src="/i/shap/13.png"> </td>
    <td valign="bottom"><img src="/i/shap/5.png"> </td>
</tr>
<?foreach($goods as $v):?>
    <? $temp =array();?>
    <? foreach($v->get_value()->get_value() as $vv):?>
        <? $temp[$vv->id_fieldtc] = $vv->value;?>
    <?endforeach;?>
<tr>
    <td><a href="/good/lift_one/<?=$v->get_id();?>"><?=$temp[154];?></a></td>
    <td><?=$temp[155];?></td>
    <td><?=$temp[156];?></td>
    <td><?=$temp[157];?></td>
    <td><?=$temp[158];?></td>
    <td><?=$temp[159];?></td>
    <td><?=$temp[160];?></td>
</tr>


<?endforeach;?>
</table>