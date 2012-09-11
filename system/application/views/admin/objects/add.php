<?=$this->validation->error_string; ?>

<?=form_open('/admin/objects/add'); ?>

<label>Текст
    <textarea name="text" cols="102" rows="10"><?=set_value('text');?></textarea>
</label>

<div><input type="submit" value="Отправить" /></div>

</form>