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
<?php echo $this->BcForm->create('PetitBlogCustomFieldConfig', array('url' => array('action' => 'index'))) ?>
<p>
	<span>
		<?php echo $this->BcForm->label('PetitBlogCustomFieldConfig.blog_content_id', 'ブログ') ?>
		&nbsp;<?php echo $this->BcForm->input('PetitBlogCustomFieldConfig.blog_content_id', array('type' => 'select', 'options' => $blogContentDatas)) ?>
	</span>
</p>
<div class="button">
	<?php echo $this->BcForm->submit('admin/btn_search.png', array('alt' => '検索', 'class' => 'btn'), array('div' => false, 'id' => 'BtnSearchSubmit')) ?>
</div>
<?php echo $this->BcForm->end() ?>
