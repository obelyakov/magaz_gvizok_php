<?=$this->validation->error_string; ?>

<?=form_open_multipart('/admin/objects/edit/'.$item->id); ?>
<?if(isset($mess)):?><p style="color:red">Отредактировано</p><?endif;?>
<input type="hidden" name="id" size="100" value="<?=set_value('id', $item->id);?>" />   
<label>Текст
    <textarea name="text" cols="102" rows="10"><?=set_value('text', $item->text);?></textarea>
</label>
<label>Картинка
    <? if($item->fname):?>
    <img src="/uploads/<?=$this->config->item('foto_thumb').set_value('fname', $item->fname);?>">
    <?endif;?>
<input type="file" name="userfile" size="20" />
<div><input type="submit" value="Отправить" /></div>
</label>
</form>