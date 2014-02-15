<?php
/**
 * [ADMIN] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
?>
<?php if($this->action == 'admin_add'): ?>
	<?php echo $this->BcForm->create('PetitBlogCustomField', array('url' => array('action' => 'add'))) ?>
<?php else: ?>
	<?php echo $this->BcForm->create('PetitBlogCustomField', array('url' => array('action' => 'edit'))) ?>
	<?php echo $this->BcForm->input('PetitBlogCustomField.id', array('type' => 'hidden')) ?>
	<?php echo $this->BcForm->input('PetitBlogCustomField.blog_post_id', array('type' => 'hidden')) ?>
	<?php echo $this->BcForm->input('PetitBlogCustomField.blog_content_id', array('type' => 'hidden')) ?>
<?php endif ?>

<?php $this->BcBaser->element('petit_blog_custom_field_form') ?>

<div class="submit">
<?php if($this->action == 'admin_add'): ?>
	<?php echo $this->BcForm->submit('登録', array('div' => false, 'class' => 'btn-red button')) ?>
<?php else: ?>
	<?php echo $this->BcForm->submit('更新', array('div' => false, 'class' => 'btn-red button')) ?>
	<?php $this->BcBaser->link('削除',
		array('action' => 'delete', $this->BcForm->value('PetitBlogCustomField.id')),
		array('class' => 'btn-gray button'),
		sprintf('ID：%s のデータを削除して良いですか？', $this->BcForm->value('PetitBlogCustomField.id')),
		false); ?>
<?php endif ?>
</div>
<?php echo $this->BcForm->end() ?>
