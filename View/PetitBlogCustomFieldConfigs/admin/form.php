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
	<?php echo $bcForm->create('PetitBlogCustomFieldConfig', array('url' => array('action' => 'add'))) ?>
<?php else: ?>
	<?php echo $bcForm->create('PetitBlogCustomFieldConfig', array('url' => array('action' => 'edit'))) ?>
	<?php echo $bcForm->input('PetitBlogCustomFieldConfig.id', array('type' => 'hidden')) ?>
<?php endif ?>

<h2><?php echo $blogContentDatas[$this->data['PetitBlogCustomFieldConfig']['blog_content_id']] ?></h2>
<?php $bcBaser->element('petit_blog_custom_field_config_form') ?>

<div class="submit">
	<?php echo $bcForm->submit('保　存', array('div' => false, 'class' => 'btn-red button')) ?>
</div>
<?php echo $bcForm->end() ?>
