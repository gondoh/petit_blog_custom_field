<?php
/**
 * [ADMIN] petit_blog_custom_field
 *
 * @copyright		Copyright 2013, materializing.
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
?>
<?php if($this->action == 'admin_add'): ?>
	<?php echo $bcForm->create('PetitBlogCustomField', array('url' => array('action' => 'add'))) ?>
<?php else: ?>
	<?php echo $bcForm->create('PetitBlogCustomField', array('url' => array('action' => 'edit'))) ?>
	<?php echo $bcForm->input('PetitBlogCustomField.id', array('type' => 'hidden')) ?>
	<?php echo $bcForm->input('PetitBlogCustomField.blog_post_id', array('type' => 'hidden')) ?>
	<?php echo $bcForm->input('PetitBlogCustomField.blog_content_id', array('type' => 'hidden')) ?>
<?php endif ?>

<?php $bcBaser->element('petit_blog_custom_field_form') ?>

<div class="submit">
<?php if($this->action == 'admin_add'): ?>
	<?php echo $bcForm->submit('登録', array('div' => false, 'class' => 'btn-red button')) ?>
<?php else: ?>
	<?php echo $bcForm->submit('更新', array('div' => false, 'class' => 'btn-red button')) ?>
	<?php $bcBaser->link('削除',
		array('action' => 'delete', $bcForm->value('PetitBlogCustomField.id')),
		array('class' => 'btn-gray button'),
		sprintf('ID：%s のデータを削除して良いですか？', $bcForm->value('PetitBlogCustomField.id')),
		false); ?>
<?php endif ?>
</div>
<?php echo $bcForm->end() ?>
