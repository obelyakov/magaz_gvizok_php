<?=$this->validation->error_string; ?>

<?=form_open('/admin/news/edit/'.$item->id); ?>
<?if(isset($mess)):?><p style="color:red">Отредактировано</p><?endif;?>
<input type="hidden" name="id" size="100" value="<?=set_value('id', $item->id);?>" />   
<label>Титул
    <input type="text" name="title" size="100" value="<?=set_value('title', $item->title);?>" />
</label>

<label>Анонс
    <textarea name="anons" cols="102"><?=set_value('anons', $item->anons);?></textarea>
</label>

<label>Текст
    <textarea name="text" cols="102" rows="10"><?=set_value('text', $item->text);?></textarea>
</label>

<div><input type="submit" value="Отправить" /></div>

</form>