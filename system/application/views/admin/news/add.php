<?=$this->validation->error_string; ?>

<?=form_open('/admin/news/add'); ?>

<label>Титул
    <input type="text" name="title" size="100" value="<?=set_value('title');?>" />
</label>

<label>Анонс
    <textarea name="anons" cols="102"><?=set_value('anons');?></textarea>
</label>

<label>Текст
    <textarea name="text" cols="102" rows="10"><?=set_value('text');?></textarea>
</label>

<div><input type="submit" value="Отправить" /></div>

</form>