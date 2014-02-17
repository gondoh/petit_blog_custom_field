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
<?php if($this->request->action == 'admin_add'): ?>
	<?php echo $this->BcForm->create('PetitBlogCustomFieldConfig', array('url' => array('action' => 'add'))) ?>
<?php else: ?>
	<?php echo $this->BcForm->create('PetitBlogCustomFieldConfig', array('url' => array('action' => 'edit'))) ?>
	<?php echo $this->BcForm->input('PetitBlogCustomFieldConfig.id', array('type' => 'hidden')) ?>
<?php endif ?>

<h2><?php echo $blogContentDatas[$this->request->data['PetitBlogCustomFieldConfig']['blog_content_id']] ?></h2>
<?php $this->BcBaser->element('petit_blog_custom_field_config_form') ?>

<div class="submit">
	<?php echo $this->BcForm->submit('保　存', array('div' => false, 'class' => 'btn-red button')) ?>
</div>
<?php echo $this->BcForm->end() ?>
